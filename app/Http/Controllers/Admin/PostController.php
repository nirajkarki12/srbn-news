<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use Metatags;
use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use App\Models\Poll;
use App\Models\Polloption;
use App\Models\Gallery;

class PostController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        /* firebase set values */
        NotificationController::setValues();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $parentSlug = null)
    {

      $posts = Post::orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));
      if($posts->count() == 0 && $posts->currentPage() !== 1) {
         return redirect()->route('admin.post');
      }
      return view('admin.post.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = $request->except('_token');

            $validator = Validator::make( $data, [
                'title' => 'required|max:255',
                'category' => 'required',
                'description' => 'required|min:50',
                'type' => 'required',
                'urls' => 'required_if:type,'.(Post::TYPE_IMAGE),
                'youtubeUrl' => 'url|required_if:type,'.(Post::TYPE_VIDEO),
                'source' => 'nullable|max:150',
                'source_url' => 'nullable|url',
                'audio_url' => 'nullable|url',
                'status' => 'required',
               ]
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);
            if($request->question && (!$request->option1 || !$request->option2)) throw new \Exception('Question given but both options not found');

            $post = new Post;
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->note = $data['note'];
            $post->type = $data['type'];
            $post->source = $data['source'] ?: $data['source_url'];
            $post->source_url = $data['source_url'];
            $post->source_url2 = $data['source_url2'] ?: null;
            $post->source_url3 = $data['source_url3'] ?: null;
            $post->audio_url = $data['audio_url'];
            $post->status = $data['status'];
            $post->lang = $data['lang'];
            $post->is_full_width = array_key_exists('is_full_width', $data) ? $data['is_full_width'] : 0;
            $post->save();

            if($request->type == Post::TYPE_IMAGE && is_array($request->urls)) {
                $urls = [];
                foreach ($request->urls as $url) {
                    array_push($urls, new Gallery(['url' => $url]));
                }
                $post->galleries()->saveMany($urls);
            }elseif($request->type == Post::TYPE_VIDEO) {
                $videoUrl = new Gallery(['url' => $request->youtubeUrl]);
                $post->galleries()->save($videoUrl);
            }

            if(isset($data['category']))
            {
                $post->categories()->attach($data['category']);

                /* firebase notification sending */
                try {
                    /* get users subscribed to the categories the post belongs */
                    $users = User::whereHas('userCategories', function($q) use ($data){
                        $q->whereIn('id', $data['category']);
                    })->get();

                    foreach($users as $user) {
                        NotificationController::newPost($user, $post);
                    }
                } catch (\Throwable $th) {

                }
            }

             if($request->question) {
                 $post->poll()->create([
                     'question' => $request->question?: null,
                 ]);

                 $polloption = new Polloption;
                 $polloption->value = $request->option1;
                 $polloption->poll_id = $post->poll->id;
                 $polloption->save();

                 $polloption2 = new Polloption;
                 $polloption2->value = $request->option2;
                 $polloption2->poll_id = $post->poll->id;
                 $polloption2->save();

                 $post->is_poll = true;
                 $post->update();
             }

            return back()->with('flash_success', 'Post added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($data);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $postEdit = Post::with('poll')
            ->with('categories')
            ->where('slug', $slug)
            ->first();

        $selectedCategories = [];

        if($postEdit->categories) {
            foreach ($postEdit->categories as $cat) {
                array_push($selectedCategories, $cat->id);
            }
        }

        $categories = Category::where('status', 1)->get();

        return view('admin.post.edit', compact('postEdit', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug, int $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $slug, int $page = null)
    {
        try {
            $data = $request->except('_token');

            $validator = Validator::make( $data, [
                   'title' => 'required|max:255',
                   'category' => 'required',
                   'description' => 'required|min:50',
                   'type' => 'required',
                   'urls' => 'required_if:type,'.(Post::TYPE_IMAGE),
                   'youtubeUrl' => 'url|required_if:type,'.(Post::TYPE_VIDEO),
                   'source' => 'nullable|max:150',
                   'source_url' => 'nullable|url',
                   'audio_url' => 'nullable|url',
                   'status' => 'required',
               ],
                [],
                [
                    'urls' => "Gallery"
                ]
            );

            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);
            if($request->question && (!$request->options && !count($request->options) === 2)) throw new \Exception('Question given but both options not found');

            if(!$post = Post::where('slug', $slug)->first()) throw new \Exception("Error Processing Request", 1);

            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->note = $data['note'];
            $post->type = $data['type'];
            $post->source = $data['source'] ?: $data['source_url'];
            $post->source_url = $data['source_url'];
            $post->source_url2 = $data['source_url2'] ?: null;
            $post->source_url3 = $data['source_url3'] ?: null;
            $post->audio_url = $data['audio_url'];
            $post->status = $data['status'];
            $post->lang = $data['lang'];
            $post->is_full_width = array_key_exists('is_full_width', $data) ? $data['is_full_width'] : 0;
            $post->save();

            if(isset($data['category']))
            {
                $post->categories()->detach();
                $post->categories()->attach($data['category']);
            }

            if($request->type == Post::TYPE_IMAGE && is_array($request->urls)) {
                $post->galleries()->delete();
                $urls = [];
                foreach ($request->urls as $url) {
                    array_push($urls, new Gallery(['url' => $url]));
                }
                $post->galleries()->saveMany($urls);
                $post->update();
            }elseif($request->type == Post::TYPE_VIDEO) {
                $post->galleries()->delete();
                $videoUrl = new Gallery(['url' => $request->youtubeUrl]);
                $post->galleries()->save($videoUrl);
                $post->update();
            }

             if($request->question) {
                 $post->is_poll = true;

                 if($post->poll) {
                     $post->poll()->update([
                         'question' => $request->question?: null,
                     ]);

                     if(isset($data['options']) && is_array($data['options']))
                     {
                         foreach ($data['options'] as $id => $val) {
                             Polloption::where(['id' => $id])
                                 ->update([
                                     'value' => $val
                                 ]);
                         }
                     }

                 } else {
                     $poll = new Poll;
                     $poll->question = $request->question?: null;
                     $poll->post()->associate($post);
                     $poll->save();

                     foreach ($data['options'] as $key => $val) {
                         $polloption = new Polloption;
                         $polloption->value = $val;
                         $polloption->poll_id = $poll->id;
                         $polloption->save();
                     }
                 }
                 $post->update();

             } else {
                 $post->is_poll = false;
                 if($post->poll) $post->poll()->delete();
             }

            return redirect()->route('admin.post', ['page' => $page])->with('flash_success', 'Post updated Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug, int $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug, int $page = null)
    {
        try {
            if(!$slug) throw new \Exception("Error Processing Request", 1);

            if(!Post::where('slug', $slug)->delete()) throw new \Exception("Error Processing Request", 1);

            return redirect()->route('admin.post', ['page' => $page])->with('flash_success', 'Post removed Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

    public function getWebContent(Request $request)
    {
      try {
         $validator = Validator::make($request->all(), [
               'url' => 'required|url',
            ]
         );

         if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

         $url = $request->url;

         $metadata = Metatags::get($url);

         if(array_key_exists('og:title', $metadata)) {
            $data['title'] = $metadata['og:title'];
         } elseif(array_key_exists('twitter:title', $metadata)) {
            $data['title'] = $metadata['twitter:title'];
         } else{
            $data['title'] = null;
         }

         if(array_key_exists('description', $metadata)) {
            $data['description'] = $metadata['description'];
         } elseif(array_key_exists('og:description', $metadata)) {
            $data['description'] = $metadata['og:description'];
         } elseif(array_key_exists('twitter:description', $metadata)) {
            $data['description'] = $metadata['twitter:description'];
         } else{
            $data['description'] = null;
         }

         if(array_key_exists('og:image', $metadata)) {
            $data['image'] = $metadata['og:image'];
         } elseif(array_key_exists('twitter:image', $metadata)) {
            $data['image'] = $metadata['twitter:image'];
         } else{
            $data['image'] = null;
         }

         $data['source'] = preg_replace("/^www\./", "", parse_url($url, PHP_URL_HOST));

         return $this->ajaxResponse($data);

      } catch (\Exception $e) {
         return $this->ajaxResponse(null, $e->getMessage(), false);
      }
    }

}

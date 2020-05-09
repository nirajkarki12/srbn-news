<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use Metatags;
use App\Models\Category;
use App\Models\Post;

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
                   'content' => 'required|url',
                   'source' => 'nullable|max:150',
                   'source_url' => 'nullable|url',
                   'audio_url' => 'nullable|url',
                   'status' => 'required',
               ]
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            $post = new Post;
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->note = $data['note'];
            $post->type = $data['type'];
            $post->content = $data['content'];
            $post->source = $data['source'] ?: $data['source_url'];
            $post->source_url = $data['source_url'];
            $post->audio_url = $data['audio_url'];
            $post->status = $data['status'];
            $post->save();

            if(isset($data['category']))
            {
                $post->categories()->attach($data['category']);
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
        $postEdit = Post::with('categories')->where('slug', $slug)->first();

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
                   'content' => 'required|url',
                   'source' => 'nullable|max:150',
                   'source_url' => 'nullable|url',
                   'audio_url' => 'nullable|url',
                   'status' => 'required',
               ]
            );

            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$post = Post::where('slug', $slug)->first()) throw new \Exception("Error Processing Request", 1);

            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->note = $data['note'];
            $post->type = $data['type'];
            $post->content = $data['content'];
            $post->source = $data['source'] ?: $data['source_url'];
            $post->source_url = $data['source_url'];
            $post->audio_url = $data['audio_url'];
            $post->status = $data['status'];
            $post->save();

            if(isset($data['category']))
            {
                $post->categories()->detach();
                $post->categories()->attach($data['category']);
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

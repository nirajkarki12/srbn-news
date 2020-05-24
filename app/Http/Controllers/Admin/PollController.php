<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Models\Poll;
use App\Models\Polloption;

class PollController extends BaseController
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

      $polls = Poll::with('options')
            ->orderBy('created_at', 'desc')
            ->paginate(Setting::get('data_per_page', 25));
      if($polls->count() == 0 && $polls->currentPage() !== 1) {
         return redirect()->route('admin.poll');
      }
      return view('admin.poll.list', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.poll.create');
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
                   'description' => 'required|min:10',
                   'type' => 'required',
                   'content' => 'required|url',
                   'question' => 'required|max:150',
                   'options' => 'required',
                   'audio_url' => 'nullable|url',
                   'status' => 'required',
               ]
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            $poll = new Poll;
            $poll->title = $data['title'];
            $poll->description = $data['description'];
            $poll->type = $data['type'];
            $poll->content = $data['content'];
            $poll->question = $data['question'];
            $poll->audio_url = $data['audio_url'];
            $poll->status = $data['status'];
            $poll->save();

            if(isset($data['options']) && is_array($data['options']))
            {
               foreach ($data['options'] as $val) {

                  if(isset($val))
                  {
                     Polloption::create([
                        'value' => $val,
                        'poll_id' => $poll->id
                     ]);
                  }
               }
            }

            if(isset($data['optional'])) {
               Polloption::create([
                  'value' => $data['optional'],
                  'poll_id' => $poll->id
               ]);
            }

            return back()->with('flash_success', 'Poll added Successfully');

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
        $pollEdit = Poll::where('slug', $slug)->first();

        return view('admin.poll.edit', compact('pollEdit'));
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
                   'description' => 'required|min:10',
                   'type' => 'required',
                   'content' => 'required|url',
                   'options' => 'required',
                   'question' => 'required|max:150',
                   'audio_url' => 'nullable|url',
                   'status' => 'required',
               ]
            );

            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$poll = Poll::where('slug', $slug)->first()) throw new \Exception("Error Processing Request", 1);

            $poll->title = $data['title'];
            $poll->description = $data['description'];
            $poll->type = $data['type'];
            $poll->content = $data['content'];
            $poll->question = $data['question'];
            $poll->audio_url = $data['audio_url'];
            $poll->status = $data['status'];
            $poll->save();

            if(isset($data['options']) && is_array($data['options']))
            {
               foreach ($data['options'] as $id => $val) {

                  if(isset($val))
                  {
                     Polloption::where(['id' => $id])
                        ->update([
                           'value' => $val
                        ]);
                  } else{
                     Polloption::find($id)->delete();
                  }
               }
            }

            if(isset($data['optional'])) {
               Polloption::create([
                  'value' => $data['optional'],
                  'poll_id' => $poll->id
               ]);
            }

            return redirect()->route('admin.poll', ['page' => $page])->with('flash_success', 'Poll updated Successfully');

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
            
            if(!Poll::where('slug', $slug)->delete()) throw new \Exception("Error Processing Request", 1);

            return redirect()->route('admin.poll', ['page' => $page])->with('flash_success', 'Poll removed Successfully');
               
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }


}
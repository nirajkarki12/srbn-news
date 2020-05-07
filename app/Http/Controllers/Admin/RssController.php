<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Helpers\Helper;
use App\Models\Rss;

class RssController extends BaseController
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
  public function index()
  {
    $data = Rss::paginate(Setting::get('data_per_page', 25));

    if($data->count() == 0 && $data->currentPage() !== 1) {
      return redirect()->route('admin.rss');
    }
    return view('admin.rss.list', compact('data'));
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

      $validator = Validator::make( $data, array(
             'name' => 'required|max:255',
             'tagline' => 'required|max:100',
             'logo_file' => 'required',
             'url' => 'required|url',
             'status' => 'required',
          )
      );
      if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

      if(strpos(file_get_contents($data['url']),'<?xml') === false) throw new \Exception("Invalid RSS Feed URL", 1);

      if($request->file('logo_file')) {
          if(!$file = Helper::uploadImage($request->file('logo_file'), 'rss')) throw new \Exception("Cannot Save Logo", 1);
          $data['logo_file'] = $file;
      }

      if(!Rss::create($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);

      return back()->with('flash_success', 'RSS added Successfully');

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
    try {

      if(!$slug) throw new \Exception("Error Processing Request", 1);
      
      $data = Rss::paginate(Setting::get('data_per_page', 25));

      if($data->count() == 0 && $data->currentPage() !== 1) {
        return redirect()->route('admin.rss.edit', ['slug', $slug]);
      }

      if(!$rssEdit = Rss::where('slug', $slug)->first()) throw new \Exception("Rss not Found", 1);

      return view('admin.rss.list', compact('data', 'rssEdit'));

    } catch (\Exception $e) {
      return back()->with('flash_error', $e->getMessage());
    }

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

      $validator = Validator::make( $data, array(
           'name' => 'required|max:255',
           'tagline' => 'required|max:100',
            'url' => 'required|url',
           'status' => 'required',
        )
      );

      if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

      if(!$rss = Rss::where('slug', $slug)->first()) throw new \Exception("Error Processing Request", 1);

      if($request->file('logo_file')) {
        if(!$file = Helper::uploadImage($request->file('logo_file'), 'rss')) throw new \Exception("Cannot Save Logo", 1);

        $data['logo_file'] = $file;

        if(!Helper::deleteImage($rss->logo_file, 'rss')) throw new Exception("Error Processing Request", 1);
      }

      if(!$rss->update($data)) throw new \Exception("Error Processing Request", 1);

      return redirect()->route('admin.rss', ['page' => $page])->with('flash_success', 'Rss updated Successfully');

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

      if(!$rss = Rss::where('slug', $slug)->first()) throw new \Exception("Error Processing Request", 1);

      if(!Helper::deleteImage($rss->logo_file, 'rss')) throw new Exception("Error Processing Request", 1);

      if(!$rss->delete()) throw new \Exception("Error Processing Request", 1);

      return redirect()->route('admin.rss', ['page' => $page])->with('flash_success', 'Rss removed Successfully');
         
    } catch (\Exception $e) {
      return back()->with('flash_error', $e->getMessage());
    }
  }
}

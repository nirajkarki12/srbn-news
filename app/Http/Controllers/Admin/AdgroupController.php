<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Models\Adgroup;
use App\Models\Ad;

class AdgroupController extends BaseController
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
      $adgroups = Adgroup::orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));
      if($adgroups->count() == 0 && $adgroups->currentPage() !== 1) {
         return redirect()->route('admin.adgroup');
      }
      return view('admin.adgroup.list', compact('adgroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adgroup.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');

            $validator = Validator::make( $data, [
                    'title' => 'required|max:255',
                    'show_after' => 'required|numeric',
                    'publish_date' => 'required|date',
                    'expiry_date' => 'required|date',
                    'images' => 'required',
                ]
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            $adgroup = new Adgroup;
            $adgroup->title = $request->title;
            $adgroup->show_after = $request->show_after;
            $adgroup->publish_date = $request->publish_date;
            $adgroup->expiry_date = $request->expiry_date;
            $adgroup->save();

            if(is_array($request->images)) {
                $images = [];
                foreach ($request->images as $image) {
                    array_push($images, new Ad(['image' => $image]));
                }
                $adgroup->ads()->saveMany($images);
            }

            return back()->with('flash_success', 'Adgroup added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($data);
        }

    }
    /**
     * Show the form for editing the specified resource.
     * @param  int  $adgroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Adgroup $adgroup)
    {
        return view('admin.adgroup.edit', compact('adgroup'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int $adgroup, int $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adgroup $adgroup, int $page = null)
    {
        try {
            $data = $request->except('_token');

            $validator = Validator::make( $data, [
                    'title' => 'required|max:255',
                    'show_after' => 'required|numeric',
                    'publish_date' => 'required|date',
                    'expiry_date' => 'required|date',
                    'images' => 'required',
               ]
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            $adgroup->title = $request->title;
            $adgroup->show_after = $request->show_after;
            $adgroup->publish_date = $request->publish_date;
            $adgroup->expiry_date = $request->expiry_date;
            $adgroup->save();

            if(is_array($request->images)) {
                $adgroup->ads()->delete();
                $images = [];
                foreach ($request->images as $image) {
                    array_push($images, new Ad(['image' => $image]));
                }
                $adgroup->ads()->saveMany($images);
            }

            return redirect()->route('admin.adgroup', ['page' => $page])->with('flash_success', 'Post updated Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $adgroup, int $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adgroup $adgroup, int $page = null)
    {
        try {
            if(!$adgroup->delete()) throw new \Exception("Error Processing Request", 1);

            return redirect()->route('admin.adgroup', ['page' => $page])->with('flash_success', 'Post removed Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}

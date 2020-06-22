<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Helpers\Helper;
use App\Models\Movie;

class MovieController extends BaseController
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
        $categories = Movie::orderBy('created_at', 'desc')
                     ->paginate(Setting::get('data_per_page', 25));

        if($categories->count() == 0 && $categories->currentPage() !== 1) {
            return redirect()->route('admin.category');
        }
        return view('admin.category.list', compact('categories'));
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
                   'name_np' => 'required|max:255',
                   'position' => 'required|integer|min:1',
                )
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!Movie::create($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);

            return back()->with('flash_success', 'Category added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($data);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $categories = Movie::orderBy('created_at', 'desc')
            ->paginate(Setting::get('data_per_page', 25));

        if($categories->count() == 0 && $categories->currentPage() !== 1) {
            return redirect()->route('admin.category', ['id', $id]);
        }

        $categoryEdit = Movie::where('id', $id)->first();

        return view('admin.category.list', compact('categories', 'categoryEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id, int $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id, int $page = null)
    {
        try {
            $data = $request->except('_token');

            $validator = Validator::make( $data, array(
                    'name' => 'required|max:255',
                    'name_np' => 'required|max:255',
                    'position' => 'required|integer|min:1',
                )
            );

            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$category = Movie::where('id', $id)->first()) throw new \Exception("Error Processing Request", 1);

            if(!$category->update($data)) throw new \Exception("Error Processing Request", 1);

            return redirect()->route('admin.category', ['page' => $page])->with('flash_success', 'Category updated Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id, int $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, int $page = null)
    {
        try {
            if(!$id) throw new \Exception("Error Processing Request", 1);

            if(!$category = Movie::where('id', $id)->first()) throw new \Exception("Error Processing Request", 1);

            if(!Helper::deleteImage($category->image_file, 'category')) throw new Exception("Error Processing Request", 1);

            if(!$category->delete()) throw new \Exception("Error Processing Request", 1);

            return redirect()->route('admin.category', ['page' => $page])->with('flash_success', 'Category removed Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

}

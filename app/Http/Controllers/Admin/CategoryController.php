<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Helpers\Helper;
use App\Models\Category;

class CategoryController extends BaseController
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
        $parentCategory = null;
        if($parentSlug) {
            $parentCategory = Category::where('slug', $parentSlug)->first();
            $query = Category::select('categories.*')->join('categories AS parent', 'parent.id', 'categories.parent_id')->where('parent.slug', $parentSlug);
        }else{
            $query = Category::where('categories.parent_id', null);
        }

        $categories = $query->paginate(Setting::get('data_per_page', 25));

        if($categories->count() == 0 && $categories->currentPage() !== 1) {
            return redirect()->route('admin.category', ['parentSlug' => $parentSlug]);
        }
        return view('admin.category.list', compact('categories', 'parentCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get()->toArray();
        $arrCategory = $this->buildCategoryTree($categories);
        $controller = $this;
        return view('admin.category.create', compact('categories', 'arrCategory', 'controller'));
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
                )
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if($request->file('image_file')) {
                if(!$file = Helper::uploadImage($request->file('image_file'), 'category')) throw new \Exception("Cannot Save Image", 1);
                $data['image_file'] = $file;
            }

            if(!Category::create($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);

            return back()->with('flash_success', 'Category added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($data);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSubCategory(string $categorySlug)
    {
        try {
            
            $category = Category::with(['parent'])->where('slug', $categorySlug)->first()->toArray();
            if(!$category['status']) throw new \Exception("{$category['name']} category is disabled", 1);
            
            return view('admin.category.create-sub-category', compact('category'));

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
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
        $categoryEdit = Category::where('slug', $slug)->first();

        $categories = Category::where('status', 1)->get()->toArray();
        $arrCategory = $this->buildCategoryTree($categories);
        $controller = $this;

        return view('admin.category.edit', compact('categoryEdit', 'arrCategory', 'controller'));
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
                )
            );

            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$category = Category::where('slug', $slug)->first()) throw new \Exception("Error Processing Request", 1);

            if($request->file('image_file')) {
                if(!$file = Helper::uploadImage($request->file('image_file'), 'category')) throw new \Exception("Cannot Save Image", 1);
                $data['image_file'] = $file;
                if(!Helper::deleteImage($category->image_file, 'category')) throw new Exception("Error Processing Request", 1);
            }

            if(!$category->update($data)) throw new \Exception("Error Processing Request", 1);

            return redirect()->route('admin.category', ['page' => $page, 'parentSlug' => ($category->parent ? $category->parent->slug : null)])->with('flash_success', 'Category updated Successfully');

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
            
            if(!$category = Category::where('slug', $slug)->first()) throw new \Exception("Error Processing Request", 1);
            $parentSlug = $category->parent ? $category->parent->slug : null;

            if(!Helper::deleteImage($category->image_file, 'category')) throw new Exception("Error Processing Request", 1);

            if(!$category->delete()) throw new \Exception("Error Processing Request", 1);

            return redirect()->route('admin.category', ['page' => $page, 'parentSlug' => $parentSlug])->with('flash_success', 'Category removed Successfully');
               
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

}

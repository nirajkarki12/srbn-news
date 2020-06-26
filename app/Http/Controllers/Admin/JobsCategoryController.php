<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Common\BaseController;
use anlutro\LaravelSettings\Facade as Setting;

use App\Http\Helpers\Helper;
use App\Http\Requests\JobCategoryRequest;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobsCategoryController extends BaseController
{
    public function index() {
        $categories = JobCategory::orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));
        return view('admin.jobs.category.index', compact('categories'));
    }

    public function store(JobCategoryRequest $request, JobCategory $jobCategory = null) {
        try {

            $data = $request->all();

            if($request->file('image')) {

                if(!$file = Helper::uploadImage($request->file('image'), 'jobs')) throw new \Exception("Cannot Save Image", 1);
                $data['image'] = $file;

                if($jobCategory) {
                    Helper::deleteImage(basename($jobCategory->image), 'jobs');
                }
            }

            if($jobCategory) {
                if(!$jobCategory->update($data)) throw new \Exception('Can not update this time');
            } else {
                if(!JobCategory::create($data)) throw new \Exception('Can not create category');
            }

            return back()->with('flash_success', $jobCategory?'Category updated':'Category created');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

    public function destroy(JobCategory $jobCategory) {
        try {

            if(!$jobCategory) throw new \Exception("Error Processing Request", 1);

            if(!$jobCategory->delete()) throw new \Exception("Error Processing Request", 1);

            Helper::deleteImage(basename($jobCategory->image), 'jobs');

            return redirect()->route('jobs.category', ['page' => request('page')?:null])->with('flash_success', 'Category removed Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Common\BaseController;
use App\Http\Requests\VacancyRequest;
use anlutro\LaravelSettings\Facade as Setting;
use App\Models\Vacancy;
use App\Models\JobCategory;
use App\Models\Company;
use App\Http\Helpers\Helper;

class VacancyController extends BaseController
{
    public function index(){
        $companies = Company::orderBy('name', 'asc')->get();
        $jobCategories = JobCategory::orderBy('name', 'asc')->get();
        $vacancies = Vacancy::orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));

        return view('admin.jobs.vacancy.index', compact('companies', 'jobCategories', 'vacancies'));
    }

    public function store(VacancyRequest $request, Vacancy $vacancy = null){
        try {
            $data = $request->all();

            if ($request->file('image')) {

                $data['image'] = Helper::uploadImage($request->image, 'vacancies');

                if ($vacancy) {
                    Helper::deleteImage(basename($vacancy->image), 'vacancies');
                }
            }

            if ($vacancy) {
                if (!$vacancy->update($data)) throw new \Exception('Can not update a vacancy this time.');
            } else {
                if (!$newVacancy = Vacancy::create($data)) throw new \Exception('Can not create a vacancy.');
            }

            if($request->job_category_id) {
                if($vacancy) {
                    $vacancy->jobCategories()->detach($vacancy->jobCategories);
                    $vacancy->jobCategories()->attach($request->job_category_id);
                } else {
                    $newVacancy->jobCategories()->attach($request->job_category_id);
                }
            }

            return redirect()->route('admin.vacancy')->with('flash_success', $vacancy ? 'Vacancy Updated' : 'Vacancy Created');
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

    public function destroy(Vacancy $vacancy){
            try {
                if (!$vacancy->delete()) throw new \Exception('Can not delete this time');
                Helper::deleteImage(basename($vacancy->image), 'vacancies');
                return back()->with('flash_success', 'Vacancy Deleted successfully');
            } catch (\Exception $e) {
                return back()->with('flash_error', $e->getMessage());
            }
    }

}

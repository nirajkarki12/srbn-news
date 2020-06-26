<?php

namespace App\Http\Controllers\Admin;

use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Controllers\Common\BaseController;
use App\Http\Helpers\Helper;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class CompanyController extends BaseController
{
    public function index() {
        $companies = Company::orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));
        return view('admin.jobs.company.index', compact('companies'));
    }

    public function store(CompanyRequest $request, Company $company = null) {
        try {
            $data = $request->all();

            if($request->file('image')) {

                if(!$file = Helper::uploadImage($request->file('image'), 'companies')) throw new \Exception("Cannot Save Image", 1);
                $data['image'] = $file;

                if($company) {
                    Helper::deleteImage(basename($company->image), 'companies');
                }
            }

            if($company) {
                if(!$company->update($data)) throw new \Exception('Can not update this time');
            } else {
                if(!Company::create($data)) throw new \Exception('Can not create Company');
            }

            return back()->with('flash_success', $company?'Company updated':'Company created');
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

    public function destroy(Company $company) {
        try {

            if(!$company) throw new \Exception("Error Processing Request", 1);

            if(!$company->delete()) throw new \Exception("Error Processing Request", 1);

            Helper::deleteImage(basename($company->image), 'jobs');

            return redirect()->route('jobs.company', ['page' => request('page')?:null])->with('flash_success', 'Company removed Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Helpers\Helper;

class SettingController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $data = $request->except('_token');

            if($request->file('site_logo')) {
                if(!Helper::deleteImage(Setting::get('site_logo'), 'uploads')) throw new Exception("Error Processing Request", 1);

                if(!$file = Helper::uploadImage($request->file('site_logo'), 'uploads')) throw new \Exception("Cannot Save Logo", 1);
                $data['site_logo'] = $file;
                $data['site_logo_path'] = env('APP_URL') .'/storage/uploads/' .$file;
            }

            if($request->file('site_icon')) {
                if(!Helper::deleteImage(Setting::get('site_icon'), 'uploads')) throw new Exception("Error Processing Request", 1);

                if(!$file = Helper::uploadImage($request->file('site_icon'), 'uploads')) throw new \Exception("Cannot Save Icon", 1);
                $data['site_icon'] = $file;
                $data['site_icon_path'] = env('APP_URL') .'/storage/uploads/' .$file;
            }


            if($data && is_array($data)){
                foreach ($data as $key => $value) {
                    Setting::set($key, $value);
                }

                Setting::save();
            }
            
            return redirect()->route('admin.config')->with('flash_success', 'Config updated Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput();
        }
    }

}

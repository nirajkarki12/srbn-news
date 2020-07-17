<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Helpers\Helper;
use App\Models\Horoscope;


class HoroscopeController extends BaseController
{
    public function index() {
        $horoscopes1 = Horoscope::where('lang', 'ne')->orderBy('order', 'asc')->get();
        $horoscopes2 = Horoscope::where('lang', 'en')->orderBy('order', 'asc')->get();
        return view('admin.horoscope.index', compact('horoscopes1', 'horoscopes2'));
    }

    public function create(Horoscope $horoscope = null) {
        return view('admin.horoscope.create', compact('horoscope'));
    }

    public function store(Request $request, Horoscope $horoscope = null) {

        try {

            $edit = (bool) $horoscope;

            $data = $request->except('_token');

            if(!$horoscope) {

                $validator = Validator::make( $data, array(
                        'name'   => 'required',
                        'info'   => 'required',
                        'lang'   => 'required',
                        'image'  => 'required|mimes:png,jpg,jpeg',
                        'order' => 'required'
                    )
                );

                if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);
            }

            if($request->file('image')) {
                if($horoscope) {
                    if(!Helper::deleteImage(basename($horoscope->image), 'horoscopes')) throw new Exception("Error Processing Request", 1);
                }

                if(!$file = Helper::uploadImage($request->file('image'), 'horoscopes')) throw new \Exception("Cannot Save Image", 1);

                $data['image'] = $file;
            }

            if($horoscope) {
                if(!$horoscope->update($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);
            } else {
                Horoscope::create($data);
            }

            if($edit) return redirect()->route('admin.horoscope')->with('flash_success', 'Horoscope edited successfully');
            return back()->with('flash_success', 'Horoscope added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($data);
        }
    }

    public function destroy(Horoscope $horoscope) {
        try {
            if(!$horoscope->delete()) throw new \Exception('Something went wrong try again');

            Helper::deleteImage(basename($horoscope->image), 'horoscopes');

            return back()->with('flash_success', 'Horoscope Removed');
        } catch (\Throwable $th) {
            return back()->with('flash_error', $th->getMessage());
        }
    }


}

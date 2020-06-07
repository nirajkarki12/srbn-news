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
        $horoscopes = Horoscope::orderBy('order', 'asc')->get();
        return view('admin.horoscope.index', compact('horoscopes'));
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
                        'name_nepali'   => 'required',    
                        'name_english'   => 'required',    
                        'image_nepali'  => 'required|mimes:png,jpg,jpeg',
                        'image_english'  => 'required|mimes:png,jpg,jpeg',
                        'order' => 'required'
                    )
                );
        
                if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);
            }

            if(Horoscope::where('order', $data['order'])->first()) throw new \Exception('order is already defined', 1);
    
    
            if($request->file('image_nepali')) {
    
                if($horoscope) {
                    if(!Helper::deleteImage(basename($horoscope->image_nepali), 'horoscopes')) throw new Exception("Error Processing Request", 1);
                }
    
                if(!$file = Helper::uploadImage($request->file('image_nepali'), 'horoscopes')) throw new \Exception("Cannot Save Image", 1);
                
                $data['image_nepali'] = $file;
            }
    
            if($request->file('image_english')) {
    
                if($horoscope) {
                    if(!Helper::deleteImage(basename($horoscope->image_english), 'horoscopes')) throw new Exception("Error Processing Request", 1);
                }
    
                if(!$file = Helper::uploadImage($request->file('image_english'), 'horoscopes')) throw new \Exception("Cannot Save Image", 1);
                $data['image_english'] = $file;
            }
    
            if($horoscope) {
    
                if(!$horoscope->update($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);
    
            } else {
    
                $horoscope = Horoscope::create($data);            
    
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

            Helper::deleteImage(basename($horoscope->image_nepali), 'horoscopes');
            Helper::deleteImage(basename($horoscope->image_english), 'horoscopes');

            return back()->with('flash_success', 'Horoscope Removed');
        } catch (\Throwable $th) {
            return back()->with('flash_error', $th->getMessage());
        }
    }


}

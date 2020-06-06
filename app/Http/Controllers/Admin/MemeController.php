<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Helpers\Helper;
use App\Models\Meme;

class MemeController extends BaseController
{
    public function __construct() {
        $this->middleware('auth');
    }


    public function index() {
        $memes = Meme::orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));
        return view('admin.meme.index', compact('memes'));
    }

    public function create(Meme $meme = null) {
        return view('admin.meme.create', compact('meme'));
    }

    public function store(Request $request, Meme $meme= null) {
        try {

            $edit = (bool) $meme;
            
            $data = $request->all();
    
            $validator = Validator::make( $data, array(
                   'image'  => 'required|mimes:png,jpg,jpeg'
                )
            );
    
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);
    
            if($request->file('image')) {
    
                if($meme) {
                    if(!Helper::deleteImage(basename($meme->image), 'memes')) throw new Exception("Error Processing Request", 1);
                }
    
                if(!$file = Helper::uploadImage($request->file('image'), 'memes')) throw new \Exception("Cannot Save Image", 1);
                $data['image'] = $file;
            }
    
            if(!empty($meme)) {
    
                if(!$meme->update($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);
    
            } else {
    
                $meme = meme::create($data);            
    
            }
    
            if($edit) return redirect()->route('admin.meme')->with('flash_success', 'Meme edited successfully');
            return back()->with('flash_success', 'Meme added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($data);
        }
       
    }

    public function destroy(Meme $meme) {
        try {
            
            if(!$meme->delete()) throw new \Exception("Error Processing Request", 1);
    
            if(!Helper::deleteImage(basename($meme->image), 'memes')) throw new \Exception('Error Processing Request', 1);
    
            return redirect()->route('admin.meme', ['page' => request('page')?:null])->with('flash_success', 'Meme removed Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}

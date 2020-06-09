<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Helpers\Helper;
use App\Models\LifeHack;

class LifeHackController extends BaseController
{

    public function __construct() {
        $this->middleware('auth');
    }


    public function index() {
        $lifehacks = LifeHack::orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));
        return view('admin.lifehack.index', compact('lifehacks'));
    }

    public function create(LifeHack $lifehack = null) {
        return view('admin.lifehack.create', compact('lifehack'));
    }

    public function store(Request $request, LifeHack $lifehack= null) {
        try {

            $edit = (bool) $lifehack;

            $data = $request->all();

            $validator = Validator::make( $data, array(
                   'image'  => 'mimes:png,jpg,jpeg'
                )
            );

            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if($request->file('image')) {

                if($lifehack) {
                    if(!Helper::deleteImage(basename($lifehack->image), 'lifehacks')) throw new Exception("Error Processing Request", 1);
                }

                if(!$file = Helper::uploadImage($request->file('image'), 'lifehacks')) throw new \Exception("Cannot Save Image", 1);
                $data['image'] = $file;
            }

            if(!empty($lifehack)) {

                if(!$lifehack->update($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);

            } else {

                $lifehack = LifeHack::create($data);

            }


            if($request->content_nepali) {

                if($lifehack && $lifehack->translation) {

                    $lifehack->translation()->update([
                        'content' => $request->content_nepali?:''
                    ]);

                } else {

                    $lifehack->translation()->create([
                        'content' => $request->content_nepali?:''
                    ]);
                }
            }

            if($edit) return redirect()->route('admin.lifehack')->with('flash_success', 'Life Hack edited successfully');
            return back()->with('flash_success', 'Life Hack added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($data);
        }

    }

    public function destroy(LifeHack $lifehack) {
        try {

            if(!$lifehack) throw new \Exception("Error Processing Request", 1);

            if(!$lifehack->delete()) throw new \Exception("Error Processing Request", 1);

            Helper::deleteImage(basename($lifehack->image), 'lifehacks');

            return redirect()->route('admin.lifehack', ['page' => request('page')?:null])->with('flash_success', 'Life Hack removed Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use App\Models\Admin;

class DashboardController extends BaseController
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function profile() {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function profileSave(Request $request) {

        $validator = Validator::make( $request->all(),array(
                'name' => 'max:255',
                'email' => 'email|max:255',
                'id' => 'required|exists:admins,id'
            )
        );
        
        if($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            return back()->with('flash_errors', $error_messages);
        } else {
            
            $admin = Admin::find($request->id);
            
            $admin->name = $request->has('name') ? $request->name : $admin->name;

            $admin->email = $request->has('email') ? $request->email : $admin->email;

            $admin->save();

            return back()->with('flash_success', 'Profile updated Successfully');
        }
    
    }

    public function changePassword(Request $request) {

        $old_password = $request->old_password;
        $new_password = $request->password;
        $confirm_password = $request->confirm_password;
        
        $validator = Validator::make($request->all(), [              
                'password' => 'required|min:6',
                'old_password' => 'required',
                'confirm_password' => 'required|min:6',
                'id' => 'required|exists:admins,id'
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('flash_errors', $error_messages);

        } else {

            $admin = Admin::find($request->id);

            if(Hash::check($old_password,$admin->password))
            {
                $admin->password = Hash::make($new_password);
                $admin->save();

                return back()->with('flash_success', "Password Changed successfully");
                
            } else {
                return back()->with('flash_error', "Pasword is mismatched");
            }
        }

        $response = response()->json($response_array,$response_code);

        return $response;
    }

}

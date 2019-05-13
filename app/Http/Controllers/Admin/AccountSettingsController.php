<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Hash;
use Validator;
use App\Admin;

class AccountSettingsController extends Controller
{
    /**
     * display settings page
     * for current logged-in admin user
     */
    public function index()
    {        
        $admin['name'] = Auth('admin')->user()->name;
        $admin['email'] = Auth('admin')->user()->email;
        // dd($admin);
        return view('admin.settings.account', compact('admin'));
    }

    function updateInfo(Request $request)
    {
        
        if(isset(Auth('admin')->user()->id))                        
        {
            //validate data from form
            $validator = Validator::make($request->all(),[          
            'name'  =>  'required|max:255',                         
            'email' =>  'required|email|max:255',
            ]);

            if (!($validator->fails()))                               
            {
                //find user's account
                $admin = Admin::where('id', Auth('admin')->user()->id)->first();
                
                //check if email from request allready exists for some other admin/user
                $check_admin = Admin::where('email', $request->email)->first();
                
                if($check_admin == null || ($check_admin != null && $check_admin->id == $admin->id)) 
                {
                    //update admin info: name and email
                    $admin->name = $request->name;
                    $admin->email = $request->email;
                    $admin->update();
                    return redirect()->back()->with('success', 'Information successfully updated!');

                } elseif ($check_admin->id != $admin->id) {
                    return redirect()->back()->with('email-error', 'Admin user with this email address already exists!');
                }
            } // if
        } // if
    } // function    

    public function updatePassword(Request $request)
    {
        if(isset(Auth('admin')->user()->id))
        {
            // validate data from from
            $validator = Validator::make($request->all(), [
                'old_password'  =>  'required|string|min:8|max:20',
                'new_password'  =>  'required|string|min:8|max:20|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
                'new_password2' =>  'required|same:new_password',
            ]);

            if (!($validator->fails()))
            {
                // find user's account
                $check_id = Auth('admin')->user()->id;
                $admin = Admin::where('id', $check_id)->first();

                // check if old password is valid
                if (Hash::check($request->old_password, $admin->password))
                {                  
                    // update database
                    $hashed = Hash::make($request->new_password);
                    $admin->password = $hashed;
                    $admin->update();
                    // $admin_message = '<div class="alerts alert-green center"><p>Password updated!</p></div>';
                    return redirect()->back()->with('password-success', 'Password updated!');

                } else {
                    // invalid old password
                    return redirect()->back()->with('old-password-error', 'Invalid old password!');
                    // $admin_message = '<div class="alerts alert-error center"><p>Invalid old password!</p></div>';
                }
                
            } 
            else 
            {
                // invalid entries in password fields
                $errors = $validator->errors();

                if ( $errors->first('old_password') != null ){
                    return redirect()->back()->with('old-password-validation-error', $errors->first('old_password'));
                }

                if ( $errors->first('new_password') != null ){
                    return redirect()->back()->with('new-password-validation-error', $errors->first('new_password'));
                }

                if ( $errors->first('new_password2') != null ){
                    return redirect()->back()->with('repeat-password-validation-error', $errors->first('new_password2'));
                }
            }
        }
    }
}
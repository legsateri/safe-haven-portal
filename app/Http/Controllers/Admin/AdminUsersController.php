<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Hash;

use App\Admin;

class AdminUsersController extends Controller
{
    /**
     * display list of admin users
     */
    public function index()
    {
        $admins = Admin::orderBy('name')->paginate(10);
        return view('admin.settings.admin-users', compact('admins'));
    }


    /**
     * single admin user page
     * with form for editing data
     */
    public function single($id)
    {
        $admin = Admin::where('id', $id)->first();
        if ( isset($admin->id) )
        {
            return view('admin.settings.admin-user-single', compact('admin'));
        }
        return "failed page load";
    }


    /**
     * add admin user form
     */
    public function add()
    {
        return view('admin.settings.admin-user-add');
    }


    /**
     * add new admin user form submit
     */
    public function addSubmit(Request $request)
    {
        // validate data from request
        $validator = Validator::make($request->all(),[
            'name'              => 'required|string|max:50',
            'email'             => 'required|email|max:60|unique:admins,email',
            'password'          => 'required|string|max:40|min:6',
            'repeat_password'   => 'required|same:password',
            'your_password'     => 'required|string|max:40|min:6',
        ]);

        if (!($validator->fails()))
        {
            // check is current admin password correct
            $check_id = Auth('admin')->user()->id;
            $admin = Admin::where('id', $check_id)->first();

            // check if old password is valid
            if (Hash::check($request->your_password, $admin->password))
            {
                // create new admin user
                $admin = new Admin();
                $admin->name = $request->name;
                $admin->email = $request->email;
                $admin->active = 0;
                $admin->password = Hash::make($request->password);
                $admin->save();

                // redirect to edit admin user page
                return redirect()
                ->route('admin.settings.admin-user.single', [
                    'id' => $admin->id
                ])
                ->with('success', 'New Admin user successfully created!');

            }
            // invalid current admin password
            return redirect()->back()->with('your_password_error', 'Your password is not correct.')->withInput();
        }

        // invalid entries
        return redirect()->back()->withErrors($validator)->withInput();
    }


    /**
     *  submit update admin user
     *  general information
     */

    public function submitGeneral($id, Request $request)
    {
        // dd($request);
        // validate data from request
        $validator = Validator::make($request->all(),[
            'name'              => 'required|string|max:50',
            'email'             => 'required|email|max:60',
            'password_general'  => 'required|string|max:40|min:6',
        ]);

        if (!($validator->fails()))
        {
            // find admin user to change
            $adminUser = Admin::where('id', $id)->first();
            // dd($adminUser);

            // find current admin
            $currentAdmin = Auth('admin')->user();
            // dd($currentAdmin);

            // check email from request
            $checkEmail =Admin::where('email', $request->email)->first();

            // check if admin password is valid and
            if ((Hash::check($request->password_general, $currentAdmin->password))) {
                
                // check if email from request allready exists for some other admin user
                if ($checkEmail == null || ($checkEmail != null && $checkEmail->id == $adminUser->id)) {
                    $adminUser->name = $request->name;
                    $adminUser->email = $request->email;
                    $adminUser->update();

                    return redirect()
                        ->route('admin.settings.admin-user.single', ['id' => $adminUser->id])
                        ->with('success-general', ' General information successfully changed!');

                } else {
                    return redirect()->back()->with('email-error-general', 'User with this email address already exists.');
                }
            } else {
                return redirect()->back()->with('password-error-general', 'Wrong admin password. Please try again!.');
            }
        }
        // invalid entries 
        return redirect()->back()->withErrors($validator)->withInput();
    }


    /**
     * submit update admin user
     * password
     */    
    public function submitPassword($id, Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'admin_password'    =>  'required|string|min:6|max:40',
            'new_password'      =>  'required|string|min:6|max:40',
            'repeat_password'   =>  'required|same:new_password',
        ]);

        if (!($validator->fails()))
        {
            //find admin user to edit
            $adminUser = Admin::where('id', $id)->first();
            // dd($adminUser);

            // find current admin
            $currentAdmin = Auth('admin')->user();
            // dd($currentAdmin);

            // check if admin password is valid
            if (Hash::check($request->admin_password, $currentAdmin->password)){ 

                // update password for admin user
                $hashed = Hash::make($request->new_password);
                $adminUser->password = $hashed;
                $adminUser->update();
                // dd($adminUser);

                return redirect()
                    ->route('admin.settings.admin-user.single', ['id' => $adminUser->id])
                    ->with('success-password', ' Password successfully changed!');

            } else {
                // invalid admin password
                return redirect()->back()->with('error-admin-password', 'Invalid admin password!');
            }
        }
        // invalid entries in password fields
        return redirect()->back()->withErrors($validator)->withInput();
    }


    /**
     * submit update admin user
     * active status
     */
    public function submitActiveStatus($id, Request $request)
    {
        // dd($request);
        
        //validate data from form
        $validator = Validator::make($request->all(), [
            'new_active_value'    => 'boolean',
            'password_ban' => 'required|string|min:6|max:40',
        ]);

        if (!($validator->fails())){

            // find admin user to edit
            $adminUser = Admin::where('id', $id)->first();
            // dd($adminUser);

            // find current admin
            $currentAdmin = Auth('admin')->user();
            // dd($currentAdmin);

            // check if admin password is valid
            if (Hash::check($request->password_ban, $currentAdmin->password)){

                $adminUser->active = $request->new_active_value;
                $adminUser->update();
                
                // dd($user);

                if ($adminUser->active == "0") {
                    return redirect()
                    ->route('admin.settings.admin-user.single', ['id' => $adminUser->id])
                    ->with('success-active0', 'Admin user deactivated!');
                } else {
                    return redirect()
                    ->route('admin.settings.admin-user.single', ['id' => $adminUser->id])
                    ->with('success-active1', 'Admin user activated!');
                }
                
            } else {
                // invalid admin password
                return redirect()->back()->with('error-admin-password-ban', 'Invalid admin password!');
            }
        } else {
            // invalid entries in password fields
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }    
    

}
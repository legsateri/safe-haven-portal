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
}

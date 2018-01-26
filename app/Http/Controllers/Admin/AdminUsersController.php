<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}

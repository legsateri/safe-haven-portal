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
        $admins = Admin::paginate(20);
        
        return view('admin.settings.admin-users', compact('admins'));
    }


    public function single($id)
    {

    }
}

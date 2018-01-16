<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * display user list page
     */
    public function index()
    {
        return view('admin.users.users_all.list');
    }

    /**
     * display advocates list page
     */
    public function advocates()
    {
        return view('admin.users.advocates.list');
    }

    /**
     * display advocates list page
     */
    public function shelters()
    {
        return view('admin.users.shelters.list');
    }

    /**
     * display add user page (form)
     */
    public function add()
    {
        return view('admin.users.user_add.list');
    }
}

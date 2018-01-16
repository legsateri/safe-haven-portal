<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountSettingsController extends Controller
{
    /**
     * display settings page
     * for current logged-in admin user
     */
    public function index()
    {
        return view('admin.settings.account');
    }
}

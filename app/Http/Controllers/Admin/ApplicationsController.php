<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{
    /**
     * display applications list page
     */
    public function index()
    {
        return view('admin.clients.applications.list');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PetsController extends Controller
{
    /**
     * display pet list page
     */
    public function index()
    {
        return view('admin.clients.pets_all.list');
    }
}

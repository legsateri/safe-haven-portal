<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPagesController extends Controller
{
    public function index()
    {
        return view('PublicPages.homePage');
    }
}

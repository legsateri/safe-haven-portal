<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Code\UserObject;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }


    /**
     * user account page
     */
    public function index()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        return view('auth.shared.userAccount', compact('currentUser'));
    }
}

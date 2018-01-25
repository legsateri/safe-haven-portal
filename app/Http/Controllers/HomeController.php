<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Code\UserObject;
use App\Code\TempObject as Temp;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $temp = (Temp::set(Auth::user()->id, 'new_application_form', ['first_name' => 'magdalena', 'last_name' => 'petrovic', 'phone_type' => 'mobile', 'phone' => '064555999']));
        // $temp = (Temp::set(Auth::user()->id, 'test_application', ['first_name' => 'milos', 'last_name' => 'djokic', 'phone_type' => 'mobile', 'phone' => '021225545']));

        $temp = (Temp::get(Auth::user()->id, 'test_application'));
        dd($temp);
        exit;
        
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        if ($currentUser->type == "shelter")
        {
            return view('user.shelter.dashboard', compact('currentUser'));
        }
        elseif($currentUser->type == "advocate")
        {
            return view('user.advocate.dashboard', compact('currentUser'));
        }

    }
}

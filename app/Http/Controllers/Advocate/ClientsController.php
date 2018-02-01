<?php

namespace App\Http\Controllers\Advocate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Code\UserObject;

class ClientsController extends Controller
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
        $this->_checkVerifiedUser();
    }

    
    /**
     * associated clients list page
     */
    public function associatedList()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        return view('auth.advocate.clientsCurrent', compact('currentUser'));
    }

    /**
     * clients in need list page
     */
    public function inNeedList()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        return view('auth.advocate.clientsInNeed', compact('currentUser'));
    }

    /**
     * single client page
     */
    public function single($id, $slug)
    {

    }
    
}

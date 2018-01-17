<?php

namespace App\Http\Controllers\Shelter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Code\UserObject;

class PetsController extends Controller
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
     * associated pets list page
     */
    public function associatedList()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');
    }


    /**
     * pets in need list page
     */
    public function inNeedList()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');
    }


    /**
     * single pet page
     * with pet's details
     */
    public function single($id, $slug)
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');
    }


    /**
     * single client page (pet owner) - id and slug of client
     */
    public function owner($id, $slug)
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');
    }
}

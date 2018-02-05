<?php

namespace App\Http\Controllers\Advocate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

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

        $data = DB::table('applications')
                    ->where([
                        ['status', '=', '0']
                    ])
                    ->join('application_pets', 'applications.id', '=', 'application_pets.application_id')
                    ->join('clients', 'applications.client_id', '=', 'clients.id')
                    ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                    ->paginate(4);
        // dd($data);
        return view('auth.advocate.clientsInNeed', compact('currentUser'));
    }

    /**
     * single client page
     */
    public function single($id, $slug)
    {

    }
    
}

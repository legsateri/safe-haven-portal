<?php

namespace App\Http\Controllers\Advocate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

use App\ObjectType;
use App\State;

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

        $petTypes = ObjectType::where('type', 'pet')->get();
        $phoneTypes = ObjectType::where('type', 'phone')->get();
        $states = State::all();
        $preferedContactMethods = [
            'phone' => 'Phone', 
            'email' => 'Email', 
            'text_message' => 'Text message'
        ];

        $dataEntries = DB::table('applications')
                    ->join('application_pets', 'applications.id', '=', 'application_pets.application_id')
                    ->join('clients', 'applications.client_id', '=', 'clients.id')
                    ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                    ->join('addresses', 'applications.client_id' , '=' , 'addresses.entity_id')
                    ->join('phones', 'applications.client_id' , '=' , 'phones.entity_id')
                    ->where([
                        ['addresses.entity_type', '=', 'client'],
                        ['phones.entity_type', '=', 'client'],
                        ['applications.status', '=', '0'],
                        ['applications.organisation_id', '=', $currentUser->organisation_id]
                    ])
                    ->paginate(4);
                        // dd($dataEntries);

        return  view('auth.advocate.clientsInNeed', 
                compact('currentUser', 'dataEntries', 'petTypes', 'phoneTypes', 'states', 'preferedContactMethods'));
    }

    /**
     * single client page
     */
    public function single($id, $slug)
    {

    }


    /**
     * ajax handler for accepting new client
     * from clients in need table
     */
    public function acceptClient(Request $request)
    {
        return "ok";
    }
    
}

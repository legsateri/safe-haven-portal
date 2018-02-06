<?php

namespace App\Http\Controllers\Shelter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;

use App\ObjectType;
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

        return view('auth.shelter.petsAssociated', compact('currentUser'));
    }


    /**
     * pets in need list page
     */
    public function inNeedList()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        $petTypes = ObjectType::where('type', 'pet')->get();

        $dataEntries = DB::table('application_pets')
                    ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                    ->where([
                        ['application_pets.status', '=', '0'],
                    ])
                    ->paginate(4);


        return  view('auth.shelter.petsInNeed', 
                compact('currentUser', 'dataEntries', 'petTypes'));
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

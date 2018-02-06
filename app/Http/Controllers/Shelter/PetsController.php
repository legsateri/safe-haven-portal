<?php

namespace App\Http\Controllers\Shelter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Validator;

use App\ObjectType;
use App\Code\UserObject;
use App\Application;
use App\ApplicationPet;

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

        $petTypes = ObjectType::where('type', 'pet')->get();

        $dataEntries = DB::table('application_pets')
                    ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                    ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                    ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
                    ->where([
                        ['application_pets.status', '=', '1'],
                        ['application_pets.accepted_by_shelter_organisation_id', '=', Auth::user()->organisation_id],
                        ['addresses.entity_type', '=', 'client'],
                    ])
                    ->paginate(4);

        return  view('auth.shelter.petsAssociated', 
                compact('currentUser', 'dataEntries', 'petTypes'));
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
                    ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                    ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
                    ->where([
                        ['application_pets.status', '=', '0'],
                        ['addresses.entity_type', '=', 'client'],
                        ['applications.accepted_by_advocate_id', '<>', null],
                        ['applications.accepted_by_advocate_id', '<>', '']
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


    public function acceptpet(Request $request)
    {
        // validate data from request
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:application_pets,id',
            'action' => 'required|in:accept_pet_confirmed'
        ]);

        if ( !$validator->fails() )
        {
            // check is pet application available for accepting
            $applicationPet = ApplicationPet::where([
                ['status', '=', 0],
                ['accepted_by_shelter_organisation_id' , '=', null]
            ])
            ->orWhere([
                ['status', '=', 0],
                ['accepted_by_shelter_organisation_id' , '=', '']
            ])
            ->first();

            if ( $applicationPet )
            {
                // validate status of client application
                $application = Application::where('id', $applicationPet->application_id)->first();
                if ( $application->status == 1 && $application->accepted_by_advocate_id != null && $application->accepted_by_advocate_id != '' )
                {
                    $applicationPet->accepted_by_shelter_organisation_id = Auth::user()->organisation_id;
                    $applicationPet->status = 1;
                    $applicationPet->update();
    
                    return [
                        'success' => true
                    ];
                }
                
            }

        }

        return [
            'success' => false,
            'message' => 'Accepting pet application failed'
        ];

    }
}

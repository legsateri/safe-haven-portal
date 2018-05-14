<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Code\UserObject;
use App\Code\TempObject as Temp;

use DB;
use App\Client;
use App\Organisation;
use App\Application;
use App\Status;

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

        $currentUser = UserObject::get(Auth::user()->email, 'email');
        $data = [];

        if ($currentUser->type == "shelter")
        {
            $data = $this->_getShelterData ($currentUser);
            return view('user.shelter.dashboard', compact('currentUser', 'data'));
        }
        elseif($currentUser->type == "advocate")
        {
            $data = $this->_getAdvocateData ($currentUser);
            return view('user.advocate.dashboard', compact('currentUser', 'data'));
        }

    }

    /**
     * Get advocate data for dashboard.
     * 
     */
    protected function _getAdvocateData($currentUser) 
    {
        $advocateData = [];
        
        // Get Clients applications
        $applications = DB::table('applications')
        ->join('clients', 'applications.client_id', '=', 'clients.id')
        ->join('organisations', 'applications.organisation_id', '=', 'organisations.id' )
        ->join('users', 'applications.created_by_advocate_id', '=', 'users.id')
        ->leftJoin('statuses', 'applications.release_status_id','=', 'statuses.id')
        ->where([
            ['applications.organisation_id', '=', $currentUser->organisation_id],
            ['accepted_by_advocate_id', '=', null],
            ['release_status_id', '=', null],
        ])
        ->orWhere([
            ['applications.organisation_id', '=', $currentUser->organisation_id],
            ['accepted_by_advocate_id', '=', ''],
            ['release_status_id', '=', null],
        ])
        ->select([
            'clients.first_name as first_name',
            'clients.last_name as last_name',
            'clients.email as email',
            'applications.created_at as created_at',
            'organisations.name as org_name',
        ])
        ->oldest()
        ->limit(10)
        ->get();

        // Chart - realeased clients
        $completed = DB::table('applications')
        ->join('clients', 'applications.client_id', '=', 'clients.id')
        ->join('organisations', 'applications.organisation_id', '=', 'organisations.id' )
        ->join('users', 'applications.created_by_advocate_id', '=', 'users.id')
        ->leftJoin('statuses', 'applications.release_status_id','=', 'statuses.id')
        ->where([
            ['applications.organisation_id', '=', $currentUser->organisation_id],
            ['statuses.type', '=', 'client_release'],
            ['statuses.value', '=', 'completed'],
        ])
        ->count();

        $not_provided = DB::table('applications')
        ->join('clients', 'applications.client_id', '=', 'clients.id')
        ->join('organisations', 'applications.organisation_id', '=', 'organisations.id' )
        ->join('users', 'applications.created_by_advocate_id', '=', 'users.id')
        ->leftJoin('statuses', 'applications.release_status_id','=', 'statuses.id')
        ->where([
            ['applications.organisation_id', '=', $currentUser->organisation_id],
            ['statuses.type', '=', 'client_release'],
            ['statuses.value', '=', 'not_provided'],
        ])
        ->count();

        $no_longer_needed = DB::table('applications')
        ->join('clients', 'applications.client_id', '=', 'clients.id')
        ->join('organisations', 'applications.organisation_id', '=', 'organisations.id' )
        ->join('users', 'applications.created_by_advocate_id', '=', 'users.id')
        ->leftJoin('statuses', 'applications.release_status_id','=', 'statuses.id')
        ->where([
            ['applications.organisation_id', '=', $currentUser->organisation_id],
            ['statuses.type', '=', 'client_release'],
            ['statuses.value', '=', 'not_provided'],
        ])
        ->count();

        $total_released_client = DB::table('applications')
        ->join('clients', 'applications.client_id', '=', 'clients.id')
        ->join('organisations', 'applications.organisation_id', '=', 'organisations.id' )
        ->join('users', 'applications.created_by_advocate_id', '=', 'users.id')
        ->leftJoin('statuses', 'applications.release_status_id','=', 'statuses.id')
        ->where([
            ['applications.organisation_id', '=', $currentUser->organisation_id],
            ['statuses.type', '=', 'client_release'],
        ])
        ->count();

        $advocateData['applications'] = $applications;
        $advocateData['completed'] = $completed;
        $advocateData['not_provided'] = $not_provided;
        $advocateData['no_longer_needed'] = $no_longer_needed;
        $advocateData['total_released_client'] = $total_released_client;

        return $advocateData;
    }


    /**
     * Get shelter data for dashboard.
     * 
     */

    protected function _getShelterData($currentUser) 
    {
        $shelterData = [];
        
        // Get pets applicatons
        $applications = DB::table('application_pets')
        ->join('applications', 'application_pets.application_id', '=', 'applications.id' )
        // ->join('pets', 'application_pets.id', '=', 'pets.pet_application_id')
        ->join('clients', 'application_pets.client_id', '=', 'clients.id')
        ->join('organisations', 'application_pets.organisation_id', '=', 'organisations.id' )
        ->join('users', 'application_pets.created_by_advocate_id', '=', 'users.id')
        // ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->leftJoin('statuses', 'application_pets.release_status_id','=', 'statuses.id')
        ->where([
            ['accepted_by_shelter_organisation_id', '=', null],
            ['application_pets.release_status_id', '=', null],
        ])
        ->orWhere([
            ['accepted_by_shelter_organisation_id', '=', ''],
            ['application_pets.release_status_id', '=', null],
        ])
        ->select([
            'application_pets.id as id',
            'application_pets.created_at as created_at'
        ])
        ->oldest()
        ->limit(10)
        ->get();
        
        // Get pets details
        $pets = [];
        foreach ($applications as $application) 
        {   
            $pets[$application->id] = DB::table('pets')
            ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
            ->where([
                ['pets.pet_application_id', '=', $application->id]
            ])
            ->select([
                'pets.name as name',
                'object_types.value as type',
                'pets.breed as breed'
            ])
            ->get();
        }  

        // Chart - realeased pets 
        $pets_returned_to_owner = DB::table('application_pets')
        ->join('applications', 'application_pets.application_id', '=', 'applications.id' )
        ->join('pets', 'application_pets.id', '=', 'pets.pet_application_id')
        ->join('clients', 'application_pets.client_id', '=', 'clients.id')
        ->join('organisations', 'application_pets.organisation_id', '=', 'organisations.id' )
        ->join('users', 'application_pets.created_by_advocate_id', '=', 'users.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->leftJoin('statuses', 'application_pets.release_status_id','=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
            ['statuses.value', '=', 'pet_released_to_owner'],
        ])
        ->count();

        $pet_released_to_adoption = DB::table('application_pets')
        ->join('applications', 'application_pets.application_id', '=', 'applications.id' )
        ->join('pets', 'application_pets.id', '=', 'pets.pet_application_id')
        ->join('clients', 'application_pets.client_id', '=', 'clients.id')
        ->join('organisations', 'application_pets.organisation_id', '=', 'organisations.id' )
        ->join('users', 'application_pets.created_by_advocate_id', '=', 'users.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->leftJoin('statuses', 'application_pets.release_status_id','=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
            ['statuses.value', '=', 'pet_released_to_adoption_pool'],
        ])
        ->count();

        $pet_not_served = DB::table('application_pets')
        ->join('applications', 'application_pets.application_id', '=', 'applications.id' )
        ->join('pets', 'application_pets.id', '=', 'pets.pet_application_id')
        ->join('clients', 'application_pets.client_id', '=', 'clients.id')
        ->join('organisations', 'application_pets.organisation_id', '=', 'organisations.id' )
        ->join('users', 'application_pets.created_by_advocate_id', '=', 'users.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->leftJoin('statuses', 'application_pets.release_status_id','=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
            ['statuses.value', '=', 'pet_services_not_provided'],
        ])
        ->count();

        $pet_not_admitted = DB::table('application_pets')
        ->join('applications', 'application_pets.application_id', '=', 'applications.id' )
        ->join('pets', 'application_pets.id', '=', 'pets.pet_application_id')
        ->join('clients', 'application_pets.client_id', '=', 'clients.id')
        ->join('organisations', 'application_pets.organisation_id', '=', 'organisations.id' )
        ->join('users', 'application_pets.created_by_advocate_id', '=', 'users.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->leftJoin('statuses', 'application_pets.release_status_id','=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
            ['statuses.value', '=', 'pet_not_admitted'],
        ])
        ->count();

        $total_released_pets = DB::table('application_pets')
        ->join('applications', 'application_pets.application_id', '=', 'applications.id' )
        ->join('pets', 'application_pets.id', '=', 'pets.pet_application_id')
        ->join('clients', 'application_pets.client_id', '=', 'clients.id')
        ->join('organisations', 'application_pets.organisation_id', '=', 'organisations.id' )
        ->join('users', 'application_pets.created_by_advocate_id', '=', 'users.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->leftJoin('statuses', 'application_pets.release_status_id','=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
        ])
        ->count();


        $shelterData['applications'] = $applications;
        $shelterData['pets'] = $pets;
        $shelterData['pets_returned_to_owner'] = $pets_returned_to_owner;
        $shelterData['pet_released_to_adoption'] = $pet_released_to_adoption;
        $shelterData['pet_not_served'] = $pet_not_served;
        $shelterData['pet_not_admitted'] = $pet_not_admitted;
        $shelterData['total_released_pets'] = $total_released_pets;
        // dd($shelterData['applications']);
        return $shelterData ;
    }

    
}

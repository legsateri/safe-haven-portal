<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Client;
use App\Organisation;
use App\Application;
use App\Status;

class DashboardController extends Controller
{
    public function index()
    {
        $applications = DB::table('applications')
        ->join('clients', 'applications.client_id', '=', 'clients.id')
        ->join('organisations', 'applications.organisation_id', '=', 'organisations.id' )
        ->join('users', 'applications.created_by_advocate_id', '=', 'users.id')
        // ->leftJoin('users', 'applications.accepted_by_advocate_id', '=', 'users.id')
        ->leftJoin('statuses', 'applications.release_status_id','=', 'statuses.id')
        ->where([
            ['accepted_by_advocate_id', '=', null],
            ['release_status_id', '=', null],
        ])
        ->orWhere([
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
        ->latest()
        ->limit(10)
        ->get();
        
        // Chart - realeased pets
        $pets_returned_to_owner = DB::table('pets')
        ->join('clients', 'pets.client_id', '=', 'clients.id')
        ->leftJoin('organisations', 'pets.organisation_id', '=', 'organisations.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->join('application_pets', 'pets.pet_application_id', '=', 'application_pets.id')
        ->join('statuses', 'application_pets.release_status_id', '=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
            ['statuses.value', '=', 'pet_released_to_owner'],
        ])
        ->count();

        $pet_released_to_adoption = DB::table('pets')
        ->join('clients', 'pets.client_id', '=', 'clients.id')
        ->leftJoin('organisations', 'pets.organisation_id', '=', 'organisations.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->join('application_pets', 'pets.pet_application_id', '=', 'application_pets.id')
        ->join('statuses', 'application_pets.release_status_id', '=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
            ['statuses.value', '=', 'pet_released_to_adoption_pool'],
        ])
        ->count();

        $pet_not_served = DB::table('pets')
        ->join('clients', 'pets.client_id', '=', 'clients.id')
        ->leftJoin('organisations', 'pets.organisation_id', '=', 'organisations.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->join('application_pets', 'pets.pet_application_id', '=', 'application_pets.id')
        ->join('statuses', 'application_pets.release_status_id', '=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
            ['statuses.value', '=', 'pet_services_not_provided'],
        ])
        ->count();

        $pet_not_admitted = DB::table('pets')
        ->join('clients', 'pets.client_id', '=', 'clients.id')
        ->leftJoin('organisations', 'pets.organisation_id', '=', 'organisations.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->join('application_pets', 'pets.pet_application_id', '=', 'application_pets.id')
        ->join('statuses', 'application_pets.release_status_id', '=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
            ['statuses.value', '=', 'pet_not_admitted'],
        ])
        ->count();

        $total_released_pets = DB::table('pets')
        ->join('clients', 'pets.client_id', '=', 'clients.id')
        ->leftJoin('organisations', 'pets.organisation_id', '=', 'organisations.id')
        ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
        ->join('application_pets', 'pets.pet_application_id', '=', 'application_pets.id')
        ->join('statuses', 'application_pets.release_status_id', '=', 'statuses.id')
        ->where([
            ['object_types.type', '=', 'pet'],
            ['statuses.type', '=', 'pet_release'],
        ])
        ->count();

        // Chart - realeased clients
        $completed = DB::table('applications')
        ->join('clients', 'applications.client_id', '=', 'clients.id')
        ->join('organisations', 'applications.organisation_id', '=', 'organisations.id' )
        ->join('users', 'applications.created_by_advocate_id', '=', 'users.id')
        ->leftJoin('statuses', 'applications.release_status_id','=', 'statuses.id')
        ->where([
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
            ['statuses.type', '=', 'client_release'],
        ])
        ->count();

        return  view('admin.dashboard.dashboard', 
                compact('applications', 'pets_returned_to_owner','pet_released_to_adoption',
                        'pet_not_served','pet_not_admitted','total_released_pets',
                        'completed','not_provided','no_longer_needed','total_released_client'));

    }

}

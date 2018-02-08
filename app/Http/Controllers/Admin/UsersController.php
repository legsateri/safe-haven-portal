<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class UsersController extends Controller
{

    /**
     * display advocates list page
     */
    public function advocates()
    {
        $users = DB::table('users')
        ->join('object_types', 'users.user_type_id', '=', 'object_types.id')
        ->join('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['object_types.type', '=', 'user'],
            ['object_types.value', '=', 'advocate'],
        ])
        ->select([
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.slug as slug',
            'users.email as email',
            'users.verified as verified',
            'users.banned as banned',
            'organisations.id as organisation_id',
            'organisations.name as organisation_name',
            'organisations.slug as organisation_slug'
        ])
        ->paginate(10);
        
        return view('admin.users.advocates.list', compact('users'));
    }

    /**
     * display advocates list page
     */
    public function shelters()
    {
        $users = DB::table('users')
        ->join('object_types', 'users.user_type_id', '=', 'object_types.id')
        ->join('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['object_types.type', '=', 'user'],
            ['object_types.value', '=', 'shelter'],
        ])
        ->select([
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.slug as slug',
            'users.email as email',
            'users.verified as verified',
            'users.banned as banned',
            'organisations.id as organisation_id',
            'organisations.name as organisation_name',
            'organisations.slug as organisation_slug'
        ])
        ->paginate(10);
        
        return view('admin.users.shelters.list', compact('users'));
    }

    /**
     * display add user page (form)
     */
    public function add()
    {
        $userTypes = DB::table('object_types')->where('type', 'user')->get();

        $organisations = DB::table('organisations')
        ->select([
            'organisations.name as name', 
            'organisations.id as id'
        ])
        ->get();

        // dd($organisations);
        
        return view('admin.users.user_add.add_user', compact('userTypes', 'organisations'));
    }

    public function addSubmit(Request $request)
    {
        
    }

}

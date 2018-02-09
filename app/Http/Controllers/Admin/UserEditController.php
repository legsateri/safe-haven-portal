<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Phone;
use App\Address;
use App\ObjectType;
use App\State;

class UserEditController extends Controller
{
    /**
     * display edit user page
     */
    public function editUserPage($id, $slug)
    {
        // get user data
        $user = DB::table('users')
        ->join('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['users.id', '=', $id],
            ['users.slug', '=', $slug]
        ])
        ->select([
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.email as email',
            'users.slug as slug',
            'users.verified as verified',
            'users.banned as banned',
            'organisations.id as organisation_id',
            'organisations.name as organisation_name',
            'organisations.slug as organisation_slug'
        ])
        ->first();

        if ( !isset($user->id) )
        {
            // user not found, return error
            return "404 error<br>resource not found";
        }

        // get user phone
        $userPhone = Phone::where([
            ['entity_type', '=', 'user'],
            ['entity_id', '=', $user->id]
        ])->first();

        // get user address
        $userAddress = Address::where([
            ['entity_type', '=', 'user'],
            ['entity_id', '=', $user->id]
        ])->first();

        $organisations = DB::table('organisations')
        ->select([
            'organisations.name as name', 
            'organisations.id as id'
        ])
        ->get();

        $phoneTypes = ObjectType::where([
            ['type', '=', 'phone']
        ])->get();

        $addressTypes = ObjectType::where([
            ['type', '=', 'address']
        ])->get();

        $states = State::all();

        return  view('admin.users.user.edit_user', 
                compact('user', 'userPhone', 'userAddress', 'organisations', 'phoneTypes', 'addressTypes', 'states'));
    }


    /**
     * submit action
     * update user general information
     */
    public function submitGeneral(Request $request)
    {

    }


    /**
     * submit action
     * update user contact information
     */
    public function submitContact(Request $request)
    {

    }


    /**
     * submit action
     * reset user password
     */
    public function submitPassword(Request $request)
    {

    }


    /**
     * submit action
     * verify/unverify user email address
     */
    public function submitVerified(Request $request)
    {

    }


    /**
     * submit action
     * ban/unbun user
     */
    public function submitBan(Request $request)
    {

    }
}

<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\State;
use App\ObjectType;
use App\Address;
use App\Phone;
use App\Organisation;
use App\OrganisationAdmin;
use Validator;
use DB;

use App\Code\UserObject;

class OrganizationController extends Controller
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
     * user organization page
     */
    public function index()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');
        
        $states = State::all();

        $organisation = Organisation::where([
            ['id', '=', $currentUser->organisation_id]
        ])->first();

        $organisationPhone = Phone::where([
            ['entity_type', '=', 'organisation'],
            ['entity_id', '=', $currentUser->organisation_id]
        ])->first();

        $organisationAddress = Address::where([
            ['entity_type', '=', 'organisation'],
            ['entity_id', '=', $currentUser->organisation_id]
        ])->first();

        $phoneTypes = ObjectType::where('type', 'phone')->get();

        $checkOrganisationAdmin = OrganisationAdmin::where([
        ['user_id', '=', $currentUser->id],
        ['organisation_id', '=', $organisation->id]
        ])->first();
        
        $organisationAdmin = DB::table('users')
            ->join('organisation_admins', 'users.id', '=', 'organisation_admins.user_id')
            ->where([
                ['organisation_admins.organisation_id', '=', $currentUser->organisation_id]
            ])
            ->select('users.email')
            ->first();

        return view('auth.shared.orgAccount', compact('currentUser', 'states', 'organisation', 'organisationPhone','organisationAddress', 'phoneTypes', 'organisationAdmin', 'checkOrganisationAdmin' ));
    }
}

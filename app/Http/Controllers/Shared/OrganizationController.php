<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
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
     * User organisation page.
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


    /**
     * Update user organisation page.
     */
    public function updateInfo(Request $request){
        // dd($request);
        //validate data from form
        $validator = Validator::make($request->all(),[          
            'name'                  => 'required|string|max:255',
            'code'                  => 'nullable|string|max:20',
            'tax_id'                => 'nullable|regex:/^\d{2}-\d{7}$/',
            'services'              => 'nullable|max:3000',
            'have_office_hours'     => 'required|in:1,0',
            'website'               => 'nullable|max:100|url',
            'geographic_area_served'=> 'nullable|max:3000',
            // 'org_admin'          => '',
            'email'                 => 'required|email|max:255',
            'phone_number'          => 'required|regex:/^\d{3}\d{3}\d{4}$/',
            'street'                => 'nullable|string|max:255',
            'city'                  => 'nullable|string|max:255',
            'zip_code'              => 'nullable|integer|regex:/^\d{5}$/',
            'state'                 => 'nullable|exists:states,id',

            ]);
        
        if (!($validator->fails())){

            //find user
            $user = User::where('id', Auth()->user()->id)->first();

            //find organisation
            $organisation = Organisation::where([
                ['id', '=', $user->organisation_id]
            ])->first();
                
            //find organisation admin
            $organisationAdminId = DB::table('users')
            ->join('organisation_admins', 'users.id', '=', 'organisation_admins.user_id')
            ->where([
                ['organisation_admins.user_id', '=', Auth::user()->id],
                ['organisation_admins.organisation_id', '=', $user->organisation_id]
            ])
            ->select('users.id')
            ->first();
            
            //check if current user is organisation admin
            if(isset($organisationAdminId)){

                //update organisation info
                $organisation->name = $request->name;
                $organisation->code = $request->code;
                $organisation->tax_id = $request->tax_id;
                $organisation->services = $request->services;
                $organisation->have_office_hours = $request->have_office_hours;
                $organisation->website = $request->website;
                $organisation->geographic_area_served = $request->geographic_area_served;
                $organisation->email = $request->email;
                $organisation->update();

                //update organisation phone
                $organisationPhone = Phone::where([
                    ['entity_type', '=', 'organisation'],
                    ['entity_id', '=', $organisation->id]
                ])->first();

                $organisationPhoneType = ObjectType::where([
                    ['type', '=', 'phone'],
                    ['value', '=', 'office']                        
                ])->first();

                if(isset($organisationPhone->id)){
                    $organisationPhone->phone_type_id = $organisationPhoneType->id;
                    $organisationPhone->number = $request->phone_number;                    
                    $organisationPhone->update();
                } else {
                    $organisationPhone = new Phone();
                    $organisationPhone->entity_type = 'organisation';
                    $organisationPhone->entity_id = $organisation->id;
                    $organisationPhone->phone_type_id = $organisationPhoneType->id;

                    $organisationPhone->number = $request->phone_number;
                    $organisationPhone->save();
                }

                //update organisation's address
                $organisationAddress = Address::where([
                    ['entity_type', '=', 'organisation'],
                    ['entity_id', '=', $organisation->id]
                ])->first();
                
                $organisationAddressType = ObjectType::where([
                    ['type', '=', 'address'],
                    ['value', '=', 'office']                        
                ])->first();

                if(isset($organisationAddress->id)){
                    $organisationAddress->address_type_id = $organisationAddressType->id; 
                    $organisationAddress->street = $request->street;
                    $organisationAddress->city = $request->city;
                    $organisationAddress->zip_code = $request->zip_code;
                    $organisationAddress->state = $request->state;
                    $organisationAddress->update();
                } else {
                    $organisationAddress = new Address();
                    $organisationAddress->entity_type = 'organisation';
                    $organisationAddress->entity_id = $organisation->id;
                    $organisationAddress->address_type_id = $organisationAddressType->id;

                    $organisationAddress->street = $request->street;
                    $organisationAddress->city = $request->city;
                    $organisationAddress->zip_code = $request->zip_code;
                    $organisationAddress->state = $request->state;
                    $organisationAddress->save();
                }

                return redirect()->back()->with('success', 'Organisation successfully updated!');

            } elseif (!isset($organisationAdmin->id)) {
                return redirect()->back()->with('error', 'You have no authority to make changes!');
            }

        } 
        // invalid entries
        $errors = $validator->errors();
        
        if ( $errors->first('name') != null ){
            return redirect()->back()->with('error', $errors->first('name'));
        }
        if ( $errors->first('code') != null ){
            return redirect()->back()->with('error', $errors->first('code'));
        }
        if ( $errors->first('tax_id') != null ){
            return redirect()->back()->with('error', $errors->first('tax_id'));
        }
        if ( $errors->first('services') != null ){
            return redirect()->back()->with('error', $errors->first('services'));
        }
        if ( $errors->first('have_office_hours') != null ){
            return redirect()->back()->with('error', $errors->first('have_office_hours'));
        }
        if ( $errors->first('website') != null ){
            return redirect()->back()->with('error', $errors->first('website'));
        }
        if ( $errors->first('geographic_area_served') != null ){
            return redirect()->back()->with('error', $errors->first('geographic_area_served'));
        }
        if ( $errors->first('email') != null ){
            return redirect()->back()->with('error', $errors->first('email'));
        }
        if ( $errors->first('phone_number') != null ){
            return redirect()->back()->with('error', $errors->first('phone_number'));
        }
        if ( $errors->first('street') != null ){
            return redirect()->back()->with('error', $errors->first('street'));
        }
        if ( $errors->first('city') != null ){
            return redirect()->back()->with('error', $errors->first('city'));
        }
        if ( $errors->first('zip_code') != null ){
            return redirect()->back()->with('error', $errors->first('zip_code'));
        }
        if ( $errors->first('state') != null ){
            return redirect()->back()->with('error', $errors->first('state'));
        }
    }
}

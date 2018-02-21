<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Validator;

use App\User;
use App\OrganisationAdmin;
use App\State;
use App\Phone;
use App\Address;
use App\Organisation;
use App\ObjectType;

class OrganisationEditController extends Controller
{
    /**
     * load edit organisation general information page
     */
    public function editGeneral($id, $slug)
    {
        $organisationTypes = DB::table('object_types')
        ->where([
            ['type', '=', 'organisation']
        ])
        ->get();

        $organisation = $this->_getOrganisationInfo($id, $slug);

        return  view('admin.organisations.edit_organisation_general', 
                compact('organisationTypes', 'organisation'));
    } // end editGeneral


    /**
     * load edit organisation contact information page
     */
    public function editContact($id, $slug)
    {
        // get organisation basin data
        $organisation = $this->_getOrganisationInfo($id, $slug);
        // get states list
        $states = State::all();

        // get organisation phone
        $phone = Phone::where([
            ['entity_type', '=', 'organisation'],
            ['entity_id', '=', $organisation->id]
        ])
        ->first();
        // get organisation address
        $address = Address::where([
            ['entity_type', '=', 'organisation'],
            ['entity_id', '=', $organisation->id]
        ])
        ->first();

        return  view('admin.organisations.edit_organisation_contact', 
                compact('organisation', 'states', 'phone','address'));
    } // end editContact


    /**
     * load edit organisation profile information page
     */
    public function editProfile($id, $slug)
    {
        $organisation = $this->_getOrganisationInfo($id, $slug);
        
        return  view('admin.organisations.edit_organisation_profile', 
                compact('organisation'));
    } // end editProfile


    /**
     * load organisation user list page
     */
    public function editUsers($id, $slug)
    {
        $organisation = $this->_getOrganisationInfo($id, $slug);

        $users = DB::table('users')
        ->leftJoin('organisation_admins', 'users.id', '=', 'organisation_admins.user_id')
        ->where([
            ['users.organisation_id', '=', $id]
        ])
        ->select(
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.slug as slug',
            'users.email as email',
            'users.verified as verified',
            'users.banned as banned',
            'organisation_admins.id as admin'
        )
        ->paginate(10);
        
        return  view('admin.organisations.edit_organisation_users', 
                compact('organisation', 'users'));
    } // end editUsers


    /**
     * load organisation user list page
     */
    public function editAdmins($id, $slug)
    {
        $admins = DB::table('users')
        ->join('organisation_admins', 'users.id', '=', 'organisation_admins.user_id')
        ->where([
            ['users.organisation_id', '=', $id]
        ])
        ->select(
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.slug as slug',
            'users.email as email',
            'users.verified as verified',
            'users.banned as banned'
        )
        ->paginate(10);

        $users = DB::table('users')
        ->leftJoin('organisation_admins', 'users.id', '=', 'organisation_admins.user_id')
        ->where([
            ['users.organisation_id', '=', $id]
        ])
        ->select(
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.slug as slug',
            'users.email as email',
            'users.verified as verified',
            'users.banned as banned',
            'organisation_admins.id as admin'
        )
        ->get();
        
        $organisation = $this->_getOrganisationInfo($id, $slug);
        
        return  view('admin.organisations.edit_organisation_admins', 
                compact('organisation', 'admins', 'users'));
    } // end editAdmins


    /**
     * return organisation informations
     * as object
     */
    private function _getOrganisationInfo($id, $slug)
    {
        $organisation = DB::table('organisations')
        ->where([
            ['organisations.id', '=', $id],
            ['organisations.slug', '=', $slug]
        ])
        ->select(
            'organisations.id as id',
            'organisations.slug as slug',
            'organisations.name as name',
            'organisations.email as email',
            'organisations.org_type_id as type_id',
            'organisations.tax_id as tax_id'
        )
        ->first();

        return $organisation;
    } // end _getOrganisationInfo



    /**
     * submit edit organisation general information
     */
    public function submitGeneral($id, $slug, Request $request)
    {
        $organisation = $this->_getOrganisationInfo($id, $slug);
        if( !isset($organisation->id) )
        {
            // if no organisation is found, return back to page
            return redirect()->route('admin.organisation.edit.general.page', [ 'id' => $id, 'slug' => $slug ]);
        }

        // validate entries from request
        $validator = Validator::make($request->all(),[
            'name'     => 'required|string|max:45',
            'code'     => 'nullable|string|max:10',
            'tax_id'   => 'nullable|exists:states,name',
            'type'     => 'required',
        ]);

        if (!($validator->fails()))
        {

        }

        // return to edit page
        return redirect()
        ->route('admin.organisation.edit.contact.page', [
            'id' => $id,
            'slug' => $slug
        ])
        ->withErrors($validator)
        ->withInput();

    } // end submitGeneral

    

    /**
     * submit edit organisation contact information
     */
    public function submitContact($id, $slug, Request $request)
    {
        $organisation = $this->_getOrganisationInfo($id, $slug);
        if( !isset($organisation->id) )
        {
            // if no organisation is found, return back to page
            return redirect()->route('admin.organisation.edit.contact.page', [ 'id' => $id, 'slug' => $slug ]);
        }
        
        // validate data from request
        $validator = Validator::make($request->all(),[
            'email'     => 'nullable|email|max:45',
            'phone'     => 'nullable|string|max:10',
            'state'     => 'nullable|exists:states,name',
            'city'      => 'nullable|string|max:45',
            'zip_code'  => 'nullable|string|max:5',
            'street'    => 'nullable|string|max:65',
        ]);

        if (!($validator->fails()))
        {
            // update email
            if ( $organisation->email != $request->email )
            {
                $organisation = Organisation::where('id', $organisation->id)->first();
                $organisation->email = $request->email;
                $organisation->update();
            }

            // update phone (or add if not found)
            $phone = Phone::where([
                ['entity_type', '=', 'organisation'],
                ['entity_id', '=', $organisation->id]
            ])->first();
            
            if ( isset($phone->id) )
            {   
                // update phone entry
                $phone->number = $request->phone;
                $phone->update();
            }
            else
            {
                // get new phone type id
                $phoneType = ObjectType::where([
                    ['type', '=', 'phone'],
                    ['value', '=', 'office']
                ])->first();
                // insert new phone entry
                $phone = new Phone();
                $phone->entity_type = 'organisation';
                $phone->entity_id = $organisation->id;
                $phone->phone_type_id = $phoneType->id;
                $phone->number = $request->phone;
                $phone->save();
            }

            // update address (or add if not found)
            $address = Address::where([
                ['entity_type', '=', 'organisation'],
                ['entity_id', '=', $organisation->id]
            ])->first();

            if ( isset($address->id) )
            {
                // update address entry
                $address->state = $request->state;
                $address->city = $request->city;
                $address->zip_code = $request->zip_code;
                $address->street = $request->street;
                $address->update();
            }
            else
            {
                // get new address type id
                $addressType = ObjectType::where([
                    ['type', '=', 'address'],
                    ['value', '=', 'office']
                ])->first();
                // inser new address entry
                $address = new Address();
                $address->entity_type = 'organisation';
                $address->entity_id = $addressType->id;
                $address->state = $request->state;
                $address->city = $request->city;
                $address->zip_code = $request->zip_code;
                $address->street = $request->street;
                $address->save();
            }

            // return redirect to list page with success message
            return redirect()
                    ->route('admin.organisation.edit.contact.page', [
                        'id' => $id,
                        'slug' => $slug
                    ])
                    ->with('success', 'Contact information successfully updated!');

        }

        // return to edit page
        return redirect()
        ->route('admin.organisation.edit.contact.page', [
            'id' => $id,
            'slug' => $slug
        ])
        ->withErrors($validator)
        ->withInput();

    } // end submitContact


    /**
     * submit remove user from organisation
     */
    public function removeUserSubmit($id, $slug, Request $request)
    {
        // get list of user ids that belongs to organisation
        $users = DB::table('users')
        ->join('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['organisations.id', '=', $id],
            ['organisations.slug', '=', $slug]
        ])
        ->select(
            'users.id as id'
        )
        ->get();

        $list = "";
        foreach( $users as $user )
        {
            if ( $list != "" ) { $list .= ','; }
            $list .= (string)$user->id;
        }
        if ( $list == "" )
        {
            // no user found for organisation, return back to user list
            return redirect()
                    ->route('admin.organisation.edit.users.page', [
                        'id' => $id,
                        'slug' => $slug
                    ]);
        }
        
        // validate user id
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|in:' . $list,
        ]);

        if (!($validator->fails()))
        {
            // check is user organisation admin
            // if it is, remove from admin list
            $isAdmin = OrganisationAdmin::where('user_id', $request->user_id)->delete();

            // update user
            $user = User::where('id', $request->user_id)->first();
            $user->organisation_id = null;
            $user->update();

            // return redirect to list page with success message
            return redirect()
                    ->route('admin.organisation.edit.users.page', [
                        'id' => $id,
                        'slug' => $slug
                    ])
                    ->with('success', 'User ' . $user->first_name . ' ' . $user->last_name . ' successfully removed from organization!');
        }

        // return to list page
        return redirect()
                ->route('admin.organisation.edit.users.page', [
                    'id' => $id,
                    'slug' => $slug
                ]);
    } // end removeUserSubmit


    /**
     * submit remove admin from organisation
     */
    public function removeAdminSubmit($id, $slug, Request $request)
    {
        // get list of user ids that belongs to organisation
        $users = DB::table('users')
        ->join('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['organisations.id', '=', $id],
            ['organisations.slug', '=', $slug]
        ])
        ->select(
            'users.id as id'
        )
        ->get();

        $list = "";
        foreach( $users as $user )
        {
            if ( $list != "" ) { $list .= ','; }
            $list .= (string)$user->id;
        }
        if ( $list == "" )
        {
            // no user found for organisation, return back to user list
            return redirect()
                    ->route('admin.organisation.edit.admins.page', [
                        'id' => $id,
                        'slug' => $slug
                    ]);
        }
        
        // validate user id
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|in:' . $list,
        ]);

        if (!($validator->fails()))
        {
            // remove user as organisation admin
            $removeAdmin = OrganisationAdmin::where('user_id', $request->user_id)->delete();

            // return redirect to list page with success message
            return redirect()
                    ->route('admin.organisation.edit.admins.page', [
                        'id' => $id,
                        'slug' => $slug
                    ])
                    ->with('success', 'Administrator successfully removed from organization!');

        }

        // return to list page
        return redirect()
                ->route('admin.organisation.edit.admins.page', [
                    'id' => $id,
                    'slug' => $slug
                ]);
    } // end removeAdminSubmit

    
    /**
     * submit add admin to organisation
     */
    public function addAdminSubmit($id, $slug, Request $request)
    {
        // get list of user ids that belongs to organisation
        $users = DB::table('users')
        ->join('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['organisations.id', '=', $id],
            ['organisations.slug', '=', $slug]
        ])
        ->select(
            'users.id as id'
        )
        ->get();

        $list = "";
        foreach( $users as $user )
        {
            if ( $list != "" ) { $list .= ','; }
            $list .= (string)$user->id;
        }
        if ( $list == "" )
        {
            // no user found for organisation, return back to user list
            return redirect()
                    ->route('admin.organisation.edit.admins.page', [
                        'id' => $id,
                        'slug' => $slug
                    ]);
        }
        
        // validate user id
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|in:' . $list,
        ]);

        if (!($validator->fails()))
        {
            // check is user already organisation admin
            // if it is, just return back
            $isAdmin = OrganisationAdmin::where([
                ['user_id', '=', $request->user_id],
                ['organisation_id', '=', $id]
                ])->first();
            if ( isset($isAdmin->id) )
            {
                // return to list page
                return redirect()
                ->route('admin.organisation.edit.admins.page', [
                    'id' => $id,
                    'slug' => $slug
                ]);
            }

            // add user to organisation admin list
            $newAdmin = new OrganisationAdmin();
            $newAdmin->user_id = $request->user_id;
            $newAdmin->organisation_id = $id;
            $newAdmin->save();

            // return redirect with success message
            return redirect()
                    ->route('admin.organisation.edit.admins.page', [
                        'id' => $id,
                        'slug' => $slug
                    ])
                    ->with('success', 'New administrator successfully assigned to organization!');
        }

        // return to list page
        return redirect()
                ->route('admin.organisation.edit.admins.page', [
                    'id' => $id,
                    'slug' => $slug
                ]);
    } // end addAdminSubmit
}

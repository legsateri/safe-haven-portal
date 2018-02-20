<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Validator;

use App\State;
use App\Organisation;
use App\Phone;
use App\Address;

class OrganisationController extends Controller
{
    /**
     * load advocate organisations page
     */
    public function advocates()
    {
        $organisations = $this->_getListItems('advocate');
        $type = DB::table('object_types')
        ->where([
            ['type', '=', 'organisation'],
            ['value', '=', 'advocate']
        ])
        ->first();
        
        return  view('admin.organisations.list', 
                compact('organisations', 'type'));
    }


    /**
     * load shelter organisations page
     */
    public function shelters()
    {
        $organisations = $this->_getListItems('shelter');
        $type = DB::table('object_types')
        ->where([
            ['type', '=', 'organisation'],
            ['value', '=', 'shelter']
        ])
        ->first();

        return  view('admin.organisations.list', 
                compact('organisations', 'type'));
    }


    /**
     * add new organisations page
     */
    public function add()
    {
        $organisationTypes = DB::table('object_types')
        ->where([
            ['type', '=', 'organisation']
        ])
        ->get();

        $states = State::all();

        return  view('admin.organisations.add_organisation', 
                compact('organisationTypes', 'states'));
    }


    /**
     * add new organisations submit request
     */
    public function addSubmit(Request $request)
    {
        // valid organisation type ids
        $organisationTypes = DB::table('object_types')
        ->where([
            ['type', '=', 'organisation']
        ])
        ->get();
        $organisationTypesIdString = "";
        foreach( $organisationTypes as $organisationType )
        {
            if ( $organisationTypesIdString != "" ) { $organisationTypesIdString .= ','; }
            $organisationTypesIdString .= (string)$organisationType->id;
        }

        // validate data from form
        $validator = Validator::make($request->all(),[
            'name'              => 'required|string|max:40',
            'code'              => 'nullable|string|max:20|unique:organisations',
            'tax_id'            => 'nullable|regex:/^\d{2}-\d{7}$/|unique:organisations',
            'organisation_type' => 'required|in:' . $organisationTypesIdString,
            'email'             => 'nullable|email|max:45|unique:organisations',
            'phone'             => 'nullable|numeric|max:10',
            'city'              => 'nullable|string',
            'zip_code'          => 'nullable|numeric|max:5',
            'street'            => 'nullable|string|max:50',
            'state'             => 'nullable|exists:states,name',
        ]);

        if (!($validator->fails()))
        {
            // insert new organisation in database
            $organisation = new Organisation();
            $organisation->name = $request->name;
            $organisation->slug = str_slug($request->name, '-');
            $organisation->org_type_id = $request->organisation_type;
            if ( isset( $request->code ) ) 
            { 
                $organisation->code = $request->code;
            }
            if ( isset( $request->tax_id ) ) 
            { 
                $organisation->tax_id = $request->tax_id;
            }
            if ( isset( $request->email ) ) 
            { 
                $organisation->email = $request->email;
            }
            $organisation->save();

            // save phone if is set
            if ( isset( $request->phone ) )
            {
                if ( $request->phone != "" )
                {
                    // get office phone type id
                    $phoneType = DB::table('object_types')
                    ->where([
                        ['type', '=', 'phone'],
                        ['value', '=', 'office']
                    ])
                    ->first();
                    
                    // save phone number
                    $phone = new Phone();
                    $phone->entity_type = 'organisation';
                    $phone->entity_id = $organisation->id;
                    $phone->phone_type_id = $phoneType->id;
                    $phone->number = $request->phone;
                    $phone->save();
                }
            }

            // save address if is set
            if ( isset( $request->city ) || isset( $request->zip_code ) || isset( $request->street ) || isset( $request->state ) )
            {
                if ( $request->city != "" || $request->zip_code != "" || $request->street != "" || $request->state != ""  )
                {
                    // get office sddress type id
                    $addressType = DB::table('object_types')
                    ->where([
                        ['type', '=', 'address'],
                        ['value', '=', 'office']
                    ])
                    ->first();

                    // save address
                    $address = new Address();
                    $address->entity_type = 'organisation';
                    $address->entity_id = $organisation->id;
                    $address->address_type_id = $addressType->id;
                    if ( isset($request->state) )
                    {
                        $address->state = $request->state;
                    }
                    if ( isset($request->city) )
                    {
                        $address->city = $request->city;
                    }
                    if ( isset($request->zip_code) )
                    {
                        $address->zip_code = $request->zip_code;
                    }
                    if ( isset($request->street) )
                    {
                        $address->street = $request->street;
                    }
                    $address->save();

                    // update organisation entry with address id
                    $organisation->address_id = $address->id;
                    $organisation->update();
                }
            }


            // redirect to edit organisation page
            return redirect()
                    ->route('admin.organisation.edit.general.page', [
                        'id' => $organisation->id,
                        'slug' => $organisation->slug
                    ])
                    ->with('success', 'Organization successfully created!');
        }

        // return back with errors
        return redirect()->back()->withErrors($validator)->withInput();

    }


    /**
     * load list of organisations from database
     */
    private function _getListItems($type)
    {
        $organisations = DB::table('organisations')
        ->join('object_types', 'organisations.org_type_id', '=', 'object_types.id')
        ->where([
            ['object_types.type', '=', 'organisation'],
            ['object_types.value', '=', $type],
        ])
        ->select(
            'organisations.id as id',
            'organisations.slug as slug',
            'organisations.name as name',
            'organisations.email as email',
            'organisations.code as code',
            'organisations.org_type_id as type_id',
            'organisations.tax_id as tax_id'
        )
        ->paginate(10);

        return $organisations;
    }
}

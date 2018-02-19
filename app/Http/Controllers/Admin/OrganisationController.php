<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class OrganisationController extends Controller
{
    /**
     * load advocate organisations page
     */
    public function advocates()
    {
        $organisations = $this->_getListItems('advocate');
        
        return  view('admin.organisations.list', 
                compact('organisations'));
    }


    /**
     * load shelter organisations page
     */
    public function shelters()
    {
        $organisations = $this->_getListItems('shelter');

        return  view('admin.organisations.list', 
                compact('organisations'));
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
        return view('admin.organisations.add_organisation', compact('organisationTypes'));
    }


    /**
     * add new organisations submit request
     */
    public function addSubmit(Request $request)
    {
        
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
            'organisations.org_type_id as type_id'
        )
        ->paginate(10);

        return $organisations;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class OrganisationEditController extends Controller
{
    /**
     * load edit organisation page
     */
    public function editOrganisationPage($id, $slug)
    {
        $organisationTypes = DB::table('object_types')
        ->where([
            ['type', '=', 'organisation']
        ])
        ->get();

        $organisation = DB::table('organisations')
        ->where([
            ['organisations.id', '=', $id],
            ['organisations.slug', '=', $slug],
        ])
        ->select(
            'organisations.id as id',
            'organisations.slug as slug',
            'organisations.name as name',
            'organisations.org_type_id as type_id'
        )
        ->first();

        return  view('admin.organisations.edit_organisation', 
                compact('organisationTypes', 'organisation'));
    }


    public function submitGeneral($id, $slug, Request $request)
    {

    }


    public function submitContact($id, $slug, Request $request)
    {

    }
}

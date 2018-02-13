<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

use App\Code\TempObject;

class ListFiltersController extends Controller
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

    protected $_validFilterNames = [
        'clients_in_need',
        'current_clients'
    ];


    public function submit($uenc, Request $request)
    {
        // validate filter name from request
        if( isset($request->filter_name) )
        {
            if ( in_array($request->filter_name, $this->_validFilterNames) )
            {
                switch ($request->filter_name) 
                {
                    case 'clients_in_need':
                        $this->_clientsInNeedFilter($request);
                        break;

                } // end switch
            }
        }

        // return redirect to parent
        $paret_route = base64_decode($uenc);
        header('Location: '. $paret_route);
        exit;

    } // end submit


    protected function _clientsInNeedFilter($request)
    {
        // validate request data
        $validator = Validator::make($request->all(), [
            'order_by' => 'required|in:asc,desc',
            'filter_by_answered' => 'required|in:all,answered,unanswered'
        ]);

        if ( !$validator->fails() )
        {
            // save filter in temp data for current user
        } 

    } // end _clientsInNeedFilter




}

<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;

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

    /**
     * valid filter names
     */
    protected $_validFilterNames = [
        'clients_in_need',
        'current_clients'
    ];


    /**
     * submit request for applying new filter rule
     */
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
                    case 'current_clients':
                        $this->_currentClientsFilter($request);
                        break;

                } // end switch
            }
        }

        // return redirect to parent
        $paret_route = base64_decode($uenc);
        header('Location: '. $paret_route);
        exit;

    } // end submit


    /**
     * handle update filter rules
     * for clients in need list
     */
    protected function _clientsInNeedFilter($request)
    {
        // validate request data
        $validator = Validator::make($request->all(), [
            'order_by' => 'required|in:asc,desc',
            'filter_by_answered' => 'required|in:all,answered,unanswered'
        ]);

        if ( !$validator->fails() )
        {
            // save filter rules in temp data
            $temp = TempObject::get(Auth::user()->id, 'list-filters');
            $temp['clients_in_need'] = [
                'order_by' => $request->order_by,
                'filter_by_answered' => $request->filter_by_answered
            ];
            TempObject::set(Auth::user()->id, 'list-filters', $temp);
        } 

    } // end _clientsInNeedFilter


    /**
     * handle update filter rules
     * for current clients list
     */
    protected function _currentClientsFilter($request)
    {
        // validate request data
        $validator = Validator::make($request->all(), [
            'order_by' => 'required|in:asc,desc',
            'filter_by_answered' => 'required|in:all,answered,unanswered'
        ]);

        if ( !$validator->fails() )
        {
            // save filter rules in temp data
            $temp = TempObject::get(Auth::user()->id, 'list-filters');
            $temp['current_clients'] = [
                'order_by' => $request->order_by,
                'filter_by_answered' => $request->filter_by_answered
            ];
            TempObject::set(Auth::user()->id, 'list-filters', $temp);
        } 

    } // end _currentClientsFilter




}

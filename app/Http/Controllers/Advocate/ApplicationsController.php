<?php

namespace App\Http\Controllers\Advocate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Code\UserObject;

class ApplicationsController extends Controller
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
     * new client application page (form)
     */
    public function newApplication()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        return view('auth.advocate.applicationNew', compact('currentUser'));
    }

    /**
     * submit new client application form
     */
    public function newApplicationSubmit(Request $request)
    {

    }


    public function ajaxHandler(Request $request)
    {
        $ajax_response_data = array(
                'message' => 'some error message from backend'/*, // description of why is invalid
                'global_answer_counts' => 'yes',
                'current_answer_value' => 'yes'*/
            );

        $ajax_response = array(
            'success' => true, // true if valid, false if invalid
            'data' => $ajax_response_data // add data if invalid
        );

        return $ajax_response;
    }
}

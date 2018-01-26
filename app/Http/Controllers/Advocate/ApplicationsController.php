<?php

namespace App\Http\Controllers\Advocate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use DB;

use App\ObjectType;
use App\State;

use App\Code\UserObject;
use App\Code\TempObject;

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

        $phoneTypes = ObjectType::where('type', 'phone')->get();

        $states = State::all();

        return view('auth.advocate.applicationNew', compact('currentUser', 'phoneTypes', 'states'));
    }

    /**
     * submit new client application form
     */
    public function newApplicationSubmit(Request $request)
    {

    }


    public function ajaxHandler(Request $request)
    {
        
        if ( !isset(Auth::user()->id) )
        {
            return [
                'success' => false,
                'message' => 'You re not authenticated!'
            ];
        }
        
        // check is action type specified
        if ( !isset($request->action) )
        {
            // return error to user
            return;
        }

        /**
         * validation for single fields
         */
        if ( $request->action == "validation_single" )
        {

            switch ($request->element_id) {

                case 'org_first_name':
                    $response = $this->_validateClientFirstName($request->input_value);
                    break;

                case 'org_last_name':
                    $response = $this->_validateClientLastName($request->input_value);
                    break;

                case 'contact_phone_num':
                    $response = $this->_validateClientPhoneNumber($request->input_value);
                    break;

                case 'phone_number_type':
                    $response = $this->_validateClientPhoneNumberType($request->input_value);
                    break;

                case 'inputEmail4':
                    $response = $this->_validateClientEmail($request->input_value);
                    break;

                case 'pref_contact_method':
                    $response = $this->_validateClientPreferedContactMethod($request->input_value);
                    break;

                case 'address':
                    $response = $this->_validateClientAddress($request->input_value);
                    break;

                case 'city':
                    $response = $this->_validateClientCity($request->input_value);
                    break;

                case 'state':
                    $response = $this->_validateClientState($request->input_value);
                    break;

                case 'zip':
                    $response = $this->_validateClientZip($request->input_value);
                    break;

                //case 'pet_type':
                case 'description': //testing, remove later
                    $ajax_response['success'] =true;
                    if ( $ajax_response['success'] != true )
                    {
                        $ajax_response['data']['message'] = 'not good value';
                    }
                    return $ajax_response;
                default:
                    # code...
                    break;
            }
            // die('sssssss');
            // var_dump($responce);
            // exit;
            
            
            
        }
        
        
        
        // $ajax_response_data = array(
        //         'message' => 'some error message from backend'/*, // description of why is invalid
        //         'global_answer_counts' => 'yes',
        //         'current_answer_value' => 'yes'*/
        //     );

        // $ajax_response = array(
        //     'success' => true, // true if valid, false if invalid
        //     'data' => $ajax_response_data // add data if invalid
        // );

        $ajax_response['success'] = $response['success'];
        if ( $ajax_response['success'] != true )
        {
            $ajax_response['data']['message'] = $response['message'];
        }
        return $ajax_response;
    }


    /**
     * validate new client first name
     * and return status with message
     */
    private function _validateClientFirstName($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:20'
        ]);

        if ( !$validator->fails() )
        {
            
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-first-name'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);

            // return success
            return ['success' => true];
        }
        else
        {
            // return error mesasage
            if ( $value == "" || $value == null )
            {
                return [
                    'success' => false,
                    'message' => 'Requiered field'
                ];
            }
            return [
                'success' => false,
                'message' => 'Max lenght of first name is 20 characters'
            ];
        }
    } // end _validateClientFirstName


    /**
     * validate new client last name
     * and return status with message
     */
    private function _validateClientLastName($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:20'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-last-name'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
            // return success
            return ['success' => true];
        }
        else
        {
            // return error mesasage
            if ( $value == "" || $value == null )
            {
                return [
                    'success' => false,
                    'message' => 'Requiered field'
                ];
            }
            return [
                'success' => false,
                'message' => 'Max lenght of last name is 20 characters'
            ];
        }
    } // end _validateClientLastName



    /**
     * validate new client phone number
     * and return status with message
     */
    private function _validateClientPhoneNumber($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|regex:/^\d{3}\d{3}\d{4}$/'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-phone-number'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
            // return success
            return ['success' => true];
        }
        else
        {
            // return error mesasage
            if ( $value == "" || $value == null )
            {
                return [
                    'success' => false,
                    'message' => 'Requiered field'
                ];
            }
            return [
                'success' => false,
                'message' => 'Invalid format for phone number'
            ];
        }

    } // end _validateClientPhoneNumber


    /**
     * validate new client phone number type
     * and return status with message
     */
    private function _validateClientPhoneNumberType($value)
    {
        // get phone types from db
        $phoneTypesDB = DB::table('object_types')
                        ->select('value')
                        ->where('type', '=', 'phone')
                        ->get();
        $phoneTypes = [];
        foreach ($phoneTypesDB as $phoneType) {
            array_push($phoneTypes, $phoneType->value);
        }

        // check is $value empty
        if ( $value == "" || $value == null )
        {
            return [
                'success' => false,
                'message' => 'Phone type not selected'
            ];
        }

        // check does value exist in phone types array
        if ( in_array($value, $phoneTypes) )
        {
            
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-phone-number-type'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
            // return success
            return [
                'success' => true
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid phone type'
        ];


    } // end _validateClientPhoneNumberType


    private function _validateClientEmail($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|email|max:40'
        ]);

        if ( !$validator->fails() )
        {
            
            $validator_unique = Validator::make(['value' => $value], [
                'value' => 'unique:clients,email'
            ]);

            if ( !$validator_unique->fails() )
            {
                // add value to user temp data
                $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
                $temp['client-email'] = $value;
                TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
                
                // return success
                return ['success' => true];
            }
            return [
                'success' => false,
                'message' => "Email can\'t be used"
            ];
            
        }
        
        // return error mesasage
        if ( $value == "" || $value == null )
        {
            return [
                'success' => false,
                'message' => 'Requiered field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid format of email, max lenght 40 characters'
        ];


    } // end _validateClientEmail



    private function _validateClientPreferedContactMethod($value)
    {
        // allowed values
        $contactMethods = ['phone', 'email', 'text_message'];

        if ( in_array($value, $contactMethods) )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-prefered-contact-method'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);

            // return success
            return ['success' => true];
        }

        return [
            'success' => false,
            'message' => 'Contact method not specified'
        ];

    } // end _validateClientPreferedContactMethod


    private function _validateClientAddress($value)
    {

        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:50'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-address'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);

            // return success
            return ['success' => true];
        }

        // return error mesasage
        if ( $value == "" || $value == null )
        {
            return [
                'success' => false,
                'message' => 'Requiered field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Max lenght 50 characters'
        ];

    } // end _validateClientAddress


    private function _validateClientCity($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:25'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-city'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);

            // return success
            return ['success' => true];
        }

        // return error mesasage
        if ( $value == "" || $value == null )
        {
            return [
                'success' => false,
                'message' => 'Requiered field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Max lenght 25 characters'
        ];

    } // end _validateClientCity

    private function _validateClientState($value)
    {   
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|exists:states,value'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-state'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);

            // return success
            return ['success' => true];
        }

        // return error mesasage
        if ( $value == "" || $value == null )
        {
            return [
                'success' => false,
                'message' => 'Requiered field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid value'
        ];
    }


    private function _validateClientZip($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|digits:5'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-zip'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);

            // return success
            return ['success' => true];
        }

        // return error mesasage
        if ( $value == "" || $value == null )
        {
            return [
                'success' => false,
                'message' => 'Requiered field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid format or lenght'
        ];


    } // end _validateClientZip


}

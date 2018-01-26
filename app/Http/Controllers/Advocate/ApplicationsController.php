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
                    
                default:
                    # code...
                    break;
            }

            
            
            
        }


        /**
         * validation for multy fields
         */
        if ( $request->action == "validation_multi" )
        {
            $response = $this->_validateNewApplicationStageOne($request);
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
                    'message' => 'Required field'
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
                    'message' => 'Required field'
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
                    'message' => 'Required field'
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



    /**
     * validate client email address
     */
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
                'message' => 'Required field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid format of email, max lenght 40 characters'
        ];


    } // end _validateClientEmail


    /**
     * validate client prefered contact method
     */
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



    /**
     * validate client address
     */
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
                'message' => 'Required field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Max lenght 50 characters'
        ];

    } // end _validateClientAddress



    /**
     * validate client city
     */
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
                'message' => 'Required field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Max lenght 25 characters'
        ];

    } // end _validateClientCity



    /**
     * validate client state
     */
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
                'message' => 'Required field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid value'
        ];
    }



    /**
     * validate client zip code
     */
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
                'message' => 'Required field'
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid format or lenght'
        ];


    } // end _validateClientZip



    /**
     * validation for new client application
     * for stage 1
     * (general client information)
     */
    private function _validateNewApplicationStageOne($request)
    {
        // get phone types from db
        $phoneTypesDB = DB::table('object_types')
                            ->select('value')
                            ->where('type', '=', 'phone')
                            ->get();
        $phoneTypes = "";
        $phoneTypeCounter = 0;
        foreach ($phoneTypesDB as $phoneType) 
        {
            if ( $phoneTypeCounter > 0 )
            {
                $phoneTypes .= ',';
            }
            $phoneTypes .= $phoneType->value;
            $phoneTypeCounter++;
        }
        
        // validation rules
        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|string|max:20',
            'last_name'             => 'required|string|max:20',
            'contact_phone_number'  => 'required|regex:/^\d{3}\d{3}\d{4}$/',
            'phone_number_type'     => 'required|in:' . $phoneTypes,
            'email'                 => 'required|email|max:40|unique:clients,email',
            'pref_contact_method'   => 'required|in:phone,email,text_message',
            'address'               => 'required|string|max:50',
            'city'                  => 'required|string|max:25',
            'state'                 => 'required|exists:states,value',
            'zip'                   => 'required|digits:5',
        ]);

        if ( !$validator->fails() )
        {
            // add values to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-first-name'] = $request->first_name;
            $temp['client-last-name'] = $request->last_name;
            $temp['client-phone-number'] = $request->contact_phone_number;
            $temp['client-phone-number-type'] = $request->phone_number_type;
            $temp['client-email'] = $request->email;
            $temp['client-prefered-contact-method'] = $request->pref_contact_method;
            $temp['client-address'] = $request->address;
            $temp['client-city'] = $request->city;
            $temp['client-state'] = $request->state;
            $temp['client-zip'] = $request->zip;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);

            // return success
            return ['success' => true];
        }

        // get all validation errors
        $errors = $validator->errors();
        
        $error_messages = [];

        // first name error
        // html id: org_first_name
        if ( $errors->first('first_name') != null )
        {
            if ( $request->first_name == "" || $request->first_name == null )
            {
                $error_messages['org_first_name'] = 'Required field';
            }
            else
            {
                $error_messages['org_first_name'] = 'Max lenght of first name is 20 characters';
            }
        }

        // last name error
        // html id: org_last_name
        if ( $errors->first('last_name') != null )
        {
            if ( $request->last_name == "" || $request->last_name == null )
            {
                $error_messages['org_last_name'] = 'Required field';
            }
            else
            {
                $error_messages['org_last_name'] = 'Max lenght of last name is 20 characters';
            }
        }

        // phone number error
        // html id: contact_phone_num
        if ( $errors->first('contact_phone_number') != null )
        {
            // return error mesasage
            if ( $request->contact_phone_number == "" || $request->contact_phone_number == null )
            {
                $error_messages['contact_phone_num'] = 'Required field';
            }
            else
            {
                $error_messages['contact_phone_num'] = 'Invalid format for phone number';
            }
        }

        // phone number type error
        // html id: phone_number_type
        if ( $errors->first('phone_number_type') != null )
        {
            if ( $request->phone_number_type == "" || $request->phone_number_type == null )
            {
                $error_messages['phone_number_type'] = 'Phone type not selected';
            }
            else
            {
                $error_messages['phone_number_type'] = 'Invalid phone type';
            }
        }

        // email address error
        // html id: inputEmail4
        if ( $errors->first('email') != null )
        {
            if ( $request->email == "" || $request->email == null )
            {
                $error_messages['inputEmail4'] = 'Required field';
            }
            else
            {
                $validator_unique = Validator::make(['value' => $request->email], [
                    'value' => 'unique:clients,email'
                ]);
    
                if ( !$validator_unique->fails() )
                {
                    $error_messages['inputEmail4'] = 'Invalid format of email, max lenght 40 characters';
                }
                else
                {
                    $error_messages['inputEmail4'] = "Email can\'t be used";
                }
            }
        }

        // prefered contact method error
        // html id: pref_contact_method
        if ( $errors->first('pref_contact_method') != null )
        {
            $error_messages['pref_contact_method'] = 'Contact method not specified';
        }

        // address error
        // html id: address
        if ( $errors->first('address') != null )
        {
            if ( $request->address == "" || $request->address == null )
            {
                $error_messages['address'] = 'Required field';
            }
            else
            {
                $error_messages['address'] = 'Max lenght 50 characters';
            }
        }

        // city error
        // html id: city
        if ( $errors->first('city') != null )
        {
            if ( $request->city == "" || $request->city == null )
            {
                $error_messages['city'] = 'Required field';
            }
            else
            {
                $error_messages['city'] = 'Max lenght 25 characters';
            }
        }

        // state error
        // html id: state
        if ( $errors->first('state') != null )
        {
            if ( $request->state == "" || $request->state == null )
            {
                $error_messages['state'] = 'Required field';
            }
            else
            {
                $error_messages['state'] = 'Invalid value';
            }
        }

        // zip error
        // html id: zip
        if ( $errors->first('zip') != null )
        {
            if ( $request->zip == "" || $request->zip == null )
            {
                $error_messages['zip'] = 'Required field';
            }
            else
            {
                $error_messages['zip'] = 'Invalid format or lenght';
            }
        }

        // return status and errors
        return [
            'success' => false,
            'message' => $error_messages
        ];

    } // end _validateNewApplicationStageOne


}

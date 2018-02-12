<?php

namespace App\Http\Controllers\Advocate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use DB;

use App\ObjectType;
use App\State;
use App\Client;
use App\Pet;
use App\Application;
use App\ApplicationPet;
use App\Phone;
use App\Address;

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

        $preferedContactMethods = [
            'phone' => 'Phone', 
            'email' => 'Email', 
            'text_message' => 'Text message'
        ];

        $petTypes = ObjectType::where('type', 'pet')->get();

        $tempData = TempObject::get(Auth::user()->id, 'new-client-application-form');

        return  view('auth.advocate.applicationNew', 
                compact('currentUser', 'phoneTypes', 'states', 'preferedContactMethods', 'petTypes', 'tempData'));
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

        // for testing
        if ( $request->action == "current_client_get_qa_thread" ) {
            $ajax_response['success'] =true;
            if ( $ajax_response['success'] != true )
            {
                $ajax_response['data']['message'] = 'Not good value ';
            }
            return $ajax_response;
        }

        // for testing
        if ( $request->action == "current_client_answer_post" ) {
            $ajax_response['success'] =true;
            $ajax_response['data']['message'] = '3';
            if ( $ajax_response['success'] != true )
            {
                $ajax_response['data']['message'] = '32';
            }
            return $ajax_response;
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


                /**
                 * pet data validation
                 */
                case 'pet_type':
                    $response = $this->_validatePetType($request->input_value);
                    break;

                case 'pet_name':
                    $response = $this->_validatePetName($request->input_value);
                    break;

                case 'breed':
                    $response = $this->_validatePetBreed($request->input_value);
                    break;

                case 'weight':
                    $response = $this->_validatePetWeight($request->input_value);
                    break;
                
                case 'age':
                    $response = $this->_validatePetAge($request->input_value);
                    break;

                case 'description':
                    $response = $this->_validatePetDescription($request->input_value);
                    break;

                case 'pet_spayed':
                    $response = $this->_validatePetSpayed($request->input_value);
                    break;

                case 'pet_spay_object':
                    $response = $this->_validatePetSpayedObject($request->input_value);
                    break;

                case 'pet_chipped':
                    $response = $this->_validatePetChipped($request->input_value);
                    break;
                
                case 'pet_vaccined':
                    $response = $this->_validatePetVaccined($request->input_value);
                    break;

                case 'dietary_needs':
                    $response = $this->_validatePetDietaryNeeds($request->input_value);
                    break;

                case 'veterinary_needs':
                    $response = $this->_validatePetVeterinaryNeeds($request->input_value);
                    break;

                case 'pets_behavior':
                    $response = $this->_validatePetBehavior($request->input_value);
                    break;

                case 'abuser_access':
                    $response = $this->_validatePetAbuserAccess($request->input_value);
                    break;

                case 'pet_relevant_info':
                    $response = $this->_validatePetRelevantInfo($request->input_value);
                    break;

                case 'how_long':
                    $response = $this->_validatePetHowLong($request->input_value);
                    break;

                case 'police_involved':
                    $response = $this->_validatePetPoliceInvolved($request->input_value);
                    break;

                case 'protective_order':
                    $response = $this->_validateClientProtectiveOrder($request->input_value);
                    break;

                case 'pet_covered':
                    $response = $this->_validatePetCovered($request->input_value);
                    break;

                case 'pet_paperwork':
                    $response = $this->_validatePetClientPaperwork($request->input_value);
                    break;

                case 'pet_abuser_paperwork':
                    $response = $this->_validatePetAbuserPaperwork($request->input_value);
                    break;

                case 'abuser_details':
                    $response = $this->_validateAbuserDetails($request->input_value);
                    break;

                case 'boarding_options':
                    $response = $this->_validatePetBoardingOptions($request->input_value);
                    break;


                case 'i_understand': //testing, remove later
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

            
            
            
        }


        /**
         * validation for multy fields
         */

        if ( $request->action == "validation_multi_final" )
        {
            // disable when testing
            //$response = $this->_validateNewApplicationStageOne($request);
            $response = $this->_validateNewApplicationFinal($request);
            if ( $response['success'] == true )
            {
                $this->_createNewApplication();
            }
            // for testing
            // $response['success'] = true;
        }

        if ( $request->action == "validation_multi" )
        {
            // disable when testing
            $response = $this->_validateNewApplicationStageOne($request);
            // for testing
            //$response['success'] = true;
        }

        if ( $request->action == "validation_multi_pet" )
        {
            // for testing
            $response = $this->_validateNewApplicationStageTwo($request);
            // $response['success'] = true;

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



    /**
     * validate per type
     */
    private function _validatePetType($value)
    {
        $petTypesDB = ObjectType::where('type', 'pet')->get();
        $petTypes = "";
        $firstItem = true;
        foreach( $petTypesDB as $item )
        {
            if ( !$firstItem )
            {
                $petTypes .= ",";
            }
            $petTypes .= $item->value . "_type,". $item->value;
            $firstItem = false;
        }

        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:' . $petTypes
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-type'] = $value;
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
    } // end _validatePetType


    /**
     * validate pet name
     */
    private function _validatePetName($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:25'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-name'] = $value;
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
            'message' => 'Max lenght is 25 characters'
        ];

    } // end _validatePetName


    /** 
     * validate pet breed
     */
    private function _validatePetBreed($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:25'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-breed'] = $value;
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
            'message' => 'Max lenght is 25 characters'
        ];

    } // end _validatePetBreed



    /**
     * validate pet weight
     */
    private function _validatePetWeight($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|numeric'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-weight'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'Invalid format'
        ];
    } // end _validatePetWeight


    /**
     * validate pet age
     */
    private function _validatePetAge($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|numeric'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-age'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'Invalid format'
        ];
    } // end _validatePetAge


    /** 
     * validate pet description 
     */
    private function _validatePetDescription($value)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-description'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'Max length is ' . $maxLength . ' characters'
        ];

    } // end _validatePetDescription



    /**
     * validation Pet Spayed property
     */
    private function _validatePetSpayed($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:spayed_yes,spayed_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-spayed'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];

    } // end _validatePetSpayed


    /**
     * validation Pet Spayed object property
     */
    private function _validatePetSpayedObject($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:spay_object_yes,spay_object_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-spayed-object'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];

    } // end _validatePetSpayedObject

    

    private function _validatePetChipped($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:chipped_yes,chipped_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-chipped'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];
    } // end _validatePetChipped


    private function _validatePetVaccined($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:vaccine_yes,vaccine_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-vaccine'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];
    } // end _validatePetVaccined



    private function _validatePetDietaryNeeds($value)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-dietary-needs'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'Max length is ' . $maxLength . ' characters'
        ];

    } // end _validatePetDietaryNeeds


    private function _validatePetVeterinaryNeeds($value)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-veterinary-needs'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'Max length is ' . $maxLength . ' characters'
        ];

    } // end _validatePetVeterinaryNeeds



    private function _validatePetBehavior($value)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-behavior'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'Max length is ' . $maxLength . ' characters'
        ];

    } // end _validatePetBehavior


    private function _validatePetAbuserAccess($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:abuser_access_yes,abuser_access_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-abuser-access'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];

    } // end _validatePetAbuserAccess



    private function _validatePetRelevantInfo($value)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-relevant-info'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'Max length is ' . $maxLength . ' characters'
        ];

    } // end _validatePetRelevantInfo



    private function _validatePetHowLong($value)
    {
        $maxValue = 30;
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|integer'
        ]);

        if ( !$validator->fails() )
        {
            if ( $value >= 1 && $value <= $maxValue )
            {
                // add value to user temp data
                $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
                $temp['pet-how-long'] = $value;
                TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
                
                return ['success' => true];
            }

            return [
                'success' => false,
                'message' => 'Max duration is ' . $maxValue . ' days'
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
            'message' => 'Invalid format, must be integer value'
        ];

    } // end _validatePetHowLong


    private function _validatePetPoliceInvolved($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:police_involved_yes,police_involved_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-police-involved'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];

    } // end _validatePetPoliceInvolved


    private function _validateClientProtectiveOrder($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:protective_order_yes,protective_order_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['client-protective-order'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];

    } // end _validateClientProtectiveOrder




    private function _validatePetCovered($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:pet_covered_yes,pet_covered_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-protective-order-covered'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];

    } // end _validatePetCovered



    private function _validatePetClientPaperwork($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:pet_paperwork_yes,pet_paperwork_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-client-paperwork'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];

    }



    private function _validatePetAbuserPaperwork($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:pet_abuser_paperwork_yes,pet_abuser_paperwork_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-abuser-paperwork'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];

    }


    private function _validateAbuserDetails($value)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['abuser-details'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'Max length is ' . $maxLength . ' characters'
        ];
    }



    private function _validatePetBoardingOptions($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:boarding_options_yes,boarding_options_no,yes,no'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet-boarding-options'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
            
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
            'message' => 'invalid value'
        ];
    }


    /**
     * validate part of form with all pet details
     */
    private function _validateNewApplicationStageTwo($request)
    {
        $result['success'] = true;
        
        $check = $this->_validatePetType($request->pet_type);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_type'] = $check['message'];
        }
        
        $check = $this->_validatePetName($request->pet_name);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_name'] = $check['message'];
        }


        $check = $this->_validatePetBreed($request->breed);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['breed'] = $check['message'];
        }


        $check = $this->_validatePetWeight($request->weight);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['weight'] = $check['message'];
        }
        
        
        $check = $this->_validatePetAge($request->age);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['age'] = $check['message'];
        } 
        
        $check = $this->_validatePetDescription($request->description);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['description'] = $check['message'];
        } 
        
        $check = $this->_validatePetSpayed($request->pet_spayed);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_spayed'] = $check['message'];
        } 

        $check = $this->_validatePetSpayedObject($request->pet_spay_object);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_spay_object'] = $check['message'];
        } 

        $check = $this->_validatePetChipped($request->pet_chipped);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_chipped'] = $check['message'];
        } 

        $check = $this->_validatePetVaccined($request->pet_vaccined);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_vaccined'] = $check['message'];
        } 


        $check = $this->_validatePetDietaryNeeds($request->dietary_needs);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['dietary_needs'] = $check['message'];
        } 

        $check = $this->_validatePetVeterinaryNeeds($request->veterinary_needs);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['veterinary_needs'] = $check['message'];
        } 

        $check = $this->_validatePetBehavior($request->pets_behavior);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pets_behavior'] = $check['message'];
        } 

        $check = $this->_validatePetAbuserAccess($request->abuser_access);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['abuser_access'] = $check['message'];
        } 

        $check = $this->_validatePetRelevantInfo($request->pet_relevant_info);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_relevant_info'] = $check['message'];
        } 

        $check = $this->_validatePetHowLong($request->how_long);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['how_long'] = $check['message'];
        } 

        $check = $this->_validatePetPoliceInvolved($request->police_involved);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['police_involved'] = $check['message'];
        } 

        $check = $this->_validateClientProtectiveOrder($request->protective_order);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['protective_order'] = $check['message'];
        } 

        $check = $this->_validatePetCovered($request->pet_covered);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_covered'] = $check['message'];
        } 

        $check = $this->_validatePetClientPaperwork($request->pet_paperwork);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_paperwork'] = $check['message'];
        } 

        $check = $this->_validatePetAbuserPaperwork($request->pet_abuser_paperwork);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['pet_abuser_paperwork'] = $check['message'];
        }

        $check = $this->_validateAbuserDetails($request->abuser_details);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['abuser_details'] = $check['message'];
        }

        $check = $this->_validatePetBoardingOptions($request->boarding_options);
        if ( $check['success'] == false )
        {
            $result['success'] = false;
            $result['message']['boarding_options'] = $check['message'];
        }

        return $result;

    } // end _validateNewApplicationStageTwo



    private function _validateNewApplicationFinal($request)
    {
        $response_stage_one = $this->_validateNewApplicationStageOne($request);
        $response_stage_two = $this->_validateNewApplicationStageTwo($request);

        if ( $response_stage_one['success'] == true && $response_stage_two['success'] == true )
        {
            $result['success'] = true;
        }
        else
        {
            $result['success'] = false;
            if ( isset($response_stage_one['message']) )
            {
                foreach ($response_stage_one['message'] as $key => $value) {
                    $result['message'][$key] = $value;
                }
            }
            if ( isset($response_stage_two['message']) )
            {
                foreach ($response_stage_two['message'] as $key => $value) {
                    $result['message'][$key] = $value;
                }
            }
        }

        return $result;

    } // end _validateNewApplicationFinal

    private function _createNewApplication()
    {   
        $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');

        // create new client database entry
        $client = new Client();
        $client->organisation_id = Auth::user()->organisation_id;
        $client->first_name = $temp['client-first-name'];
        $client->last_name = $temp['client-last-name'];
        $client->email = $temp['client-email'];
        $client->best_way_to_reach = $temp['client-prefered-contact-method'];
        $client->pets_count = 1;
        $client->slug = str_slug($temp['client-first-name'] . ' ' . $temp['client-last-name'] , '-');
        $client->save();

        // find pet type
        $petType = DB::table('object_types')
                        ->where([
                            ['type', '=', 'pet'],
                            ['value', '=', $temp['pet-type']]
                        ])
                        ->first();

        // create new pet database entry
        $pet = new Pet();
        $pet->client_id = $client->id;
        $pet->organisation_id = Auth::user()->organisation_id;
        $pet->pet_type_id = $petType->id;
        $pet->name = $temp['pet-name'];
        $pet->breed = $temp['pet-breed'];
        $pet->weight = $temp['pet-weight'];
        $pet->age = $temp['pet-age'];
        $pet->description = $temp['pet-description'];
        if ( in_array($temp['pet-chipped'], ['yes', 'chipped_yes']) )
        {
            $pet->microchipped = 1;
        }
        else
        {
            $pet->microchipped = 0;
        }
        if ( in_array($temp['pet-vaccine'], ['yes', 'vaccine_yes']) )
        {
            $pet->vaccinations = 1;
        }
        else
        {
            $pet->vaccinations = 0;
        }
        if ( in_array($temp['pet-spayed'], ['yes', 'spayed_yes']) )
        {
            $pet->sprayed = 1;
        }
        else
        {
            $pet->sprayed = 0;
        }
        if ( in_array($temp['pet-spayed-object'], ['yes', 'spay_object_yes']) )
        {
            $pet->objection_to_spray = 1;
        }
        else
        {
            $pet->objection_to_spray = 0;
        }
        $pet->dietary_needs = $temp['pet-dietary-needs'];
        $pet->vet_needs = $temp['pet-veterinary-needs'];
        $pet->temperament = $temp['pet-behavior'];
        $pet->aditional_info = $temp['pet-relevant-info'];
        $pet->slug = str_slug($temp['pet-name'], '-');
        $pet->save();

        // create client application database entry
        $application = new Application();
        $application->client_id = $client->id;
        $application->organisation_id = Auth::user()->organisation_id;
        $application->created_by_advocate_id = Auth::user()->id;
        if ( in_array($temp['pet-police-involved'], ['yes', 'police_involved_yes']) )
        {
            $application->police_involved = 1;
        }
        else
        {
            $application->police_involved = 0;
        }
        if ( in_array($temp['client-protective-order'], ['yes', 'protective_order_yes']) )
        {
            $application->protective_order = 1;
        }
        else
        {
            $application->protective_order = 0;
        }
        $application->abuser_notes = $temp['abuser-details'];
        $application->save();

        // create pet application database entry
        $application_pet = new ApplicationPet();
        $application_pet->application_id = $application->id;
        $application_pet->pet_id = $pet->id;
        $application_pet->client_id = $client->id;
        $application_pet->organisation_id = Auth::user()->organisation_id;
        $application_pet->created_by_advocate_id = Auth::user()->id;
        if ( in_array($temp['pet-abuser-access'], ['yes', 'abuser_access_yes']) )
        {
            $application_pet->abuser_visiting_access = 1;
        }
        else
        {
            $application_pet->abuser_visiting_access = 0;
        }
        $application_pet->estimated_lenght_of_housing = $temp['pet-how-long'];
        if ( in_array($temp['pet-protective-order-covered'], ['yes', 'pet_covered_yes']) )
        {
            $application_pet->pet_protective_order = 1;
        }
        else
        {
            $application_pet->pet_protective_order = 0;
        }
        if ( in_array($temp['pet-client-paperwork'], ['yes', 'pet_paperwork_yes']) )
        {
            $application_pet->client_legal_owner_of_pet = 1;
        }
        else
        {
            $application_pet->client_legal_owner_of_pet = 0;
        }
        if ( in_array($temp['pet-abuser-paperwork'], ['yes', 'pet_abuser_paperwork_yes']) )
        {
            $application_pet->abuser_legal_owner_of_pet = 1;
        }
        else
        {
            $application_pet->abuser_legal_owner_of_pet = 0;
        }
        if ( in_array($temp['pet-boarding-options'], ['yes', 'boarding_options_yes']) )
        {
            $application_pet->explored_boarding_options = 1;
        }
        else
        {
            $application_pet->explored_boarding_options = 0;
        }
        $application_pet->save();

        // get phone type
        $phone_type = ObjectType::where([
                            ['type', '=', 'phone'],
                            ['value', '=', $temp['client-phone-number-type']]
                        ])->first();

        // save client phone
        $phone = new Phone();
        $phone->entity_type = 'client';
        $phone->entity_id = $client->id;
        $phone->phone_type_id = $phone_type->id;
        $phone->number = $temp['client-phone-number'];
        $phone->save();
        
        // get state name
        $state = State::where('value', $temp['client-state'])->first();

        // save client address
        $address = new Address();
        $address->entity_type = 'client';
        $address->entity_id = $client->id;
        $address->state = $state->name;
        $address->city = $temp['client-city'];
        $address->street = $temp['client-address'];
        $address->zip_code = $temp['client-zip'];
        $address->save();
        
        TempObject::delete(Auth::user()->id, 'new-client-application-form');

        return true;
        
    }

}

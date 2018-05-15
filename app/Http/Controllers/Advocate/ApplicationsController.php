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

        TempObject::delete(Auth::user()->id, 'new-client-application-form'); // clear temp entry on every page refresh
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
         * pet form closed by user
         */
        if ( $request->action == "close_pet_form" ) {

            $this->_closePetForm($request->pet_form_number);

            $ajax_response['success'] =true;
            if ( $ajax_response['success'] != true )
            {
                $ajax_response['data']['message'] = 'not good value';
            }
            return $ajax_response;

        }

        /**
         * validation for single fields
         */
        if ( $request->action == "validation_single" ) {

            /*
            // check for elements coming from add another pet form, and trim if needed
            if ( strpos( $request->element_id, '-' ) !== false ) {
                $request_element_id = strstr($request->element_id, '-', true);

                // checkbox values also have form number, check for those, and trim
                if ( strpos( $request->input_value, '-' ) !== false ) {
                    $request->input_value = strstr($request->input_value, '-', true);
                }

            } else {
                $request_element_id = $request->element_id;
            }
            */

            /**
             * extracting entry number if exist
             * that will define order of pet in application
             * form
             */
            $request_element_pet_order = 1;
            if ( strpos( $request->element_id, '-' ) !== false )
            {
                $temp = explode('-', $request->element_id);
                $request_element_id = $temp[0];
                if ( isset($temp[1]) )
                {
                    if ( (int)$temp[1] > 0 )
                    {
                        $request_element_pet_order = (int)$temp[1];
                    }
                }
            }
            else
            {
                $request_element_id = $request->element_id;
            }

           /* switch ($request->element_id) {*/
            switch ($request_element_id) {

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
                    $response = $this->_validatePetType($request->input_value, $request_element_pet_order);
                    break;

                case 'pet_name':
                    $response = $this->_validatePetName($request->input_value, $request_element_pet_order);
                    break;

                case 'breed':
                    $response = $this->_validatePetBreed($request->input_value, $request_element_pet_order);
                    break;

                case 'weight':
                    $response = $this->_validatePetWeight($request->input_value, $request_element_pet_order);
                    break;
                
                case 'age':
                    $response = $this->_validatePetAge($request->input_value, $request_element_pet_order);
                    break;

                case 'description':
                    $response = $this->_validatePetDescription($request->input_value, $request_element_pet_order);
                    break;

                case 'pet_spayed':
                    $response = $this->_validatePetSpayed($request->input_value, $request_element_pet_order);
                    break;

                case 'pet_spay_object':
                    $response = $this->_validatePetSpayedObject($request->input_value, $request_element_pet_order);
                    break;

                case 'pet_chipped':
                    $response = $this->_validatePetChipped($request->input_value, $request_element_pet_order);
                    break;
                
                case 'pet_vaccined':
                    $response = $this->_validatePetVaccined($request->input_value, $request_element_pet_order);
                    break;

                case 'dietary_needs':
                    $response = $this->_validatePetDietaryNeeds($request->input_value, $request_element_pet_order);
                    break;

                case 'veterinary_needs':
                    $response = $this->_validatePetVeterinaryNeeds($request->input_value, $request_element_pet_order);
                    break;

                case 'pets_behavior':
                    $response = $this->_validatePetBehavior($request->input_value, $request_element_pet_order);
                    break;

                case 'abuser_access':
                    $response = $this->_validatePetAbuserAccess($request->input_value, $request_element_pet_order);
                    break;

                case 'pet_relevant_info':
                    $response = $this->_validatePetRelevantInfo($request->input_value, $request_element_pet_order);
                    break;

                case 'how_long':
                    $response = $this->_validatePetHowLong($request->input_value, $request_element_pet_order);
                    break;

                case 'police_involved':
                    $response = $this->_validatePetPoliceInvolved($request->input_value, $request_element_pet_order);
                    break;

                case 'protective_order':
                    $response = $this->_validateClientProtectiveOrder($request->input_value, $request_element_pet_order);
                    break;

                case 'pet_covered':
                    $response = $this->_validatePetCovered($request->input_value, $request_element_pet_order);
                    break;

                case 'pet_paperwork':
                    $response = $this->_validatePetClientPaperwork($request->input_value, $request_element_pet_order);
                    break;

                case 'pet_abuser_paperwork':
                    $response = $this->_validatePetAbuserPaperwork($request->input_value, $request_element_pet_order);
                    break;

                case 'abuser_details':
                    $response = $this->_validateAbuserDetails($request->input_value, $request_element_pet_order);
                    break;

                case 'boarding_options':
                    $response = $this->_validatePetBoardingOptions($request->input_value, $request_element_pet_order);
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


    private function _closePetForm($petOrder)
    {
        $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
        if ( isset($temp['pet'][$petOrder]) )    
        {
            unset($temp['pet'][$petOrder]);
        }
        TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
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
            'value' => 'required|regex:/^\d{3}-\d{3}-\d{4}$/'
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
            
            // $validator_unique = Validator::make(['value' => $value], [
            //     'value' => 'unique:clients,email'
            // ]);

            // if ( !$validator_unique->fails() )
            // {
                // add value to user temp data
                $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
                $temp['client-email'] = $value;
                TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);
                
                // return success
                return ['success' => true];
            // }
            // return [
            //     'success' => false,
            //     'message' => "Email can\'t be used"
            // ];
            
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
            'contact_phone_number'  => 'required|regex:/^\d{3}-\d{3}-\d{4}$/',
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
     * validate number of pets in the new application
     */
    private function _validatePetNumber($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|digits:1'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pets-number-of'] = $value;
            TempObject::set(Auth::user()->id, 'new-client-application-form', $temp);

            return ['success' => true];
        }

        // return error mesasage
        if ( $value == "" || $value == null )
        {
            return [
                'success' => false,
                'message' => 'Failed access'
            ];
        }
        return [
            'success' => false,
            'message' => 'Failed access'
        ];
    } // end _validatePetNumber

    /**
     * validate per type
     */
    private function _validatePetType($value, $petOrder)
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
            if ( $petOrder == 1 )
            {
                $petTypes .= $item->value . "_type,". $item->value;
            }
            else
            {
                $petTypes .= $item->value . "_type-".$petOrder.",". $item->value;
            }
            
            $firstItem = false;
        }

        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:' . $petTypes
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-type'] = $value;
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
    private function _validatePetName($value, $petOrder)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:25'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-name'] = $value;
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
    private function _validatePetBreed($value, $petOrder)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:25'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-breed'] = $value;
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
    private function _validatePetWeight($value, $petOrder)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|numeric'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-weight'] = $value;
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
    private function _validatePetAge($value, $petOrder)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|numeric'
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-age'] = $value;
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
    private function _validatePetDescription($value, $petOrder)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-description'] = $value;
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
    private function _validatePetSpayed($value, $petOrder)
    {
        $possible_values = "spayed_yes,spayed_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "spayed_yes-".$petOrder.",spayed_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-spayed'] = $value;
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
    private function _validatePetSpayedObject($value, $petOrder)
    {
        $possible_values = "spay_object_yes,spay_object_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "spay_object_yes-".$petOrder.",spay_object_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-spayed-object'] = $value;
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

    

    private function _validatePetChipped($value, $petOrder)
    {
        $possible_values = "chipped_yes,chipped_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "chipped_yes-".$petOrder.",chipped_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-chipped'] = $value;
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


    private function _validatePetVaccined($value, $petOrder)
    {
        $possible_values = "vaccine_yes,vaccine_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "vaccine_yes-".$petOrder.",vaccine_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-vaccine'] = $value;
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



    private function _validatePetDietaryNeeds($value, $petOrder)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-dietary-needs'] = $value;
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


    private function _validatePetVeterinaryNeeds($value, $petOrder)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-veterinary-needs'] = $value;
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



    private function _validatePetBehavior($value, $petOrder)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-behavior'] = $value;
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


    private function _validatePetAbuserAccess($value, $petOrder)
    {
        $possible_values = "abuser_access_yes,abuser_access_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "abuser_access_yes-".$petOrder.",abuser_access_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-abuser-access'] = $value;
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



    private function _validatePetRelevantInfo($value, $petOrder)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-relevant-info'] = $value;
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



    private function _validatePetHowLong($value, $petOrder)
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
                $temp['pet'][$petOrder]['pet-how-long'] = $value;
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


    private function _validatePetPoliceInvolved($value, $petOrder)
    {
        $possible_values = "police_involved_yes,police_involved_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "police_involved_yes-".$petOrder.",police_involved_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-police-involved'] = $value;
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


    private function _validateClientProtectiveOrder($value, $petOrder)
    {
        $possible_values = "protective_order_yes,protective_order_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "protective_order_yes-".$petOrder.",protective_order_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['client-protective-order'] = $value;
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




    private function _validatePetCovered($value, $petOrder)
    {
        $possible_values = "pet_covered_yes,pet_covered_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "pet_covered_yes-".$petOrder.",pet_covered_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-protective-order-covered'] = $value;
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



    private function _validatePetClientPaperwork($value, $petOrder)
    {
        $possible_values = "pet_paperwork_yes,pet_paperwork_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "pet_paperwork_yes-".$petOrder.",pet_paperwork_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-client-paperwork'] = $value;
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



    private function _validatePetAbuserPaperwork($value, $petOrder)
    {
        $possible_values = "pet_abuser_paperwork_yes,pet_abuser_paperwork_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "pet_abuser_paperwork_yes-".$petOrder.",pet_abuser_paperwork_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-abuser-paperwork'] = $value;
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


    private function _validateAbuserDetails($value, $petOrder)
    {
        $maxLength = '500';
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|string|max:' . $maxLength
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['abuser-details'] = $value;
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



    private function _validatePetBoardingOptions($value, $petOrder)
    {
        $possible_values = "boarding_options_yes,boarding_options_no,yes,no";
        if ( $petOrder != 1 )
        {
            $possible_values = "boarding_options_yes-".$petOrder.",boarding_options_no-".$petOrder.",yes,no";
        }
        $validator = Validator::make(['value' => $value], [
            'value' => 'required|in:'.$possible_values
        ]);

        if ( !$validator->fails() )
        {
            // add value to user temp data
            $temp = TempObject::get(Auth::user()->id, 'new-client-application-form');
            $temp['pet'][$petOrder]['pet-boarding-options'] = $value;
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

        $check = $this->_validatePetNumber($request->number_of_pets);
        if ( $check['success'] == false )
        {
            // die('pet number missing');
            $result['success'] = false;
            $result['message']['number_of_pets'] = $check['message'];
        }

        $number_of_pets = $request->number_of_pets;

        for ($i = 1; $i <= $number_of_pets; $i++) {

            if ($i === 1) {
                $item_suffix = '';
                $pet_order_number = null;
            } else {
                $item_suffix = '-' . $i;
                $pet_order_number = $i;
            }

            $check = $this->_validatePetType($request->{"pet_type".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_type'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetName($request->{"pet_name".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_name'.$item_suffix] = $check['message'];
            }


            $check = $this->_validatePetBreed($request->{"breed".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['breed'.$item_suffix] = $check['message'];
            }


            $check = $this->_validatePetWeight($request->{"weight".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['weight'.$item_suffix] = $check['message'];
            }


            $check = $this->_validatePetAge($request->{"age".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['age'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetDescription($request->{"description".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['description'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetSpayed($request->{"pet_spayed".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_spayed'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetSpayedObject($request->{"pet_spay_object".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_spay_object'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetChipped($request->{"pet_chipped".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_chipped'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetVaccined($request->{"pet_vaccined".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_vaccined'.$item_suffix] = $check['message'];
            }


            $check = $this->_validatePetDietaryNeeds($request->{"dietary_needs".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['dietary_needs'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetVeterinaryNeeds($request->{"veterinary_needs".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['veterinary_needs'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetBehavior($request->{"pets_behavior".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pets_behavior'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetAbuserAccess($request->{"abuser_access".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['abuser_access'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetRelevantInfo($request->{"pet_relevant_info".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_relevant_info'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetHowLong($request->{"how_long".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['how_long'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetPoliceInvolved($request->{"police_involved".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['police_involved'.$item_suffix] = $check['message'];
            }

            $check = $this->_validateClientProtectiveOrder($request->{"protective_order".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['protective_order'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetCovered($request->{"pet_covered".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_covered'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetClientPaperwork($request->{"pet_paperwork".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_paperwork'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetAbuserPaperwork($request->{"pet_abuser_paperwork".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['pet_abuser_paperwork'.$item_suffix] = $check['message'];
            }

            $check = $this->_validateAbuserDetails($request->{"abuser_details".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['abuser_details'.$item_suffix] = $check['message'];
            }

            $check = $this->_validatePetBoardingOptions($request->{"boarding_options".$item_suffix}, $pet_order_number);
            if ( $check['success'] == false )
            {
                $result['success'] = false;
                $result['message']['boarding_options'.$item_suffix] = $check['message'];
            }
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

        // create client application database entry
        $application = new Application();
        $application->client_id = $client->id;
        $application->organisation_id = Auth::user()->organisation_id;
        $application->created_by_advocate_id = Auth::user()->id;
        if ( in_array($temp['pet'][1]['pet-police-involved'], ['yes', 'police_involved_yes-1']) )
        {
            $application->police_involved = 1;
        }
        else
        {
            $application->police_involved = 0;
        }
        if ( in_array($temp['pet'][1]['client-protective-order'], ['yes', 'protective_order_yes-1']) )
        {
            $application->protective_order = 1;
        }
        else
        {
            $application->protective_order = 0;
        }
        $application->abuser_notes = $temp['pet'][1]['abuser-details'];

        // check assingn to
        if ( isset( $_POST['assign_application_to'] ) )
        {
            if( $_POST['assign_application_to'] == 'assign_to_me' )
            {
                $application->accepted_by_advocate_id = Auth::user()->id;
            }
        }

        $application->save();

        // create pet application database entry
        $application_pet = new ApplicationPet();
        $application_pet->application_id = $application->id;
        $application_pet->client_id = $client->id;
        $application_pet->organisation_id = Auth::user()->organisation_id;
        $application_pet->created_by_advocate_id = Auth::user()->id;
        if ( in_array($temp['pet'][1]['pet-boarding-options'], ['yes', 'boarding_options_yes-1']) )
        {
            $application_pet->explored_boarding_options = 1;
        }
        else
        {
            $application_pet->explored_boarding_options = 0;
        }
        $application_pet->save();


        // create pet entries in database
        $pets_count = 0;
        foreach ($temp['pet'] as $key => $value) {

            if ( $key == "" )
            {
                continue;
            }
            $pets_count++;

            // find pet type
            $value['pet-type'] = str_replace("_type", "", $value['pet-type']);
            $petType = DB::table('object_types')
                            ->where([
                                ['type', '=', 'pet'],
                                ['value', '=', $value['pet-type']]
                            ])
                            ->first();

            // create new pet database entry
            $pet = new Pet();
            $pet->client_id = $client->id;
            $pet->organisation_id = Auth::user()->organisation_id;
            $pet->pet_application_id = $application->id;
            $pet->pet_type_id = $petType->id;
            $pet->name = $value['pet-name'];
            $pet->breed = $value['pet-breed'];
            $pet->weight = $value['pet-weight'];
            $pet->age = $value['pet-age'];
            $pet->description = $value['pet-description'];
            if ( in_array($value['pet-chipped'], ['yes', 'chipped_yes']) )
            {
                $pet->microchipped = 1;
            }
            else
            {
                $pet->microchipped = 0;
            }
            if ( in_array($value['pet-vaccine'], ['yes', 'vaccine_yes']) )
            {
                $pet->vaccinations = 1;
            }
            else
            {
                $pet->vaccinations = 0;
            }
            if ( in_array($value['pet-spayed'], ['yes', 'spayed_yes']) )
            {
                $pet->sprayed = 1;
            }
            else
            {
                $pet->sprayed = 0;
            }
            if ( in_array($value['pet-spayed-object'], ['yes', 'spay_object_yes']) )
            {
                $pet->objection_to_spray = 1;
            }
            else
            {
                $pet->objection_to_spray = 0;
            }
            $pet->dietary_needs = $value['pet-dietary-needs'];
            $pet->vet_needs = $value['pet-veterinary-needs'];
            $pet->temperament = $value['pet-behavior'];
            $pet->aditional_info = $value['pet-relevant-info'];
            $pet->slug = str_slug($value['pet-name'], '-');
            if ( in_array($value['pet-abuser-access'], ['yes', 'abuser_access_yes']) )
            {
                $pet->abuser_visiting_access = 1;
            }
            else
            {
                $pet->abuser_visiting_access = 0;
            }
            $pet->estimated_lenght_of_housing = $value['pet-how-long'];
            if ( in_array($value['pet-protective-order-covered'], ['yes', 'pet_covered_yes']) )
            {
                $pet->pet_protective_order = 1;
            }
            else
            {
                $pet->pet_protective_order = 0;
            }
            if ( in_array($value['pet-client-paperwork'], ['yes', 'pet_paperwork_yes']) )
            {
                $pet->client_legal_owner_of_pet = 1;
            }
            else
            {
                $pet->client_legal_owner_of_pet = 0;
            }
            if ( in_array($value['pet-abuser-paperwork'], ['yes', 'pet_abuser_paperwork_yes']) )
            {
                $pet->abuser_legal_owner_of_pet = 1;
            }
            else
            {
                $pet->abuser_legal_owner_of_pet = 0;
            }
            $pet->save();

        }

        // update client database entry
        // update pet count
        $client->pets_count = $pets_count;
        $client->update();

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

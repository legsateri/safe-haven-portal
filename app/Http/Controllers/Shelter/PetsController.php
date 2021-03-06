<?php

namespace App\Http\Controllers\Shelter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Validator;
use Mail;

use App\ObjectType;
use App\Code\UserObject;
use App\Application;
use App\ApplicationPet;
use App\Status;
use App\Organisation;

use App\Mail\AcceptedPetNotificationMail;

use App\Code\TempObject;

class PetsController extends Controller
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
     * associated pets list page
     */
    public function associatedList()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        // get list filter rules
        $filter_rules = [];
        $temp = TempObject::get(Auth::user()->id, 'list-filters');
        if ( isset($temp['accepted_pets']) ) 
        {
            $filter_rules = $temp['accepted_pets'];
        }
        // defaults for filter
        if ( !isset( $filter_rules['order_by'] ) ) { $filter_rules['order_by'] = 'asc'; }
        if ( !isset( $filter_rules['pet_type'] ) ) { $filter_rules['pet_type'] = 'all'; }

        $petTypes = ObjectType::where('type', 'pet')->get();

        if ( $filter_rules['pet_type'] == 'all' )
        {
            $dataEntries = DB::table('application_pets')
            // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
            ->join('applications', 'application_pets.application_id', '=', 'applications.id')
            ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
            ->where([
                ['application_pets.status', '=', '1'],
                ['application_pets.accepted_by_shelter_organisation_id', '=', Auth::user()->organisation_id],
                ['addresses.entity_type', '=', 'client'],
            ])
            ->select([
                'application_pets.id as id',
                'application_pets.application_id as application_id',
                'applications.client_id as client_id',
                'applications.organisation_id as organisation_id',
                'applications.created_by_advocate_id as created_by_advocate_id',
                'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                'application_pets.status as status',
                'application_pets.explored_boarding_options as explored_boarding_options',
                'application_pets.release_status_id as release_status_id',
                'application_pets.created_at as created_at',
                'application_pets.updated_at as updated_at',
                'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                'applications.police_involved as police_involved',
                'applications.protective_order as protective_order',
                'applications.abuser_notes as abuser_notes',
                'addresses.state as state',
                'addresses.city as city',
                'addresses.zip_code as zip_code',
                'addresses.street as street',
                'addresses.number as number',
            ])
            ->orderBy('application_pets.created_at', $filter_rules['order_by'])
            ->paginate(4);
        }
        else
        {
            $dataEntries = DB::table('application_pets')
            // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
            ->join('applications', 'application_pets.application_id', '=', 'applications.id')
            ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
            ->select([
                'application_pets.id as id',
                'application_pets.application_id as application_id',
                'applications.client_id as client_id',
                'applications.organisation_id as organisation_id',
                'applications.created_by_advocate_id as created_by_advocate_id',
                'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                'application_pets.status as status',
                'application_pets.explored_boarding_options as explored_boarding_options',
                'application_pets.release_status_id as release_status_id',
                'application_pets.created_at as created_at',
                'application_pets.updated_at as updated_at',
                'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                'applications.police_involved as police_involved',
                'applications.protective_order as protective_order',
                'applications.abuser_notes as abuser_notes',
                'addresses.state as state',
                'addresses.city as city',
                'addresses.zip_code as zip_code',
                'addresses.street as street',
                'addresses.number as number',
            ])
            ->where([
                ['application_pets.status', '=', '1'],
                // ['pets.pet_type_id', '=', $filter_rules['pet_type']],
                ['application_pets.accepted_by_shelter_organisation_id', '=', Auth::user()->organisation_id],
                ['addresses.entity_type', '=', 'client'],
            ])
            ->orderBy('application_pets.created_at', $filter_rules['order_by'])
            ->paginate(4);
        }

        /**
         * get pet details
         */
        $dataEntriesPets = [];
        foreach( $dataEntries as $dataEntry )
        {
            $dataEntriesPets[$dataEntry->id] = 
            DB::table('pets')
            ->where([
                ['pets.pet_application_id', '=', $dataEntry->id],
                // ['pets.pet_type_id', '=', $filter_rules['pet_type']]
            ])
            ->get();
        }

        // get number of messages that are not seen by current user
        // and where question is posted by user's shelter
        $qa_badge = [];
        foreach( $dataEntries as $dataEntry )
        {
            $qa_badge[$dataEntry->id] = 0;

            $checkNewMessages = DB::table('question_conversations')
            ->leftJoin('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
            ->leftJoin('seen_messages', 'question_conversation_messages.id', '=', 'seen_messages.conversation_message_id')
            ->where([
                ['question_conversations.application_pet_id', '=', $dataEntry->id],
                ['question_conversation_messages.message', '<>', null]
                // ['question_conversations.shelter_organisation_id', '=', Auth::user()->organisation_id],
                // ['seen_messages.user_id', '=', Auth::user()->id]
            ])
            ->select([
                'seen_messages.id as seen_messages_id',
                'seen_messages.user_id as seen_messages_user_id'
            ])
            ->get();

            foreach( $checkNewMessages as $checkNewMessage )
            {
                if ( $checkNewMessage->seen_messages_id == null )
                {
                    $qa_badge[$dataEntry->id] = $qa_badge[$dataEntry->id] + 1;
                }
            }
        }

        return  view('auth.shelter.petsAssociated', 
                compact('currentUser', 'dataEntries', 'dataEntriesPets', 'petTypes', 'qa_badge', 'filter_rules'));
    }


    /**
     * pets in need list page
     */
    public function inNeedList()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        // get list filter rules
        $filter_rules = [];
        $temp = TempObject::get(Auth::user()->id, 'list-filters');
        if ( isset($temp['pets_in_need']) ) 
        {
            $filter_rules = $temp['pets_in_need'];
        }
        // defaults for filter
        if ( !isset( $filter_rules['order_by'] ) ) { $filter_rules['order_by'] = 'asc'; }
        if ( !isset( $filter_rules['pet_type'] ) ) { $filter_rules['pet_type'] = 'all'; }

        $petTypes = ObjectType::where('type', 'pet')->get();

        $currentShelter = Organisation::where('id', Auth::user()->organisation_id)->first();

        /*
        if ( $filter_rules['pet_type'] == 'all' )
        {
            $dataEntries = DB::table('application_pets')
            // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
            ->join('applications', 'application_pets.application_id', '=', 'applications.id')
            ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
            ->where([
                ['application_pets.status', '=', 0],
                ['addresses.entity_type', '=', 'client'],
                ['applications.accepted_by_advocate_id', '<>', null],
                ['applications.accepted_by_advocate_id', '<>', '']
            ])
            ->orderBy('application_pets.created_at', $filter_rules['order_by'])
            ->select([
                'application_pets.id as id',
                'application_pets.application_id as application_id',
                'applications.client_id as client_id',
                'applications.organisation_id as organisation_id',
                'applications.created_by_advocate_id as created_by_advocate_id',
                'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                'application_pets.status as status',
                'application_pets.explored_boarding_options as explored_boarding_options',
                'application_pets.release_status_id as release_status_id',
                'application_pets.created_at as created_at',
                'application_pets.updated_at as updated_at',
                'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                'applications.police_involved as police_involved',
                'applications.protective_order as protective_order',
                'applications.abuser_notes as abuser_notes',
                'addresses.state as state',
                'addresses.city as city',
                'addresses.zip_code as zip_code',
                'addresses.street as street',
                'addresses.number as number',
            ])
            ->paginate(4);
        }
        else
        {
        */
        // pet can be found in pets-in-need under 2 conditions:
        // 1) totally new client by advocate (i.e. his pet)
        // 2) pet was previously not admitted,
        //    and then client chose not to proceed and has again accepted this client
        $dataEntries = DB::table('application_pets')
        // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
        ->join('applications', 'application_pets.application_id', '=', 'applications.id')
        ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
        ->where([
            ['application_pets.status', '=', 0],
            ['applications.status', '=', 1],
            ['applications.release_status_id', '=', null],
            ['applications.accepted_by_advocate_id', '<>', null],
            ['applications.accepted_by_advocate_id', '<>', ''],
            ['addresses.entity_type', '=', 'client']
        ])
        ->orWhere([
            ['application_pets.status', '=', 0],
            ['applications.status', '=', 1],
            ['applications.release_status_id', '=', 5],
            ['applications.accepted_by_advocate_id', '<>', null],
            ['applications.accepted_by_advocate_id', '<>', ''],
            ['addresses.entity_type', '=', 'client']
        ])
        ->orderBy('application_pets.created_at', $filter_rules['order_by'])
        ->select([
            'application_pets.id as id',
            'application_pets.application_id as application_id',
            'applications.client_id as client_id',
            'applications.organisation_id as organisation_id',
            'applications.created_by_advocate_id as created_by_advocate_id',
            'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
            'application_pets.status as status',
            'application_pets.explored_boarding_options as explored_boarding_options',
            'application_pets.release_status_id as release_status_id',
            'application_pets.created_at as created_at',
            'application_pets.updated_at as updated_at',
            'applications.accepted_by_advocate_id as accepted_by_advocate_id',
            'applications.police_involved as police_involved',
            'applications.protective_order as protective_order',
            'applications.abuser_notes as abuser_notes',
            'addresses.state as state',
            'addresses.city as city',
            'addresses.zip_code as zip_code',
            'addresses.street as street',
            'addresses.number as number',
        ])
        ->paginate(4);
        //}

        /**
         * get pet details
         */
        $dataEntriesPets = [];
        foreach( $dataEntries as $dataEntry )
        {
            $dataEntriesPets[$dataEntry->id] = 
            DB::table('pets')
            ->where([
                ['pets.pet_application_id', '=', $dataEntry->application_id]
                // ['pets.pet_type_id', '=', $filter_rules['pet_type']]
            ])
            ->get();
        }
        


        // get number of messages that are not seen by current user
        // and where question is posted by user's shelter
        $qa_badge = [];
        foreach( $dataEntries as $dataEntry )
        {
            $qa_badge[$dataEntry->id] = 0;

            $checkNewMessages = DB::table('question_conversations')
            ->leftJoin('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
            ->leftJoin('seen_messages', 'question_conversation_messages.id', '=', 'seen_messages.conversation_message_id')
            ->where([
                ['question_conversations.application_pet_id', '=', $dataEntry->id],
                ['question_conversation_messages.message', '<>', null]
                // ['question_conversations.shelter_organisation_id', '=', Auth::user()->organisation_id],
                // ['seen_messages.user_id', '=', Auth::user()->id]
            ])
            ->select([
                'seen_messages.id as seen_messages_id',
                'seen_messages.user_id as seen_messages_user_id'
            ])
            ->get();

            foreach( $checkNewMessages as $checkNewMessage )
            {
                if ( $checkNewMessage->seen_messages_id == null )
                {
                    $qa_badge[$dataEntry->id] = $qa_badge[$dataEntry->id] + 1;
                }
            }
        }

        return  view('auth.shelter.petsInNeed', 
                compact('currentUser', 'dataEntries', 'dataEntriesPets', 'petTypes', 'currentShelter', 'qa_badge', 'filter_rules'));
    }


    /**
     * accept pet as shelter
     */
    public function acceptpet(Request $request)
    {
        // validate data from request
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:application_pets,id',
            'action' => 'required|in:accept_pet_confirmed'
        ]);

        if ( !$validator->fails() )
        {
            // check is pet application available for accepting
            $applicationPet = ApplicationPet::where([
                ['id', '=', $request->client_id],
                ['status', '=', 0],
                ['accepted_by_shelter_organisation_id' , '=', null]
            ])
            ->orWhere([
                ['id', '=', $request->client_id],
                ['status', '=', 0],
                ['accepted_by_shelter_organisation_id' , '=', '']
            ])
            ->first();

            if ( $applicationPet )
            {   
                $application = Application::where('id', $applicationPet->application_id)->first();

                if ( $application->status == 1 && $application->accepted_by_advocate_id !== null && $application->accepted_by_advocate_id != '' )
                {
                    $applicationPet->accepted_by_shelter_organisation_id = Auth::user()->organisation_id;
                    $applicationPet->shelter_id_previous_state = $applicationPet->accepted_by_shelter_organisation_id;
                    $applicationPet->status = 1;
                    $applicationPet->update();
    
                    // email notification for advocate
                    // that is working on client case
                    $advocate = DB::table('users')
                    ->join('applications', 'users.id', '=', 'applications.accepted_by_advocate_id')
                    ->where([
                        ['applications.id', '=', $application->id]
                    ])
                    ->select(
                        'users.email as email'
                    )
                    ->first();

                    $data['application'] = DB::table('application_pets')
                    ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                    ->join('clients', 'applications.client_id', '=', 'clients.id')
                    ->join('organisations', 'application_pets.accepted_by_shelter_organisation_id', '=', 'organisations.id')
                    ->where([
                        ['application_pets.id', '=', $applicationPet->id]
                    ])
                    ->select(
                        'application_pets.id as id',
                        'clients.first_name as client_first_name',
                        'clients.last_name as client_last_name',
                        'organisations.name as shelter_name'
                    )
                    ->first();

                    $data['pets'] = DB::table('pets')
                    ->where([
                        ['pets.pet_application_id', '=', $data['application']->id]
                    ])
                    ->select(
                        'pets.name as name'
                    )
                    ->get();

                    $tempuserType = 'user';
                    $shelterAgent = DB::table('users')
                    // ->leftJoin('phones', 'users.id' , '=', 'phones.entity_id')
                    ->where([
                        ['users.id', '=', Auth::user()->id]
                        // ['phones.entity_type', '=', $tempuserType]
                    ])
                    ->select(
                        'users.id as id',
                        'users.first_name as shelter_user_first_name',
                        'users.last_name as shelter_user_last_name',
                        'users.email as shelter_user_email'
                        // 'phones.number as phone'
                    )
                    ->first();

                    $shelterAgentPhone = DB::table('phones')
                    ->where([
                        ['phones.entity_type', '=', $tempuserType],
                        ['phones.entity_id', '=', $shelterAgent->id]
                    ])
                    ->select(
                        'phones.number as phone'
                    )
                    ->first();

                    $data['subject'] = "Safe Haven Secure Portal notification: Pet related to your client has been accepted by shelter";

                    // send notification
                    Mail::to($advocate->email)->send(new AcceptedPetNotificationMail($data, $shelterAgent, $shelterAgentPhone));

                    return [
                        'success' => true
                    ];
                }
                
            }

        }

        return [
            'success' => false,
            'message' => 'This Pet has already been accepted. Refresh your page to continue.'
        ];

    } // end acceptpet


    public function releasePet(Request $request)
    {
        // validate data from request
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:application_pets,id',
            'action' => 'required|in:release_pet_confirmed',
            'confirmed_release_pet_reason' => 'required|in:pet_released_to_owner,pet_services_not_provided,pet_released_to_adoption_pool,pet_not_admitted'
        ]);

        if ( !$validator->fails() )
        {
            // find related pet application
            $applicationPet = ApplicationPet::where([
                ['accepted_by_shelter_organisation_id', '=', Auth::user()->organisation_id],
                ['id', '=', $request->client_id],
                ['status', '=', 1]
            ])->first();
        
            if ( $applicationPet )
            {
                // get release status id
                $releaseStatus = Status::where([
                    ['type', '=', 'pet_release'],
                    ['value', '=', $request->confirmed_release_pet_reason]
                ])->first();

                // update pet application
                if ( in_array($request->confirmed_release_pet_reason, ['pet_released_to_owner', 'pet_released_to_adoption_pool', 'pet_services_not_provided']) )
                {
                    $applicationPet->status = 2;
                    $applicationPet->release_status_id = $releaseStatus->id;
                }
                else
                {
                    $applicationPet->status = 0;
                    $applicationPet->release_status_id = $releaseStatus->id;
                    $applicationPet->accepted_by_shelter_organisation_id = null;
                }

                $applicationPet->update();

                return [
                    'success' => true
                ];

            }
        
        }

        return [
            'success' => false,
            'message' => 'Releasing pet failed'
        ];

    } // end releasePet

    public function archiveList(){

        $currentUser = UserObject::get(Auth::user()->email, 'email');

        // get list filter rules
        $filter_rules = [];
        $temp = TempObject::get(Auth::user()->id, 'list-filters');
        if ( isset($temp['pets_archive']) )
        {
            $filter_rules = $temp['pets_archive'];
        }
        // defaults for filter
        if ( !isset( $filter_rules['order_by'] ) ) { $filter_rules['order_by'] = 'asc'; }
        if ( !isset( $filter_rules['filter_by_release_state'] ) ) { $filter_rules['filter_by_release_state'] = 'all'; }

        $petTypes = ObjectType::where('type', 'pet')->get();

        $currentShelter = Organisation::where('id', Auth::user()->organisation_id)->first();

        if ( $filter_rules['filter_by_release_state'] == 'all' )
        {
            $dataEntries = DB::table('application_pets')
                // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
                ->join('users', 'users.id' , '=' , 'application_pets.created_by_advocate_id')
                ->where([
//                    ['application_pets.status', '=', 0],
                    ['application_pets.release_status_id', '<>', null],
                    ['addresses.entity_type', '=', 'client'],
//                    ['applications.accepted_by_advocate_id', '<>', null],
//                    ['applications.accepted_by_advocate_id', '<>', '']
                ])
                ->orderBy('application_pets.created_at', $filter_rules['order_by'])
                ->select([
                    'application_pets.id as id',
                    'application_pets.application_id as application_id',
                    'applications.client_id as client_id',
                    'applications.organisation_id as organisation_id',
                    'applications.created_by_advocate_id as created_by_advocate_id',
                    'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                    'application_pets.status as status',
                    'application_pets.explored_boarding_options as explored_boarding_options',
                    'application_pets.release_status_id as release_status_id',
                    'application_pets.created_at as created_at',
                    'application_pets.updated_at as updated_at',
                    'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                    'applications.police_involved as police_involved',
                    'applications.protective_order as protective_order',
                    'applications.abuser_notes as abuser_notes',
                    'addresses.state as state',
                    'addresses.city as city',
                    'addresses.zip_code as zip_code',
                    'addresses.street as street',
                    'addresses.number as number',
                    'users.first_name as first_name',
                    'users.last_name as last_name'
                ])
                ->paginate(4);
        }
        elseif ( $filter_rules['filter_by_release_state'] == 'released_to_owner' )
        {
            $dataEntries = DB::table('application_pets')
                // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
                ->join('users', 'users.id' , '=' , 'application_pets.created_by_advocate_id')
                ->where([
//                    ['application_pets.status', '=', 0],
                    ['application_pets.release_status_id', '=', '7'],
                    ['addresses.entity_type', '=', 'client'],
//                    ['applications.accepted_by_advocate_id', '<>', null],
//                    ['applications.accepted_by_advocate_id', '<>', '']
                ])
                ->orderBy('application_pets.created_at', $filter_rules['order_by'])
                ->select([
                    'application_pets.id as id',
                    'application_pets.application_id as application_id',
                    'applications.client_id as client_id',
                    'applications.organisation_id as organisation_id',
                    'applications.created_by_advocate_id as created_by_advocate_id',
                    'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                    'application_pets.status as status',
                    'application_pets.explored_boarding_options as explored_boarding_options',
                    'application_pets.release_status_id as release_status_id',
                    'application_pets.created_at as created_at',
                    'application_pets.updated_at as updated_at',
                    'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                    'applications.police_involved as police_involved',
                    'applications.protective_order as protective_order',
                    'applications.abuser_notes as abuser_notes',
                    'addresses.state as state',
                    'addresses.city as city',
                    'addresses.zip_code as zip_code',
                    'addresses.street as street',
                    'addresses.number as number',
                    'users.first_name as first_name',
                    'users.last_name as last_name'
                ])
                ->paginate(4);
        }
        elseif ( $filter_rules['filter_by_release_state'] == 'client_chose_not_to_proceed' )
        {
            $dataEntries = DB::table('application_pets')
                // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
                ->join('users', 'users.id' , '=' , 'application_pets.created_by_advocate_id')
                ->where([
//                    ['application_pets.status', '=', 0],
                    ['application_pets.release_status_id', '=', '8'],
                    ['addresses.entity_type', '=', 'client'],
//                    ['applications.accepted_by_advocate_id', '<>', null],
//                    ['applications.accepted_by_advocate_id', '<>', '']
                ])
                ->orderBy('application_pets.created_at', $filter_rules['order_by'])
                ->select([
                    'application_pets.id as id',
                    'application_pets.application_id as application_id',
                    'applications.client_id as client_id',
                    'applications.organisation_id as organisation_id',
                    'applications.created_by_advocate_id as created_by_advocate_id',
                    'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                    'application_pets.status as status',
                    'application_pets.explored_boarding_options as explored_boarding_options',
                    'application_pets.release_status_id as release_status_id',
                    'application_pets.created_at as created_at',
                    'application_pets.updated_at as updated_at',
                    'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                    'applications.police_involved as police_involved',
                    'applications.protective_order as protective_order',
                    'applications.abuser_notes as abuser_notes',
                    'addresses.state as state',
                    'addresses.city as city',
                    'addresses.zip_code as zip_code',
                    'addresses.street as street',
                    'addresses.number as number',
                    'users.first_name as first_name',
                    'users.last_name as last_name'
                ])
                ->paginate(4);
        }
        elseif ( $filter_rules['filter_by_release_state'] == 'released_to_adoption_pool' )
        {
            $dataEntries = DB::table('application_pets')
                // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
                ->join('users', 'users.id' , '=' , 'application_pets.created_by_advocate_id')
                ->where([
//                    ['application_pets.status', '=', 0],
                    ['application_pets.release_status_id', '=', '9'],
                    ['addresses.entity_type', '=', 'client'],
//                    ['applications.accepted_by_advocate_id', '<>', null],
//                    ['applications.accepted_by_advocate_id', '<>', '']
                ])
                ->orderBy('application_pets.created_at', $filter_rules['order_by'])
                ->select([
                    'application_pets.id as id',
                    'application_pets.application_id as application_id',
                    'applications.client_id as client_id',
                    'applications.organisation_id as organisation_id',
                    'applications.created_by_advocate_id as created_by_advocate_id',
                    'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                    'application_pets.status as status',
                    'application_pets.explored_boarding_options as explored_boarding_options',
                    'application_pets.release_status_id as release_status_id',
                    'application_pets.created_at as created_at',
                    'application_pets.updated_at as updated_at',
                    'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                    'applications.police_involved as police_involved',
                    'applications.protective_order as protective_order',
                    'applications.abuser_notes as abuser_notes',
                    'addresses.state as state',
                    'addresses.city as city',
                    'addresses.zip_code as zip_code',
                    'addresses.street as street',
                    'addresses.number as number',
                    'users.first_name as first_name',
                    'users.last_name as last_name'
                ])
                ->paginate(4);
        }
        elseif ( $filter_rules['filter_by_release_state'] == 'pet_not_admitted' )
        {
            $dataEntries = DB::table('application_pets')
                // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
                ->join('users', 'users.id' , '=' , 'application_pets.created_by_advocate_id')
                ->where([
//                    ['application_pets.status', '=', 0],
                    ['application_pets.release_status_id', '=', '10'],
                    ['addresses.entity_type', '=', 'client'],
//                    ['applications.accepted_by_advocate_id', '<>', null],
//                    ['applications.accepted_by_advocate_id', '<>', '']
                ])
                ->orderBy('application_pets.created_at', $filter_rules['order_by'])
                ->select([
                    'application_pets.id as id',
                    'application_pets.application_id as application_id',
                    'applications.client_id as client_id',
                    'applications.organisation_id as organisation_id',
                    'applications.created_by_advocate_id as created_by_advocate_id',
                    'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                    'application_pets.status as status',
                    'application_pets.explored_boarding_options as explored_boarding_options',
                    'application_pets.release_status_id as release_status_id',
                    'application_pets.created_at as created_at',
                    'application_pets.updated_at as updated_at',
                    'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                    'applications.police_involved as police_involved',
                    'applications.protective_order as protective_order',
                    'applications.abuser_notes as abuser_notes',
                    'addresses.state as state',
                    'addresses.city as city',
                    'addresses.zip_code as zip_code',
                    'addresses.street as street',
                    'addresses.number as number',
                    'users.first_name as first_name',
                    'users.last_name as last_name'
                ])
                ->paginate(4);
        }
        else
        {
            die('internal error.');
        }

        /**
         * get pet details
         */
        $dataEntriesPets = [];
        foreach( $dataEntries as $dataEntry )
        {
            $dataEntriesPets[$dataEntry->id] =
                DB::table('pets')
                    ->where([
                        ['pets.pet_application_id', '=', $dataEntry->application_id],
                        // ['pets.pet_type_id', '=', $filter_rules['pet_type']]
                    ])
                    ->get();
        }



        /*
        // get number of messages that are not seen by current user
        // and where question is posted by user's shelter
        $qa_badge = [];
        foreach( $dataEntries as $dataEntry )
        {
            $qa_badge[$dataEntry->id] = 0;

            $checkNewMessages = DB::table('question_conversations')
                ->leftJoin('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
                ->leftJoin('seen_messages', 'question_conversation_messages.id', '=', 'seen_messages.conversation_message_id')
                ->where([
                    ['question_conversations.application_pet_id', '=', $dataEntry->id],
                    ['question_conversation_messages.message', '<>', null]
                    // ['question_conversations.shelter_organisation_id', '=', Auth::user()->organisation_id],
                    // ['seen_messages.user_id', '=', Auth::user()->id]
                ])
                ->select([
                    'seen_messages.id as seen_messages_id',
                    'seen_messages.user_id as seen_messages_user_id'
                ])
                ->get();

            foreach( $checkNewMessages as $checkNewMessage )
            {
                if ( $checkNewMessage->seen_messages_id == null )
                {
                    $qa_badge[$dataEntry->id] = $qa_badge[$dataEntry->id] + 1;
                }
            }
        }
        */

        return view('auth.shelter.petsArchive',
            compact('currentUser', 'dataEntries', 'dataEntriesPets', 'petTypes', 'currentShelter', 'qa_badge', 'filter_rules'));

    }
}

<?php

namespace App\Http\Controllers\Advocate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Validator;
use Mail;

use App\ObjectType;
use App\State;
use App\Client;
use App\Application;
use App\Status;

use App\Code\UserObject;
use App\Code\TempObject;
use App\Code\Mailer;

use App\Mail\NewPetInNeedMail;

class ClientsController extends Controller
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
     * associated clients list page
     */
    public function associatedList()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        // get list filter rules
        $filter_rules = [];
        $temp = TempObject::get(Auth::user()->id, 'list-filters');
        if ( isset($temp['current_clients']) ) 
        {
            $filter_rules = $temp['current_clients'];
        }
        // defaults for filter
        if ( !isset( $filter_rules['order_by'] ) ) { $filter_rules['order_by'] = 'asc'; }
        if ( !isset( $filter_rules['filter_by_answered'] ) ) { $filter_rules['filter_by_answered'] = 'all'; }

        $petTypes = ObjectType::where('type', 'pet')->get();
        $phoneTypes = ObjectType::where('type', 'phone')->get();
        $states = State::all();
        $preferedContactMethods = [
            'phone' => 'Phone', 
            'email' => 'Email', 
            'text_message' => 'Text message'
        ];

        // get client list
        if ( $filter_rules['filter_by_answered'] == 'all' )
        {
            $dataEntries = DB::table('applications')
            ->join('application_pets', 'applications.id', '=', 'application_pets.application_id')
            ->join('clients', 'applications.client_id', '=', 'clients.id')
            ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
            ->join('addresses', 'applications.client_id' , '=' , 'addresses.entity_id')
            ->join('phones', 'applications.client_id' , '=' , 'phones.entity_id')
            ->where([
                ['addresses.entity_type', '=', 'client'],
                ['phones.entity_type', '=', 'client'],
                ['applications.status', '=', '1'],
                ['applications.organisation_id', '=', $currentUser->organisation_id],
                ['applications.accepted_by_advocate_id', '=', Auth::user()->id]
            ])
            ->select(
                'applications.id as id',
                'clients.id as client_id',
                'applications.created_by_advocate_id as created_by_advocate_id',
                'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                'applications.status as status',
                'applications.police_involved as police_involved',
                'applications.protective_order as protective_order',
                'applications.abuser_notes as abuser_notes',
                'applications.release_status_id as release_status_id',
                'applications.created_at as created_at',
                'applications.id as application_id',
                'application_pets.pet_id as pet_id',
                'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                'application_pets.abuser_visiting_access as abuser_visiting_access',
                'application_pets.estimated_lenght_of_housing as estimated_lenght_of_housing',
                'application_pets.pet_protective_order as pet_protective_order',
                'application_pets.client_legal_owner_of_pet as client_legal_owner_of_pet',
                'application_pets.abuser_legal_owner_of_pet as abuser_legal_owner_of_pet',
                'application_pets.explored_boarding_options as explored_boarding_options',
                'clients.first_name as first_name',
                'clients.last_name as last_name',
                'clients.email as email',
                'clients.best_way_to_reach as best_way_to_reach',
                'clients.pets_count as pets_count',
                'pets.slug as slug',
                'pets.pet_type_id as pet_type_id',
                'pets.name as name',
                'pets.breed as breed',
                'pets.weight as weight',
                'pets.age as age',
                'pets.reported as reported',
                'pets.description as description',
                'pets.microchipped as microchipped',
                'pets.vaccinations as vaccinations',
                'pets.sprayed as sprayed',
                'pets.objection_to_spray as objection_to_spray',
                'pets.dietary_needs as dietary_needs',
                'pets.vet_needs as vet_needs',
                'pets.temperament as temperament',
                'pets.aditional_info as aditional_info',
                'addresses.state as state',
                'addresses.city as city',
                'addresses.zip_code as zip_code',
                'addresses.street as street',
                'phones.number as number',
                'phones.phone_type_id as phone_type_id'
            )
            ->orderBy('applications.created_at', $filter_rules['order_by'])
            ->paginate(4);
        }
        elseif( $filter_rules['filter_by_answered'] == 'answered' )
        {
            $dataEntries = DB::table('applications')
            ->join('application_pets', 'applications.id', '=', 'application_pets.application_id')
            ->join('clients', 'applications.client_id', '=', 'clients.id')
            ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
            ->join('addresses', 'applications.client_id' , '=' , 'addresses.entity_id')
            ->join('phones', 'applications.client_id' , '=' , 'phones.entity_id')
            ->join('question_conversations', 'application_pets.id', '=', 'question_conversations.application_pet_id')
            ->join('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
            ->where([
                ['addresses.entity_type', '=', 'client'],
                ['phones.entity_type', '=', 'client'],
                ['applications.status', '=', '1'],
                ['applications.organisation_id', '=', $currentUser->organisation_id],
                ['applications.accepted_by_advocate_id', '=', Auth::user()->id],
                ['question_conversation_messages.message', '<>', null]
            ])
            ->select(
                'applications.id as id',
                'clients.id as client_id',
                'applications.created_by_advocate_id as created_by_advocate_id',
                'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                'applications.status as status',
                'applications.police_involved as police_involved',
                'applications.protective_order as protective_order',
                'applications.abuser_notes as abuser_notes',
                'applications.release_status_id as release_status_id',
                'applications.created_at as created_at',
                'applications.id as application_id',
                'application_pets.pet_id as pet_id',
                'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                'application_pets.abuser_visiting_access as abuser_visiting_access',
                'application_pets.estimated_lenght_of_housing as estimated_lenght_of_housing',
                'application_pets.pet_protective_order as pet_protective_order',
                'application_pets.client_legal_owner_of_pet as client_legal_owner_of_pet',
                'application_pets.abuser_legal_owner_of_pet as abuser_legal_owner_of_pet',
                'application_pets.explored_boarding_options as explored_boarding_options',
                'clients.first_name as first_name',
                'clients.last_name as last_name',
                'clients.email as email',
                'clients.best_way_to_reach as best_way_to_reach',
                'clients.pets_count as pets_count',
                'pets.slug as slug',
                'pets.pet_type_id as pet_type_id',
                'pets.name as name',
                'pets.breed as breed',
                'pets.weight as weight',
                'pets.age as age',
                'pets.reported as reported',
                'pets.description as description',
                'pets.microchipped as microchipped',
                'pets.vaccinations as vaccinations',
                'pets.sprayed as sprayed',
                'pets.objection_to_spray as objection_to_spray',
                'pets.dietary_needs as dietary_needs',
                'pets.vet_needs as vet_needs',
                'pets.temperament as temperament',
                'pets.aditional_info as aditional_info',
                'addresses.state as state',
                'addresses.city as city',
                'addresses.zip_code as zip_code',
                'addresses.street as street',
                'phones.number as number',
                'phones.phone_type_id as phone_type_id'
            )
            ->orderBy('applications.created_at', $filter_rules['order_by'])
            ->paginate(4);
        }
        elseif( $filter_rules['filter_by_answered'] == 'unanswered' )
        {
            $dataEntries = DB::table('applications')
            ->join('application_pets', 'applications.id', '=', 'application_pets.application_id')
            ->join('clients', 'applications.client_id', '=', 'clients.id')
            ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
            ->join('addresses', 'applications.client_id' , '=' , 'addresses.entity_id')
            ->join('phones', 'applications.client_id' , '=' , 'phones.entity_id')
            ->join('question_conversations', 'application_pets.id', '=', 'question_conversations.application_pet_id')
            ->leftJoin('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
            ->where([
                ['addresses.entity_type', '=', 'client'],
                ['phones.entity_type', '=', 'client'],
                ['applications.status', '=', '1'],
                ['applications.organisation_id', '=', $currentUser->organisation_id],
                ['applications.accepted_by_advocate_id', '=', Auth::user()->id],
                ['question_conversation_messages.message', '=', null]
            ])
            ->select(
                'applications.id as id',
                'clients.id as client_id',
                'applications.created_by_advocate_id as created_by_advocate_id',
                'applications.accepted_by_advocate_id as accepted_by_advocate_id',
                'applications.status as status',
                'applications.police_involved as police_involved',
                'applications.protective_order as protective_order',
                'applications.abuser_notes as abuser_notes',
                'applications.release_status_id as release_status_id',
                'applications.created_at as created_at',
                'applications.id as application_id',
                'application_pets.pet_id as pet_id',
                'application_pets.accepted_by_shelter_organisation_id as accepted_by_shelter_organisation_id',
                'application_pets.abuser_visiting_access as abuser_visiting_access',
                'application_pets.estimated_lenght_of_housing as estimated_lenght_of_housing',
                'application_pets.pet_protective_order as pet_protective_order',
                'application_pets.client_legal_owner_of_pet as client_legal_owner_of_pet',
                'application_pets.abuser_legal_owner_of_pet as abuser_legal_owner_of_pet',
                'application_pets.explored_boarding_options as explored_boarding_options',
                'clients.first_name as first_name',
                'clients.last_name as last_name',
                'clients.email as email',
                'clients.best_way_to_reach as best_way_to_reach',
                'clients.pets_count as pets_count',
                'pets.slug as slug',
                'pets.pet_type_id as pet_type_id',
                'pets.name as name',
                'pets.breed as breed',
                'pets.weight as weight',
                'pets.age as age',
                'pets.reported as reported',
                'pets.description as description',
                'pets.microchipped as microchipped',
                'pets.vaccinations as vaccinations',
                'pets.sprayed as sprayed',
                'pets.objection_to_spray as objection_to_spray',
                'pets.dietary_needs as dietary_needs',
                'pets.vet_needs as vet_needs',
                'pets.temperament as temperament',
                'pets.aditional_info as aditional_info',
                'addresses.state as state',
                'addresses.city as city',
                'addresses.zip_code as zip_code',
                'addresses.street as street',
                'phones.number as number',
                'phones.phone_type_id as phone_type_id'
            )
            ->orderBy('applications.created_at', $filter_rules['order_by'])
            ->paginate(4);
        }
        else
        {
            die('internal error');
        }
        // dd($dataEntries);

        // get Q&A unanswered questions number
        $qa_badge = [];

        foreach( $dataEntries as $dataEntry )
        {
            $qa_badge[$dataEntry->id] = 0;
            
            $questions = DB::table('application_pets')
                ->join('question_conversations', 'application_pets.id', '=', 'question_conversations.application_pet_id')
                ->leftJoin('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
                ->where([
                    ['application_pets.application_id', '=', $dataEntry->id]
                ])
                ->get();
                // dd($questions);
                
            foreach( $questions as $question )
            {
                if( $question->message == null )
                {
                    $qa_badge[$dataEntry->id] =  $qa_badge[$dataEntry->id] + 1;
                }
            }
        }
// dd($qa_badge);
        return  view('auth.advocate.clientsCurrent', 
                compact('currentUser', 'dataEntries', 'petTypes', 'phoneTypes', 'states', 'preferedContactMethods', 'qa_badge', 'filter_rules'));
    }

    /**
     * clients in need list page
     */
    public function inNeedList()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        // get list filter rules
        $filter_rules = [];
        $temp = TempObject::get(Auth::user()->id, 'list-filters');
        if ( isset($temp['clients_in_need']) ) 
        {
            $filter_rules = $temp['clients_in_need'];
        }
        // defaults for filter
        if ( !isset( $filter_rules['order_by'] ) ) { $filter_rules['order_by'] = 'asc'; }

        $petTypes = ObjectType::where('type', 'pet')->get();
        $phoneTypes = ObjectType::where('type', 'phone')->get();
        $states = State::all();
        $preferedContactMethods = [
            'phone' => 'Phone', 
            'email' => 'Email', 
            'text_message' => 'Text message'
        ];

        $dataEntries = DB::table('applications')
            ->join('application_pets', 'applications.id', '=', 'application_pets.application_id')
            ->join('clients', 'applications.client_id', '=', 'clients.id')
            ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
            ->join('addresses', 'applications.client_id' , '=' , 'addresses.entity_id')
            ->join('phones', 'applications.client_id' , '=' , 'phones.entity_id')
            ->where([
                ['addresses.entity_type', '=', 'client'],
                ['phones.entity_type', '=', 'client'],
                ['applications.status', '=', '0'],
                ['applications.organisation_id', '=', $currentUser->organisation_id]
            ])
            ->orderBy('applications.created_at', $filter_rules['order_by'])
            ->paginate(4);

        return  view('auth.advocate.clientsInNeed', 
                compact('currentUser', 'dataEntries', 'petTypes', 'phoneTypes', 'states', 'preferedContactMethods', 'filter_rules'));
    }



    /**
     * ajax handler for accepting new client
     * from clients in need table
     */
    public function acceptClient(Request $request)
    {
        // validate data from request
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:applications,id',
            'action' => 'required|in:accept_client_confirmed'
        ]);

        if ( !$validator->fails() )
        {
            // check is advocate arganisation created client application
            $application = Application::where([
                ['organisation_id', '=', Auth::user()->organisation_id],
                ['id', '=', $request->client_id],
                ['status', '=', 0]
            ])
            ->first();

            if ($application)
            {
                // update client application status
                $application->status = 1;
                $application->accepted_by_advocate_id = Auth::user()->id;
                $application->update();

                /**
                 * send mass mail to all shelter users
                 */
                // get data from database for filling email template
                $data = DB::table('application_pets')
                ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                ->join('object_types', 'pets.pet_type_id', '=', 'object_types.id')
                ->join('organisations', 'application_pets.organisation_id', '=', 'organisations.id')
                ->where([
                    ['application_pets.application_id', '=', $application->id]
                ])
                ->select(
                    'pets.name as name',
                    'pets.age as age',
                    'object_types.label as type',
                    'pets.breed as breed',
                    'organisations.name as adv_organisation_name'
                )
                ->first();
                // send email notification
                Mail::bcc($this->_getActiveShelterUsers())->send(new NewPetInNeedMail($data));

                return [
                    'success' => true
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Accepting client application failed'
        ];
    }


    /**
     * release client ajax handler
     */
    public function releaseClient(Request $request)
    {
        // validate data from request
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:applications,id',
            'action' => 'required|in:release_client_confirmed',
            'confirmed_release_reason' => 'required|in:completed,not_provided,no_longer_needed',
        ]);

        if ( !$validator->fails() )
        {
            // check is advocate accepted this client
            $application = Application::where([
                ['organisation_id', '=', Auth::user()->organisation_id],
                ['accepted_by_advocate_id', '=', Auth::user()->id],
                ['id', '=', $request->client_id],
                ['status', '=', 1]
            ])
            ->first();

            if ($application)
            {
                // get release status id
                $releaseStatus = Status::where([
                    ['type', '=', 'client_release'],
                    ['value', '=', $request->confirmed_release_reason]
                ])->first();

                // update client application
                if ( in_array($request->confirmed_release_reason, ['completed', 'no_longer_needed']) )
                {
                    $application->status = 2;
                    $application->release_status_id = $releaseStatus->id;
                }
                else
                {
                    $application->status = 0;
                    $application->release_status_id = $releaseStatus->id;
                    $application->accepted_by_advocate_id = null;
                }

                $application->update();

                return [
                    'success' => true
                ];

            }

        }
        
        return [
            'success' => false,
            'message' => 'Releasing client failed'
        ];
    }

    /**
     * create array with emails
     * for shelter users
     */
    protected function _getActiveShelterUsers()
    {
        $users = DB::table('users')
        ->join('object_types', 'users.user_type_id', '=', 'object_types.id')
        ->where([
            ['object_types.type', '=', 'user'],
            ['object_types.value', '=', 'shelter'],
            ['users.verified', '=', 1],
            ['users.banned', '=', 0]
        ])
        ->select('users.email')
        ->get();

        // create array with email lists
        $emails = [];
        foreach( $users as $user )
        {
            array_push($emails, $user->email);
        }

        return $emails;
    }
    
}

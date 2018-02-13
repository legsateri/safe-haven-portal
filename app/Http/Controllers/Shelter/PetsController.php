<?php

namespace App\Http\Controllers\Shelter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Validator;

use App\ObjectType;
use App\Code\UserObject;
use App\Application;
use App\ApplicationPet;
use App\Status;
use App\Organisation;

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

        $petTypes = ObjectType::where('type', 'pet')->get();

        $dataEntries = DB::table('application_pets')
                    ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                    ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                    ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
                    ->where([
                        ['application_pets.status', '=', '1'],
                        ['application_pets.accepted_by_shelter_organisation_id', '=', Auth::user()->organisation_id],
                        ['addresses.entity_type', '=', 'client'],
                    ])
                    ->paginate(4);

        return  view('auth.shelter.petsAssociated', 
                compact('currentUser', 'dataEntries', 'petTypes'));
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

        if ( $filter_rules['pet_type'] == 'all' )
        {
            $dataEntries = DB::table('application_pets')
            ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
            ->join('applications', 'application_pets.application_id', '=', 'applications.id')
            ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
            ->where([
                ['application_pets.status', '=', '0'],
                ['addresses.entity_type', '=', 'client'],
                ['applications.accepted_by_advocate_id', '<>', null],
                ['applications.accepted_by_advocate_id', '<>', '']
            ])
            ->orderBy('application_pets.created_at', $filter_rules['order_by'])
            ->paginate(4);
        }
        else
        {
            $dataEntries = DB::table('application_pets')
            ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
            ->join('applications', 'application_pets.application_id', '=', 'applications.id')
            ->join('addresses', 'application_pets.client_id' , '=' , 'addresses.entity_id')
            ->where([
                ['application_pets.status', '=', '0'],
                ['pets.pet_type_id', '=', $filter_rules['pet_type']],
                ['addresses.entity_type', '=', 'client'],
                ['applications.accepted_by_advocate_id', '<>', null],
                ['applications.accepted_by_advocate_id', '<>', '']
            ])
            ->orderBy('application_pets.created_at', $filter_rules['order_by'])
            ->paginate(4);
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
                compact('currentUser', 'dataEntries', 'petTypes', 'currentShelter', 'qa_badge', 'filter_rules'));
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
                // validate status of client application
                $application = Application::where('id', $applicationPet->application_id)->first();
                if ( $application->status == 1 && $application->accepted_by_advocate_id != null && $application->accepted_by_advocate_id != '' )
                {
                    // upate pet application entry
                    $applicationPet->accepted_by_shelter_organisation_id = Auth::user()->organisation_id;
                    $applicationPet->status = 1;
                    $applicationPet->update();
    
                    return [
                        'success' => true
                    ];
                }
                
            }

        }

        return [
            'success' => false,
            'message' => 'Accepting pet application failed'
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
}

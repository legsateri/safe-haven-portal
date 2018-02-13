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
                
            foreach( $questions as $question )
            {
                if( $question->message == null )
                {
                    $qa_badge[$dataEntry->id] =  $qa_badge[$dataEntry->id] + 1;
                }
            }
        }

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

                // // get shelter user type id
                // $shelterUser = ObjectType::where([
                //     ['type', '=', 'user'],
                //     ['value', '=', 'shelter']
                // ])->first();

                // // get email list
                // $shelterUsers = DB::table('users')
                //             ->select('email')
                //             ->where([
                //                 ['user_type_id', '=', $shelterUser->id],
                //                 ['verified', '=', 1],
                //                 ['banned', '=', 0]
                //             ])
                //             ->get();

                // $emails = [];
                
                // // create array with email lists
                // foreach( $shelterUsers as $shelterUser )
                // {
                //     array_push($emails, $shelterUser->email);
                // }

                // // try sending emails
                // try
                // {
                //     // Mail::send('emails.welcome', [], function($message) use ($emails)
                //     // {    
                //     //     $message->bcc($emails)->subject('This is test e-mail');    
                //     // });
                // } 
                // catch (Exception $e) 
                // {
                //     // alternative action if sending emails fails
                // }

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
    
}

<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use DB;
use Mail;
use App\Application;
use App\ApplicationPet;
use App\QuestionConversation;
use App\QuestionConversationMessage;
use App\SeenMessage;

use App\Mail\NewQuestionAboutPetMail;
use App\Mail\NewAnswerAboutPetMail;

class QuestionMessages extends Controller
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
     * ajax handler
     * response when shelter open Q&A modal
     */
    public function petListGetModal(Request $request)
    {
        // validate request data
        $validator = Validator::make($request->all(), [
            'pet_id' => 'required|integer|exists:application_pets,id',
            'action' => 'required|in:pet_in_need_get_qa_thread'
        ]);

        if ( !$validator->fails() )
        {
            // check pet application id
            $application_pet = ApplicationPet::where([
                ['id', '=', $request->pet_id]
            ])
            ->first();

            if ($application_pet)
            {
                // get conversation/messages collection
                $conversations = DB::table('question_conversations')
                                ->leftJoin('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
                                ->leftJoin('users', 'question_conversation_messages.sender_user_id', '=', 'users.id')
                                ->leftJoin('organisations', 'users.organisation_id', '=', 'organisations.id')
                                ->select(
                                    'question_conversations.title as title',
                                    'question_conversations.created_at as question_created_at',
                                    'question_conversations.shelter_organisation_id as shelter_id',
                                    'question_conversation_messages.id as message_id',
                                    'question_conversation_messages.message as message',
                                    'question_conversation_messages.created_at as answer_date',
                                    'organisations.name as organisation_name'
                                )
                                ->where([
                                    ['question_conversations.application_pet_id', '=', $application_pet->id]
                                ])
                                ->orderBy('question_conversations.created_at', 'desc')
                                ->get();
                
                // set messagee as seen by current user for messages posted
                // by shelter where he belongs
                foreach( $conversations as $conversation )
                {
                    if ( $conversation->shelter_id == Auth::user()->organisation_id && $conversation->message_id != null )
                    {
                        $checkSeen = SeenMessage::where([
                            ['user_id', '=', Auth::user()->id],
                            ['conversation_message_id', '=', $conversation->message_id]
                        ])->first();

                        if(!isset($checkSeen->id))
                        {
                            $checkSeen = new SeenMessage();
                            $checkSeen->user_id = Auth::user()->id;
                            $checkSeen->conversation_message_id = $conversation->message_id;
                            $checkSeen->save();
                        }
                    }
                    
                }

                // return view
                $html = view('auth.render.questionsPetListModal', ['conversations' => $conversations])->render();
                return [
                    'success' => true,
                    'data' => $html
                ];
            }


        }
        
        return [
            'success' => false
        ];

    } // end petListGetModal


    /**
     * ajax handler
     * response when advocate open Q&A modal
     */
    public function clientsListGetModal(Request $request)
    {
        
        // validate request data
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:applications,id',
            'action' => 'required|in:current_client_get_qa_thread'
        ]);

        if ( !$validator->fails() )
        {
            // check is current advocate organisation
            // owner of client application
            $application = Application::where([
                ['id', '=', $request->client_id],
                ['organisation_id', '=', Auth::user()->organisation_id]
            ])
            ->first();

            if ($application)
            {
                $questions = DB::table('applications')
                ->join('application_pets', 'applications.id', '=', 'application_pets.application_id')
                ->join('question_conversations', 'application_pets.id', '=', 'question_conversations.application_pet_id')
                ->leftJoin('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
                ->join('organisations', 'question_conversations.shelter_organisation_id', '=', 'organisations.id')
                ->where([
                    ['applications.organisation_id', '=', Auth::user()->organisation_id],
                    ['applications.id', '=', $request->client_id]
                ])
                ->select([
                    'question_conversations.id as id',
                    'question_conversations.title as question',
                    'question_conversations.created_at as question_time',
                    'question_conversation_messages.message as answer',
                    'question_conversation_messages.created_at as answer_time',
                    'organisations.name as shelter_name'
                ])
                ->get();

                $advocateOrganisation = DB::table('organisations')->where('id', Auth::user()->organisation_id)->select('name')->first();

                // dd($questions);

                $isClientsArchive = strpos($request->headers->get('referer'), 'clients/archive');
                $html = view('auth.render.questionsClientListModal', compact('questions', 'advocateOrganisation','isClientsArchive'))->render();
                // return $html;
                return [
                    'success' => true,
                    'data' => $html
                ];

            }

        }
        
        return [
            'success' => false
        ];

    } // end clientsListGetModal


    /**
     * ajax handler
     * response when shelter post question
     * in Q&A modal
     */
    public function sendQuestion(Request $request)
    {
        // validate request data
        $validator = Validator::make($request->all(), [
            'pet_id' => 'required|integer|exists:application_pets,id',
            'organisation_id' => 'required|integer|exists:organisations,id|in:' . Auth::user()->organisation_id,
            'action' => 'required|in:pet_in_need_question_post',
            'pet_in_need_qa' => 'required|string|max:1000'
        ]);

        if ( !$validator->fails() )
        {
            // find related pet application
            $application_pet = ApplicationPet::where([
                ['id', '=', $request->pet_id]
            ])->first();

            // if pet application is found, post question
            if ($application_pet)
            {
                // post new question
                $question = new QuestionConversation();
                $question->application_pet_id = $application_pet->id;
                // $question->pet_id = $application_pet->pet_id;
                $question->shelter_organisation_id = Auth::user()->organisation_id;
                $question->title = $request->pet_in_need_qa;
                $question->save();

                // email notification to advocate organisaton
                // that they have new question
                $data['application'] = DB::table('application_pets')
                ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                ->join('clients', 'applications.client_id', '=', 'clients.id')
                // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                ->join('question_conversations', 'application_pets.id', '=', 'question_conversations.application_pet_id')
                ->join('users', 'application_pets.created_by_advocate_id', '=', 'users.id')
                ->where([
                    ['application_pets.id', '=', $application_pet->id],
                    ['question_conversations.id', '=', $question->id]
                ])
                ->select(
                    'applications.organisation_id as adv_organisation_id',
                    'clients.first_name as client_first_name',
                    'clients.last_name as client_last_name',
                    // 'pets.name as pet_name',
                    'question_conversations.title as question',
                    'users.id as advocate_id'
                )
                ->first();

                $data['pets'] = DB::table('pets')
                ->where([
                    ['pets.pet_application_id', '=', $application_pet->id]
                ])
                ->select(
                    'pets.name as name'
                )
                ->get();

                $data['subject'] = "Safe Haven Secure Portal notification: New question posted related to your client's pet";

                // send notification
//                Mail::bcc($this->_getActiveUsersFromOrg($data['application']->adv_organisation_id))->send(new NewQuestionAboutPetMail($data));
                Mail::bcc($this->_getPetsAdvocateMail($data['application']->advocate_id))->send(new NewQuestionAboutPetMail($data));

                return [
                    'success' => true
                ];
            }

        }

        return [
            'success' => false
        ];

    } // end sendQuestion



    /**
     * ajax handler
     * response when advocate post answer to question
     * in Q&A modal
     */
    public function clientSendAnswer(Request $request)
    {
        // validate request data
        $validator = Validator::make($request->all(), [
            'client_current_qa_id' => 'required|integer|exists:question_conversations,id',
            'action' => 'required|in:current_client_answer_post',
            'client_current_qa_answer' => 'required|string|max:1000'
        ]);

        if ( !$validator->fails() )
        {
            // check is application made by this advocate organisation
            $petApplication = DB::table('application_pets')
            ->join('question_conversations', 'application_pets.id', '=', 'question_conversations.application_pet_id')
            ->where([
                ['organisation_id', '=', Auth::user()->organisation_id],
                ['question_conversations.id', '=', $request->client_current_qa_id]
            ])
            ->select([
                'application_pets.id as application_pet_id',
                'application_pets.application_id as application_id',
                'question_conversations.id as conversation_id',
                'question_conversations.shelter_organisation_id as shelter_organisation_id'
            ])
            ->first();

            if ( isset( $petApplication->conversation_id ) )
            {
                // check is there answer on this question already
                $answer = QuestionConversationMessage::where('conversation_id', $petApplication->conversation_id)->first();

                if (isset($answer->id))
                {
                    // update existing answer
                    $answer->sender_user_id = Auth::user()->id;
                    $answer->message = $request->client_current_qa_answer;
                    $answer->update();

                    // remove seen status for this question
                    $seens = SeenMessage::where([
                        ['conversation_message_id', '=', $answer->id]
                    ])->get();
                    foreach( $seens as $seen )
                    {
                        $seen->delete();
                    }

                    // send email notification
                    // to shelter that have posted question
                    $data['application'] = DB::table('application_pets')
                    ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                    // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                    ->join('question_conversations', 'application_pets.id', '=', 'question_conversations.application_pet_id')
                    ->join('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
                    ->where([
                        ['question_conversation_messages.id', '=', $answer->id]
                    ])
                    ->select(
                        'applications.organisation_id as shelter_organisation_id',
                        // 'pets.name as pet_name',
                        'question_conversations.title as question',
                        'question_conversation_messages.message as answer'
                    )
                    ->first();

                    $data['pets'] = DB::table('pets')
                    ->where([
                        ['pets.pet_application_id', '=', $petApplication->application_pet_id]
                    ])
                    ->select(
                        'pets.name as name'
                    )
                    ->get();

                    $data['subject'] = "Safe Haven Secure Portal notification: New answer posted on question about pet";

                    // send notification
                    Mail::bcc($this->_getActiveUsersFromOrg($petApplication->shelter_organisation_id))->send(new NewAnswerAboutPetMail($data));

                    return [
                        'success' => true
                    ];
                }
                else
                {
                    // insert new answer
                    $answer = new QuestionConversationMessage();
                    $answer->conversation_id = $petApplication->conversation_id;
                    $answer->sender_user_id = Auth::user()->id;
                    $answer->message = $request->client_current_qa_answer;
                    $answer->save();

                    // count how many unanswered questions are left
                    $unanswered_count = 0;
                    
                    $questions = DB::table('application_pets')
                    ->join('question_conversations', 'application_pets.id', '=', 'question_conversations.application_pet_id')
                    ->leftJoin('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
                    ->where([
                        ['application_pets.application_id', '=', $petApplication->application_id]
                    ])
                    ->get();
                        
                    foreach( $questions as $question )
                    {
                        if( $question->message == null )
                        {
                            $unanswered_count++;
                        }
                    }

                    // send email notification
                    // to shelter that have posted question
                    $data['application'] = DB::table('application_pets')
                    ->join('applications', 'application_pets.application_id', '=', 'applications.id')
                    // ->join('pets', 'application_pets.pet_id', '=', 'pets.id')
                    ->join('question_conversations', 'application_pets.id', '=', 'question_conversations.application_pet_id')
                    ->join('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
                    ->where([
                        ['question_conversation_messages.id', '=', $answer->id]
                    ])
                    ->select(
                        'applications.organisation_id as shelter_organisation_id',
                        // 'pets.name as pet_name',
                        'question_conversations.title as question',
                        'question_conversation_messages.message as answer'
                    )
                    ->first();

                    $data['pets'] = DB::table('pets')
                    ->where([
                        ['pets.pet_application_id', '=', $petApplication->application_pet_id]
                    ])
                    ->select(
                        'pets.name as name'
                    )
                    ->get();

                    $data['subject'] = "Safe Haven Secure Portal notification: New answer posted on question about pet";

                    // send notification
                    Mail::bcc($this->_getActiveUsersFromOrg($petApplication->shelter_organisation_id))->send(new NewAnswerAboutPetMail($data));

                    return [
                        'success' => true,
                        'application_id' => $petApplication->application_id,
                        'unanswered_count' => $unanswered_count
                    ];

                }



            }
            
        }

        return [
            'success' => false
        ];

    } // end clientSendAnswer


    protected function _getActiveUsersFromOrg($organisation_id)
    {
        $users = DB::table('users')
        ->join('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['organisations.id', '=', $organisation_id],
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

    protected function _getPetsAdvocateMail($advocate_id){

        return DB::table('users')
            ->where([
                ['users.id', '=', $advocate_id],
                ['users.verified', '=', 1],
                ['users.banned', '=', 0]
            ])
            ->select(
                'users.email'
            )
            ->get();

    }

}

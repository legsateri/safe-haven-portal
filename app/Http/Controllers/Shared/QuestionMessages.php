<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use DB;
use App\Application;
use App\ApplicationPet;
use App\QuestionConversation;
use App\QuestionConversationMessage;

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
                                ->join('question_conversation_messages', 'question_conversations.id', '=', 'question_conversation_messages.conversation_id')
                                ->join('users', 'question_conversation_messages.sender_user_id', '=', 'users.id')
                                ->join('organisations', 'users.organisation_id', '=', 'organisations.id')
                                ->select(
                                    'question_conversations.title as title',
                                    'question_conversation_messages.message as message',
                                    'question_conversation_messages.created_at as answer_date',
                                    'organisations.name as organisation_name'
                                )
                                ->where([
                                    ['question_conversations.pet_id', '=', $application_pet->pet_id]
                                ])
                                ->get();
                // dd($conversations);
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

                $html = view('auth.render.questionsClientListModal', compact('questions', 'advocateOrganisation'))->render();
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
                $question->pet_id = $application_pet->pet_id;
                $question->shelter_organisation_id = Auth::user()->organisation_id;
                $question->title = $request->pet_in_need_qa;
                $question->save();

                return [
                    'success' => true
                ];
            }

        }

        return [
            'success' => false
        ];

    } // end sendQuestion
}

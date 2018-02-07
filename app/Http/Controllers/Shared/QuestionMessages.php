<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use DB;
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
}

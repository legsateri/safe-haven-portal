<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

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
        $html = view('auth.render.questionsPetListModal')->render();
        
        return $html;

        // return [
        //     'modal' => $html
        // ];
    }
}

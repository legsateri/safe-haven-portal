<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class PublicPagesController extends Controller
{
    public function index()
    {
        
        // $emails = ['mdjokic@ztech.io', 'mdjokic@ztech.rs','milos.djokic@ztech.io'];

        // Mail::send('emails.welcome', [], function($message) use ($emails)
        // {    
        //     $message->bcc($emails)->subject('This is test e-mail');    
        // });
        // var_dump( Mail:: failures());
        // exit;
        
        
        return view('PublicPages.homePage');
    }
}

<?php
/**
 * sending mass mail functionality
 */
namespace App\Code;

use DB;
use Mail;
use App\ObjectType;

class MassMailer
{
    public function __construct()
    {

    }

    protected function _getActiveShelterUsers()
    {
        $shelterUser = ObjectType::where([
            ['type', '=', 'user'],
            ['value', '=', 'shelter']
        ])->first();

        $users = DB::table('users')
        ->select('email')
        ->where([
            ['user_type_id', '=', $shelterUser->id],
            ['verified', '=', 1],
            ['banned', '=', 0]
        ])
        ->get();

        // create array with email lists
        $emails = [];
        foreach( $shelterUsers as $shelterUser )
        {
            array_push($emails, $shelterUser->email);
        }

        return $emails;
    }

    protected function _emailSender()
    {
        try
        {
            Mail::send('emails.welcome', [], function($message) use ($emails)
            {    
                $message->bcc($emails)->subject('This is test e-mail');    
            });
        } 
        catch (Exception $e) 
        {
            // alternative action if sending emails fails
        }
    }

}
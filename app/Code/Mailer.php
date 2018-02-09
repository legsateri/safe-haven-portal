<?php
/**
 * sending emails functionality
 */
namespace App\Code;

use DB;
use Mail;

class Mailer
{
    // available mailing lists
    protected $_allowedEmailLists = [
        'shelter-users'
    ];

    // email addresses for sending
    protected $_emailList = [];
    protected $_email = "";

    // email template, data and subject
    protected $_emailTemplate = "";
    protected $_emailData = [];
    protected $_emailSubject = "";

    
    
    public function __construct($data)
    {
        // handle is email need to be sent to multilpe addresses
        if ( isset($data['email-list']) )
        {
            if ( in_array($data['email-list'], $this->_allowedEmailLists) )
            {
                $this->_getRecipientsList($data['email-list']);
            }
        }

        // handle single email recipient
        if ( isset($data['email']) )
        {
            $this->_email = $data['email'];
        }

        // handle email template
        $this->_emailTemplate = $data['template'];

        // handle email data
        $this->_emailData = $data['data'];

        // handle email subject
        $this->_emailSubject = $data['subject'];

        // send email(s)
        $this->_send();
        
    }


    /**
     * get emails from specific list
     */
    protected function _getRecipientsList($listCode)
    {
        switch ($listCode) {
            case 'shelter-users':
                $this->_emailList = $this->_getActiveShelterUsers();
                break;

        }
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

    
    /**
     * send email
     */
    protected function _send()
    {
        // render email template
        $data = $this->_emailData;
        $body = view($this->_emailTemplate, compact('data'))->render();
        
        // send email to single address
        if ( $this->_email != "" )
        {
            Mail::raw($body, function ($message) {
                $message->to($this->_email)->subject($this->_emailSubject);
            });
        }

        // send email to multiple addresses
        if ( count($this->_emailList) > 0 )
        {
            Mail::raw($body, function ($message) {
                $message->bcc($this->_emailList)->subject($this->_emailSubject);
            });
        }

    }


    /**
     * entry point for class
     */
    static function send($data)
    {
        $mailer = new Mailer($data);
    }

}
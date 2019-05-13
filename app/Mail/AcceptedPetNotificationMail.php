<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptedPetNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $shelterAgent;
    public $shelterAgentPhone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $shelterAgent, $shelterAgentPhone)
    {
        $this->data = $data;
        $this->shelterAgent = $shelterAgent;
        $this->shelterAgentPhone = $shelterAgentPhone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.accepted_pet_notification')->subject($this->data['subject']);
    }
}

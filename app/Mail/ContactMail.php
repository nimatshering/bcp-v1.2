<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contactus;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactus)
    {
        $this->contactus = $contactus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->subject($this->contactus['subject'])
                    ->from($this->contactus['email'], $this->contactus['name'])
                    ->replyTo($this->contactus['email'], $this->contactus['name'])
                    ->markdown('emails.contactSendMail')
                    ->with('contactus', $this->contactus);
    }
}

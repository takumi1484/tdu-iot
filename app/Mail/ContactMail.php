<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $contact;

    public function __construct($contact)
    {
        //
        $_POST= $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$addre->$this->email;
        return $this->subject("SmartControllerのサポート依頼<".$_POST["email"].">")
                    ->view('mail'); 
    }
}

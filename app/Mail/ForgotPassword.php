<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    //Define attributes
    public $username;
    public $token;

    public function __construct($username,$token)
    {
        $this->username = $username;
        $this->token = $token;
    }


    //Call view and past attributes
    public function content(): Content
    {   
        return new Content(
            view: 'mail.forgot-password',
            with: [
                'username' => $this->username,
                'token' => $this->token
            ],
        );
    }


}

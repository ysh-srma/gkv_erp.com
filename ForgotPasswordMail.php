<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailable\Envelope;
use Illuminate\Mail\Mailable\Content;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
   
     */
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
   
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ForgotPassword',
        );
    }


    public function content(): Content
    {
        return new Content(
            markdown: 'emails.forgot',
            with: [
                'user' => $this->user,
            ],
        );
       } 
       
        // return new Content(
          
        //         markdown:'emails.forgot', with: [
        //             'user' => $this->user,
        //         ]);
   

    



    public function attachments(): array
    {
        return [];
    }
    

}









   

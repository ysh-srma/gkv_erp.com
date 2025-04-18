<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.forgot',[
            'user' => $this->user,
            ]);
    }
}


// return $this->from('admin@gkv.erp.com')
// ->markdown('emails.forgot', [
//     'user' => $this->user,
// ]);
// }

// return new Content(
//             markdown: 'emails.forgot',
//             with: [
//                 'user' => $this->user,
//             ],
//         );
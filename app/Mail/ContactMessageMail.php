<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $messageContent;

    public function __construct($email, $messageContent)
    {
        $this->email = $email;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('New Contact Message')
                    ->view('dashboard.layouts.email.contact-message-email');
    }
}

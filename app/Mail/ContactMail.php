<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($name, $email, $message)
    {
        $this->data = [
            'name' => $name,
            'email' => $email,
            'message' => $message
        ];
    }

    public function build()
    {
        return $this->subject('Nuevo mensaje de contacto')
                    ->view('emails.contact');
    }
}
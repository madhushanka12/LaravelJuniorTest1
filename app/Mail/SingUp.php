<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SingUp extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];

    public function __construct()
    {
        $this->data =$data; 
    }

   
    public function envelope(): Envelope
    {
        return new Envelope(
        );
    }


    
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    
    public function attachments(): array
    {
        return [];
    }
}

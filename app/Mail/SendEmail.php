<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected  $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    
    /**
     * Get the message content definition.
     */
       public function build()
       {
           return $this->from('hoalongcutelvh@gmail.com','Chot_sport Giày bóng đá chính hãng')
               ->view('User.checkout.email')
               ->subject($this->data['subject'])->with('data',$this->data);
       }
}

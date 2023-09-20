<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reminderemail extends Mailable
{
    use Queueable, SerializesModels;
    public $permit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($permit)
    {

    $this->permit= $permit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reminder');
    }
}

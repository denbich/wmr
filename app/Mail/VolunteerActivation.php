<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VolunteerActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $datam;

    public function __construct($datam)
    {
        $this->datam = $datam;
    }

    public function build()
    {
        return $this->subject('Twoje konto zostało aktywowane!')->view('mail.volunteeractivation')->with('data', $this->datam);
    }
}

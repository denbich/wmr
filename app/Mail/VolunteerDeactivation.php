<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VolunteerDeactivation extends Mailable
{
    use Queueable, SerializesModels;

    public $datam;

    public function __construct($datam)
    {
        $this->datam = $datam;
    }

    public function build()
    {
        return $this->subject('Twoje konto nie zostało aktywowane!')->view('mail.volunteerdeactivation')->with('data', $this->datam);
    }
}

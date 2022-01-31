<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPoints extends Mailable
{
    use Queueable, SerializesModels;

    public $datam;

    public function __construct($datam)
    {
        $this->datam = $datam;
    }

    public function build()
    {
        return $this->subject('Potwierdzenie skasowania niewykorzystanych punków 2021 rok - WMR')->view('mail.resetpoints')->with('data', $this->datam); //->from(env('MAIL_USERNAME'))
    }
}

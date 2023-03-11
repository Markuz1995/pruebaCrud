<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $usersByCountry;

    public function __construct($usersByCountry)
    {
        $this->usersByCountry = $usersByCountry;
    }

    public function build()
    {
        return $this->view('emails.admin')
            ->with(['usersByCountry' => $this->usersByCountry]);
    }
}

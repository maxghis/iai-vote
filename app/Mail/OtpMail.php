<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, String $otp)
    {
        $this->otp = $otp;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $otp = $this->otp;
        return $this->markdown('emails.OtpUserRequest', compact('user', 'otp'))
        ->from(env('MAIL_FROM_ADDRESS'))
        ->subject( "CODE TENTATIVE D'AUTHENTIFICATION IAI-VOTE" );
    }
}

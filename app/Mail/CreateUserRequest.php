<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateUserRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $mdp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, String $mdp)
    {
        $this->mdp = $mdp;
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
        $mdp = $this->mdp;
        return $this->markdown('emails.CreateUserRequest', compact('user', 'mdp'))
        ->from(env('MAIL_FROM_ADDRESS'))
        ->subject( "INFORMATIONS D'AUTHENTIFICATION IAI-VOTE" );
    }
}

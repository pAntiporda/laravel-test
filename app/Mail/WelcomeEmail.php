<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user)
    {
        //
    }

    public function build()
    {
        $subject = 'Welcome to Laravel Blog Test!';

        return $this
            ->view('emails.welcome-email')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($subject)
            ->with(['username' => $this->user->username]);
    }
}

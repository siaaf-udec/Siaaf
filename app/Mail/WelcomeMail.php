<?php

namespace App\Mail;

use App\Container\Users\Src\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    public $message;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param $subject
     * @param $message
     */
    public function __construct($subject, $message)
    {

        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => 'no-reply@ucundinamarca.edu.co', 'name' => env('APP_NAME') ])
                    ->with([
                        'subject'       => $this->subject,
                        'message'       => $this->message,
                    ])
                    ->view('vendor.mail.welcome.welcome');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailHumTalent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;
    /**
     * @var
     */

    public $message;
    public $subject;
    public $file;

    /**
     * Create a new message instance.
     *
     * @param $subject
     * @param $message
     * @param $file
     *
     * @return void
     */
    public function __construct($subject, $message, $file)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->file != null) {
            return $this->from(['address' => 'no-reply@ucundinamarca.edu.co', 'name' => env('APP_NAME')])
                ->attach($this->file)
                ->with(['subject', $this->subject,
                    'message', $this->message,
                ])
                ->view('humtalent.empleado.emailEmpleados');
        }
        else
        {
            return $this->from(['address' => 'no-reply@ucundinamarca.edu.co', 'name' => env('APP_NAME')])
                ->with(['subject', $this->subject,
                    'message', $this->message,
                ])
                ->view('humtalent.empleado.emailEmpleados');
        }

    }


}

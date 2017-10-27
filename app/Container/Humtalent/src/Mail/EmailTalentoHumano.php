<?php

namespace App\Container\Humtalent\src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Exception;

class EmailTalentoHumano extends Mailable implements ShouldQueue
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
    public $asunto;
    public $file;

    /**
     * Create a new message instance.
     *
     * @param $asunto
     * @param $message
     * @param $file
     *
     */
    public function __construct($asunto, $message, $file)
    {
        $this->asunto = $asunto;
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
        if ($this->file !== null) {
            return $this->from(['address' => 'no-reply@ucundinamarca.edu.co', 'name' => env('APP_NAME')])
                ->attach($this->file)
                ->view('humtalent.empleado.emailEmpleados', ['title' => $this->asunto, 'body' => $this->message]);
        } else {
            return $this->from(['address' => 'no-reply@ucundinamarca.edu.co', 'name' => env('APP_NAME')])
                ->view('humtalent.empleado.emailEmpleados', ['title' => $this->asunto, 'body' => $this->message]);
        }

    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        // Send user notification of failure, etc...
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addSeconds(5);
    }


}

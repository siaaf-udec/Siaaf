<?php

namespace App\Mail\Acadspace;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAcadspace extends Mailable
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
     *
     * @return void
     */
    public function __construct($asunto, $message)
    {
        $this->asunto = $asunto;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

            return $this->from(['address' => 'no-reply@ucundinamarca.edu.co', 'name' => env('APP_NAME')])
                ->view('acadspace.formatosacademicos.emailFormatos',['title'=>$this->asunto, 'body' => $this->message]);


    }


}

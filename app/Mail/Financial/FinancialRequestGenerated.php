<?php

namespace App\Mail\Financial;

use App\Container\Financial\src\Extension;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FinancialRequestGenerated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    private $subject;
    /**
     * @var Extension
     */
    private $extension;

    /**
     * Create a new message instance.
     *
     * @param $subject
     * @param Extension $extension
     */
    public function __construct($subject, Extension $extension)
    {
        $this->subject = $subject;
        $this->extension = $extension;
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
                'body'          => $this->extension,
            ])
            ->view('vendor.mail.welcome.welcome');
    }
}
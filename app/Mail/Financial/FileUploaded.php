<?php

namespace App\Mail\Financial;

use App\Container\Financial\src\File;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FileUploaded extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * @var File
     */
    private $file;

    /**
     * Create a new message instance.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('financial.templates.email.email')
                    ->subject( __('financial.email.file.title') )
                    ->with([
                        'title'     =>      __('financial.email.file.title'),
                        'body'      =>      __('financial.email.file.message', ['filename' => $this->file->{ file_name() } ]),
                        'button'    =>      __('financial.email.file.button'),
                        'url'       =>      route('financial.files.show', ['id' => $this->file->{ primaryKey() }])
                    ]);
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

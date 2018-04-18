<?php

namespace App\Observers;


use App\Container\Financial\src\File;
use App\Mail\Financial\FileUploaded;
use Illuminate\Support\Facades\Mail;

class FileObserver
{
    /**
     * Send mail to student with new file request
     *
     * @param File $file
     * @return bool
     */
    public function created(File $file)
    {
        return $this->sendMail( $file );
    }

    /**
     * Send mail to student when file is updated
     *
     * @param File $file
     * @return bool
     */
    public function updated(File $file)
    {
        return $this->sendMail( $file );
    }

    /**
     * Send the email
     *
     * @param $file
     * @return bool
     */
    public function sendMail($file )
    {
        return authUserHasEmail() ? Mail::to( auth()->user()->email )->send( new FileUploaded( $file ) ) : false;
    }
}
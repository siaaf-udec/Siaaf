<?php

namespace App\Observers;


use App\Container\Financial\src\File;
use App\Mail\Financial\FileUploaded;
use Illuminate\Support\Facades\Mail;

class FileObserver
{
    public function created(File $file)
    {
        return $this->sendMail( $file );
    }

    public function updated(File $file)
    {
        return $this->sendMail( $file );
    }

    public function sendMail( $file )
    {
        return authUserHasEmail() ? Mail::to( auth()->user()->email )->send( new FileUploaded( $file ) ) : false;
    }
}
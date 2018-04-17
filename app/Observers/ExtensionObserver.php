<?php

namespace App\Observers;


use App\Container\Financial\src\Extension;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class ExtensionObserver
{
    public function deleting(Extension $extension)
    {
        return ( $extension->comments() !== null ) ? $extension->comments()->forceDelete() : false;
    }

    public function created(Extension $extension)
    {
        return Mail::to( auth()->user()->email )->send( new WelcomeMail('Se ha creado una solicitud de Supletorio', $extension->subject->{ subject_name() }) );
    }
}
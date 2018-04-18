<?php

namespace App\Observers;


use App\Container\Financial\src\Extension;
use App\Mail\Financial\FinancialExtensionGenerated;
use Illuminate\Support\Facades\Mail;

class ExtensionObserver
{
    public function deleting(Extension $extension)
    {
        return ( $extension->comments() !== null ) ? $extension->comments()->forceDelete() : false;
    }

    public function created(Extension $extension)
    {
        return $this->sendMail( $extension );
    }

    public function sendMail( $extension )
    {
        return authUserHasEmail() ? Mail::to( auth()->user()->email )->send( new FinancialExtensionGenerated( $extension ) ) : false;
    }
}
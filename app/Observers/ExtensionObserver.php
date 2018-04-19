<?php

namespace App\Observers;


use App\Container\Financial\src\Extension;
use App\Mail\Financial\FinancialExtensionGenerated;
use Illuminate\Support\Facades\Mail;

class ExtensionObserver
{
    /**
     * Force delete the comments of an existing extension deleted
     *
     * @param Extension $extension
     * @return bool|mixed
     */
    public function deleting(Extension $extension)
    {
        return ( $extension->comments() !== null ) ? $extension->comments()->forceDelete() : false;
    }

    /**
     * Send mail to student with new extension request
     *
     * @param Extension $extension
     * @return bool
     */
    public function created(Extension $extension)
    {
        return $this->sendMail( $extension );
    }

    /**
     * Send the email
     *
     * @param $extension
     * @return bool
     */
    public function sendMail($extension )
    {
        return authUserHasEmail() ? Mail::to( auth()->user()->email )->send( new FinancialExtensionGenerated( $extension ) ) : false;
    }
}
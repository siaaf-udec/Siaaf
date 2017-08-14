<?php

namespace App\Listeners;

use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Log\Writer as Log;

class LogRegisteredUser implements ShouldQueue
{

    use InteractsWithQueue;

    private $log;

    /**
     * Create the event listener.
     *
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    /**
     * Handle the event.
     *
     * @param  Registered $event
     * @return void
     * @internal param Mailer $mailer
     * @internal param Log $log
     */
    public function handle(Registered $event)
    {
        $this->log->info("Tuiteando sobre usuario:  {$event->user->name} ");
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        $this->log->error("Error :  {$exception} ");
    }
}

<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SubscriptionCancelled;
use App\Jobs\ProcessBillingActionJob;

class ProcessRefundListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        ProcessBillingActionJob::dispatch($event->subscription, 'refund');
    }
}

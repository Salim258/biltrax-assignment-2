<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SubscriptionCancelledEvent;
use App\Jobs\SendNotificationEmailJob;

class SendCancellationNotificationListener
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
        SendNotificationEmailJob::dispatch($event->subscription, 'cancellation');
    }
}

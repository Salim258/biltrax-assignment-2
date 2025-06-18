<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;

class LogSubscriptionActivityListener
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
        $subscription = $event->subscription;

        ActivityLog::create([
            'subscription_id' => $subscription->id,
            'description' => 'Subscription status changed to: ' . $subscription->status,
            'created_at' => now(),
        ]);
    }
}

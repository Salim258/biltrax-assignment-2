<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateBillingRecordsListener
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

        $subscription->billingRecords()->create([
            'amount' => 0,
            'description' => 'Billing record updated due to status: ' . $subscription->status,
            'date' => now(),
        ]);
    }
}

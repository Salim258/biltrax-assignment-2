<?php

namespace App\Services;

use App\Events\SubscriptionCancelledEvent;
use App\Events\SubscriptionReactivatedEvent;
use App\Events\SubscriptionStatusChangedEvent;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SubscriptionService.
 */
class SubscriptionService
{
    public function cancelSubscription(Subscription $subscription)
    {
        DB::beginTransaction();

        try {
            $oldStatus = $subscription->status;
            $subscription->status = 'cancelled';
            $subscription->save();

            // event(new SubscriptionCancelledEvent($subscription));
            // event(new SubscriptionStatusChangedEvent($subscription, $oldStatus, 'cancelled'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Subscription cancellation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function reactivateSubscription(Subscription $subscription)
    {
        DB::beginTransaction();

        try {
            $oldStatus = $subscription->status;
            $subscription->status = 'active';
            $subscription->save();

            event(new SubscriptionReactivatedEvent($subscription));
            event(new SubscriptionStatusChangedEvent($subscription, $oldStatus, 'active'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Subscription reactivation failed: ' . $e->getMessage());
            throw $e;
        }
    }
}

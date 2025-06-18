<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function cancel(Request $request, Subscription $subscription)
    {
        try {
            $subscriptionService = new SubscriptionService();
            $subscriptionService->cancelSubscription($subscription);

            return response()->json([
                'status' => 'success',
                'message' => 'Subscription cancelled and processing started.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Subscription cancellation failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function reactivate(Request $request, Subscription $subscription)
    {
        try {
            $subscriptionService = new SubscriptionService();
            $subscriptionService->reactivateSubscription($subscription);

            return response()->json([
                'status' => 'success',
                'message' => 'Subscription reactivated and processing started.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Subscription reactivation failed.',
                'error' => $e->getMessage()
            ], 500);
        }
}

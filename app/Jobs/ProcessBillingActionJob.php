<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionMail;
use Exception;

class ProcessBillingActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $subscription;
    protected $action;

    /**
     * Create a new job instance.
     */
    public function __construct(Subscription $subscription, $action)
    {
        $this->subscription = $subscription;
        $this->action = $action;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if ($this->action === 'refund') {
                $this->subscription->refund();

                Mail::to($this->subscription->user->email)
                    ->send(new SubscriptionMail($this->subscription, 'Your refund has been processed successfully.'));
            } elseif ($this->action === 'charged') {
                $this->subscription->charged();

                Mail::to($this->subscription->user->email)
                    ->send(new SubscriptionMail($this->subscription, 'Your payment has been processed successfully.'));
            } else {
                Log::error('Invalid billing action: ' . $this->action);
            }
        } catch (Exception $e) {
            Log::error('Billing processing failed: ' . $e->getMessage());
            throw $e; // This will allow Laravel to retry as per the $tries
        }
    }
}

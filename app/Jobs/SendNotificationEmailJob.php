<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription;
use App\Mail\SubscriptionMail;
use Exception;

class SendNotificationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $subscription;
    protected $type;

    /**
     * Create a new job instance.
     */
    public function __construct(Subscription $subscription, $type)
    {
        $this->subscription = $subscription;
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            Mail::to($this->subscription->user->email)->send(new SubscriptionMail($this->subscription, $this->type));
            return response()->json(['message' => 'Notification sent successfully.']);
        } catch (Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            throw $e;
        }
    }
}

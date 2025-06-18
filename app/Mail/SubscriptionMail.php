<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($subscription, $message)
    {
        $this->subscription = $subscription;
        $this->message = $message;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Subscription Billing Update')
            ->view('emails.subscription')
            ->with([
                'subscription' => $this->subscription,
                'messageContent' => $this->message,
            ]);
    }
}

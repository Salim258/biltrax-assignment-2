<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionNotification extends Notification
{
    use Queueable;

    protected $subscription;
    protected $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($subscription, $message)
    {
        $this->subscription = $subscription;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Subscription Update')
            ->line($this->message)
            ->action('View Subscription', url('/subscriptions/' . $this->subscription->id))
            ->line('Thank you for using our service!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'subscription_id' => $this->subscription->id,
            'message' => $this->message,
            'status' => $this->subscription->status,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

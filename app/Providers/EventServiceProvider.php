<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        \App\Events\SubscriptionCancelledEvent::class => [
            \App\Listeners\SendCancellationNotificationListener::class,
            \App\Listeners\ProcessRefundListener::class,
            \App\Listeners\UpdateBillingRecordsListener::class,
            \App\Listeners\LogSubscriptionActivityListener::class,
        ],

        \App\Events\SubscriptionReactivatedEvent::class => [
            \App\Listeners\SendReactivationNotificationListener::class,
            \App\Listeners\UpdateBillingRecordsListener::class,
            \App\Listeners\LogSubscriptionActivityListener::class,
        ],

        \App\Events\SubscriptionStatusChangedEvent::class => [
            \App\Listeners\LogSubscriptionActivityListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

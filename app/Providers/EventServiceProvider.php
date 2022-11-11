<?php

namespace App\Providers;

use App\Events\NewPostCreated;
use App\Events\SubscribedToOtherMarketing;
use App\Listeners\LogNewPostCreated;
use App\Listeners\UpdateCampaignMonitorList;
use App\Listeners\UpdateSalesforceList;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // Not necessary if the class of the object inside the Listeners are type hinted in their handle() methods
        // and if property shouldDiscoverEvents() method is returning true.
        SubscribedToOtherMarketing::class => [
            UpdateCampaignMonitorList::class,
            UpdateSalesforceList::class,
        ],
        NewPostCreated::class => [
            LogNewPostCreated::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

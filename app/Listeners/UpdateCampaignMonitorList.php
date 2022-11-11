<?php

namespace App\Listeners;

use App\Events\SubscribedToOtherMarketing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCampaignMonitorList
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SubscribedToOtherMarketing  $event
     * @return void
     */
    public function handle(SubscribedToOtherMarketing $event)
    {
        // Test only
        info('Sent user details to Campaign Monitor: ' . $event->email);
    }
}

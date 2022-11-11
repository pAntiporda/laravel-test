<?php

namespace App\Listeners;

use App\Events\SubscribedToOtherMarketing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateSalesforceList
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
        //
        info('Sent user details to Salesforce: ' . $event->email);
    }
}

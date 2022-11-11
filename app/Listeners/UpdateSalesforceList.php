<?php

namespace App\Listeners;

use App\Events\SubscribedToOtherMarketing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// If for instance this listener takes time, it should be implementing ShouldQueue interface to put the task in the Queue
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

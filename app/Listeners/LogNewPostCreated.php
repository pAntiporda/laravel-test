<?php

namespace App\Listeners;

use App\Events\NewPostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// If for instance this listener takes time, it should be implementing ShouldQueue interface to put the task in the Queue
class LogNewPostCreated
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
     * @param  \App\Events\NewPostCreated  $event
     * @return void
     */
    public function handle(NewPostCreated $event)
    {
        info('New Post has been added : ' . $event->post->title);
    }
}

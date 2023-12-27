<?php

namespace App\Listeners;

use App\Events\ChatEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChatListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function handle(ChatEvent $event)
    {
    broadcast(new \App\Events\ChatMessage($event->message));
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ChatEvent  $event
     * @return void
     */
 
}

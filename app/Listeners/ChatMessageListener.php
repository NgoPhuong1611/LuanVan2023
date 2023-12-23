<?php

namespace App\Listeners;

use App\Events\ChatMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChatMessageListener
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
     * @param  \App\Events\ChatMessage  $event
     * @return void
     */
    public function handle(ChatMessage $event)
    {
        //
    }
}

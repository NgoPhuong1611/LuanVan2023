<?php
namespace App\Events;

use App\Models\Forum;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $username;

    public function __construct(Forum $message)
    {
        $this->message = $message;
        $this->username = $username;
    }

    public function broadcastOn()
    {
        return new Channel('chat');
    }
}

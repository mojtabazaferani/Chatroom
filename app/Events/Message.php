<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Message implements ShouldBroadcastNow
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

     public $to;

     public $from;

     public $message;

    public function __construct($to, $from, $message)
    {
        
        $this->to = $to;

        $this->from = $from;

        $this->message = $message;

        Chat::create([
            'to' => $this->to,
            'from' => $this->from,
            'message' => $this->message
        ]);

        Log::debug('yes yes yes');

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('message'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message';
    }
}

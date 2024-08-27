<?php

namespace App\Events;

use App\Models\Cha;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ErsalPayam implements ShouldBroadcastNow
{
    
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id_from;

    public $name_from;

    public $id_to;

    public $name_to;

    public $message;

    public function __construct($id_from, $name_from, $id_to, $name_to, $message)
    {

        $this->id_from = $id_from;

        $this->name_from = $name_from;

        $this->id_to = $id_to;

        $this->name_to = $name_to;

        $this->message = $message;

        Cha::create([
            'id_from' => $id_from,
            'name_from' => $name_from,
            'id_to' => $id_to,
            'name_to' => $name_to,
            'chatroom' => 1,
            'message' => $message
        ]);

    }

    public function broadcastOn(): array
    {
        $channelName = 'daryaft-payam.' . min($this->id_from, $this->id_to) . '.' . max($this->id_from, $this->id_to);

        return [
            new PrivateChannel($channelName),
        ];
        
    }

    public function broadcastAs(): string
    {
        return 'daryaft.payam';
    }

}

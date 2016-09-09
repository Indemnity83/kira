<?php

namespace App\Events;

use App\Track;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class TrackCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Track
     */
    public $track;

    /**
     * Create a new event instance.
     *
     * @param Track $track
     */
    public function __construct(Track $track)
    {
        //
        $this->track = $track;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('album.' . $this->track->album_id);
    }
}
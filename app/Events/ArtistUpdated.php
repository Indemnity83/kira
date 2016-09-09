<?php

namespace App\Events;

use App\Artist;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ArtistUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Artist
     */
    public $artist;

    /**
     * Create a new event instance.
     *
     * @param Artist $artist
     */
    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('artists');
    }
}

<?php

namespace App\Events;

use App\Artist;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArtistCreated implements ShouldBroadcast
{
    use SerializesModels;

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

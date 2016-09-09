<?php

namespace App\Events;

use App\Album;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class AlbumUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Album
     */
    public $album;

    /**
     * Create a new event instance.
     *
     * @param Album $album
     */
    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('artists.' . $this->album->artist_id);
    }
}

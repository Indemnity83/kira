<?php

namespace App\Jobs;

use App\Artist;
use App\Events\AlbumCreated;
use App\Events\AlbumUpdated;
use App\Events\ArtistCreated;
use App\Events\ArtistUpdated;
use App\Events\TrackCreated;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SpotifyWebAPI\SpotifyWebAPI;

class RetrieveArtist implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Artist
     */
    private $artist_id;

    /**
     * @var location on disk
     */
    private $location;

    /**
     * Create a new job instance.
     *
     * @param $artist_id
     * @param null $location
     */
    public function __construct($artist_id, $location = null)
    {
        $this->artist_id = $artist_id;
        $this->location = $location;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // TODO: move the spotify API stuff into a service provider for global uses
        $spotify = new SpotifyWebAPI();
        $spotify->setReturnAssoc(true);

        $result = $spotify->getArtist($this->artist_id);

        // Create the Artist
        $artist = Artist::create([
            'spotify_id' => $result['id'],
            'name' => $result['name'],
            'location' => $this->location ?: $result['name'],
            'updating' => true,
        ]);
        event(new ArtistCreated($artist));
        $artist->initializeStorage();

        // Get Artist Albums
        $artist_albums = $spotify->getArtistAlbums($this->artist_id, config('spotify.album_options'));
        $album_ids = array_column($artist_albums['items'], 'id');
        $albums = $spotify->getAlbums($album_ids);

        // Create Albums
        foreach ($albums['albums'] as $album) {
            $result = $spotify->getAlbum($album['id']);

            $my_album = $artist->albums()->create([
                'spotify_id' => $result['id'],
                'name' => $result['name'],
                'release_date' => $this->parseDate($result['release_date'], $result['release_date_precision']),
            ]);
            $img = Image::make($album['images'][0]['url']);
            Storage::disk('local')->put($my_album->artwork, $img->stream());
            event(new AlbumCreated($my_album));

            // Create Tracks
            foreach ($result['tracks']['items'] as $track) {
                $my_track = $my_album->tracks()->create([
                    'spotify_id' => $track['id'],
                    'disc_number' => $track['disc_number'],
                    'track_number' => $track['track_number'],
                    'duration_ms' => $track['duration_ms'],
                    'name' => $track['name'],
                ]);
                event(new TrackCreated($my_track));
            }

            event(new AlbumUpdated($my_album));
        }

        $artist->update([
            'updating' => false
        ]);
        event(new ArtistUpdated($artist));
    }

    private function parseDate($release_date, $precision)
    {
        switch($precision) {
            case 'year':
                return Carbon::create($release_date);
                break;
            case 'month':
            case 'day':
                return Carbon::parse($release_date);
                break;
        }
    }
}

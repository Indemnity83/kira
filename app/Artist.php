<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Artist extends Model
{
    public $fillable = [
        'spotify_id',
        'name',
        'location',
        'updating',
    ];

    public $casts = [
        'updating' => 'boolean',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ordered', function(Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }

    /**
     * Process data from Spotify into Aritst model.
     *
     * This process should be queued.
     *
     * @return bool|int
     */
    public function retrieve()
    {

    }

    /**
     * Search out and load new albums for the artist
     */
    public function prospect()
    {
        $spotify = new SpotifyWebAPI();
        $spotify->setReturnAssoc(true);

        $results = $spotify->getArtistAlbums(
            $this->spotify_id,
            ['album_type' => 'album', 'market' => 'US']
        );

        foreach($results['items'] as $album) {
            $this->albums()->create([
                'spotify_id' => $album['id'],
            ]);
        }
    }

    public function initializeStorage()
    {
        return Storage::disk('media')->MakeDirectory($this->location);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function tracks()
    {
        return $this->hasManyThrough(Track::class, Album::class);
    }

    public function tracksCount()
    {
        return $this->tracks()
            ->selectRaw('artist_id, count(*) as aggregate')
            ->groupBy('artist_id');
    }

    public function getTrackCountAttribute()
    {
        if( !$this->relationLoaded('tracksCount')) {
            $this->load('tracksCount');
        }

        $related = $this->getRelation('tracksCount');

        return ($related->first()) ? (int) $related->first()->aggregate : 0;
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Album extends Model
{

    public $fillable = [
        'spotify_id',
        'name',
        'release_date',
        'artwork',
    ];

    public $dates = [
        'release_date',
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
            $builder->orderBy('release_date', 'desc');
        });
    }



    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    public function getArtworkAttribute()
    {
        return $this->spotify_id;
    }

}

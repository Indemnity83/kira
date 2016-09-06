<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{

    public $fillable = [
        'spotify_id',
        'disc_number',
        'track_number',
        'name',
        'location',
        'duration_ms',
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
            $builder->orderBy('disc_number, track_number', 'asc');
        });
    }

    public function release()
    {
        return $this->belongsTo(Album::class);
    }

    public function getDurationAttribute()
    {
        $minutes = ($this->duration_ms / 60000) % 60;
        $seconds = ($this->duration_ms / 1000) % 60;
        return sprintf("%d:%02d", $minutes, $seconds);
    }

}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SpotifyWebAPI\SpotifyWebAPI;

class SpotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Spotify', function ($app) {
            $spotify = new SpotifyWebAPI();
            $spotify->setReturnAssoc(true);

            return $spotify;
        });
    }
}

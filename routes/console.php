<?php


/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('media:root {path : The root path for media library}', function() {

    $path = $this->argument('path');

    file_put_contents(base_path('.env'), str_replace(
        'MEDIA_ROOT='.env('MEDIA_ROOT'),
        'MEDIA_ROOT='.$path,
        file_get_contents(base_path('.env'))
    ));

    $this->info("Media root [$path] set successfully.");

})->describe('Set the root path for the media library');

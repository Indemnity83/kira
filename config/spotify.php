<?php

return [

    'client_id' => env('SPOTIFY_CLIENT_ID'),
    'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
    'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),

    'album_options' => [
        'album_type' => 'album',
        'market' => 'US'
    ],

];

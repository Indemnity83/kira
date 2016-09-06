<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Jobs\RetrieveArtist;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArtistsController extends Controller
{
    public function show(Artist $artist)
    {
        $artist->load('albums', 'albums.tracks');
        return view('artists.show', compact('artist'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'spotify_id' => 'required|unique:artists',
        ]);

        dispatch(new RetrieveArtist($request->input('spotify_id')));

        return redirect('/home');
    }

}

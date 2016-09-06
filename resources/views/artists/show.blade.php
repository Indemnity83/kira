@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ $artist->name }}</h1>
        </div>

        <dl class="dl-horizontal">
            <dt>Location:</dt>
            <dd>{{ $artist->location }}</dd>
            <dt>Spotify ID:</dt>
            <dd>{{ $artist->spotify_id }} <a href="https://open.spotify.com/artist/{{ $artist->spotify_id }}"><i class="fa fa-external-link" aria-hidden="true"></i></a></dd>
        </dl>

        @foreach($artist->albums as $album)
        <table class="table release">
            <caption>
                <h2>
                    <img src="/storage/artwork/{{ $album->firstMedia('thumbnail')->basename }}" width="70" height="70" />
                    {{ $album->name }} <small>{{ $album->release_date->format('Y') }}</small>
                </h2>
            </caption>
            <tr>
                <th width="5%">#</th>
                <th wdith="35%">Song</th>
                <th width="50%">Filename</th>
                <th width="5%"><i class="fa fa-clock-o" aria-hidden="true"></i></th>
                <th width="5%"><i class="fa fa-search" aria-hidden="true"></i></th>
            </tr>
            @foreach($album->tracks as $track)
            <tr class="warning">
                <th>{{ $track->disc_number . '-' . $track->track_number }}</th>
                <th>{{ $track->name }}</th>
                <th>{{ $track->location }}</th>
                <th>{{ $track->duration }}</th>
                <th><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></th>
            </tr>
            @endforeach
        </table>
        @endforeach

    </div>

@stop
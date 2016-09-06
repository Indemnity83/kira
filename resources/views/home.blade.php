@extends('layouts.app')

@section('content')
<div class="container">

    <div class="page-header">
        <h1>Artist List</h1>
    </div>

    <table class="table release">
        <tr>
            <th>Artist</th>
            <th>Downloads</th>
        </tr>
        @foreach($artists as $artist)
            <tr>
                <td><a href="{{ route('artists.show', $artist->id) }}">{{ $artist->name }}</a></td>
                <td>0 / {{ $artist->trackCount }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection

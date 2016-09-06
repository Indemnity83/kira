@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="page-header">
            <h1>Add Artist</h1>
        </div>

        <div class="col-md-8 col-md-offset-2">
        <a href="/home/add/new" class="btn btn-default btn-lg btn-block" style="white-space:normal">
            <h3><i class="fa fa-plus-square" aria-hidden="true"></i> Add New Artist</h3>
            <p>For artists that you haven't downloaded yet, this option finds a show on Spotify, creates a directory for its albums, and adds it to Kira.</p>
        </a>
        <a href="/home/add/import" class="btn btn-default btn-lg btn-block" style="white-space:normal">
            <h3><i class="fa fa-download" aria-hidden="true"></i> Add Existing Artist</h3>
            <p>Use this option to add artists that already have a folder created on your hard drive. Kira will scan your existing metadata/albums and add the artist accordingly.</p>
        </a>
        <a href="/home/add/create" class="btn btn-default btn-lg btn-block" style="white-space:normal">
            <h3><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manually Add Artist</h3>
            <p>Use this option to add artists that are not on Spotify, and can't be loaded automatically.</p>
        </a>
        </div>
    </div>




@stop
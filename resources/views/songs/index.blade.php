@extends('layouts.app')

@section('content')


    @foreach($songs as $song)

        <strong>Song:</strong> {{ $song->name }}<br>
        <strong>Album:</strong> {{ $song->album->name }}<br>
        <strong>Categories:</strong> @foreach($song->categories as $category) {{ $category->name }},  @endforeach <br>
        <strong>Playlist:</strong> @foreach($song->playlists as $playlist) {{ $playlist->name }},  @endforeach
        <br>
        <br>
        <br>
    @endforeach

@endsection

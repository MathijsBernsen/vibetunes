@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold mb-4">Songs</h1>
                <a href="{{ route('songs.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">
                    Add Song
                </a>
            </div>

            <!-- Songs List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($songs as $song)
                    <div class="p-6 bg-white shadow sm:rounded-lg">
                        <h2 class="text-lg font-semibold text-indigo-600">{{ $song->name }}</h2>
                        <p class="text-gray-700">
                            <strong>Album:</strong> {{ $song->album->name ?? 'No Album' }}
                        </p>
                        <p class="text-gray-700">
                            <strong>Categories:</strong>
                            @forelse($song->categories as $category)
                                {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                            @empty
                                None
                            @endforelse
                        </p>
                        <p class="text-gray-700">
                            <strong>Playlists:</strong>
                            @forelse($song->playlists as $playlist)
                                {{ $playlist->name }}{{ !$loop->last ? ', ' : '' }}
                            @empty
                                None
                            @endforelse
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('songs.edit', $song) }}"
                               class="text-indigo-600 hover:underline">Edit</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

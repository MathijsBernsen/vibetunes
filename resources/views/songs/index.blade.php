@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success:</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error:</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif


            <div class="flex items-center justify-between p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                <h1 class="text-2xl font-bold">Songs</h1>
                <a href="{{ route('songs.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">
                    Add Song
                </a>
            </div>

            <!-- Songs List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($songs as $song)
                    <div class="p-6 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                        <h2 class="text-lg font-semibold text-indigo-600">{{ $song->name }}</h2>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Album:</strong> {{ $song->album->name ?? 'No Album' }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Categories:</strong>
                            @forelse($song->categories as $category)
                                {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                            @empty
                                None
                            @endforelse
                        </p>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Playlists:</strong>
                            @forelse($song->playlists as $playlist)
                                {{ $playlist->name }}{{ !$loop->last ? ', ' : '' }}
                            @empty
                                None
                            @endforelse
                        </p>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Amount comments:</strong>
                            {{ count($song->comments) }}
                        </p>
                        <div class="mt-4">

                            <form action="{{ route('songs.destroy', $song) }}" method="POST" class="flex gap-2">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('songs.edit', $song) }}"
                                   class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">Edit</a>
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

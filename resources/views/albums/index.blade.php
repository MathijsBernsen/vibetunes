@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                <h1 class="text-2xl font-bold">Albums</h1>
                @if(auth()->check() && auth()->user()->hasRole('artist'))
                    <a href="{{ route('albums.create') }}"
                       class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">
                        Add Album
                    </a>
                @endif
            </div>

            <!-- Songs List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($albums as $album)
                    <div class="p-6 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                        <h2 class="text-lg font-semibold text-indigo-600">{{ $album->name }}</h2>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Total duration:</strong> {{ $album->duration . " (minutes)" ?? 'Unknown' }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Release date:</strong> {{ $album->release_date ?? 'Unknown' }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Songs:</strong>
                            @forelse($album->songs as $song)
                                {{ $song->name }}{{ !$loop->last ? ', ' : '' }}
                            @empty
                                None
                            @endforelse
                        </p>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Amount comments:</strong>
                            {{ count($album->comments) }}
                        </p>
                        <div class="mt-4">

                            @if(auth()->check() && auth()->user()->hasRole('artist') && auth()->user()->id === $album->user_id)
                                <form action="{{ route('albums.destroy', $album) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('albums.edit', $album) }}"
                                       class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">Edit</a>
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

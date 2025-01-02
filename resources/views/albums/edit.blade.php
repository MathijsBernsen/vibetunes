@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold mb-4">Edit album</h1>
                <form method="POST" action="{{ route('albums.update', $album) }}">
                    @csrf
                    @method('PUT')

                    <!-- album Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">album Name</label>
                        <input type="text" name="name" id="name" value="{{ $album->name }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <!-- Duration -->
                    <div class="mb-4">
                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                        <input type="number" name="duration" id="duration" value="{{ $album->duration }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <!-- Release Date -->
                    <div class="mb-4">
                        <label for="release_date" class="block text-sm font-medium text-gray-700">Release Date</label>
                        <input type="date" name="release_date" id="release_date" value="{{ $album->release_date }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>


                    <!-- songs -->
                    <div class="mb-4">
                        <label for="songs" class="block text-sm font-medium text-gray-700">Songs</label>
                        <select name="songs[]" id="playlists" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach ($songs as $song)
                                <option value="{{ $song->id }}" {{ in_array($song->id, $album->songs->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $song->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">
                            Update Song
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

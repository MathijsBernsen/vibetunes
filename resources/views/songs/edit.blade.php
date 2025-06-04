@extends('layouts.app')

@section('content')

        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                <h1 class="text-2xl font-bold mb-4">Edit song</h1>
                <form method="POST" action="{{ route('songs.update', $song) }}">
                    @csrf
                    @method('PUT')

                    <!-- Song Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Song Name</label>
                        <input type="text" name="name" id="name" value="{{ $song->name }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                    </div>

                    <!-- Duration -->
                    <div class="mb-4">
                        <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Duration (minutes)</label>
                        <input type="number" name="duration" id="duration" value="{{ $song->duration }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                    </div>

                    <!-- Release Date -->
                    <div class="mb-4">
                        <label for="release_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Release Date</label>
                        <input type="date" name="release_date" id="release_date" value="{{ $song->release_date }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                    </div>

                    <!-- Album -->
                    <div class="mb-4">
                        <label for="album_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Album</label>
                        <select name="album_id" id="album_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                            <option value="">Select an Album</option>
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}" {{ $song->album_id == $album->id ? 'selected' : '' }}>{{ $album->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Categories -->
                    <div class="mb-4">
                        <label for="categories" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categories</label>
                        <select name="categories[]" id="categories" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, $song->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $category->name }}</option>
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

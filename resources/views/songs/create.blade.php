@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                <h1 class="text-2xl font-bold mb-4">Add new song</h1>
                <form method="POST" action="{{ route('songs.store') }}">
                    @csrf

                    <!-- Song Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Song Name</label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                    </div>

                    <!-- Duration -->
                    <div class="mb-4">
                        <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Duration (minutes)</label>
                        <input type="number" name="duration" id="duration" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                    </div>

                    <!-- Release Date -->
                    <div class="mb-4">
                        <label for="release_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Release Date</label>
                        <input type="date" name="release_date" id="release_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                    </div>

                    <!-- Album -->
                    <div class="mb-4">
                        <label for="album_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Album</label>
                        <select name="album_id" id="album_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                            <option value="">Select an Album</option>
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Categories -->
                    <div class="mb-4">
                        <label for="categories" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categories</label>
                        <select name="categories[]" id="categories" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-400 dark:placeholder-gray-400">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add Song
                    </button>

                </form>
            </div>
        </div>
    </div>
@endsection

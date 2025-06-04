@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                <h1 class="text-2xl font-bold">Categories</h1>
                @if(auth()->check() && auth()->user()->hasRole('artist'))
                    <a href="{{ route('categories.create') }}"
                       class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">
                        Add Category
                    </a>
                @endif
            </div>

            <!-- Categories List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <div class="p-6 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                        <h2 class="text-lg font-semibold text-indigo-600">{{ $category->name }}</h2>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Songs:</strong>
                            @forelse($category->songs as $song)
                                {{ $song->name }}{{ !$loop->last ? ', ' : '' }}
                            @empty
                                None
                            @endforelse
                        </p>
                        <div class="mt-4">

                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="flex gap-2">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">Edit</a>
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded">Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

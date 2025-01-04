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


            <div class="flex items-center justify-between p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold">Categories</h1>
                <a href="{{ route('categories.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">
                    Add Category
                </a>
            </div>

            <!-- Categories List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <div class="p-6 bg-white shadow sm:rounded-lg">
                        <h2 class="text-lg font-semibold text-indigo-600">{{ $category->name }}</h2>
                        <p class="text-gray-700">
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

@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Page Header -->
            <div class="flex items-center justify-between p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                <h1 class="text-2xl font-bold">Events</h1>
                @if(auth()->check() && auth()->user()->hasRole('artist'))
                <a href="{{ route('events.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">
                    Add Event
                </a>
                @endif
            </div>

            <!-- Events List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="p-6 bg-white shadow sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
                        <h2 class="text-lg font-semibold text-indigo-600">{{ $event->name }}</h2>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Location:</strong> {{ $event->location }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-200">
                            <strong>Tickets:</strong> <a href="{{ $event->ticket_url }}" target="_blank" class="text-indigo-600 hover:underline">Tickets here</a>                        </p>
                        <div class="mt-4">


                            @if(auth()->check() && auth()->user()->hasRole('artist') && auth()->user()->id === $event->user_id)
                                <form action="{{ route('events.destroy', $event) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('events.edit', $event) }}"
                                       class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">Edit</a>
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded">Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach

        </div>
    </div>

@endsection

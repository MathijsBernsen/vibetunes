@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold mb-4">Add new event</h1>
                <form method="POST" action="{{ route('events.store') }}">
                    @csrf

                    <!-- Event Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <!-- Location -->
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" id="location" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <!-- Ticket URL -->
                    <div class="mb-4">
                        <label for="ticket_url" class="block text-sm font-medium text-gray-700">Ticket URL</label>
                        <input type="text" name="ticket_url" id="ticket_url" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add Song
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
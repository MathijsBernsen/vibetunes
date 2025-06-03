<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('events.index', ['events' => Event::where('user_id', auth()->id())->get()]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'ticket_url' => 'required|url',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }

    public function edit(string $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found');
        }

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, string $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'ticket_url' => 'required|url',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    public function destroy(string $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }

}

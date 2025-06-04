<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('songs.index', ['songs' => Song::with(['categories', 'album', 'comments'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $albums = Album::where('user_id', auth()->id())->get();
        $categories = Category::all();

        return view('songs.create', compact('albums', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'release_date' => 'required|date',
            'album_id' => 'nullable|exists:albums,id',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Set user_id to authenticated user
        $validated['user_id'] = auth()->id();

        // Verify album belongs to user if provided
        if (!empty($validated['album_id'])) {
            $album = Album::find($validated['album_id']);
            if ($album->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'You can only link your own albums');
            }
        }

        $song = Song::create($validated);

        if (!empty($validated['categories'])) {
            $song->categories()->attach($validated['categories']);
        }

        return redirect()->route('songs.index')->with('success', 'Song created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $song = Song::with(['categories', 'album'])->findOrFail($id);

        // Check if song belongs to authenticated user
        if ($song->user_id !== auth()->id()) {
            return redirect()->route('songs.index')->with('error', 'Unauthorized access');
        }

        $albums = Album::where('user_id', auth()->id())->get();
        $categories = Category::all();

        return view('songs.edit', compact('song', 'albums', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $song = Song::findOrFail($id);

        // Check if song belongs to authenticated user
        if ($song->user_id !== auth()->id()) {
            return redirect()->route('songs.index')->with('error', 'Unauthorized access');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'album_id' => 'nullable|exists:albums,id',
            'release_date' => 'required|date',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Verify album belongs to user if provided
        if (!empty($validated['album_id'])) {
            $album = Album::find($validated['album_id']);
            if ($album->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'You can only link your own albums');
            }
        }

        $song->update($validated);
        $song->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('songs.index')->with('success', 'Song updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $song = Song::find($id);

        if ($song === null) {
            return redirect()->route('songs.index')->with('error', 'Song not found');
        }

        // Check if song belongs to authenticated user
        if ($song->user_id !== auth()->id()) {
            return redirect()->route('songs.index')->with('error', 'Unauthorized access');
        }

        $song->categories()->detach();
        $song->playlists()->detach();

        $song->delete();

        return redirect()->route('songs.index')->with('success', 'Song deleted successfully');
    }
}

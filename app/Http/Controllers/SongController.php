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
        return view('songs.index', ['songs' => Song::with(['categories', 'album', 'playlists'])->where('user_id', auth()->id())->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $albums = Album::where('user_id', auth()->id())->get();
        $categories = Category::where('user_id', auth()->id())->get();
        $playlists = Playlist::where('user_id', auth()->id())->get();

        return view('songs.create', compact('albums', 'categories', 'playlists'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'album_id' => 'required|exists:albums,id',
            'release_date' => 'required|date',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'playlists' => 'array',
            'playlists.*' => 'exists:playlists,id',
        ]);

        $song = Song::create($validated);

        if (!empty($validated['categories'])) {
            $song->categories()->attach($validated['categories']);
        }
        if (!empty($validated['playlists'])) {
            $song->playlists()->attach($validated['playlists']);
        }

        return redirect()->route('songs.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $song = Song::with(['categories', 'album', 'playlists'])->findOrFail($id);

        $albums = Album::where('user_id', auth()->id())->get();
        $categories = Category::where('user_id', auth()->id())->get();
        $playlists = Playlist::where('user_id', auth()->id())->get();

        return view('songs.edit', compact('song', 'albums', 'categories', 'playlists'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'album_id' => 'required|exists:albums,id',
            'release_date' => 'required|date',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'playlists' => 'array',
            'playlists.*' => 'exists:playlists,id',
        ]);

        $song = Song::findOrFail($id);
        $song->update($validated);

        $song->categories()->sync($validated['categories'] ?? []);
        $song->playlists()->sync($validated['playlists'] ?? []);

        return redirect()->route('songs.index');
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

        $song->categories()->detach();
        $song->playlists()->detach();

        $song->delete();

        return redirect()->route('songs.index') ->with('success', 'Song deleted successfully');
    }
}

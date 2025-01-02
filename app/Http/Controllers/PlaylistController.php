<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{

    public function index()
    {
        return view('playlists.index', ['playlists' => Playlist::with('songs')->get()]);
    }

    public function create()
    {
        $songs = Song::all();
        return view('playlists.create', compact('songs'));
    }

    public function store()
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'songs' => 'array',
            'songs.*' => 'exists:songs,id',
        ]);

        $playlist = Playlist::create($validated);

        if (!empty($validated['songs'])) {
            $playlist->songs()->attach($validated['songs']);
        }

        return redirect()->route('playlists.index')->with('success', 'Playlist created successfully');
    }

    public function edit($id)
    {
        $playlist = Playlist::with('songs')->findOrFail($id);
        $songs = Song::all();

        return view('playlists.edit', compact('playlist', 'songs'));
    }

    public function update(Request $request, $id)
    {
        $playlist = Playlist::find($id);
        if (!$playlist) {
            return redirect()->route('playlists.index')->with('error', 'Playlist not found');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'songs' => 'array',
            'songs.*' => 'exists:songs,id',
        ]);

        $playlist->update($validated);

        $playlist->songs()->sync($validated['songs']);

        return redirect()->route('playlists.index')->with('success', 'Playlist updated successfully');
    }

    public function destroy($id)
    {

        $playlist = Playlist::find($id);

        if (!$playlist) {
            return redirect()->route('playlists.index')->with('error', 'Playlist not found');
        }

        $playlist->songs()->detach();
        $playlist->delete();

        return redirect()->route('playlists.index')->with('success', 'Playlist deleted successfully');

    }

}

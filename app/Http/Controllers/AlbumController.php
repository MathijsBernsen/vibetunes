<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Song;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('albums.index' , ['albums' => Album::with('songs')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $songs = Song::all();

        return view('albums.create', compact('songs'));
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
            'songs' => 'array',
            'songs.*' => 'exists:songs,id',
        ]);

        $album = Album::create($validated);

        if (!empty($validated['songs'])) {
            Song::whereIn('id', $validated['songs'])->update(['album_id' => $album->id]);
        }

        return redirect()->route('albums.index')->with('success', 'Album created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $album = Album::with('songs')->findOrFail($id);
        $songs = Song::all();


        return view('albums.edit', compact('album', 'songs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'release_date' => 'required|date',
            'songs' => 'array',
            'songs.*' => 'exists:songs,id',
        ]);

        // Find album
        $album = Album::find($id);

        if ($album === null) {
            return redirect()->route('albums.index')->with('error', 'Album not found');
        }

        // Update album
        $album->update($validated);

        // Update songs that ID needs to be null
        Song::where('album_id', $id)->update(['album_id' => null]);

        // Update songs that ID needs to be updated
        if (!empty($validated['songs'])) {
            Song::whereIn('id', $validated['songs'])->update(['album_id' => $album->id]);
        }

        // Redirect to albums index with success message
        return redirect()->route('albums.index')->with('success', 'Album updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = Album::find($id);

        if ($album === null) {
            return redirect()->route('albums.index')->with('error', 'Album not found');
        }


        Song::where('album_id', $id)->update(['album_id' => null]);

        $album->delete();

        return redirect()->route('albums.index') ->with('success', 'Album deleted successfully');
    }
}

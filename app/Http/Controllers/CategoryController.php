<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Song;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return view('categories.index', ['categories' => Category::with('songs')->where('user_id', auth()->id())->get()]);
    }

    public function create()
    {
        $songs = Song::where('user_id', auth()->id())->get();
        return view('categories.create', compact('songs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'songs' => 'array',
            'songs.*' => 'exists:songs,id',
        ]);

        $category = Category::create($validated);

        if (!empty($validated['songs'])) {
            $category->songs()->attach($validated['songs']);
        }

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit(string $id)
    {
        $category = Category::with('songs')->find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        $songs = Song::where('user_id', auth()->id())->get();

        return view('categories.edit', compact('category', 'songs'));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'songs' => 'array',
            'songs.*' => 'exists:songs,id',
        ]);

        $category->update($validated);

        if (!empty($validated['songs'])) {
            $category->songs()->sync($validated['songs']);
        } else {
            $category->songs()->detach();
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        $category->songs()->detach();
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }

}

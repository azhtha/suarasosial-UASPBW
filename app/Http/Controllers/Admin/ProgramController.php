<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProgramController extends Controller
{
    /**
     * Display a listing of programs.
     */
    public function index(Request $request): View
    {
        $query = Program::with('category');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        $programs = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new program.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.programs.create', compact('categories'));
    }

    /**
     * Store a newly created program in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('programs', 'public');
            $validated['image'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title']);

        Program::create($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified program.
     */
    public function edit(Program $program): View
    {
        $categories = Category::all();
        return view('admin.programs.edit', compact('program', 'categories'));
    }

    /**
     * Update the specified program in storage.
     */
    public function update(Request $request, Program $program): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($program->image && \Storage::disk('public')->exists($program->image)) {
                \Storage::disk('public')->delete($program->image);
            }

            $image = $request->file('image');
            $path = $image->store('programs', 'public');
            $validated['image'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title']);

        $program->update($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    /**
     * Remove the specified program from storage.
     */
    public function destroy(Program $program): RedirectResponse
    {
        if ($program->image && \Storage::disk('public')->exists($program->image)) {
            \Storage::disk('public')->delete($program->image);
        }

        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil dihapus.');
    }
}

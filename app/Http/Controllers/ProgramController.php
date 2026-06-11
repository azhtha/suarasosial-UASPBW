<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    /**
     * Display a listing of programs.
     */
    public function index(Request $request): View
    {
        $query = Program::with('category');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        $programs = $query->orderBy('publish_date', 'desc')->paginate(9);
        $categories = Category::all();

        return view('programs.index', compact('programs', 'categories'));
    }

    /**
     * Display the specified program.
     */
    public function show(string $slug): View
    {
        $program = Program::where('slug', $slug)->with('category')->firstOrFail();
        $relatedPrograms = Program::where('category_id', $program->category_id)
            ->where('id', '!=', $program->id)
            ->orderBy('publish_date', 'desc')
            ->take(3)
            ->get();

        return view('programs.show', compact('program', 'relatedPrograms'));
    }
}

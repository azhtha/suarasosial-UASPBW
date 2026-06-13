<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProgramRequest;
use App\Services\ProgramService;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    protected ProgramService $programService;

    public function __construct(ProgramService $programService)
    {
        $this->programService = $programService;
    }

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
    public function store(ProgramRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $image = $request->file('image');

        $this->programService->storeProgram($data, $image);

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
    public function update(ProgramRequest $request, Program $program): RedirectResponse
    {
        $data = $request->validated();
        $image = $request->file('image');

        $this->programService->updateProgram($program, $data, $image);

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

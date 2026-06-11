<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Program;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index(): View
    {
        $totalPrograms = Program::count();
        $totalCategories = Category::count();
        $latestPrograms = Program::with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalPrograms', 'totalCategories', 'latestPrograms'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Program;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     */
    public function index(): View
    {
        $latestPrograms = Program::with('category')
            ->orderBy('publish_date', 'desc')
            ->take(6)
            ->get();

        $categories = Category::all();
        $totalPrograms = Program::count();

        return view('home.index', compact('latestPrograms', 'categories', 'totalPrograms'));
    }
}

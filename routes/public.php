<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramImageController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/media/programs/{filename}', ProgramImageController::class)
    ->where('filename', '[A-Za-z0-9._-]+')
    ->name('program-images.show');
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('programs.show');

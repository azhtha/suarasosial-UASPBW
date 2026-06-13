<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProgramImageController extends Controller
{
    public function __invoke(string $filename): BinaryFileResponse
    {
        $path = 'programs/'.$filename;
        $disk = Storage::disk('public');

        abort_unless($disk->exists($path), 404);

        return response()->file($disk->path($path), [
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}

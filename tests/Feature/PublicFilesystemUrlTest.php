<?php

use App\Models\Program;
use Illuminate\Support\Facades\Storage;

test('program images are served through the application', function () {
    config(['filesystems.program_images' => 'public']);
    Storage::fake('public');
    Storage::disk('public')->put('programs/example.jpeg', 'image-content');

    $program = new Program(['image' => 'programs/example.jpeg']);

    expect($program->image_url)->toBe('/media/programs/example.jpeg');

    $this->get($program->image_url)
        ->assertOk()
        ->assertHeader('cache-control', 'max-age=86400, public');
});

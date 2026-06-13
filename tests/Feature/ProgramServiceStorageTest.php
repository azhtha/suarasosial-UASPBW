<?php

use App\Models\Category;
use App\Services\ProgramService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('program images are uploaded to the configured disk', function () {
    config(['filesystems.program_images' => 's3']);
    Storage::fake('s3');

    $category = Category::create([
        'name' => 'Education',
        'slug' => 'education',
    ]);

    $program = app(ProgramService::class)->storeProgram([
        'category_id' => $category->id,
        'title' => 'Storage Test',
        'description' => 'Test program image upload.',
        'author' => 'Test Author',
        'publish_date' => '2026-06-13',
        'location' => 'Makassar',
    ], UploadedFile::fake()->create('example.jpeg', 10, 'image/jpeg'));

    expect($program->image)->toStartWith('programs/');
    Storage::disk('s3')->assertExists($program->image);
    Storage::disk('public')->assertMissing($program->image);
});

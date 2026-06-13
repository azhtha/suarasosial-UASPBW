<?php

use App\Models\Category;
use App\Models\Program;
use App\Models\User;
use App\Services\ProgramService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use League\Flysystem\UnableToWriteFile;

uses(RefreshDatabase::class);

test('an image storage failure redirects back without changing the program', function () {
    $user = User::factory()->create();
    $category = Category::create([
        'name' => 'Education',
        'slug' => 'education',
    ]);
    $program = Program::create([
        'category_id' => $category->id,
        'title' => 'Original title',
        'slug' => 'original-title',
        'image' => 'programs/original.jpeg',
        'description' => 'Original description',
        'author' => 'Original author',
        'publish_date' => '2026-06-13',
        'location' => 'Makassar',
    ]);

    $service = Mockery::mock(ProgramService::class);
    $service->shouldReceive('updateProgram')
        ->once()
        ->andThrow(UnableToWriteFile::atLocation('programs/new.jpeg'));
    app()->instance(ProgramService::class, $service);

    $response = $this->actingAs($user)
        ->from(route('admin.programs.edit', $program))
        ->put(route('admin.programs.update', $program), [
            'category_id' => $category->id,
            'title' => 'Changed title',
            'description' => 'Changed description',
            'author' => 'Changed author',
            'publish_date' => '2026-06-13',
            'location' => 'Jakarta',
            'image' => UploadedFile::fake()->image('new.jpeg'),
        ]);

    $response->assertRedirect(route('admin.programs.edit', $program));
    $response->assertSessionHas('error');
    $response->assertSessionHasInput('title', 'Changed title');

    expect($program->fresh())
        ->title->toBe('Original title')
        ->image->toBe('programs/original.jpeg');
});

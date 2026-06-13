<?php

use App\Models\Program;
use App\Support\SupabaseStorageUrl;

test('program images use the configured object storage URL', function () {
    config([
        'filesystems.program_images' => 's3',
        'filesystems.disks.s3.url' => 'https://example.supabase.co/storage/v1/object/public/programs',
    ]);

    $program = new Program(['image' => 'programs/example.jpeg']);

    expect($program->image_url)
        ->toBe('https://example.supabase.co/storage/v1/object/public/programs/programs/example.jpeg');
});

test('an incomplete Supabase AWS URL is completed from the bucket configuration', function () {
    config([
        'filesystems.program_images' => 's3',
        'filesystems.disks.s3.url' => SupabaseStorageUrl::normalize(
            'https://example.supabase.co',
            'program-images',
        ),
    ]);

    $program = new Program(['image' => 'programs/example.jpeg']);

    expect($program->image_url)
        ->toBe('https://example.supabase.co/storage/v1/object/public/program-images/programs/example.jpeg');
});

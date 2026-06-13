<?php

use App\Models\Program;

test('program images use the configured object storage URL', function () {
    config([
        'filesystems.program_images' => 's3',
        'filesystems.disks.s3.url' => 'https://example.supabase.co/storage/v1/object/public/programs',
    ]);

    $program = new Program(['image' => 'programs/example.jpeg']);

    expect($program->image_url)
        ->toBe('https://example.supabase.co/storage/v1/object/public/programs/programs/example.jpeg');
});

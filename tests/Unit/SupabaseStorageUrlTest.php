<?php

use App\Support\SupabaseStorageUrl;

test('it completes a Supabase project URL with the public bucket path', function () {
    expect(SupabaseStorageUrl::normalize(
        'https://hjpduecrywgggcpcrwj.supabase.co',
        'suarasosial-project',
    ))->toBe(
        'https://hjpduecrywgggcpcrwj.supabase.co/storage/v1/object/public/suarasosial-project'
    );
});

test('it leaves a complete public bucket URL unchanged', function () {
    $url = 'https://example.supabase.co/storage/v1/object/public/programs';

    expect(SupabaseStorageUrl::normalize($url, 'programs'))->toBe($url);
});

test('it leaves URLs for other S3 providers unchanged', function () {
    expect(SupabaseStorageUrl::normalize(
        'https://cdn.example.com/images',
        'programs',
    ))->toBe('https://cdn.example.com/images');
});

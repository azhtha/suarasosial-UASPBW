<?php

use App\Support\SupabaseStorageEndpoint;

test('it upgrades legacy Supabase S3 endpoints to the direct storage hostname', function () {
    expect(SupabaseStorageEndpoint::normalize(
        'https://hjpduecrywgggcpcrwj.supabase.co/storage/v1/s3'
    ))->toBe(
        'https://hjpduecrywgggcpcrwj.storage.supabase.co/storage/v1/s3'
    );
});

test('it leaves non Supabase and direct storage endpoints unchanged', function (string $endpoint) {
    expect(SupabaseStorageEndpoint::normalize($endpoint))->toBe($endpoint);
})->with([
    'direct Supabase endpoint' => 'https://project-ref.storage.supabase.co/storage/v1/s3',
    'other S3 provider' => 'https://s3.example.com',
]);

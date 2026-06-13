<?php

use Illuminate\Support\Facades\Storage;

test('public storage URLs use the current origin by default', function () {
    expect(Storage::disk('public')->url('programs/example.jpeg'))
        ->toBe('/storage/programs/example.jpeg');
});

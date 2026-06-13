<?php

use App\Models\Program;
use Tests\TestCase;

uses(TestCase::class);

test('program publication dates use Indonesian month names', function () {
    $program = new Program([
        'publish_date' => '2026-05-29',
    ]);

    expect($program->formatted_publish_date)->toBe('29 Mei 2026');
});

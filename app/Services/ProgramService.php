<?php

namespace App\Services;

use App\Models\Program;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramService
{
    public function storeProgram(array $data, ?UploadedFile $image = null): Program
    {
        if ($image) {
            $data['image'] = $image->store('programs', 'public');
        }

        $data['slug'] = Str::slug($data['title']);

        return Program::create($data);
    }

    public function updateProgram(Program $program, array $data, ?UploadedFile $image = null): Program
    {
        if ($image) {
            if ($program->image && Storage::disk('public')->exists($program->image)) {
                Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $image->store('programs', 'public');
        }

        $data['slug'] = Str::slug($data['title']);

        $program->update($data);

        return $program;
    }
}

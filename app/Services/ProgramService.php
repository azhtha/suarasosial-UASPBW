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
            $filename = time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->putFileAs('programs', $image, $filename);
            $data['image'] = $path;
        }

        $data['slug'] = Str::slug($data['title']);

        return Program::create($data);
    }

    public function updateProgram(Program $program, array $data, ?UploadedFile $image = null): Program
    {
        if ($image) {
            if ($program->image && Storage::disk('s3')->exists($program->image)) {
                Storage::disk('s3')->delete($program->image);
            }

            $filename = time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->putFileAs('programs', $image, $filename);
            $data['image'] = $path;
        }

        $data['slug'] = Str::slug($data['title']);

        $program->update($data);

        return $program;
    }
}

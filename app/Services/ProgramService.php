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
            $folder = public_path('programs');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $filename = time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();
            $image->move($folder, $filename);
            $data['image'] = 'programs/'.$filename;
        }

        $data['slug'] = Str::slug($data['title']);

        return Program::create($data);
    }

    public function updateProgram(Program $program, array $data, ?UploadedFile $image = null): Program
    {
        if ($image) {
            // delete old file if exists in public folder
            if ($program->image && file_exists(public_path($program->image))) {
                @unlink(public_path($program->image));
            }

            $folder = public_path('programs');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $filename = time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();
            $image->move($folder, $filename);
            $data['image'] = 'programs/'.$filename;
        }

        $data['slug'] = Str::slug($data['title']);

        $program->update($data);

        return $program;
    }
}

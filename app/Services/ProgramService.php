<?php

namespace App\Services;

use App\Models\Program;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramService
{
    public function storeProgram(array $data, ?UploadedFile $image = null): Program
    {
        if ($image) {
            $filename = time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();
            $path = $this->imageDisk()->putFileAs('programs', $image, $filename);
            $data['image'] = $path;
        }

        $data['slug'] = Str::slug($data['title']);

        return Program::create($data);
    }

    public function updateProgram(Program $program, array $data, ?UploadedFile $image = null): Program
    {
        if ($image) {
            $disk = $this->imageDisk();
            $filename = time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();
            $path = $disk->putFileAs('programs', $image, $filename);

            if ($program->image && $disk->exists($program->image)) {
                $disk->delete($program->image);
            }

            $data['image'] = $path;
        }

        $data['slug'] = Str::slug($data['title']);

        $program->update($data);

        return $program;
    }

    public function deleteProgramImage(Program $program): void
    {
        if ($program->image && $this->imageDisk()->exists($program->image)) {
            $this->imageDisk()->delete($program->image);
        }
    }

    private function imageDisk(): FilesystemAdapter
    {
        return Storage::disk(config('filesystems.program_images'));
    }
}

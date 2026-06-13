<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'image',
        'description',
        'author',
        'publish_date',
        'location',
    ];

    protected $casts = [
        'publish_date' => 'date',
    ];

    /**
     * Get the category that owns the program.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute()
    {
        if (! $this->image) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Storage::disk('public')->exists($this->image)) {
            return route('program-images.show', [
                'filename' => basename($this->image),
            ], false);
        }

        return null;
    }
}

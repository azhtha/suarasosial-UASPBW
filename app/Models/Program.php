<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        if ($this->image) {
            // If path already starts with http(s) return as-is
            if (Str::startsWith($this->image, ['http://', 'https://'])) {
                return $this->image;
            }
            return asset($this->image);
        }

        return asset('images/placeholder.jpg');
    }
}

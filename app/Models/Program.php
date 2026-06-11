<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->image ? asset('storage/' . $this->image) : asset('images/placeholder.jpg');
    }
}

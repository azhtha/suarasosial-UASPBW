<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function storeCategory(array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);

        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        $data['slug'] = \Str::slug($data['name']);

        $category->update($data);

        return $category;
    }
}

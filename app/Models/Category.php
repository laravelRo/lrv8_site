<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'category_page', 'category_id', 'page_id');
    }

    public function public_pages()
    {
        return $this->belongsToMany(Page::class, 'category_page', 'category_id', 'page_id')
            ->where('published_at', '<>', NULL)
            ->orderByDesc('published_at')
            ->paginate(10)
            ->withQueryString();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Page extends Model
{
    use HasFactory, Sortable;

    public $sortable = [
        'created_at',
        'title',
        'views'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_page', 'page_id', 'category_id');
    }
    public function public_categories()
    {
        return $this->belongsToMany(Category::class, 'category_page', 'page_id', 'category_id')
            ->where('publish', 1)
            ->orderBy('title')
            ->get();
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'page_id')->orderBy('position')->paginate(8);
    }
    public function public_photos()
    {
        return $this->hasMany(Photo::class, 'page_id')
            ->where('publish', 1)
            ->orderBy('position')
            ->paginate(16);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function photo_url()
    {
        return asset('images/pages-photo/' .  $this->page_id  . '/' .  $this->file);
    }

    public function file_path()
    {
        return public_path('images/pages-photo/' .  $this->page_id  . '/' .  $this->file);
    }
}

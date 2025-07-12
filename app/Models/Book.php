<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'author_id', 'category_id', 'year', 'pages', 'image_url'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}

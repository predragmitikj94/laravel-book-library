<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = ['title'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

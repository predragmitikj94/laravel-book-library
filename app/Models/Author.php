<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'biography'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

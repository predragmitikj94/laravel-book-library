<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Author extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'biography'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

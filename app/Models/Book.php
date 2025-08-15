<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'quantity',
    ];

    public function borrowRecords()
    {
        return $this->hasMany(BorrowedBook::class);
    }
}
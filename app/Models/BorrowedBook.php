<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'returned_at',
    ];

    // علاقة الكتاب المستعار بالمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة الكتاب المستعار بالكتاب
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

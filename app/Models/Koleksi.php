<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Koleksi extends Model
{
    use HasFactory;

    protected $table = 'collections';

    protected $fillable = [
        'user_id',
        'book_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }
}

<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = [
        'user_id',
        'book_id',
        'ulasan',
        'rating',
    ];
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function buku() {
        return $this->belongsTo(Book::class, 'book_id');
    }
}

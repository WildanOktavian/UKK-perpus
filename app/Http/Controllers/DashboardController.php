<?php

namespace App\Http\Controllers;

use view;
use App\Models\Book;
use App\Models\User;
use App\Models\Browwing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $book = Book::count();
        $category = Category::count();
        $user = User::count();
        $peminjaman = Browwing::with(['user', 'book'])->get();
        return view('dashboard', [
            'book' => $book,
            'category' => $category, 
            'user' => $user,
            'peminjaman' => $peminjaman
        ]);
    }

    public function exportPeminjaman()
    {
        $browings = Browwing::all();

        $CSV = "";
        $CSV .= implode(',', ["user", "book", "rent_date", "return_date"]);
        $CSV .= PHP_EOL;

        
        foreach($browings as $item){
            $CSV .= implode(',', [
                $item->user->username,
                $item->book->title,
                $item->rent_date,
                $item->return_date,
            ]);
            $CSV .= PHP_EOL;
        }

        return response($CSV, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment;filename=peminjaman.csv',
        ]);
                    
    }

}


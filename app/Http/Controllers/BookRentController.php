<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Browwing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BookRentController extends Controller
{
    public function bookRent()
    {
        $users = User::whereNotIn('role', ['admin', 'petugas'])->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('book.book-rent', ['users' => $users, 'books' => $books]);
    }

    public function storeRent(Request $request)
    {
        $request->validate([
            'user_id',
            'book_id',
            'rent_date',
            'return_date',
        ]);
        
        $check = Browwing::where('user_id', '=', Auth::user()->id)->where('book_id', '=', $request->book_id)->where('status', 'belum')->exists();
        if($check) {
            Alert::Error('Error', 'Buku sudah dipinjam!');
            return back();
        }
        $peminjaman = Browwing::create([
            'user_id' => Auth::user()->id,
            'book_id' => $request->book_id,
            'rent_date' => date('Y-m-d H:i:s'),
            'return_date' => null,
            'status' => 'belum',
        ]);
        
        if(!$peminjaman) {
            Alert::Error('Error', 'Gagal meminjam buku!');
            return back();
        }
        Alert::success('Success', 'Berhasil meminjam buku');
        return back();
    }


    public function returnBook()
    {
        $peminjaman = Browwing::with('user', 'book')->where('user_id', Auth::user()->id)->where('status', 'belum')->get();

        return view('book.book-borrow', compact('peminjaman'));
    }

    
    public function pengembalian(Request $request, $id)
    {
        $request->validate([
            'return_date',
            'status',
        ]);

        $buku = Browwing::where('id', $id);
        if(!$buku) {
            Alert::error('Error', 'Buku tidak dapat ditemukan');
            return back();
        }
        $pengembalian = $buku->update([
            'return_date' => date('Y-m-d H:i:s'),
            'status' => 'sudah',
        ]);

        if(!$pengembalian) {
            Alert::error('Error', 'Gagal mengembalikan buku!');
            return back();
        }
        Alert::success('Success', 'Berhasil mengembalikan buku');
        return back();
    }
}

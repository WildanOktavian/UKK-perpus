<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KoleksiController extends Controller
{
    public function koleksi()
    {
        $collection = Koleksi::with('user', 'book')->where('user_id', Auth::user()->id)->get();
        $data = Koleksi::with('user', 'book')->get();
        return view('book.book-collection', compact('collection', 'data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id',
            'book_id',
        ]);

        $check = Koleksi::where('user_id', '=', Auth::user()->id)->where('book_id', '=', $request->book_id)->exists();
        if($check) {
            return back()->with('error', 'Buku sudah ada!');
        }

        $koleksi = Koleksi::create([
            'user_id' => Auth::user()->id,
            'book_id' => $request->book_id
        ]);

        if(!$koleksi) {
            Alert::error('Error', 'Gagal Menambahkan koleksi!');
            return back();
        }
        Alert::success('Success', 'Berhasil ditambahkan ke koleksi');
        return redirect('collections');
    }

    public function edit($slug)
    {
        $user = User::get();
        $buku = Book::get();
        $koleksi = Koleksi::where('slug', $slug);

        if(!$koleksi) {
            Alert::error('Error', 'Koleksi tidak ditemukan!');
            return back();
        }
        return view('book.edit-collection', compact('koleksi', 'user', 'buku'));
    }


}

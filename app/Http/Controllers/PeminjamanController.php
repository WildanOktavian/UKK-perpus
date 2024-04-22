<?php

namespace App\Http\Controllers;

use App\Models\Browwing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class PeminjamanController extends Controller
{
    public function peminjaman()
    {
        $peminjaman = Browwing::all();
        return view('peminjaman.peminjaman', ['peminjaman' => $peminjaman]);
    }

    public function peminjamanUsers()
    {
        $browings = Browwing::with(['user', 'book'])->where('user_id', Auth::user()->id)->get();

        $CSV = "";
        $CSV .= implode(',', ["user", "book", "rent_date", "return_date",]);
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

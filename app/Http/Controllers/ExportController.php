<?php

namespace App\Http\Controllers;

use App\Models\Browwing;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function Export()
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

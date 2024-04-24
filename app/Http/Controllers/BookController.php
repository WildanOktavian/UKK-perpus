<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class BookController extends Controller
{
    public function books()
    {
        $categories = Category::all();
        $books = Book::paginate(5);
        return view('book.book', compact(['books', 'categories']));
    }

    public function addBook()
    {
        $categories = Category::all();
        return view('book.add-book', ['categories' => $categories]);
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
            'penulis' => 'required|max:255',
            'tahun_terbit' => 'required|max:255',
            'sinopsis' => 'required|max:255',
        ]);

        $imgName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imgName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $imgName);
        }
        
        $request['cover'] = $imgName;
        
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        Alert::success('Success', 'Data berhasil di tambahkan!');
        return redirect('books');
    }

    public function editBook($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('book.edit-book', ['categories' => $categories, 'book' => $book]);
    }

    public function updateBook(Request $request, $slug)
    {
        $imgName = '';
        $chooseCategories = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imgName = $request->title . '-' . now()->timestamp . '.' . $extension;
            
            if (!Storage::exists('cover')) {
                Storage::makeDirectory('cover');
            }
            
            $request->file('image')->storeAs('cover', $imgName);
            $request['cover'] = $imgName;
        }
    

        $book = Book::where('slug', $slug)->first();
        $book->update($request->all());

        if($request->categories){
            $book->categories()->sync($request->categories);
        }
        Alert::success('Success', 'Data berhasil di update!');
        return redirect('books');
    }

    public function deleteBook($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('book.delete-book', ['books' => $book]);
    }
    
    public function destroyBook($slug)
    {
        $book = Book::where('slug', $slug)->first();
        if($book){
            $book->delete();
            Alert::success('Success', 'Data berhasil di hapus sementara!');
        }
        return redirect('books');
    }
    
    public function showBook()
    {
        $showBook = Book::onlyTrashed()->get();
        return view('book.show-delete-book', ['showBook' => $showBook]);
    }
    
    public function restoreBook($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        Alert::success('Success', 'Data berhasil di kembalikan!');
        return redirect('books');
    }
    
        public function destroyPermanent($slug) {
            $book = Book::withTrashed()->where('slug', $slug)->first();
            $bookCategory = BookCategory::where('book_id', $book->id)->get();
            foreach ($bookCategory as $bookCategory) {
                $bookCategory->delete();
            }
            if($book){
                $book->forceDelete();
                Alert::success('Success', 'Data berhasil di hapus permanen!');
            }else {
                Alert::error('Error', 'Data gagal di hapus!');
            }
            return redirect()->route('show-delete-book');
        }

        public function exportBook()
        {
            $book = Book::all();
    
            $CSV = "";
            $CSV .= implode(',', ["book_code", "title", "penulis", "tahun_terbit", ]);
            $CSV .= PHP_EOL;
    
            foreach($book as $item){
                $CSV .= implode(',', [
                    $item->book_code,
                    $item->title,
                    $item->penulis,
                    $item->tahun_terbit,
                    $item->category
                ]);
                $CSV .= PHP_EOL;
            }
    
            return response($CSV, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment;filename=buku.csv',
            ]);
                        
        }
}

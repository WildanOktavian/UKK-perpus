<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{
    public function category()
    {
        $category = Category::all();
        return view('category.category', ['category' => $category]);
    }

    public function addCategory()
    {
        return view('category.add-category');
    }

    public function storeCategory(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100'
        ]);

        $category = Category::create($request->all());
        Alert::success('Success', 'Data berhasil di tambahkan!');
        return redirect('categories');
    }

    public function editCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category.edit-category', ['category' => $category]);
    }

    public function updateCategory(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100'
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($request->all());
        Alert::success('Success', 'Data berhasil di update!');
        return redirect('categories');
    }

    public function destroyCategory($slug)
    {
        
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            Alert::danger('Success', 'Kategori tidak ditemukan!');
            return redirect()->back();
        }

        $category->delete();
        Alert::success('Success', 'Data berhasil di hapus!');
        return redirect('categories');
    }

    public function viewCategory()
    {
        $viewCategory = Category::onlyTrashed()->get();
        return view('category.view-category-delete', ['viewCategory' => $viewCategory]);
    }

    public function restoreCategory($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        if (!$category) {
            Alert::danger('Success', 'Gagal mengembalikan kategori!');
            return redirect()->back();
        }
        $category->restore();
        Alert::success('Success', 'Berhasil mengembalikan data!');
        return redirect('categories');
    }

    public function destroyPermanent($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $categoryBook = BookCategory::where('category_id', $category->id)->get();
        foreach ($categoryBook as $dt){
            $dt->delete();
        }
        if($category){
            $category->forceDelete();
            Alert::success('Success', 'Data berhasil di hapus permanen!');
        }else{
            Alert::error('Success', 'Data gagal di hapus!');
        }
        return redirect()->route('view-delete-category');
    }

    public function permanentCategory($slug) {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $bookCategory = BookCategory::where('category_id', $category->id)->get();
        foreach ($bookCategory as $bookCategory) {
            $bookCategory->delete();
        }
        if($category){
            $category->forceDelete();
            Alert::success('Success', 'Data berhasil di hapus permanen!');
        }else {
            Alert::error('Error', 'Data gagal di hapus!');
        }
        return redirect()->route('view-delete-category');
    }
}

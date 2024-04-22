<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\PeminjamanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PublicController::class, 'index'])->middleware('auth');

//Middleware group guest
Route::middleware('only_guest')->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating'])->name('auth');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/store/register', [AuthController::class, 'storeRegis'])->name('store.regis');

});

// Route middleware group auth
Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profile']);
    //Borrowing
    Route::get('book-rent', [BookRentController::class, 'bookRent'])->name('book-rent');
    Route::post('store-rent', [BookRentController::class, 'storeRent'])->name('store-rent');
    Route::get("/rent-logs", [PeminjamanController::class, 'peminjaman'])->name('rent-logs');
    Route::get("/export", [ExportController::class, 'export'])->name('export');
    Route::get("/export-peminjaman-users", [PeminjamanController::class, 'peminjamanUsers'])->name('export-peminjaman-user');
    Route::post('/book-borrow', [BookRentController::class, 'exportPemin'])->name('book-borrow');
    // Route::post('/book-rent', [BookRentController::class, 'pengembalian'])->name('book-rent');
    
    //Return Book
    Route::post("/pengembalian/{id}", [BookRentController::class, 'pengembalian'])->name('pengembalian');
    Route::get("/return-book", [BookRentController::class, 'returnBook'])->name('return-book');

    // Koleksi
    Route::post("/store-collections", [KoleksiController::class, 'store'])->name('store-collections');
    Route::get("/collections", [KoleksiController::class, 'koleksi'])->name('collections');
});

// Middleware Group admin
Route::middleware('only_client')->group(function() {
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get("/export-dashboard", [DashboardController::class, 'exportPeminjaman'])->name('export-dashboard-peminjaman');

    //Books
    Route::get("/books", [BookController::class, 'books'])->name('books');
    Route::get("/add-book", [BookController::class, 'addBook'])->name('add-book');
    Route::post("/store-book", [BookController::class, 'storeBook'])->name('store-book');
    Route::get("/edit-book/{slug}", [BookController::class, 'editBook'])->name('edit-book');
    Route::post("/update-book/{slug}", [BookController::class, 'updateBook'])->name('update-book');
    Route::post("/destroy-book/{slug}", [BookController::class, 'destroyBook'])->name('destroy-book');
    Route::get("/show-delete-book", [BookController::class, 'showBook'])->name('show-delete-book');
    Route::post("/restore-book/{slug}", [BookController::class, 'restoreBook'])->name('restore-book');
    Route::post('/delete-permanent-book/{slug}', [BookController::class, 'destroyPermanent'])->name('delete-permanent-book');
    Route::get("/export-buku", [BookController::class, 'exportBook'])->name('export-buku');

    //Categories
    Route::get("/categories", [CategoryController::class, 'category'])->name('categories');
    Route::get("/add-category", [CategoryController::class, 'addCategory'])->name('add-category');
    Route::post("/store-category", [CategoryController::class, 'storeCategory'])->name('store-category');
    Route::get("/category-edit/{slug}", [CategoryController::class, 'editCategory'])->name('edit-category');
    Route::post("/category-update/{slug}", [CategoryController::class, 'updateCategory'])->name('update-category');
    Route::post("/category-destroy/{slug}", [CategoryController::class, 'destroyCategory'])->name('destroy-category');
    Route::get("/view-delete-category", [CategoryController::class, 'viewCategory'])->name('view-delete-category');
    Route::post("/restore-category/{slug}", [CategoryController::class, 'restoreCategory'])->name('restore-category');
    Route::post("/delete-permanent-category/{slug}", [CategoryController::class, 'permanentCategory'])->name('delete-permanent-category');


    //Users
    Route::get("/users", [UserController::class, 'user'])->name('users');
    Route::get("/register-users", [UserController::class, 'regisUser'])->name('register-users');
    Route::get("/detail-users/{slug}", [UserController::class, 'detailUser'])->name('detail-users');
    Route::get("/approve-users/{slug}", [UserController::class, 'approve'])->name('approve-users');
    Route::post("/ban-users/{slug}", [UserController::class, 'ban'])->name('ban-users');
    Route::get("/show-ban-users", [UserController::class, 'showUser'])->name('show-ban-users');
    Route::post("/restore-ban-users/{slug}", [UserController::class, 'restoreUser'])->name('restore-ban-users');
    Route::post("/delete-permanent-ban-users/{slug}", [UserController::class, 'permanentUser'])->name('permanent-ban-users');
});
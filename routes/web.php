<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $Books = \App\Models\Book::limit(8)->orderBy('created_at', 'desc')->get();
    return view('frontend.pages.home', ['Books' => $Books]);
})->name('home');

Route::get('/About-Us', function () {
    return view('frontend.pages.aboutUs');
})->name('aboutUs');

Route::get('/category', function () {
    return view('frontend.pages.aboutUs');
})->name('category');

Route::get('/library', function () {
    return view('frontend.pages.aboutUs');
})->name('library');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/dashboard/CreateBook', [BookController::class, 'store'])->name('book.create');
    Route::post('/dashboard/CreateCategory', [CategoryController::class, 'store'])->name('category.create');
});

require __DIR__.'/auth.php';

Route::get('/category/{Category}', [CategoryController::class, 'show']);
Route::get('/category/{Category}/{Book}', [BookController::class, 'show']);

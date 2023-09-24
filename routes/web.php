<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Models\Book;
use App\Models\Category;
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

Route::get('/Language/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'fa'])) {
        return redirect()->route('home');
    }

    Session::put('locale',$locale);
    return redirect()->back();
})->name('language.switch');

Route::middleware('language')->group(function () {
    Route::get('/', function () {
        $Books = Book::limit(8)->orderBy('created_at', 'desc')->get();
        $allBooks = Book::get();
        $Categories = Category::limit(8)->orderBy('created_at', 'desc')->get();
        $allCategories = Category::get();
        return view('frontend.pages.home', ['allBooks' => $allBooks, 'allCategories' => $allCategories, 'Books' => $Books, 'Categories' => $Categories]);
    })->name('home');

    Route::get('/categories', function () {
        $allCategories = Category::get();
        return view('frontend.pages.categories', ['allCategories' => $allCategories]);
    })->name('category');

    Route::get('/library', function () {
        $Books = Book::paginate(12);
        return view('frontend.pages.library', ['Books' => $Books]);
    })->name('library');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

});


Route::middleware(['language','auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/dashboard/CreateBook', [BookController::class, 'store'])->name('book.create');
    Route::post('/dashboard/CreateCategory', [CategoryController::class, 'store'])->name('category.create');
});

require __DIR__.'/auth.php';

Route::middleware('language')->group(function () {
    Route::get('/{Category}', [CategoryController::class, 'show']);
    Route::get('/{Category}/{Book}', [BookController::class, 'show']);
});

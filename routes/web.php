<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
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
    if (!in_array($locale, ['en', 'fa'])) {
        return redirect()->route('home');
    }

    Session::put('locale', $locale);
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

    Route::get('/search', function () {
        $search = Request::get('q');
        $Books = Book::where('name', 'LIKE', "%$search%")->paginate(12)->appends(['q' => $search]);
        return view('frontend.pages.search', ['Books' => $Books]);
    })->name('search');

});

Route::middleware(['language', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['language', 'AdminMiddleware', 'auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/dashboard/CreateBook', [BookController::class, 'store'])
        ->name('book.create');

    Route::post('/dashboard/CreateCategory', [CategoryController::class, 'store'])
        ->name('category.create');

    Route::get('/dashboard/{category}', [CategoryController::class, 'showEdit'])
        ->name('editCategoryShow');
    Route::post('/dashboard/{category}', [CategoryController::class, 'update'])
        ->name('editCategory');

    Route::get('/dashboard/{category}/{book}', [BookController::class, 'showEdit'])
        ->name('editBookShow');
    Route::post('/dashboard/edited/{book}', [BookController::class, 'update'])
        ->name('editBook');
});

require __DIR__ . '/auth.php';

Route::middleware('language')->group(function () {
    Route::get('/{Category}', [CategoryController::class, 'show'])->name('CategorySingle');
    Route::get('/{Category}/{Book}', [BookController::class, 'show']);
});

Route::get('/test/test/test', function (){
    Cache::lock('hello',30);
});

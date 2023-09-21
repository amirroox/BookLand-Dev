<?php

use App\Mail\MailTemplate;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/category', function () {
    return view('frontend.pages.category');
});

Route::get('/mail', function () {
    Mail::to('amirroox@yahoo.com')->send(new MailTemplate('Amir', 'Roox'));
});

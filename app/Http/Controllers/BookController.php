<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'categoryList' => 'required|min:2|max:255',
            'bookName' => 'required|min:2|max:255',
            'urlDownload' => 'required|min:2|max:255|url',
            'urlCover' => 'required|min:2|max:255|url',
        ]);

        $categoryList = array_map('intval', $request->input('categoryList')); # array => [1,2,3]

        $book = new Book();
        $book->name = $request->input('bookName');
        $book->url = $request->input('urlDownload');
        $book->cover = $request->input('urlCover');
        $book->save();
        $book->categories()->attach($categoryList); # Relative Between Book And Categories

        return redirect()->route('dashboard');
    }
}

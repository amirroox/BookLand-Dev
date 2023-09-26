<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'categoryList' => 'required|max:255',
            'bookName' => 'required|min:2|max:255|unique:App\Models\Book,name',
            'urlDownload' => 'required|min:2|max:255|url|unique:App\Models\Book,url',
            'urlCover' => 'nullable|min:2|max:255|url',
            'filePathBook' => 'nullable|mimes:jpg,jpeg,gif,png,tiff'
        ]);

        $book = new Book();

        if ($file = $request->file('filePathBook')) {
            $path = '/img/books/' . $file->hashName();
            $file->move('img/books', $file->hashName());
            $book->photo_path = $path;
        }

        $categoryList = array_map('intval', $request->input('categoryList')); # array => [1,2,3]


        $book->name = $request->input('bookName');
        $book->url = $request->input('urlDownload');
        if (!is_null($request->input('urlCover'))) {
            $book->cover = $request->input('urlCover');
        }
        $book->save();
        $book->categories()->attach($categoryList); # Relative Between Book And Categories

        return redirect()->route('dashboard')->with('MassageAdd', 'Book Added!');
    }

    public function show($category, $book)
    {
        $book = Book::where('name', $book)->first();
        if (!is_null($book)) {
            views($book)->record();
            return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book]);
        }
        return redirect()->route('home');
    }

    public function showEdit($category, $book)
    {
        $category = Category::where('slug', $category)->orWhere('title', $category)->first();
        if (!is_null($category)) {
            $book = $category->books()->where('name', $book)->first();
            if (!is_null($book)) {
                return view('frontend.panel.book', ['Book' => $book, 'Category' => $category]);
            }
        }
        return redirect()->route('dashboard');
    }

    public function update($book, Request $request)
    {
        $book = Book::where('name', $book)->first();

        $request->validate([
            'categoryList' => 'required|max:255',
            'bookName' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('books', 'name')->ignore($book->id)
            ],
            'urlDownload' => [
                'required',
                'min:2',
                'max:255',
                'url',
                Rule::unique('books', 'url')->ignore($book->id)
            ],
            'urlCover' => 'nullable|min:2|max:255|url',
            'filePathBook' => 'nullable|mimes:jpg,jpeg,gif,png,tiff'
        ]);

        if ($file = $request->file('filePathBook')) {
            $path = '/img/books/' . $file->hashName();
            $file->move('img/books', $file->hashName());
            $book->photo_path = $path;
        }

        $categoryList = array_map('intval', $request->input('categoryList')); # array => [1,2,3]


        $book->name = $request->input('bookName');
        $book->url = $request->input('urlDownload');
        if (!is_null($request->input('urlCover'))) {
            $book->cover = $request->input('urlCover');
        }
        $book->update();
        $book->categories()->sync($categoryList); # Relative Between Book And Categories

        return redirect()->route('dashboard')->with('MassageAdd', 'Book Edited!');


    }
}

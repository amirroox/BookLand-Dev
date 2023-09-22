<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'categoryTitle' => 'required|min:2|max:255|unique:App\Models\Category,title',
            'categorySlug' => 'required|min:2|max:255|unique:App\Models\Category,slug'
        ]);
        $category = new Category();
        $category->title = $request->input('categoryTitle');
        $category->slug = $request->input('categorySlug');
        $category->save();

        return redirect()->route('dashboard')->with('MassageAdd', 'Category Added!');
    }

    public function show($category)
    {
        $category = Category::where('slug', $category)->orWhere('title', $category)->first();
        if(!is_null($category)){
            return view('frontend.pages.category', ['CurrentCategory' => $category]);
        }
        return redirect()->route('home');
    }
}

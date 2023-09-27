<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'categoryTitle' => 'required|min:2|max:255|unique:App\Models\Category,title',
            'categorySlug' => 'required|min:2|max:255|unique:App\Models\Category,slug',
            'filePath' => 'nullable|mimes:jpg,gif,png,tiff'
        ]);

        $category = new Category();

        if ($file = $request->file('filePath')) {
            $path = '/img/categories/' . $file->hashName();
            $file->move(public_path('img/categories'), $file->hashName());
            $category->photo_path = $path;
        }
        $category->title = $request->input('categoryTitle');
        $category->slug = $request->input('categorySlug');
        $category->save();

        return redirect()->route('dashboard')->with('MassageAdd', __('auth.dashboard.CategoryAdded'));
    }

    public function show($category)
    {
        $category = Category::where('slug', $category)->first();
        if (!is_null($category)) {
            $allBooks = $category->books()->paginate(8);
            return view('frontend.pages.category', ['CurrentCategory' => $category, 'Books' => $allBooks]);
        }
        return redirect()->route('home');
    }

    public function showEdit($category)
    {
        $category = Category::where('slug', $category)->orWhere('title', $category)->first();
        if (!is_null($category)) {
            return view('frontend.panel.category', ['Category' => $category]);
        }
        return redirect()->route('dashboard');
    }

    public function update($categorySlug, Request $request)
    {
        $category = Category::where('slug', $categorySlug)->first();

        $request->validate([
            'categoryTitle' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('categories', 'title')->ignore($category->id)
            ],
            'categorySlug' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category->id)
            ],
            'filePath' => 'nullable|mimes:jpg,gif,png,tiff'
        ]);

        if($file = $request->file('filePath')){
            if(!is_null($category->photo_path)){
                \File::delete(public_path($category->photo_path));
            }
            $path = '/img/categories/' . $file->hashName();
            $file->move(public_path('img/categories'), $file->hashName());
            $category->photo_path = $path;
        }

        $category->title = $request->input('categoryTitle');
        $category->slug = $request->input('categorySlug');
        $category->update();

        return redirect()->route('CategorySingle', [$category->slug]);


    }

    public function delete($category)
    {
        $category = Category::where('slug', $category)->first();

        if(!is_null($category->photo_path)){
            \File::delete(public_path($category->photo_path));
        }

        $category->delete();
        return redirect()->route('dashboard')->with('MassageAdd', __('auth.dashboard.categoryDeleted'));
    }
}

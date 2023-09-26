<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use DOMDocument;
use DOMXPath;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Stichoza\GoogleTranslate\Exceptions\LargeTextException;
use Stichoza\GoogleTranslate\Exceptions\RateLimitException;
use Stichoza\GoogleTranslate\Exceptions\TranslationRequestException;
use Stichoza\GoogleTranslate\GoogleTranslate;

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

    /**
     * @throws GuzzleException
     */
    public function show($category, $book)
    {
        $cacheKey = 'book_' . $book;
        $cacheKeyFa = 'book_fa_' . $book;
        $book = Book::where('name', $book)->first();

        if (Session::get('locale') == 'fa') {
            if (Cache::has($cacheKeyFa)) {
                $textContentOfLastDiv = Cache::get($cacheKeyFa);
                views($book)->record();
                return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => $textContentOfLastDiv]);
            }
        }

        if (Cache::has($cacheKey)) {
            $textContentOfLastDiv = Cache::get($cacheKey);
            views($book)->record();
            return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => $textContentOfLastDiv]);
        } else {
            if (!is_null($book)) {
                $client = new Client();
                try {
                    $response = $client->request('GET', $book->url);
                } catch (Exception $exception) {
                    Cache::put($cacheKey, __('custom.lorem'), now()->addYears(100));
                    views($book)->record();
                    return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => __('custom.lorem')]);
                }

                if ($response->getStatusCode() == 200) {
                    $htmlContent = $response->getBody()->getContents();
                    $dom = new DOMDocument();
                    @$dom->loadHTML($htmlContent);
                    $xpath = new DOMXPath($dom);
                    $infoTD = $xpath->query('//td[@id="info"]');
                    if ($infoTD->length > 0) {
                        $divsInsideInfoTD = $xpath->query('.//div', $infoTD->item(0));
                        if ($divsInsideInfoTD->length > 0) {
                            $lastDivInsideInfoTD = $divsInsideInfoTD->item($divsInsideInfoTD->length - 1);
                            $textContentOfLastDiv = $lastDivInsideInfoTD->textContent;
                            Cache::put($cacheKey, $textContentOfLastDiv, now()->addYears(100));
                            try {
                                $textContentOfLastDivFa = GoogleTranslate::trans($textContentOfLastDiv, 'fa', 'en');
                                Cache::put($cacheKeyFa, $textContentOfLastDivFa, now()->addYears(100));
                            } catch (LargeTextException|RateLimitException|TranslationRequestException $e) {
                            }
                            views($book)->record();
                            if (Session::get('locale') == 'fa'){
                                return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => $textContentOfLastDivFa]);
                            }
                            return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => $textContentOfLastDiv]);
                        }
                    }
                }
                Cache::put($cacheKey, __('custom.lorem'), now()->addYears(100));
                views($book)->record();
                return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => __('custom.lorem')]);
            }
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

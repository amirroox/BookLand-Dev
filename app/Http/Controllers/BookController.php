<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use DOMDocument;
use DOMXPath;
use Exception;
use File;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Psr\SimpleCache\InvalidArgumentException;
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
            'release' => 'nullable|min:2|max:255|integer',
            'publisher' => 'nullable|min:2|max:255',
            'urlDownload' => 'required|min:2|max:255|url|unique:App\Models\Book,url',
            'urlCover' => 'nullable|min:2|max:255|url',
            'filePathBook' => 'nullable|mimes:jpg,jpeg,gif,png,tiff'
        ]);

        $book = new Book();

        if ($file = $request->file('filePathBook')) {
            $path = '/img/books/' . $file->hashName();
            $file->move(public_path('img/books'), $file->hashName());
            $book->photo_path = $path;
        }

        $categoryList = array_map('intval', $request->input('categoryList')); # array => [1,2,3]


        $book->name = $request->input('bookName');
        $book->release = $request->input('release');
        $book->publisher = $request->input('publisher');
        $book->url = $request->input('urlDownload');
        if (!is_null($request->input('urlCover'))) {
            $book->cover = $request->input('urlCover');
        }
        $book->save();
        $book->categories()->attach($categoryList); # Relative Between Book And Categories

        return redirect()->route('dashboard')->with('MassageAdd', __('auth.dashboard.BookAdded'));
    }

    /**
     * @throws GuzzleException
     */
    public function show($category, $book)
    {
        /* First Loading Up For Fetching and Caching */
        $cacheKey = 'book_' . $book;
        $cacheKeyFa = 'book_fa_' . $book;
        $cacheKeyUrl = 'Download_' . $book;
        $book = Book::where('name', $book)->first();
        $currentCategory = $book->categories[0]->slug;
        if (!is_null($book) && $category == $currentCategory) {
            views($book)->record();
            if (Session::get('locale') == 'fa') {
                if (Cache::has($cacheKeyUrl) && Cache::has($cacheKeyFa)) {
                    $textContentOfLastDiv = Cache::get($cacheKeyFa);
                    $downloadURL = Cache::get($cacheKeyUrl);
                    return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => $textContentOfLastDiv, 'DownloadURL' => $downloadURL]);
                }
            }

            if (Cache::has($cacheKeyUrl) && Cache::has($cacheKey)) {
                $textContentOfLastDiv = Cache::get($cacheKey);
                $downloadURL = Cache::get($cacheKeyUrl);
                return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => $textContentOfLastDiv, 'DownloadURL' => $downloadURL]);
            } else {
                $client = new Client();
                try {
                    $response = $client->request('GET', $book->url);
                } catch (Exception $exception) {
                    Cache::put($cacheKey, __('custom.lorem', [], 'en'), now()->addYears(100));
                    Cache::put($cacheKeyFa, __('custom.lorem', [], 'fa'), now()->addYears(100));
                    Cache::put($cacheKeyUrl, array(0), now()->addYears(100));
                    return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => __('custom.lorem'), 'DownloadURL' => array(0)]);
                }

                if ($response->getStatusCode() == 200) {
                    $htmlContent = $response->getBody()->getContents();
                    $dom = new DOMDocument();
                    @$dom->loadHTML($htmlContent);
                    $xpath = new DOMXPath($dom);
                    $infoTD = $xpath->query('//td[@id="info"]');
                    $downloadURL = $xpath->query('//div[@id="download"]')->item(0);
                    $allURL = array();
                    if ($infoTD->length > 0 && $downloadURL) {
                        $divsInsideInfoTD = $xpath->query('.//div', $infoTD->item(0));
                        $links = $downloadURL->getElementsByTagName('a');
                        foreach ($links as $link) {
                            $allURL[] = $link->getAttribute('href');
                        }
                        Cache::put($cacheKeyUrl, $allURL, now()->addYears(100));

                        if ($divsInsideInfoTD->length > 0) {
                            $lastDivInsideInfoTD = $divsInsideInfoTD->item($divsInsideInfoTD->length - 1);
                            $textContentOfLastDiv = $lastDivInsideInfoTD->textContent;
                            Cache::put($cacheKey, $textContentOfLastDiv, now()->addYears(100));
                            $textContentOfLastDivFa = '';
                            try {
                                $textContentOfLastDivFa = GoogleTranslate::trans($textContentOfLastDiv, 'fa', 'en');
                                Cache::put($cacheKeyFa, $textContentOfLastDivFa, now()->addYears(100));
                            } catch (LargeTextException|RateLimitException|TranslationRequestException $e) {
                            }
                            if (Session::get('locale') == 'fa') {
                                return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => $textContentOfLastDivFa, 'DownloadURL' => $allURL]);
                            }
                            return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => $textContentOfLastDiv, 'DownloadURL' => $allURL]);
                        }
                    }
                }
                Cache::put($cacheKey, __('custom.lorem', [], 'en'), now()->addYears(100));
                Cache::put($cacheKeyFa, __('custom.lorem', [], 'fa'), now()->addYears(100));
                Cache::put($cacheKeyUrl, array(0), now()->addYears(100));
                return view('frontend.pages.book', ['CurrentCategory' => $category, 'CurrentBook' => $book, 'DescriptionURL' => __('custom.lorem'), 'DownloadURL' => array(0)]);
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

    /**
     * @throws InvalidArgumentException
     */
    public function update($book, Request $request)
    {
        $cacheKey = 'book_' . $book;
        $cacheKeyFa = 'book_fa_' . $book;
        $cacheKeyUrl = 'Download_' . $book;

        $book = Book::where('name', $book)->first();

        $request->validate([
            'categoryList' => 'required|max:255',
            'bookName' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('books', 'name')->ignore($book->id)
            ],
            'release' => 'nullable|min:2|max:255',
            'publisher' => 'nullable|min:2|max:255',
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

        if (!is_null($book->photo_path)) {
            File::delete(public_path($book->photo_path));
        }

        if ($file = $request->file('filePathBook')) {
            $path = '/img/books/' . $file->hashName();
            $file->move(public_path('img/books'), $file->hashName());
            $book->photo_path = $path;
        } else {
            $book->photo_path = null;
        }

        $categoryList = array_map('intval', $request->input('categoryList')); # array => [1,2,3]


        $book->name = $request->input('bookName');
        $book->release = $request->input('release');
        $book->publisher = $request->input('publisher');
        $book->url = $request->input('urlDownload');
        if (!is_null($request->input('urlCover'))) {
            $book->cover = $request->input('urlCover');
        }
        $book->update();
        $book->categories()->sync($categoryList); # Relative Between Book And Categories

        try {
            Cache::delete($cacheKey);
            Cache::delete($cacheKeyFa);
            Cache::delete($cacheKeyUrl);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return redirect()->route('BookSinglePage', [$book->categories[0]->slug, $book->name]);


    }

    /**
     * @throws InvalidArgumentException
     */
    public function delete($book)
    {

        $cacheKey = 'book_' . $book;
        $cacheKeyFa = 'book_fa_' . $book;
        $cacheKeyUrl = 'Download_' . $book;

        $book = Book::where('name', $book)->first();

        if (!is_null($book->photo_path)) {
            File::delete(public_path($book->photo_path));
        }

        $book->delete();

        try {
            Cache::delete($cacheKey);
            Cache::delete($cacheKeyFa);
            Cache::delete($cacheKeyUrl);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return redirect()->route('dashboard')->with('MassageAdd', __('auth.dashboard.bookDeleted'));
    }
}

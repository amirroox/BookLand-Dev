@extends('frontend.main.master')

@section('title', $CurrentBook->name)

@section('content')

    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->is_admin)
        <div id="EditBtn" class="border-2 bg-gray-600 p-5 text-center rounded-full right-10 bottom-10 fixed z-10">
            <a
               href="{{ route('editBookShow', [$CurrentCategory ,$CurrentBook->name]) }}">{{ __('auth.dashboard.editBook') }}</a>
        </div>
    @endif

    @if(\Illuminate\Support\Facades\Session::get('locale') == 'fa')
        <div class="bg-red-500 p-10 mb-6 text-center rounded-2xl">
            <p class="text-3xl">توجه کنید که ترجمه به صورت خودکار انجام شده پس خورده نگیرید!</p>
        </div>
    @endif

    <div class="p-5 bg-gray-600 rounded-lg grid grid-cols-1 md:grid-cols-3 gap-4 h-full md:h-[70vh] overflow-hidden">
        <div class="text-center md:col-span-1 overflow-hidden h-full mx-auto md:mx-0">
            <img class="rounded-3xl h-full"
                 src="{{ ($CurrentBook->cover ?? ( strpos(asset($CurrentBook->photo_path), 'img/books') ? asset($CurrentBook->photo_path) : asset('img/books/template.png'))) }}"
                 alt="{{ $CurrentBook->name }}">
        </div>
        <div class="md:col-span-2 overflow-hidden">
            <h1 class="text-4xl md:text-6xl my-2">{{ $CurrentBook->name }}</h1>
            @foreach($CurrentBook->categories as $category)
                <span class="text-xl md:text-2xl">
                    <a class="hover:text-red-500" href="{{ url($category->slug) }}">
                        {{ $category->title }}
                    </a>
                </span>
            @endforeach
            <h3>{{ $CurrentBook->created_at }}</h3>
            <h3>{{ __('auth.dashboard.publisher') . ' : ' . $CurrentBook->publisher }}</h3>
            <h3>{{ __('auth.dashboard.release') . ' : ' .  $CurrentBook->release }}</h3>
            <hr class="my-2">
            <div class="my-2 hidden md:block">
                <p class="text-justify">
                    @if($DescriptionURL == '')
                        {{ __('custom.lorem') }}
                    @endif
                    {{ substr($DescriptionURL, 0, 300) . '.......' }}
                </p>
            </div>
            <div class="my-2 md:hidden">
                <p class="text-justify">
                    @if($DescriptionURL == '')
                        {{ __('custom.lorem') }}
                    @endif
                    {{ substr($DescriptionURL, 0, 400) . '.......' }}
                </p>
            </div>
        </div>
    </div>
    <br>
    <div class="p-5 text-center bg-gray-600 rounded-lg h-full overflow-hidden">
        <p class="text-4xl">{{ $CurrentBook->name }}</p>
        <hr class="my-5 w-1/2 mx-auto">
        <p class="text-justify">
            {{ $DescriptionURL }}
        </p>
        <br class="my-5">
        <h3 class="text-4xl mb-4">{{ __('custom.DownloadLink') }}</h3>
        <div class="flex flex-col md:flex-row justify-around items-spa gap-10">
            <?php $i = 0 ?>
            @foreach($DownloadURL as $url)
                @if(strpos($url, 'localhost:8080') || strpos($url, '/main/') || strpos($url, 'howtogeek.com'))
                    @continue
                @endif
                <a class="block p-5 w-full bg-blue-500 rounded-2xl duration-300 hover:bg-red-500" href="{{ $url }}" target="_blank"> {{ "Link " . ++$i }} </a>
            @endforeach
        </div>
    </div>
@endsection

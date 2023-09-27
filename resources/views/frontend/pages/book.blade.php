@extends('frontend.main.master')

@section('title', $CurrentBook->name)

@section('content')

    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->is_admin)
        <div id="EditBtn" class="bg-gray-600 p-5 text-center rounded-full right-10 bottom-10 fixed z-10">
            <a target="_blank"
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
                <span class="text-xl md:text-2xl"><a class="hover:text-red-500" href="{{ url($category->slug) }}">{{ $category->title }}</a></span>
            @endforeach
            <h3>{{ $CurrentBook->created_at }}</h3>
            <hr class="my-2">
            <div class="my-2">
                @if($DescriptionURL == '')
                    {{ __('custom.lorem') }}
                @endif
                    {{ substr($DescriptionURL, 0, 1400) . '.......' }}
            </div>
        </div>
    </div>
@endsection

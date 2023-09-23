@extends('frontend.main.master')

@section('title', 'Categories')

@section('content')
    <div
        class="[&>div]:rounded-3xl [&>div]:mb-12 [&>div]:p-5 [&>div]:mx-auto [&>div]:bg-gray-900 p-5 bg-gray-800 rounded-3xl">
        <div>
            <h2 class="text-2xl mb-5 text-center"><b>دسته بندی ها :</b></h2>
            <div class="grid grid-cols-1 md:grid-cols-4 text-center mb-5 gap-4">
                @foreach($allCategories as $Category)
                    <div
                        class="col-span-1 h-full overflow-hidden bg-gray-800 px-10 pt-5 pb-10 rounded-3xl hover:duration-300 hover:bg-white hover:text-black">
                        <a href="{{url($Category->slug)}}">
                            <div class="w-full h-3/4 overflow-hidden">
                                <img
                                    src="{{ !is_null($Category->photo_path) ? asset($Category->photo_path) : asset('img/categories/template.jpg') }}"
                                    alt="{{$Category->title}}" class="rounded-3xl object-fill w-full h-full">
                            </div>
                            <h3 class="mt-3"><b>{{$Category->title}}</b></h3>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

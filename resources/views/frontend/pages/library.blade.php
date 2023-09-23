@extends('frontend.main.master')

@section('title', 'Library')

@section('content')
    <div
        class="[&>div]:rounded-3xl [&>div]:mb-12 [&>div]:p-5 [&>div]:mx-auto [&>div]:bg-gray-900 p-5 bg-gray-800 rounded-3xl">
        <div class="relative">
            <h2 class="text-2xl mb-5 text-center"><b>کتاب ها :</b></h2>
            <div class="grid grid-cols-1 md:grid-cols-4 text-center mb-10 gap-4">
                @foreach($Books as $Book)
                    <div
                        class="h-full col-span-1 bg-gray-800 px-10 pt-5 pb-10 rounded-3xl hover:duration-300 hover:bg-white hover:text-black">
                        <a href="{{ url($Book->categories[0]->slug . '/' . $Book->name) }}">
                            <div class="w-full h-3/4 overflow-hidden">
                                <img class="rounded-3xl object-fill w-full h-full"
                                     src="{{ ($Book->cover ?? ( strpos(asset($Book->photo_path), 'img/books') ? asset($Book->photo_path) : asset('img/books/template.png') )) }}"
                                     alt="{{$Book->name}}">
                            </div>
                            <h3 class="my-5"><b>{{$Book->name}}</b></h3>
                        </a>
                        @foreach($Book->categories as $category)
                            <a href="{{url($category->slug)}}"
                               class="hover:duration-300 hover:bg-white hover:text-red-500">
                                <h4>{{$category->title}}</h4>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
            @if(!is_null($Books->nextPageUrl()))
                <a href="{{$Books->nextPageUrl()}}"
                   class="text-center hover:duration-300 hover:bg-blue-500 absolute md:bottom-[-5vh] bottom-[-2vh] rounded-3xl mx-auto bg-red-500 p-2 md:p-6 right-10">
                    <i class="fa-solid fa-hand-point-right"></i>
                </a>
            @endif
            <a
                class="text-center hover:duration-300 hover:bg-blue-500 absolute md:bottom-[-5vh] bottom-[-2vh] rounded-3xl mx-auto bg-red-500 left-[30%] right-[30%] p-2 md:p-6">
                صفحه {{$Books->currentPage()}}
            </a>
            @if(!is_null($Books->previousPageUrl()))
                <a href="{{$Books->previousPageUrl()}}"
                   class="text-center hover:duration-300 hover:bg-blue-500 absolute md:bottom-[-5vh] bottom-[-2vh] rounded-3xl mx-auto bg-red-500 left-10 p-2 md:p-6">
                    <i class="fa-solid fa-hand-point-left"></i>
                </a>
            @endif
        </div>
    </div>
@endsection

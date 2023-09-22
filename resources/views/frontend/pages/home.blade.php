@extends('frontend.main.master')

@section('title', 'Home')

@section('content')
    <div
        class="[&>div]:rounded-3xl [&>div]:mb-10 [&>div]:p-5 [&>div]:mx-auto [&>div]:bg-gray-900 p-5 bg-gray-800 rounded-3xl">
        <div class="!p-0 overflow-hidden">
            <img src="{{ asset('img/BannerHome.png') }}" alt="Banner">
        </div>
        <div>
            <h2 class="text-2xl mb-5"><b>کتاب های جدید :</b></h2>
            <div class="grid grid-cols-4 text-center mb-5 gap-4">
                @foreach($Books as $Book)
                    <div class="col-span-1">
                        <img src="{{ $Book->cover }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br>
    </div>
@endsection

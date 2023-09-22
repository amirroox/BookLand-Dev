@extends('frontend.main.master')

@section('title', $CurrentCategory->title)

@section('content')
    <div class="p-5 bg-gray-600 rounded-lg">
        <p class="text-center">{{ $CurrentCategory->slug }}</p>
        @foreach($CurrentCategory->books as $book)
            <a href="{{ url()->current() . '/' . $book->name }}">
                {{ $book->name }}
            </a>

            <br>
        @endforeach
    </div>
@endsection

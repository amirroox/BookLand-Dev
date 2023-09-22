@extends('frontend.main.master')

@section('title', $CurrentBook->name)

@section('content')
    <div class="p-5 bg-gray-600 rounded-lg">
        <p class="text-center">{{ $CurrentBook->name }}</p>
        <p class="text-center">{{ $CurrentBook->url }}</p>
        <p class="text-center">{{ $CurrentBook->cover }}</p>
        <p class="text-center">
            {{ $CurrentBook->created_at }}
            <br>
            {{ date('H', strtotime($CurrentBook->created_at)) }}
        </p>
    </div>
@endsection

@extends('frontend.main.master')

@section('title', $CurrentBook->name)

@section('content')

    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->is_admin)
        <div id="EditBtn" class="bg-gray-600 p-5 text-center rounded-full right-10 bottom-10 fixed z-10">
            <a href="{{ route('editBookShow', [$CurrentCategory ,$CurrentBook->name]) }}">{{ __('auth.dashboard.editBook') }}</a>
        </div>
    @endif

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

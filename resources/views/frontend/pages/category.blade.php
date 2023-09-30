@extends('frontend.main.master')

@section('title', $CurrentCategory->title)

@section('content')
    @if(\Illuminate\Support\Facades\Request::get('page') !== null && (\Illuminate\Support\Facades\Request::get('page') > $Books->lastPage()))
        @php
            header('Location: '. route('CategorySingle', $CurrentCategory->title));
            exit();
        @endphp
    @endif

    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->is_admin)
        <div id="EditBtn" class="border-2 bg-gray-600 p-5 text-center rounded-full right-10 bottom-10 fixed z-10">
            <a href="{{ route('editCategoryShow', $CurrentCategory->slug) }}">{{ __('auth.dashboard.editCategory') }}</a>
        </div>
    @endif

    <div class="p-5 bg-gray-600 rounded-lg md:w-1/2 mx-auto mb-12">
        <h1 class="text-center text-3xl">{{ $CurrentCategory->title }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-center mb-12">
        @php
            $newBook = $CurrentCategory->books()->orderBy('updated_at', 'desc')->limit(4)->get();
            $topViewBook = $CurrentCategory->books()->orderByViews('desc')->limit(4)->get();
        @endphp
        <div>
            <h2 class="text-2xl mb-4">{{ __('custom.newest') }}</h2>
            <div class="p-5 bg-gray-600 rounded-lg grid grid-cols-2 md:grid-cols-4 gap-3">
                @for($i=0 ; $i < 4 ; $i++)
                    @if(!isset($newBook[$i]))
                        @break
                    @endif
                    <a href="{{ url($CurrentCategory->title . '/' . $newBook[$i]->name) }}" class="block">
                        <div
                            class="elementJump text-center p-2 border-blue-500 border-2 h-52 md:h-40 overflow-hidden rounded-lg relative">
                            <img
                                src="{{ ($newBook[$i]->cover ?? ( strpos(asset($newBook[$i]->photo_path), 'img/books') ? asset($newBook[$i]->photo_path) : asset('img/books/template.png') )) }}"
                                alt="{{ $newBook[$i]->name }}"
                                class="h-full w-full object-cover rounded-lg mx-auto">
                            <div
                                class="overflow-hidden text-xl absolute z-10 mx-auto bottom-[-100%] duration-300 bg-blue-500 p-2 h-full w-full flex items-center justify-center">
                                {{ substr($newBook[$i]->name, 0 , 20) . "..." }}
                            </div>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
        <div>
            <h2 class="text-2xl mb-4">{{ __('custom.mostVisited') }}</h2>
            <div class="p-5 bg-gray-600 rounded-lg grid grid-cols-2 md:grid-cols-4 gap-3">
                @for($i=0 ; $i < 4 ; $i++)
                    @if(!isset($topViewBook[$i]))
                        @break
                    @endif
                    <a href="{{ url($CurrentCategory->title . '/' . $topViewBook[$i]->name) }}" class="block">
                        <div
                            class="elementJump text-center p-2 border-red-500 border-2 h-52 md:h-40 overflow-hidden rounded-lg relative">
                            <img
                                src="{{ ($topViewBook[$i]->cover ?? ( strpos(asset($topViewBook[$i]->photo_path), 'img/books') ? asset($topViewBook[$i]->photo_path) : asset('img/books/template.png') )) }}"
                                alt="{{ $topViewBook[$i]->name }}"
                                class="h-full w-full object-cover rounded-lg mx-auto">
                            <div
                                class="text-xl overflow-hidden absolute z-10 mx-auto bottom-[-100%] space-y-6 duration-300 bg-red-500 p-2 h-full w-full flex flex-col items-center justify-center">
                                <p class="text-base">{{ substr($topViewBook[$i]->name, 0 , 20) . '...' }}</p>
                                <div>
                                    <i class="fa-solid fa-eye align-middle"></i>
                                    <i>{{ views($topViewBook[$i])->remember()->unique()->count() }}</i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
    </div>

    <div
        class="[&>div]:rounded-3xl [&>div]:mb-12 [&>div]:p-5 [&>div]:mx-auto [&>div]:bg-gray-900 p-5 bg-gray-800 rounded-3xl">
        <div class="relative">
            <h2 class="text-2xl mb-5 text-center"><b>{{__('custom.home.books') . " {$Books->total()}"}}</b></h2>
            <div class="grid grid-cols-1 md:grid-cols-4 text-center mb-10 gap-4">
                @foreach($Books as $Book)
                    <div
                        class="col-span-1 bg-gray-800 px-10 pt-5 pb-5 rounded-3xl hover:duration-300 hover:bg-white hover:text-black">
                        <a href="{{ url($Book->categories[0]->slug . '/' . $Book->name) }}"
                           class="flex flex-col space-y-6">
                            <div>
                                <span>{{ views($Book)->unique()->count() }}</span>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <div class="h-64 overflow-hidden">
                                <img class="rounded-3xl object-cover w-full h-full"
                                     src="{{ ($Book->cover ?? ( strpos(asset($Book->photo_path), 'img/books') ? asset($Book->photo_path) : asset('img/books/template.png') )) }}"
                                     alt="{{$Book->name}}">
                            </div>
                            <h3 class="h-20 flex items-center justify-center"><b>{{$Book->name}}</b></h3>
                            <hr class="pb-5">
                        </a>
                        <div class="h-16 flex flex-col items-center justify-center">
                            @for($i=0 ; $i < 3 ; $i++)
                                @if(!isset($Book->categories[$i]))
                                    @break
                                @endif
                                <a href="{{url($Book->categories[$i]->slug)}}"
                                   class="hover:duration-300 hover:bg-white hover:text-red-500">
                                    <h4>{{$Book->categories[$i]->title}}</h4>
                                </a>
                            @endfor
                        </div>
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
                {{__('custom.home.page') . ' ' .$Books->currentPage()}}
            </a>
            @if(!is_null($Books->previousPageUrl()))
                <a href="{{$Books->previousPageUrl()}}"
                   class="text-center hover:duration-300 hover:bg-blue-500 absolute md:bottom-[-5vh] bottom-[-2vh] rounded-3xl mx-auto bg-red-500 left-10 p-2 md:p-6">
                    <i class="fa-solid fa-hand-point-left"></i>
                </a>
            @endif
        </div>
    </div>

    <script>

        const newestElm = $('.elementJump');
        newestElm.on('mouseenter', function () {
            $(this).find('div').addClass('!bottom-0');
        });
        newestElm.on('mouseleave', function () {
            $(this).find('div').removeClass('!bottom-0');
        });
    </script>
@endsection

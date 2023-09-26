<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('auth.dashboard.panel') }}
        </h2>
    </x-slot>

    <div class="py-12 [&>div]:mb-5">
            @if(session()->has('MassageAdd'))
                <!-- Massage Create Book & Category -->
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 grid grid-cols-6 gap-10">
                            {{ session('MassageAdd') }}
                        </div>
                    </div>
                </div>
                <br>
            @endif

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 grid grid-cols-1 md:grid-cols-6 gap-10">
                        <div class="col-span-3">
                            <h2 class="mb-2"><b>{{ __('auth.dashboard.addCategory') }}</b></h2>
                            <hr>
                            <br>
                            {!! Form::open(['action' => 'POST', 'url' => route('category.create'), 'files' => true]) !!}
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('categoryTitle',  __('auth.dashboard.addCategory'), ['class' => 'w-full']) !!}
                                {!! Form::text('categoryTitle', '', ['class' => 'rounded-lg text-black md:w-10/12 pl-4 ml-2', 'placeholder' => 'Laravel']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('categorySlug', __('auth.dashboard.slug'), ['class' => 'w-full']) !!}
                                {!! Form::text('categorySlug', '', ['class' => 'rounded-lg text-black md:w-10/12 pl-4 ml-2', 'placeholder' => 'Laravel-Learning']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('filePath', __('auth.dashboard.picCategory'), ['class' => 'w-full']) !!}
                                {!! Form::label('filePath', __('auth.dashboard.picCategory'), ['class' => 'rounded-lg bg-white text-black text-center md:w-10/12 p-4 ml-2 hover:duration-300 hover:cursor-pointer hover:bg-red-500']) !!}
                                {!! Form::file('filePath', ['class' => 'hidden']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::submit(__('auth.dashboard.addCategory'), ['class' => 'rounded-lg bg-blue-500 hover:duration-300 hover:bg-red-500 p-2 md:w-10/12 ml-2 hover:cursor-pointer']) !!}
                            </div>
                            {!! Form::close() !!}
                            @if($errors->hasAny(['categoryTitle', 'categorySlug']))
                                <div
                                    class="flex flex-col gap-2 mb-2 md:w-10/12 rounded-lg bg-red-500 pl-4 ml-2 py-8 text-center">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>

                        <div class="col-span-3" dir="rtl">
                            <h2 class="text-right mb-2"><b>{{ __('auth.dashboard.addBook') }}</b></h2>
                            <hr>
                            <br>
                            {!! Form::open(['action' => 'POST', 'url' => route('book.create') , 'files' => true]) !!}
                            <div class="flex flex-col gap-2 mb-2">
                                <label for="categoryList" class="w-full">{{ __('auth.dashboard.catBook') }}</label>
                                <select name="categoryList[]" id="categoryList"
                                        class="rounded-lg text-black md:w-10/12 pl-4 ml-2" multiple>
                                    {{ $allCategory = \App\Models\Category::get() }}
                                    @foreach($allCategory as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('bookName', __('auth.dashboard.bookName'), ['class' => 'w-full']) !!}
                                {!! Form::text('bookName', '', ['class' => 'rounded-lg text-black md:w-10/12 pl-4 ml-2', 'placeholder' => 'Mastering Laravel']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('urlDownload', __('auth.dashboard.urlDownload'), ['class' => 'w-full']) !!}
                                {!! Form::text('urlDownload', '', ['class' => 'text-left rounded-lg text-black md:w-10/12 pl-4 ml-2', 'dir' => 'ltr', 'placeholder' => '(libgen.is) - https://libgen.is/book/index.php?md5=?']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('urlCover', __('auth.dashboard.urlCover'), ['class' => 'w-full']) !!}
                                {!! Form::text('urlCover', '', ['class' => 'rounded-lg text-black md:w-10/12 pl-4 ml-2 text-left', 'dir' => 'ltr', 'placeholder' => 'Custom Link Cover']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('filePathBook', __('auth.dashboard.picBook'), ['class' => 'w-full']) !!}
                                {!! Form::label('filePathBook', __('auth.dashboard.picBook'), ['dir' => 'ltr', 'class' => 'rounded-lg bg-white text-black text-center md:w-10/12 p-4 ml-2 hover:duration-300 hover:cursor-pointer hover:bg-red-500']) !!}
                                {!! Form::file('filePathBook', ['class' => 'hidden']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::submit(__('auth.dashboard.addBook'), ['class' => 'rounded-lg bg-blue-500 hover:duration-300 hover:bg-red-500 p-2 md:w-10/12 ml-2 hover:cursor-pointer']) !!}
                            </div>
                            {!! Form::close() !!}
                            @if($errors->hasAny(['categoryList', 'bookName', 'urlDownload', 'urlCover']))
                                <div
                                    class="flex flex-col gap-2 mb-2 md:w-10/12 rounded-lg bg-red-500 pl-4 ml-2 py-8 text-center"
                                    dir="ltr">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5 text-white">
                    <h2>
                        <b>
                            {{ __('custom.recentBook') }}
                        </b>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 text-center mb-10 gap-4 py-4">
                        @php
                            $Books = \App\Models\Book::limit(8)->orderBy('updated_at', 'desc')->get();
                        @endphp
                        @foreach($Books as $Book)
                            <div
                                class="col-span-1 bg-gray-600 px-10 pt-5 pb-10 rounded-3xl hover:duration-300 hover:bg-white hover:text-black">
                                <a href="{{ url('/dashboard/' . $Book->categories[0]->slug . '/' . $Book->name) }}" class="inline-block h-60 md:h-64 space-y-6">
                                    <div>
                                        <span>{{ views($Book)->unique()->count() }}</span>
                                        <i class="fa-solid fa-eye"></i>
                                    </div>
                                    <div class="h-full h-3/4 overflow-hidden">
                                        <img class="rounded-3xl object-fill w-full h-full"
                                             src="{{ ($Book->cover ?? ( strpos(asset($Book->photo_path), 'img/books') ? asset($Book->photo_path) : asset('img/books/template.png') )) }}"
                                             alt="{{$Book->name}}">
                                    </div>
                                    <h3><b>{{$Book->name}}</b></h3>
                                </a>
                                <hr class="pb-5">
                                @for($i=0 ; $i < 3 ; $i++)
                                    @if(!isset($Book->categories[$i]))
                                        @break
                                    @endif
                                    <a href="{{url('/dashboard/' . $Book->categories[$i]->slug)}}"
                                       class="hover:duration-300 hover:bg-white hover:text-red-500">
                                        <h4>{{$Book->categories[$i]->title}}</h4>
                                    </a>
                                @endfor
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>

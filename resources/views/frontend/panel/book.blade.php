<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('custom.header.categories') }}
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
                <div class="p-6 text-gray-900 dark:text-gray-100 grid grid-cols-1 gap-10">
                    <div>
                        <h2 class="mb-2"><b>{{ __('auth.dashboard.editBook') }}</b></h2>
                        <hr>
                        <br>
                        {!! Form::open(['method' => 'POST', 'url' => route('editBook', [$Book->name]) , 'files' => true]) !!}
                        <div class="flex flex-col gap-2 mb-2">
                            <label for="categoryList" class="w-full">{{ __('auth.dashboard.catBook') }}</label>
                            <select name="categoryList[]" id="categoryList"
                                    class="rounded-lg text-black pl-4 ml-2" multiple>
                                {{ $allCategory = \App\Models\Category::get() }}
                                @foreach($allCategory as $category)
                                    <option {{ $category->slug == $Book->categories[0]->slug ? 'selected' : '' }} value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::label('bookName', __('auth.dashboard.bookName'), ['class' => 'w-full']) !!}
                            {!! Form::text('bookName', $Book->name, ['class' => 'rounded-lg text-black pl-4 ml-2', 'placeholder' => 'Mastering Laravel']) !!}
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::label('urlDownload', __('auth.dashboard.urlDownload'), ['class' => 'w-full']) !!}
                            {!! Form::text('urlDownload', $Book->url, ['class' => 'text-left rounded-lg text-black pl-4 ml-2', 'dir' => 'ltr', 'placeholder' => '(libgen.is) - https://libgen.is/book/index.php?md5=?']) !!}
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::label('urlCover', __('auth.dashboard.urlCover'), ['class' => 'w-full']) !!}
                            {!! Form::text('urlCover', $Book->cover_url, ['class' => 'rounded-lg text-black pl-4 ml-2 text-left', 'dir' => 'ltr', 'placeholder' => 'Custom Link Cover']) !!}
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::label('filePathBook', __('auth.dashboard.picBook'), ['class' => 'w-full']) !!}
                            {!! Form::label('filePathBook', __('auth.dashboard.picBook'), ['dir' => 'ltr', 'class' => 'rounded-lg bg-white text-black text-center p-4 ml-2 hover:duration-300 hover:cursor-pointer hover:bg-red-500']) !!}
                            {!! Form::file('filePathBook', ['class' => 'hidden']) !!}
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            <img
                                src="{{ !is_null($Book->photo_path) ? asset($Book->photo_path) : asset('img/books/template.png/template.jpg')  }}"
                                alt="{{ $Category->title }}" class="md:w-1/2 mx-auto">
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::submit(__('auth.dashboard.editBook'), ['class' => 'rounded-lg bg-blue-500 hover:duration-300 hover:bg-red-500 p-2 ml-2 hover:cursor-pointer']) !!}
                        </div>
                        {!! Form::close() !!}

                        {!! Form::open(['method' => 'DELETE', 'url' => route('deleteBook', [$Book->name])]) !!}
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::submit(__('auth.dashboard.deleteBook'), ['class' => 'rounded-lg bg-blue-500 hover:duration-300 hover:bg-red-500 p-2 ml-2 hover:cursor-pointer']) !!}
                        </div>
                        {!! Form::close() !!}
                        @if($errors->hasAny(['categoryList', 'bookName', 'urlDownload', 'urlCover']))
                            <div
                                class="flex flex-col gap-2 mb-2 rounded-lg bg-red-500 pl-4 ml-2 py-8 text-center"
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
    </div>
</x-app-layout>

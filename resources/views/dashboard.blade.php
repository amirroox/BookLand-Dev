<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 grid grid-cols-6 gap-10">
                        <div class="col-span-3">
                            <h2 class="mb-2"><b>Add Category</b></h2>
                            <hr>
                            <br>
                            {!! Form::open(['action' => 'POST', 'url' => route('category.create'), 'name' => 'sdsd']) !!}
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('categoryTitle', 'Category Title :', ['class' => 'w-full']) !!}
                                {!! Form::text('categoryTitle', '', ['class' => 'rounded-lg text-black w-10/12 pl-4 ml-2', 'placeholder' => 'Laravel']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('categorySlug', 'Slug :', ['class' => 'w-full']) !!}
                                {!! Form::text('categorySlug', '', ['class' => 'rounded-lg text-black w-10/12 pl-4 ml-2', 'placeholder' => 'Laravel-Learning']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::submit('Add Category', ['class' => 'rounded-lg bg-blue-500 hover:duration-300 hover:bg-red-500 p-2 w-10/12 ml-2 hover:cursor-pointer']) !!}
                            </div>
                            {!! Form::close() !!}
                            @if($errors->hasAny(['categoryTitle', 'categorySlug']))
                                <div class="flex flex-col gap-2 mb-2 w-10/12 rounded-lg bg-red-500 pl-4 ml-2 py-8 text-center">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                        <div class="col-span-3" dir="rtl">
                            <h2 class="text-right mb-2"><b>Add Book</b></h2>
                            <hr>
                            <br>
                            {!! Form::open(['action' => 'POST', 'url' => route('book.create')]) !!}
                            <div class="flex flex-col gap-2 mb-2">
                                <label for="categoryList" class="w-full">Category Book :</label>
                                <select name="categoryList[]" id="categoryList"
                                        class="rounded-lg text-black w-10/12 pl-4 ml-2" multiple>
                                    {{ $allCategory = \App\Models\Category::get() }}
                                    @foreach($allCategory as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('bookName', 'Book Name :', ['class' => 'w-full']) !!}
                                {!! Form::text('bookName', '', ['class' => 'rounded-lg text-black w-10/12 pl-4 ml-2', 'placeholder' => 'Mastering Laravel']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('urlDownload', 'Url Download :', ['class' => 'w-full']) !!}
                                {!! Form::text('urlDownload', '', ['class' => 'rounded-lg text-black w-10/12 pl-4 ml-2', 'placeholder' => '(libgen.is) - https://libgen.is/book/index.php?md5=?']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::label('urlCover', 'Url Cover :', ['class' => 'w-full']) !!}
                                {!! Form::text('urlCover', '', ['class' => 'rounded-lg text-black w-10/12 pl-4 ml-2', 'placeholder' => 'Custom Link Cover']) !!}
                            </div>
                            <div class="flex flex-col gap-2 mb-2">
                                {!! Form::submit('Add Book', ['class' => 'rounded-lg bg-blue-500 hover:duration-300 hover:bg-red-500 p-2 w-10/12 ml-2 hover:cursor-pointer']) !!}
                            </div>
                            {!! Form::close() !!}
                            @if($errors->hasAny(['categoryList', 'bookName', 'urlDownload', 'urlCover']))
                                <div class="flex flex-col gap-2 mb-2 w-10/12 rounded-lg bg-red-500 pl-4 ml-2 py-8 text-center" dir="ltr">
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
                @endif
            </div>
    </div>
</x-app-layout>

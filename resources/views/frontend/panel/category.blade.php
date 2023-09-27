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
                        <h2 class="mb-2"><b>{{ __('auth.dashboard.editCategory') }}</b></h2>
                        <hr>
                        <br>
                        {!! Form::open(['method' => 'POST', 'url' => route('editCategory', $Category->slug), 'files' => true]) !!}
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::label('categoryTitle',  __('auth.dashboard.categoryTitle'), ['class' => 'w-full']) !!}
                            {!! Form::text('categoryTitle', $Category->title, ['class' => 'rounded-lg text-black pl-4 ml-2', 'placeholder' => 'Laravel']) !!}
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::label('categorySlug', __('auth.dashboard.slug'), ['class' => 'w-full']) !!}
                            {!! Form::text('categorySlug', $Category->slug, ['class' => 'rounded-lg text-black pl-4 ml-2', 'placeholder' => 'Laravel-Learning']) !!}
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::label('filePath', __('auth.dashboard.picCategory'), ['class' => 'w-full']) !!}
                            {!! Form::label('filePath', __('auth.dashboard.picCategory'), ['class' => 'rounded-lg bg-white text-black text-center p-4 ml-2 hover:duration-300 hover:cursor-pointer hover:bg-red-500']) !!}
                            {!! Form::file('filePath', ['class' => 'hidden']) !!}
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            <img
                                src="{{ !is_null($Category->photo_path) ? asset($Category->photo_path) : asset('img/categories/template.jpg')  }}"
                                alt="{{ $Category->title }}" class="md:w-1/2 mx-auto">
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::submit(__('auth.dashboard.editCategory'), ['class' => 'rounded-lg bg-blue-500 hover:duration-300 hover:bg-red-500 p-2 ml-2 hover:cursor-pointer']) !!}
                        </div>
                        {!! Form::close() !!}

                        {!! Form::open(['method' => 'DELETE', 'url' => route('deleteCategory', [$Category->slug])]) !!}
                        <div class="flex flex-col gap-2 mb-2">
                            {!! Form::submit(__('auth.dashboard.deleteCategory'), ['class' => 'rounded-lg bg-blue-500 hover:duration-300 hover:bg-red-500 p-2 ml-2 hover:cursor-pointer']) !!}
                        </div>
                        {!! Form::close() !!}
                        @if($errors->hasAny(['categoryTitle', 'categorySlug']))
                            <div
                                class="flex flex-col gap-2 mb-2 rounded-lg bg-red-500 pl-4 ml-2 py-8 text-center">
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

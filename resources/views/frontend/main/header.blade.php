<!-- START HEADER SECTION -->
<header id="MyHeader"
    class="md:container z-50 mx-auto grid grid-cols-1 md:grid-cols-8 gap-y-5 md:gap-10 md:items-center text-center pt-8 pb-2 text-white md:sticky top-0">
    <div class="md:col-span-1">
        <a href="{{route('home')}}">
            <img class="w-40 md:w-32 mx-auto" src='{{asset("/img/Book.png")}}' alt="Logo">
        </a>
    </div>
    <div class="md:col-span-2 flex justify-center items-center">
        <form action="{{ route('search') }}" method="get">
            <label for="search">
                <button type="submit"><i class="text-blue-500 hover:text-red-500 fa-brands fa-searchengin fa-2xl"></i>
                </button>
                <input class="text-red-500 p-1 text-center rounded-2xl outline-none bg-transparent border-2 border-red-500"
                       type="text" name="q" id="search" placeholder="{{__('custom.header.search')}}">
            </label>
        </form>
    </div>
    <hr class="md:hidden">
    <div class="md:col-span-3">
        <ul class="[&>li]:text-blue-500 flex justify-evenly font-bold">
            <li class="hover:text-red-500">
                <a href="{{route('library')}}" class="md:flex md:flex-col md:gap-5">
                    <span class="hidden md:inline"><i class="fa-solid fa-book fa-xl"></i></span>
                    <span class="md:hidden"><i class="fa-solid fa-book"></i></span>
                    {{__('custom.header.library')}}
                </a>
            </li>
            <li class="hover:text-red-500">
                <a href="{{route('category')}}" class="md:flex md:flex-col md:gap-5">
                    <span class="hidden md:inline"><i class="fa-solid fa-braille fa-xl"></i></span>
                    <span class="md:hidden"><i class="fa-solid fa-braille"></i></span>
                    {{__('custom.header.categories')}}
                </a>
            </li>
            <li class="hover:text-red-500">
                <a href="https://ro-ox.com/rooxteam/about/" target="_blank" class="md:flex md:flex-col md:gap-5">
                    <span class="hidden md:inline"><i class="fa-solid fa-users fa-xl"></i></span>
                    <span class="md:hidden"><i class="fa-solid fa-users"></i></span>
                    {{__('custom.header.about us')}}
                </a>
            </li>
        </ul>
    </div>
    <hr class="md:hidden">
    <div class="md:col-span-2 my-2 [&>ul]:text-red-500">
        <ul class="font-bold flex justify-evenly">
            <li class="hover:text-blue-500">
                <a href="https://github.com/amirroox/BookLand-Dev" target="_blank" class="flex flex-col gap-5">
                    <span><i class="fa-brands fa-github fa-xl"></i></span>
                    {{__('custom.header.github')}}
                </a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->is_admin)
            <li class="hover:text-blue-500">
                <a href="{{route('dashboard')}}" class="flex flex-col gap-5">
                    <span><i class="fa-solid fa-user-secret fa-xl"></i></span>
                    {{__('custom.header.admin')}}
                </a>
            </li>
            @endif
        </ul>
    </div>
</header>
<!-- END HEADER SECTION -->

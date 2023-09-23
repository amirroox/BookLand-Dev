<!-- START HEADER SECTION -->
<header id="MyHeader"
    class="md:container z-50 mx-auto grid grid-cols-1 md:grid-cols-8 gap-y-5 md:gap-10 md:items-center text-center pt-8 pb-2 text-white md:sticky top-0">
    <div class="md:col-span-1">
        <a href="{{route('home')}}">
            <img class="w-40 md:w-32 mx-auto" src='{{asset("/img/Book.png")}}' alt="Logo">
        </a>
    </div>
    <div class="md:col-span-2 flex justify-center items-center">
        <form action="" method="get">
            <label for="search">
                <button type="submit"><i class="text-blue-500 hover:text-red-500 fa-brands fa-searchengin fa-2xl"></i>
                </button>
                <input class="p-1 text-center rounded-2xl outline-none bg-transparent border-2 border-red-500"
                       type="text" name="search" id="search" placeholder="جستجو">
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
                    کتابخانه
                </a>
            </li>
            <li class="hover:text-red-500">
                <a href="{{route('category')}}" class="md:flex md:flex-col md:gap-5">
                    <span class="hidden md:inline"><i class="fa-solid fa-braille fa-xl"></i></span>
                    <span class="md:hidden"><i class="fa-solid fa-braille"></i></span>
                    دسته بندی ها
                </a>
            </li>
            <li class="hover:text-red-500">
                <a href="{{route('aboutUs')}}" class="md:flex md:flex-col md:gap-5">
                    <span class="hidden md:inline"><i class="fa-solid fa-users fa-xl"></i></span>
                    <span class="md:hidden"><i class="fa-solid fa-users"></i></span>
                    درباره ما
                </a>
            </li>
        </ul>
    </div>
    <hr class="md:hidden">
    <div class="md:col-span-2 my-2 [&>ul]:text-red-500">
        <ul class="font-bold flex justify-evenly">
            <li class="hover:text-blue-500">
                <a href="" class="flex flex-col gap-5">
                    <span><i class="fa-brands fa-github fa-xl"></i></span>
                    گیت هاب
                </a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::check())
            <li class="hover:text-blue-500">
                <a href="{{route('dashboard')}}" class="flex flex-col gap-5">
                    <span><i class="fa-solid fa-user-secret fa-xl"></i></span>
                    ادمین
                </a>
            </li>
            @endif
        </ul>
    </div>
</header>
<!-- END HEADER SECTION -->

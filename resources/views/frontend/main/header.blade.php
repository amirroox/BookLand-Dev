<!-- START HEADER SECTION -->
<header class="md:container mx-auto grid grid-cols-1 md:grid-cols-8 gap-y-5 md:gap-10 md:items-center text-center p-4 text-white md:sticky top-0">
    <div class="md:col-span-1">
        <img class="w-40 md:w-32 mx-auto" src='{{asset("/img/Book.png")}}' alt="Logo">
    </div>
    <div class="md:col-span-2 flex justify-center items-center">
        <form action="" method="get">
            <label for="search">
                <button type="submit"><i class="text-blue-500 hover:text-red-500 fa-brands fa-searchengin fa-2xl"></i></button>
                <input class="p-1 text-center rounded-2xl outline-none bg-transparent border-2 border-red-500" type="text" name="search" id="search" placeholder="جستجو">
            </label>
        </form>
    </div>
    <hr class="md:hidden">
    <div class="md:col-span-3">
        <ul class="[&>li]:text-blue-500 flex justify-evenly font-bold">
            <li class="hover:text-red-500"><a href="">کتابخانه</a></li>
            <li class="hover:text-red-500"><a href="">دسته بندی ها</a></li>
            <li class="hover:text-red-500"><a href="">درباره ما</a></li>
        </ul>
    </div>
    <hr class="md:hidden">
    <div class="md:col-span-2 my-2 [&>ul]:text-red-500">
        <ul class="font-bold flex justify-evenly">
            <li class="hover:text-blue-500 flex flex-col gap-5">
                <i class="fa-brands fa-github fa-xl"></i>
                <a href="">گیت هاب</a>
            </li>
            <li class="hover:text-blue-500 flex flex-col gap-5">
                <i class="fa-solid fa-user-secret fa-xl"></i>
                <a href="">ادمین</a>
            </li>
        </ul>
    </div>
</header>
<!-- END HEADER SECTION -->

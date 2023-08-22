<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://v1.fontapi.ir/css/Vazir" rel="stylesheet">
    <link rel="stylesheet" href="/css/frontend/style.css">
    <title>@yield('title')</title>
    @vite('resources/css/app.css') <!-- TailWind Styles -->
</head>
<body>
<!-- START HEADER SECTION -->
<header class="grid grid-cols-1 md:grid-cols-8 gap-y-5 md:gap-10 md:items-center text-center p-4 bg-gray-900 text-white sticky top-0">
    <div class="md:col-span-1">
        <img class="w-40 md:w-32 mx-auto" src="/img/Book.png" alt="Logo">
    </div>
    <div class="md:col-span-2 flex justify-center items-center">
        <form action="" method="get">
            <label for="search">
                <button type="submit"><i class="text-blue-500 hover:text-red-500 fa-brands fa-searchengin fa-2xl"></i></button>
                <input class="p-1 text-center rounded-2xl outline-none bg-transparent border-2 border-red-500" type="text" name="search" id="search" placeholder="SEARCH">
            </label>
        </form>
    </div>
    <hr class="md:hidden">
    <div class="md:col-span-3">
        <ul class="[&>li]:text-blue-500 flex justify-evenly font-bold">
            <li class="hover:text-red-500"><a href="">Shop</a></li>
            <li class="hover:text-red-500"><a href="">Card</a></li>
            <li class="hover:text-red-500"><a href="">About</a></li>
        </ul>
    </div>
    <hr class="md:hidden">
    <div class="md:col-span-2 my-2 [&>ul]:text-red-500">
        <ul class="font-bold flex justify-evenly">
            <li class="hover:text-blue-500 flex flex-col gap-5">
                <i class="fa-brands fa-github fa-xl"></i>
                <a href="">GitHub</a>
            </li>
            <li class="hover:text-blue-500 flex flex-col gap-5">
                <i class="fa-solid fa-user-secret fa-xl"></i>
                <a href="">Profile</a>
            </li>
        </ul>
    </div>
</header>
<!-- END HEADER SECTION -->
</body>
</html>

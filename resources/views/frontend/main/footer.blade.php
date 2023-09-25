<!-- START FOOTER SECTION -->
<footer class="px-7 text-white pb-5">
    <div class="hidden fixed text-center opacity-90 left-0 bottom-[15%] md:bottom-[35%] overflow-hidden rounded-r-3xl" id="footerLang">
        <ul>
            <a href="{{route('language.switch', ['fa'])}}">
                <li class="bg-white p-5 md:px-7 duration-300 hover:bg-gray-700 text-black hover:text-white">
                    {{__('custom.lang.fa')}}
                </li>
            </a>
            <a href="{{route('language.switch', ['en'])}}">
                <li class="bg-white p-5 md:px-7 duration-300 hover:bg-gray-700 text-black hover:text-white">
                    {{__('custom.lang.en')}}
                </li>
            </a>
        </ul>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-9 gap-y-5 md:gap-10 md:items-center py-4">
        <div class="col-span-1 md:col-span-3 flex justify-center items-center gap-2">
            <i class="text-red-500 fa-solid fa-location-crosshairs fa-2xl"></i>
            <div>
                <h4 class="font-bold text-red-500">{{__('custom.footer.FindUs')}}</h4>
                <a href="https://ro-ox.com/rooxteam" target="_blank"><p class="text-blue-500 hover:text-red-700">Roox
                        Team</p></a>
            </div>
        </div>
        <div class="col-span-1 md:col-span-3 flex justify-center items-center gap-2">
            <i class="text-red-500 fa-brands fa-github fa-2xl"></i>
            <div>
                <h4 class="font-bold text-red-500">{{__('custom.footer.GitHub')}}</h4>
                <a href="https://github.com/amirroox/BookLand-Dev" target="_blank"><p
                        class="text-blue-500 hover:text-red-700">BookLand-Dev</p></a>
            </div>
        </div>
        <div class="hidden md:flex md:col-span-3 justify-center items-center gap-2">
            <i class="text-red-500 fa-solid fa-envelope fa-2xl"></i>
            <div>
                <h4 class="font-bold text-red-500">{{__('custom.footer.MailUs')}}</h4>
                <a href="mailto:info@ro-ox.com"><p class="text-blue-500 hover:text-red-700">info@ro-ox.com</p></a>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER SECTION -->
<script src="https://kit.fontawesome.com/496bc94ed3.js" crossorigin="anonymous"></script>
<script src="{{ asset("js/mainScripts.js") }}"></script>

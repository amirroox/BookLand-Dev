@include('frontend.main.header')

    <!-- START MAIN SECTION -->
    <section class="p-10 bg-gray-900 text-white">
        <div class="p-5 bg-gray-600 rounded-lg">
            @yield('content')
        </div>
    </section>
    <!-- END MAIN SECTION -->

@include('frontend.main.footer')

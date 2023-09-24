<!doctype html>
<html lang="{{\Illuminate\Support\Facades\Session::get('locale')}}"
      dir="{{\Illuminate\Support\Facades\Session::get('locale') == 'fa' ? 'rtl' : 'ltr'}}">

<!-- START HEAD LINK -->
@include('frontend.main.head')
<!-- END HEAD LINK -->

<body class="mx-auto bg-gray-900">
@include('frontend.main.header')

<!-- START MAIN SECTION -->
<section class="container p-10 text-white mx-auto">
    @yield('content')
</section>
<!-- END MAIN SECTION -->

@include('frontend.main.footer')

</body>
</html>

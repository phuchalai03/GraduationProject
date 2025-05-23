<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>TravelDay - Travel & Tour Booking Website</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="assets/images/logos/favicon.png" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-5.14.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-css.css') }}">

</head>

<body>
    <div class="page-wrapper">
        <!-- main header -->
        @include('layout.partials.header')
        @include('layout.partials.hidden_bar')
        <!--Form Back Drop-->
        <div class="form-back-drop"></div>

        @yield('content')


        <!-- footer area start -->
        @include('layout.partials.footer')
        <!-- footer area end -->

    </div>
    <!--End pagewrapper-->


    <!-- Jquery -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Appear Js -->
    <script src="{{ asset('assets/js/appear.min.js') }}"></script>
    <!-- Slick -->
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Nice Select -->
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <!-- Image Loader -->
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Skillbar -->
    <script src="{{ asset('assets/js/skill.bars.jquery.min.js') }}"></script>
    <!-- Isotope -->
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <!-- AOS Animation -->
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <!-- Custom script -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    
    <script src="{{ asset('assets/js/custom-js.js') }}"></script>
    <script>
        var filterToursUrl = "{{ route('filter-tours') }}";
    </script>

    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
</body>

</html>

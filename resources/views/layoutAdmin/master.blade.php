<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets_admin/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets_admin/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets_admin/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets_admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_admin/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_admin/css/kaiadmin.min.css') }}" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layoutAdmin.partials.sidebar')
        <!-- End Sidebar -->
        <div class="main-panel">

            @include('layoutAdmin.partials.header')

            @yield('content')
            
            @include('layoutAdmin.partials.footer')
        </div>
        
        {{-- @include('layoutAdmin.partials.custom') --}}
    </div>
    <script src="{{ asset('assets_admin/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/custom.js') }}"></script>
    <script src="{{ asset('assets_admin/js/custom-add.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
</body>

</html>

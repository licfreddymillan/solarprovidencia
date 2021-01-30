<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <!-- BEGIN: Head-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Solar Providencia">
        <meta name="keywords" content="solar, providencia, cursos, astrología">
        <meta name="author" content="SOLAR PROVIDENCIA">
        <title>Solar Providencia | Admin</title>
        <link rel="apple-touch-icon" href="{{ asset('admin-template/app-assets/images/ico/apple-icon-120.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin-template/app-assets/images/ico/favicon.ico') }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/vendors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/charts/apexcharts.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/extensions/tether-theme-arrows.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/extensions/tether.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/animate/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/extensions/toastr.css') }}">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/colors.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/components.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/themes/dark-layout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/themes/semi-dark-layout.css') }}">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/core/colors/palette-gradient.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/pages/dashboard-analytics.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/pages/card-analytics.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/plugins/extensions/toastr.css') }}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin-template/assets/css/style.css') }}">
        <!-- END: Custom CSS-->

        @stack('styles')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->

    <body class="vertical-layout vertical-menu-modern 2-columns navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

        <!-- BEGIN: Header-->
        @include('layouts.partials.navbar')
        <!-- END: Header-->


        <!-- BEGIN: Main Menu-->
        @include('layouts.partials.sidebar')
        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        <!-- BEGIN: Footer-->
        <footer class="footer footer-static footer-light">
            <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent,</a>All rights Reserved</span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i class="feather icon-heart pink"></i></span>
                <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
            </p>
        </footer>
        <!-- END: Footer-->


        <!-- BEGIN: Vendor JS-->
        <script src="{{ asset('admin-template/app-assets/vendors/js/vendors.min.js') }}"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="{{ asset('admin-template/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('admin-template/app-assets/vendors/js/extensions/tether.min.js') }}"></script>
        <script src="{{ asset('admin-template/app-assets/vendors/js/extensions/shepherd.min.js') }}"></script>
        <script src="{{ asset('admin-template/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
        <script src="{{ asset('admin-template/app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
        <script src="{{ asset('admin-template/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="{{ asset('admin-template/app-assets/js/core/app-menu.js') }}"></script>
        <script src="{{ asset('admin-template/app-assets/js/core/app.js') }}"></script>
        <script src="{{ asset('admin-template/app-assets/js/scripts/components.js') }}"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <script src="{{ asset('admin-template/app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
        <!-- END: Page JS-->

        @stack('scripts')

    </body>
    <!-- END: Body-->

</html>
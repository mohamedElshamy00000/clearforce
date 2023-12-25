<!DOCTYPE html>

<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}"
    data-theme="theme-default"
    data-assets-path="{{ asset('/backend/assets/') . '/' }}"
    data-template="vertical-menu-template">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title> {{ env('APP_NAME') }} @yield('title') </title>
        
        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/fave.svg') }}" />
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('backend/assets/img/fave.svg') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('backend/assets/img/fave.svg') }}">

        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
        <!-- Icons -->
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/fontawesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/tabler-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/flag-icons.css') }}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/select2/select2.css') }}" />

        <!-- Vendors CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" /> --}}
        {{-- <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/node-waves/node-waves.css') }}" /> --}}
        {{-- <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/typeahead-js/typeahead.css') }}" /> --}}
        {{-- <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/apex-charts/apex-charts.css') }}" /> --}}
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/swiper/swiper.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

        <!-- Page CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/pages/cards-advance.css') }}" /> --}}
        <!-- Helpers -->
        <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/toastr/toastr.css') }}" />

        {{-- <script src="{{ asset('backend/assets/vendor/js/template-customizer.js') }}"></script> --}}
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('backend/assets/js/config.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/pages/page-faq.css') }}" />

        {{-- <!-- Scripts -->
        <script script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        @yield('style')
    </head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('backend.inclouds.side')

            <!-- Layout container -->
            <div class="layout-page">
            <!-- Navbar -->

                @include('backend.inclouds.nav')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @include('backend.inclouds.flash')
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    @include('backend.inclouds.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
        {{-- <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script> --}}
        {{-- <script src="{{ asset('backend/assets/vendor/libs/node-waves/node-waves.js') }}"></script> --}}

        <script src="{{ asset('backend/assets/vendor/libs/hammer/hammer.js') }}"></script>
        {{-- http://i18njs.com/#pluralisation translate in js --}}
        {{-- <script src="{{ asset('backend/assets/vendor/libs/i18n/i18n.js') }}"></script> --}}
        {{-- <script src="{{ asset('backend/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script> --}}

        <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        {{-- <script src="{{ asset('backend/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
        <script src="{{ asset('backend/assets/vendor/libs/swiper/swiper.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('backend/assets/js/main.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/select2/select2.js') }}"></script>

        <!-- Page JS -->
        {{-- <script src="{{ asset('backend/assets/js/dashboards-analytics.js') }}"></script> --}}
        <!-- Flat Picker -->
        <script src="{{ asset('backend/assets/vendor/libs/moment/moment.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

        <script src="{{ asset('backend/assets/vendor/libs/toastr/toastr.js') }}"></script>
        <!-- Form Validation -->
        <script src="{{ asset('backend/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/forms-selects.js') }}"></script>

        {{-- <script src="{{ asset('backend/assets/js/tables-datatables-advanced.js') }}"></script> --}}
        {{-- <script src="{{ asset('backend/assets/js/tables-datatables-basic.js') }}"></script> --}}

        @yield('script')
        @stack('script')
    </body>
</html>

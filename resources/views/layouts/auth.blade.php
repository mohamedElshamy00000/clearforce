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

        <title> {{ env('APP_NAME') }} @yield('title') </title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/fave.png') }}" />

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

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/node-waves/node-waves.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
        <!-- Page CSS -->
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/pages/page-auth.css') }}" />
        <!-- Helpers -->
        <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
        <script src="{{ asset('backend/assets/vendor/js/template-customizer.js') }}"></script>

        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('backend/assets/js/config.js') }}"></script>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WHRN859F');</script>
        <!-- End Google Tag Manager -->

        
    </head>

    <body>
        <!-- Content -->
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WHRN859F"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    
        <div class="authentication-wrapper authentication-cover authentication-bg">
            <div class="authentication-inner row">
                <!-- /Left Text -->
                <div class="d-none d-lg-flex col-lg-7 p-0">
                    <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                        <img
                        {{-- src="{{ asset('backend/assets/img/illustrations/auth-login-illustration-light.png') }}"
                        alt="auth-login-cover"
                        class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-login-illustration-light.png"
                        data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

                        <img --}}
                        src="{{ asset('backend/assets/img/illustrations/bg-shape-image-light.png') }}"
                        alt="auth-login-cover"
                        class="platform-bg"
                        data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                    </div>
                </div>
                <!-- /Left Text -->
                @yield('content')
            </div>
        </div>

        <!-- / Content -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

        <script src="{{ asset('backend/assets/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

        <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('backend/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('backend/assets/js/main.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ asset('backend/assets/js/pages-auth.js') }}"></script>
        @yield('script')
        @stack('script')
    </body>
</html>

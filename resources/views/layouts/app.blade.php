<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/fave.png') }}">
    <title> @yield('title') كلير فورس شريكك الموثوق لحلول التخليص الجمركي وتيسير عبور البضائع عبر الحدود </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keyword" content="فسح, منصة فسح ,منصة فسح الجمارك ,منصة فسح الالكترونية ,فسح جمركي ">
    <meta name="description" content="Your Trusted Partner for Seamless Customs Clearance Efficent, Reliable, and Cost-Effactive Customs Clearance Services to Meet Business Needs">
    <meta name="title" content="كلير فورس شريكك الموثوق لحلول التخليص الجمركي وتيسير عبور البضائع عبر الحدود ">
    <meta name="website" content="https://clearforce.co" />
    <meta name="Version" content="v1.0" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://clearforce.com/">
    <meta property="og:title" content="شريكك الموثوق لحلول التخليص الجمركي">
    <meta property="og:description" content=" كلير فورس شريكك الموثوق لحلول التخليص الجمركي وتيسير عبور البضائع عبر الحدود خدمات تخليص جمركي موثوقة وفعالة من حيث التكلفة وتلبية احتياجات العمل">
    <meta property="og:image" content="{{ asset('frontend/assets/images/placeholder-01.png') }}" />

    <!-- Twitter -->
    <meta name="twitter:image" content="{{ asset('frontend/assets/images/placeholder-01.png') }}">
    <meta name="twitter:card" content="{{ asset('frontend/assets/images/placeholder-01.png') }}">
    <meta property="twitter:url" content="https://clearforce.com/">
    <meta property="twitter:title" content="شريكك الموثوق لحلول التخليص الجمركي">
    <meta property="twitter:description" content=" كلير فورس شريكك الموثوق لحلول التخليص الجمركي وتيسير عبور البضائع عبر الحدود خدمات تخليص جمركي موثوقة وفعالة من حيث التكلفة وتلبية احتياجات العمل">
    <meta property="twitter:image" content="">
    <meta property="og:image" content="{{ asset('frontend/assets/images/placeholder-01.png') }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/fave.svg') }}" />
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('backend/assets/img/fave.svg') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('backend/assets/img/fave.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css?v1.5.0') }}">

    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/theme.css') }}">
    <meta property="og:image" content="{{ asset('backend/assets/img/placeholder-01.png') }}">
    <!-- Hotjar Tracking Code for https://clearforce.co -->
    {{-- <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:3722586,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script> --}}

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WHRN859F');</script>
    <!-- End Google Tag Manager -->

</head>

<body class="nk-body" data-menu-collapse="lg">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WHRN859F"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="nk-app-root ">
        @include('frontend.inclouds.header')

        <main class="nk-pages">
            @yield('content')
        </main>
        
        @include('frontend.inclouds.footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('frontend/assets/js/bundle.js?v1.4.0') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js?v1.4.0') }}"></script>
</body>

</html>
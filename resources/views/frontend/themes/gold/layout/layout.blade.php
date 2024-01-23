<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css"
        href="/themes/gold/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/icons/themify/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/icons/flaticon/flaticon_mooncart.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/vendor/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/icons/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/vendor/lightgallery/dist/css/lightgallery.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/vendor/lightgallery/dist/css/lg-thumbnail.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/vendor/lightgallery/dist/css/lg-zoom.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/css/main.css">
    <!-- GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-N93SWKFXY9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-N93SWKFXY9');
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-962247904"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-962247904');
    </script>
</head>

<body>
    <div class="page-wraper">
        <div id="loading-area" class="preloader-wrapper-1">
            <div>
                <span class="loader-2"></span>
                <img src="/themes/gold/assets/images/loader-logo.png" alt="reklamni materijal">
                <span class="loader"></span>
            </div>
        </div>
        <!-- Header -->
        @include('frontend.themes.gold.layout.header')
        <!-- #Header -->

        <!-- Main Content -->
        @yield('content')
        <!-- #Main Content -->

        <!-- Footer -->
        @include('frontend.themes.gold.layout.footer')
        <!-- #Footer -->

    </div>
    <!-- Scripts -->
    @include('frontend.themes.gold.layout.scripts')
    <!-- #Scripts -->
    <!-- Additional Scripts -->
    @yield('scripts')
    <!-- #Additional scripts-->
</body>

</html>

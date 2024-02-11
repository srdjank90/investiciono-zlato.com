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
    <meta property="og:image" content="@yield('image')">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css"
        href="/themes/gold/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/icons/themify/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/icons/flaticon/flaticon_mooncart.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/icons/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/themes/gold/assets/css/main.css">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TEHWNK8P7N"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-TEHWNK8P7N');
    </script>
</head>

<body>
    <div class="page-wraper">
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

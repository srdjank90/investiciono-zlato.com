<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/ml24kkv023pfzgo2l1oguevft88bqeqk7liqpzl06stq5vn5/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- -->
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <!-- -->

    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])
</head>

<body class="lp-body">

    <!-- Sidebar -->
    @include('backend.layout.sidebar')
    <!-- Content -->
    <div class="lp-content">
        <!-- Header -->
        @include('backend.layout.header')
        <!-- Content -->
        <div class="lp-main-content">
            @yield('content')
        </div>
        <!-- Footer -->
        @include('backend.layout.footer')
    </div>
    <!-- Modals -->
    @include('backend.layout.modals')
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <!-- Additional Scripts -->
    @yield('scripts')
</body>

</html>
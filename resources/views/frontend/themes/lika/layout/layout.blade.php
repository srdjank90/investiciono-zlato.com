<!DOCTYPE html>
<html lang="en" dir="">

<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Title -->
  <title>MinuteShop</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="favicon.ico" />
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="/themes/lika/assets/vendor/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/themes/lika/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css" />
  <link rel="stylesheet" href="/themes/lika/assets/vendor/swiper/swiper-bundle.min.css" />
  <!-- CSS Front Template -->
  <link rel="stylesheet" href="/themes/lika/assets/css/theme.min.css" />
  <link rel="stylesheet" href="/themes/lika/assets/css/lika.css" />
</head>

<body>
  <!-- Header -->
  @include('frontend.themes.lika.layout.header')
  <!-- End Header -->
  <main id="content" role="main">
    @yield('content')
  </main>
  <!-- Footer -->
  @include('frontend.themes.lika.layout.footer')
  <!-- End Footer -->

  <!-- Go To Top -->
  <a class="js-go-to go-to position-fixed" href="javascript:;" style="visibility: hidden" data-hs-go-to-options='{
       "offsetTop": 700,
       "position": {
         "init": {
           "right": "2rem"
         },
         "show": {
           "bottom": "2rem"
         },
         "hide": {
           "bottom": "-2rem"
         }
       }
     }'>
    <i class="bi-chevron-up"></i>
  </a>

  <!-- Offcanvas Cart -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarEmptyShoppingCart">
    <div class="offcanvas-header justify-content-end border-0 pb-0">
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body cart-container">
      <!-- Cart Body -->
    </div>
  </div>

  <!-- Scripts -->
  @include('frontend.themes.lika.layout.scripts')
  <!-- End Scripts -->
  <!-- Additional Scripts -->
  @yield('scripts')
  <!-- End additional scripts-->
</body>

</html>
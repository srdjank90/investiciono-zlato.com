<header id="header" class="navbar navbar-expand-lg navbar-end navbar-light">
    <div class="container">
        <nav class="js-mega-menu navbar-nav-wrap">
            <!-- Default Logo -->
            <a class="navbar-brand" href="{{route('frontend.index')}}" aria-label="Front">
                <img class="navbar-brand-logo" src="/themes/lika/assets/svg/logos/logo.svg" alt="Logo" />
            </a>
            <!-- End Default Logo -->

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-default">
                    <i class="bi-list"></i>
                </span>
                <span class="navbar-toggler-toggled">
                    <i class="bi-x"></i>
                </span>
            </button>
            <!-- End Toggler -->

            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() == 'frontend.index' ? 'active':''}}" href="{{route('frontend.index')}}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() == 'frontend.products' ? 'active':''}}" href="{{route('frontend.products')}}">Products</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() == 'frontend.cart' ? 'active':''}}" href="{{route('frontend.cart')}}">Cart</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() == 'frontend.checkout' ? 'active':''}}" href="{{route('frontend.checkout')}}">Checkout</a>
                    </li>

                    <li class="nav-item">
                        <!-- Search -->
                        <button class="btn btn-ghost-secondary btn-sm btn-icon d-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarSearch" aria-controls="offcanvasNavbarSearch">
                            <i class="bi-search"></i>
                        </button>
                        <!-- End Search -->

                        <!-- Shopping Cart -->
                        <button type="button" class="btn btn-ghost-secondary btn-sm btn-icon cart-number-container" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarEmptyShoppingCart" aria-controls="offcanvasNavbarEmptyShoppingCart">

                        </button>
                        <!-- End Shopping Cart -->
                    </li>
                </ul>
            </div>
            <!-- End Collapse -->
        </nav>
    </div>
</header>

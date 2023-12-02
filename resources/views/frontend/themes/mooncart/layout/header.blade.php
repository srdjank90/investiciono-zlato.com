<header class="site-header mo-left header style-2">
    <!-- Main Header -->
    <div class="header-info-bar">
        <div class="container clearfix">
            <!-- Website Logo -->
            <div class="logo-header logo-dark">
                <a href="{{ route('frontend.index') }}"><img src="/themes/mooncart/assets/images/logo.png"
                        alt="reklamni-materijal"></a>
            </div>

            <!-- EXTRA NAV -->
            <div class="extra-nav d-md-flex d-none">
                <div class="extra-cell">
                    <ul class="navbar-nav header-right">
                        <li class="nav-item info-box pe-3 d-xl-flex d-none">
                            <div class="nav-link">
                                <div class="dz-icon">
                                    <i class="flaticon flaticon-fast-delivery"></i>
                                </div>
                                <!-- EXTRA NAV-->
                                <div class="info-content">
                                    <span>BESPLATNA</span>
                                    <h6 class="title mb-0">DOSTAVA</h6>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item info-box ">
                            <div class="nav-link">
                                <div class="dz-icon">
                                    <i class="flaticon flaticon-message"></i>
                                </div>
                                <div class="info-content">
                                    <span>IMATE PITANJE</span>
                                    <h6 class="title mb-0">+381 60 011 1448</h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Global Search -->
            <div class="header-search-nav">
                <form class="header-item-search" action="/search">
                    @csrf
                    <div class="input-group search-input">
                        <input type="text" name="searchString" class="form-control"
                            aria-label="Text input with dropdown button" placeholder="Upišite šifru ili ime proizvoda">
                        <button class="btn" type="submit">
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10.0535" cy="10.5399" r="7.49047" stroke="#0D775E" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.2632 16.1387L18.1999 19.0677" stroke="#0D775E" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <!-- #Global Search -->
        </div>
    </div>
    <!-- Main Header End -->

    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar dark clearfix">
            <div class="container clearfix">
                <!-- Website Logo -->
                <div class="logo-header logo-dark">
                    <a href="index.html"><img src="/themes/mooncart/assets/images/logo.png"
                            alt="reklamni-materijal"></a>
                </div>

                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <!-- Cart In Navigation -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <ul class="header-right">
                            <li class="nav-item cart-link">
                                <a href="javascript:void(0);" class="nav-link cart-btn" data-bs-toggle="offcanvas"
                                    data-bs-target="#shoppingCart" aria-controls="shoppingCart">
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.08374 2.61947C1.08374 2.27429 1.36356 1.99447 1.70874 1.99447H3.29314C3.91727 1.99447 4.4722 2.39163 4.67352 2.98239L5.06379 4.1276H15.4584C17.6446 4.1276 19.4168 5.89981 19.4168 8.08593V11.5379C19.4168 13.7241 17.6446 15.4963 15.4584 15.4963H9.22182C7.30561 15.4963 5.66457 14.1237 5.32583 12.2377L4.00967 4.90953L3.49034 3.3856C3.46158 3.30121 3.3823 3.24447 3.29314 3.24447H1.70874C1.36356 3.24447 1.08374 2.96465 1.08374 2.61947ZM5.36374 5.3776L6.55614 12.0167C6.78791 13.3072 7.91073 14.2463 9.22182 14.2463H15.4584C16.9542 14.2463 18.1668 13.0337 18.1668 11.5379V8.08593C18.1668 6.59016 16.9542 5.3776 15.4584 5.3776H5.36374Z"
                                            fill="var(--white)" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.16479 17.8278C8.16479 17.1374 8.72444 16.5778 9.4148 16.5778H9.42313C10.1135 16.5778 10.6731 17.1374 10.6731 17.8278C10.6731 18.5182 10.1135 19.0778 9.42313 19.0778H9.4148C8.72444 19.0778 8.16479 18.5182 8.16479 17.8278Z"
                                            fill="var(--white)" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.8315 17.8278C14.8315 17.1374 15.3912 16.5778 16.0815 16.5778H16.0899C16.7802 16.5778 17.3399 17.1374 17.3399 17.8278C17.3399 18.5182 16.7802 19.0778 16.0899 19.0778H16.0815C15.3912 19.0778 14.8315 18.5182 14.8315 17.8278Z"
                                            fill="var(--white)" />
                                    </svg>
                                    <div class="cart-number-container">
                                        <span class="badge badge-circle d-none">7</span>
                                    </div>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- #Cart In Navigation -->

                <!-- Main Navigation -->
                <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <div class="logo-header">
                        <a href="{{ route('frontend.index') }}"><img src="/themes/mooncart/assets/images/logo.png"
                                alt="reklamni-materijal"></a>
                    </div>
                    <div class="browse-category-menu">
                        <a href="javascript:void(0);" class="category-btn">
                            <svg class="me-3" width="21" height="13" viewBox="0 0 21 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.248047" y="12" width="20" height="1" fill="white" />
                                <rect x="0.248047" width="20" height="1" fill="white" />
                                <rect x="0.248047" y="6" width="20" height="1" fill="white" />
                            </svg>
                            <span class="category-btn-title">
                                Kategorije proizvoda
                            </span>
                            <span class="toggle-arrow ms-auto">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.24805 9L12.248 15L18.248 9" stroke="white" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                        <div class="category-menu-items" style="display: none;">

                            <ul class="nav navbar-nav">
                                @foreach ($parentProductCategories as $pCategory)
                                    <li class="has-mega-menu cate-drop">
                                        <a href="{{ route('frontend.category.products', $pCategory->slug) }}">

                                            <span>{{ $pCategory->name }}</span>
                                            <span class="menu-icon">
                                                <svg width="16" height="16" viewBox="0 0 16 16"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 12L10 8L6 4" stroke="#24262B" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                            @if (
                                                $pCategory->name == 'Kalendarii' ||
                                                    $pCategory->name == 'Upaljači' ||
                                                    $pCategory->name == 'Olovke' ||
                                                    $pCategory->name == 'Rokovnici i notesi')
                                                <span class="badge bg-danger">HOT</span>
                                            @endif
                                            @if ($pCategory->name == 'Satovii')
                                                <span class="badge bg-success">ECO</span>
                                            @endif
                                            @if ($pCategory->name == 'Kalendari')
                                                <span class="badge bg-success">Sa štampom</span>
                                            @endif
                                        </a>
                                        <ul class="sub-menu d-none">
                                            @foreach ($pCategory->childs as $child)
                                                <li><a
                                                        href="{{ route('frontend.category.products', $child->slug) }}">{{ $child->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="mega-menu">
                                            <div class="row">
                                                @foreach ($pCategory->childs as $child)
                                                    @if ($child->products->count() > 0)
                                                        <div class="col-md-3 col-sm-4 col-6">
                                                            <a href="{{ route('frontend.category.products', $child->slug) }}"
                                                                class="menu-title">{{ $child->name }}
                                                            </a>
                                                            <ul>
                                                                @foreach ($child->products as $key => $cProd)
                                                                    @if ($key < 3)
                                                                        <li>
                                                                            <a class="d-flex justify-content-start align-items-center flex-row"
                                                                                href="{{ route('frontend.product', $cProd->slug) }}">
                                                                                @if ($cProd->files && count($cProd->files) > 0)
                                                                                    <img style="width: 64px;height:64px"
                                                                                        src="{{ $storageUrl . $cProd->files[0]['path'] }}"
                                                                                        alt="image">
                                                                                @endif
                                                                                <span
                                                                                    class="text-uppercase">{{ $cProd->name }}</span>
                                                                                @if (
                                                                                    $pCategory->name == 'Kalendarii' ||
                                                                                        $pCategory->name == 'Upaljači' ||
                                                                                        $pCategory->name == 'Olovke' ||
                                                                                        $pCategory->name == 'Rokovnici i notesi')
                                                                                    <span
                                                                                        class="badge bg-danger">HOT</span>
                                                                                @endif
                                                                                @if (
                                                                                    $pCategory->name == 'Kalendari' &&
                                                                                        ($cProd->name !== 'Mini calendar bag' && $cProd->name !== 'Calendar bag' && $cProd->name !== 'New year card'))
                                                                                    <span class="badge bg-success">Sa
                                                                                        štampom</span>
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                    <ul class="nav navbar-nav dark-nav">
                        <li class="sub-menu sub-menu-down d-block d-xl-none"><a
                                href="javascript:void(0);"><span>Kategorije
                                    proizvoda</span></a>
                            <ul class="sub-menu">
                                @foreach ($parentProductCategories as $pxCategory)
                                    <li> <a
                                            href="{{ route('frontend.category.products', $pxCategory->slug) }}">{{ $pxCategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="has-mega-menu sub-menu-down">
                            <a href="javascript:void(0);"><span>Usluge štampe</span></a>
                            <div class="mega-menu demo-menu">
                                <div class="row">
                                    <div class="col-md-3 col-6"><a
                                            href="{{ route('frontend.page', 'laserska-gravura') }}"><img
                                                src="/themes/mooncart/assets/images/laserska-gravura.jpg"
                                                alt="Laserska gravura">
                                            <span class="menu-title">Laserska
                                                gravura</span></a></div>
                                    <div class="col-md-3 col-6"><a
                                            href="{{ route('frontend.page', 'digitalna-stampa') }}"><img
                                                src="/themes/mooncart/assets/images/digitalna-stampa.jpg"
                                                alt="Digitalna štampa">
                                            <span class="menu-title">Digitalna
                                                štampa</span></a></div>
                                    <div class="col-md-3 col-6"><a
                                            href="{{ route('frontend.page', 'stampa-i-dizajn-kalendara') }}"><img
                                                src="/themes/mooncart/assets/images/stampa-kalendara.jpg"
                                                alt="Štampa i dizajn kalendara">
                                            <span class="menu-title">Štampa i dizajn kalendara</span></a></div>
                                    <div class="col-md-3 col-6"><a
                                            href="{{ route('frontend.page', 'zlatotisak') }}"><img
                                                src="/themes/mooncart/assets/images/zlatotisak.jpg" alt="Zlatotisak">
                                            <span class="menu-title">Zlatotisak</span></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="has-mega-menu sub-menu-down">
                            <a href="javascript:void(0);"><span>Usluge dizajna</span></a>
                            <div class="mega-menu demo-menu">
                                <div class="row">
                                    <div class="col-md-3 col-6"><a
                                            href="https://studiozadizajn.rs/izrada-dizajn-logotipa-najkvalitetnije-najpovoljnije"><img
                                                src="/themes/mooncart/assets/images/logotip.png" alt="logo dizan">
                                            <span class="menu-title">Logo dizajn</span></a></div>
                                    <div class="col-md-3 col-6"><a
                                            href="https://studiozadizajn.rs/izrada-dizajn-web-shopa-prodavnice-custom-CMS"><img
                                                src="/themes/mooncart/assets/images/webshop.jpg" alt="web dizajn">
                                            <span class="menu-title">Websajt dizajn</span></a></div>
                                    <div class="col-md-3 col-6"><a
                                            href="https://studiozadizajn.rs/izrada-dizajn-knjige-grafickih-standarda-brand-book"><img
                                                src="/themes/mooncart/assets/images/knjiga-grafickih-standarda.jpg"
                                                alt="Knjiga grafičkih standarda"> <span class="menu-title">Knjiga
                                                grafičkih standarda</span></a></div>
                                    <div class="col-md-3 col-6"><a
                                            href="https://studiozadizajn.rs/graficki-dizajn-stampa-reklamni-materijal"><img
                                                src="/themes/mooncart/assets/images/graficki-dizajn.jpg"
                                                alt="Grafički dizajn">
                                            <span class="menu-title">Grafički
                                                dizajn</span></a></div>
                                </div>
                            </div>
                        </li>
                        @if ($posts->count() > 0)
                            <li class="has-mega-menu sub-menu-down"><a
                                    href="javascript:void(0);"><span>Blog</span></a>
                                <div class="mega-menu blog-menu">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <div class="widget widget_post pt-2">
                                                <ul>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/1.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Wooden
                                                                    Water
                                                                    Bottles</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/2.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Eco
                                                                    friendly
                                                                    bags</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/3.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Bamboo
                                                                    toothbrushes</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/2.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Eco
                                                                    friendly
                                                                    bags</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/1.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Wooden
                                                                    Water
                                                                    Bottles</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">

                                            <div class="widget widget_post pt-2">
                                                <ul>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/1.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Wooden
                                                                    Water
                                                                    Bottles</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/2.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Eco
                                                                    friendly
                                                                    bags</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/3.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Bamboo
                                                                    toothbrushes</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/2.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Eco
                                                                    friendly
                                                                    bags</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dz-media">
                                                            <img src="/themes/mooncart/assets/images/shop/product/small/1.png"
                                                                alt="">
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name"><a href="post-standard.html">Wooden
                                                                    Water
                                                                    Bottles</a></h6>
                                                            <span class="time">July 23, 2023</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                        <li><a href="{{ route('frontend.contact') }}">Kontakt</a></li>

                    </ul>
                    <!-- Main Header End <div class="dz-social-icon">
                        <ul>
                            <li><a class="fab fa-facebook-f" target="_blank" href="javascript:void(0);"></a></li>
                            <li><a class="fab fa-twitter" target="_blank" href="javascript:void(0);"></a></li>
                            <li><a class="fab fa-linkedin-in" target="_blank" href="https://www.linkedin.com/showcase/3686700/admin/"></a></li>
                            <li><a class="fab fa-instagram" target="_blank" href="javascript:void(0);"></a></li>
                        </ul>
                    </div>-->
                </div>
                <!-- #Main Navigation -->
            </div>
        </div>
    </div>
    <!-- Main Header End -->

    <!-- Sidebar cart -->
    <div class="offcanvas dz-offcanvas offcanvas offcanvas-end " tabindex="-1" id="shoppingCart">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            &times;
        </button>
        <div class="offcanvas-body">
            <div class="product-description">
                <div class="dz-tabs">
                    <ul class="nav nav-tabs center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="shopping-cart" class="cart-number-container"
                                data-bs-toggle="tab" data-bs-target="#shopping-cart-pane" type="button"
                                role="tab" aria-controls="shopping-cart-pane" aria-selected="true">Korpa
                                <span class="badge badge-light d-none">3</span>
                            </button>
                        </li>

                    </ul>
                    <div class="tab-content pt-4" id="dz-shopcart-sidebar">
                        <div class="tab-pane fade show active cart-container" id="shopping-cart-pane" role="tabpanel"
                            aria-labelledby="shopping-cart" tabindex="0">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar cart -->
</header>

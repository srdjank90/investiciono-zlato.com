<header class="site-header mo-left header style-2 header-fixed">
    <!-- Main Header -->
    <div class="header-info-bar">
        <div class="container clearfix">
            <!-- Website Logo -->
            <div class="logo-header logo-dark">
                <a href="{{ route('frontend.index') }}"><img src="/themes/gold/assets/images/header-logo.webp"
                        alt="logo"></a>
            </div>
            <!-- EXTRA NAV -->
            <div class="extra-nav d-md-flex d-none">
                <div class="extra-cell">
                    <ul class="navbar-nav header-right">
                        <li class="nav-item info-box pe-3 d-xl-flex d-none">

                        </li>
                        <li class="nav-item info-box ">
                            <div class="nav-link">
                                <div class="dz-icon">
                                    <i class="flaticon flaticon-call-center"></i>
                                </div>
                                <div class="info-content">
                                    <span>24/7 AŽURIRANE</span>
                                    <h6 class="title mb-0">cene zlata</h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- header search nav -->
            <div class="header-search-nav">
                <form class="header-item-search form-search" method="GET" action="{{ route('frontend.search') }}">
                    <div class="input-group search-input">
                        <input type="text" class="form-control autocomplete-search" name="qty"
                            aria-label="Text input with dropdown button" placeholder="Pretraga">
                        <button class="btn" type="button">
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
        </div>
    </div>
    <!-- Main Header End -->

    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar dark clearfix">
            <div class="container clearfix">
                <!-- Website Logo -->
                <div class="logo-header logo-dark">
                    <a href="{{ route('frontend.index') }}"><img src="/themes/gold/assets/images/header-logo.webp"
                            alt="logo"></a>
                </div>
                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- EXTRA NAV -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <ul class="header-right">
                            <li class="nav-item search-link">
                                <i id="prices-updated" class="prices-updated text-white">Cene zlata upravo ažurirane</i>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Main Nav -->
                <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <div class="logo-header">
                        <a href="index"><img src="/themes/gold/assets/images/header-logo.webp" alt=""></a>
                    </div>
                    <ul class="nav navbar-nav dark-nav">
                        <li class="has-mega-menu sub-menu-down">
                            <a href="{{ route('frontend.gold') }}"><span>Investiciono zlato</span></a>
                            <div class="mega-menu demo-menu">
                                <div class="row">
                                    <div class="col-md-3 col-6"><a href="{{ route('frontend.plates') }}"><img
                                                src="/themes/gold/assets/images/demo/demo-1.webp" alt="/"> <span
                                                class="menu-title">Zlatne pločice</span></a></div>
                                    <div class="col-md-3 col-6"><a href="{{ route('frontend.bars') }}"><img
                                                src="/themes/gold/assets/images/demo/demo-2.webp" alt="/">
                                            <span class="menu-title">Zlatne poluge</span></a>
                                    </div>
                                    <div class="col-md-3 col-6"><a href="{{ route('frontend.coins') }}"><img
                                                src="/themes/gold/assets/images/demo/demo-3.webp" alt="/">
                                            <span class="menu-title">Zlatni dukati</span></a>
                                    </div>
                                    <div class="col-md-3 col-6"><a href="{{ route('frontend.best') }}"><img
                                                src="/themes/gold/assets/images/loader-logo.webp" alt="/">
                                            <span class="menu-title">Najpovoljnije/Najnepovoljnije</span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="has-mega-menu sub-menu-down">
                            <a href="{{ route('frontend.companies') }}"><span>Gde kupiti</span></a>
                            <div class="mega-menu demo-menu">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 col-6">
                                                <ul>
                                                    @foreach ($companies as $key => $company)
                                                        @if ($key < 3)
                                                            <li class="mb-2">
                                                                <a target="_blank" style="width:100px"
                                                                    href="{{ $company->url }}">

                                                                    <img src="{{ $company->image_url }}"
                                                                        alt=""></a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-6">
                                                <ul>
                                                    @foreach ($companies as $key => $company)
                                                        @if ($key > 2 && $key < 6)
                                                            <li class="mb-2">
                                                                <a target="_blank" style="width:100px"
                                                                    href="{{ $company->url }}">
                                                                    <img src="{{ $company->image_url }}"
                                                                        alt=""></a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-6">
                                                <ul>
                                                    @foreach ($companies as $key => $company)
                                                        @if ($key > 5)
                                                            <li class="mb-2">
                                                                <a target="_blank" style="width:100px"
                                                                    href="{{ $company->url }}">

                                                                    <img src="{{ $company->image_url }}"
                                                                        alt=""></a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <div class="col-md-3 col-sm-4 col-6 d-md-block">
                                                <div class="adv-media">
                                                    <a href="https://forum.investiciono-zlato.com/"><img
                                                            src="/themes/gold/assets/images/demo/demo-4.webp"
                                                            alt="/"></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="has-mega-menu sub-menu-down"><a
                                href="{{ route('frontend.posts') }}"><span>Blog</span></a>
                            <div class="mega-menu blog-menu">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <a href="javascript:;" class="menu-title">Najbolji saveti</a>
                                        <div class="widget widget_post pt-2">
                                            <ul>
                                                @foreach ($najboljiSaveti as $post)
                                                    <li>
                                                        <div class="dz-media">
                                                            @if ($post->image)
                                                                <img src="{{ $storageUrl . $post->image->path }}"
                                                                    style="width:50px;height:50px;object-fit:cover"
                                                                    alt="/">
                                                            @endif
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name">
                                                                <a href="{{ route('frontend.post', $post->slug) }}">
                                                                    {{ $post->title }}
                                                                </a>
                                                            </h6>
                                                            <span class="time d-none">23.jul 2023.</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <a href="javascript:;" class="menu-title">Najnoviji tekstovi</a>
                                        <div class="widget widget_post pt-2">
                                            <ul>
                                                @foreach ($najnovijiTekstovi as $post)
                                                    <li>
                                                        <div class="dz-media">
                                                            @if ($post->image)
                                                                <img src="{{ $storageUrl . $post->image->path }}"
                                                                    style="width:50px;height:50px;object-fit:cover"
                                                                    alt="/">
                                                            @endif
                                                        </div>
                                                        <div class="dz-content">
                                                            <h6 class="name">
                                                                <a href="{{ route('frontend.post', $post->slug) }}">
                                                                    {{ $post->title }}
                                                                </a>
                                                            </h6>
                                                            <span class="time d-none">23.jul 2023.</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="sub-menu"><a href="{{ route('frontend.exchange') }}"><span>Kursna lista
                                    NBS</span></a></li>
                        <li class="sub-menu"><a href="{{ route('frontend.price') }}"><span>Cena zlata</span></a>
                        </li>
                        <li><a href="{{ route('frontend.contact') }}">Kontakt</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header End -->

    <!-- SearchBar -->
    <div class="dz-search-area dz-offcanvas offcanvas offcanvas-top d-none" tabindex="-1" id="offcanvasTop">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            &times;
        </button>
        <div class="container">
            <form class="header-item-search form-search" method="GET" action="{{ route('frontend.search') }}">
                <div class="input-group search-input">
                    <input type="text" class="form-control autocomplete-search" name="qty"
                        aria-label="Text input with dropdown button" placeholder="Unesi ime proizvoda">
                    <button class="btn" type="button">
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
    </div>
    <!-- SearchBar -->
</header>

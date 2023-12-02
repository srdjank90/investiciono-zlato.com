@extends('frontend.themes.mooncart.layout.layout')
@section('title',
    isset($setting['setting_seo_title_opt'])
    ? $setting['setting_seo_title_opt']
    : 'Reklamni materijal by
    Jefimija dizajn')
@section('description', isset($setting['setting_seo_description_opt']) ? $setting['setting_seo_description_opt'] : '')
@section('keywords', isset($setting['setting_seo_keywords_opt']) ? $setting['setting_seo_keywords_opt'] : '')
@section('content')
    <div class="page-content bg-white">

        <!--Hero Section -->
        <div class="main-slider style-2">
            <div class="main-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide bg-light">
                        <div class="container">
                            <div class="banner-content">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-7 align-self-center">
                                        <div class="swiper-content">
                                            <div class="content-info">
                                                <h1 class="offer-title mb-0" data-swiper-parallax="-20">100+</h1>
                                                <h2 class="title mb-2" data-swiper-parallax="-20">novih promo proizvoda,
                                                </h2>
                                                <p class="sub-title mb-0" data-swiper-parallax="-40">kao i besplatna dostava
                                                    za sve porudžbine veće od 198 eura</p>
                                            </div>
                                            <div class="content-btn" data-swiper-parallax="-60">

                                                <a class="btn btn-outline-secondary " href="/products">DETALJNIJE</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-5">
                                        <div class="banner-media">
                                            <div class="img-preview" data-swiper-parallax="-100">
                                                <img src="/themes/mooncart/assets/images/main-slider/slider2/pic2.jpg"
                                                    alt="banner-media">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide bg-light">
                        <div class="container">
                            <div class="banner-content">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-7 align-self-center">
                                        <div class="swiper-content">
                                            <div class="content-info">
                                                <h1 class="offer-title mb-0" data-swiper-parallax="-20">DIZAJN</h1>
                                                <h2 class="title mb-2" data-swiper-parallax="-20">prema Vašim željama.</h2>
                                                <p class="sub-title mb-0" data-swiper-parallax="-40">Unesite stil u Vaše
                                                    poslovanje i oduševite klijente!</p>
                                            </div>
                                            <div class="content-btn" data-swiper-parallax="-60">

                                                <a class="btn btn-outline-secondary " href="">DETALJNIJE</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-5">
                                        <div class="banner-media">
                                            <div class="img-preview" data-swiper-parallax="-100">
                                                <img src="/themes/mooncart/assets/images/main-slider/slider2/pic1.jpg"
                                                    alt="banner-media">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('frontend.contact') }}" class="service-btn btn-dark">Imate pitanje?</a>
            </div>
        </div>
        <!--#Hero Section -->

        <!-- Product Bestseller Categories -->
        <section class="content-inner-1 py-0 overlay-white-middle">
            <div class="container-fluid p-3">
                <div class="swiper swiper-product">
                    <div class="swiper-wrapper product-style2">
                        <div class="swiper-slide">
                            <div class="product-box style-2 wow fadeInUp" data-wow-delay="0.1s"
                                style="background-image: url('/themes/mooncart/assets/images/gym/1.png');">
                                <div class="product-content">
                                    <div class="main-content">
                                        <h2 class="product-name">Kalendari za 2024</h2>
                                        <span class="offer">NAJBOLJE CENE U SRBIJI</span>
                                    </div>
                                    <a href="{{ route('frontend.category.products', 'kalendari') }}"
                                        class="btn btn-outline-secondary">SVI KALENDARI</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-box style-2 wow fadeInUp" data-wow-delay="0.2s"
                                style="background-image: url('/themes/mooncart/assets/images/gym/2.png');">
                                <div class="product-content">
                                    <div class="main-content">
                                        <h2 class="product-name">Rokovnici i notesi</h2>
                                        <span class="offer">NOVI I STARI MODELI</span>
                                    </div>
                                    <a href="{{ route('frontend.category.products', 'rokovnici') }}"
                                        class="btn btn-outline-secondary">SVI ROKOVNICI</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-box style-2 wow fadeInUp" data-wow-delay="0.3s"
                                style="background-image: url('/themes/mooncart/assets/images/gym/3.png');">
                                <div class="product-content">
                                    <div class="main-content">
                                        <h2 class="product-name">Olovke</h2>
                                        <span class="offer">PLASTIČNE I METALNE</span>
                                    </div>
                                    <a href="{{ route('frontend.category.products', 'olovke') }}"
                                        class="btn btn-outline-secondary">SVE OLOVKE</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-box style-2 wow fadeInUp" data-wow-delay="0.4s"
                                style="background-image: url('/themes/mooncart/assets/images/gym/4.png');">
                                <div class="product-content">
                                    <div class="main-content">
                                        <h2 class="product-name">Upaljači</h2>
                                        <span class="offer">UBEDLJIVO NAJVEĆI IZBOR</span>
                                    </div>
                                    <a href="{{ route('frontend.category.products', 'upaljaci') }}"
                                        class="btn btn-outline-secondary">SVI UPALJAČI</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- #Product Bestseller Categories -->

        <!-- Info Box -->
        <section class="content-inner-3 overlay-white-dark"
            style="background-image: url('/themes/mooncart/assets/images/background/bg2.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="container">
                <div class="row justify-content-center gx-sm-1">
                    <div class="col-lg-4 col-md-4 col-sm-4 p-b30 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="icon-bx-wraper style-1 text-center">
                            <div class="icon-bx">
                                <i class="flaticon flaticon-fast-delivery"></i>
                            </div>
                            <div class="icon-content">
                                <h3 class="dz-title m-b0">BESPLATNA DOSTAVA</h3>
                                <div class="square"></div>
                                <p class="font-20">Iskoristite mogućnost besplatna dostave za sve Vaše porudžbine veće od
                                    198 eura.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 p-b30 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-bx-wraper style-1 text-center">
                            <div class="icon-bx">
                                <i class="flaticon flaticon-message"></i>
                            </div>
                            <div class="icon-content">
                                <h3 class="dz-title m-b0">IMATE PITANJE</h3>
                                <div class="square"></div>
                                <p class="font-20">Stojimo Vam na raspolaganju za sva Vaša pitanja i nedoumice.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 p-b30 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="icon-bx-wraper style-1 text-center">
                            <div class="icon-bx">
                                <i class="flaticon flaticon-money-back-guarantee"></i>
                            </div>
                            <div class="icon-content">
                                <h3 class="dz-title m-b0">BOLJA CENA</h3>
                                <div class="square"></div>
                                <p class="font-20">Ubedljivo najpovoljniji dizajn i štampa reklamnog materijala u Srbiji.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- #Info Box -->

        <!-- Bestseller Products - CONNECTED -->
        <section class="content-inner-1 overlay-white-middle overflow-hidden">
            <div class="container">
                <div class="section-head style-2 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="left-content">
                        <h2 class="title">Najpopularniji proizvodi</h2>
                        <p>Pogledajte neke od najpopularnijih proizvoda u našoj ponudi</p>
                    </div>
                    <a href="{{ route('frontend.products') }}"
                        class="text-secondary font-14 d-flex align-items-center gap-1">Svi proizvodi
                        <i class="icon feather icon-chevron-right font-18"></i>
                    </a>
                </div>
                <div class="swiper-btn-center-lr">
                    <div class="swiper swiper-four">
                        <div class="swiper-wrapper">
                            @foreach ($bestSellerProducts as $key => $bestSeller)
                                <div class="swiper-slide">
                                    <div class="shop-card wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="dz-media">
                                            @if (count($bestSeller->files) > 0)
                                                <img src="{{ $storageUrl . $bestSeller->files[0]['path'] }}"
                                                    alt="image">
                                            @endif
                                            <div class="shop-meta">
                                                <a href="{{ route('frontend.product', $bestSeller->slug) }}"
                                                    class="btn btn-secondary btn-icon">
                                                    <i class="fa-solid fa-eye d-md-none d-block"></i>
                                                    <span class="d-md-block d-none">Detaljnije</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dz-content">
                                            <h5 class="title text-uppercase"><a
                                                    href="{{ route('frontend.product', $bestSeller->slug) }}">{{ $bestSeller->name }}</a>
                                            </h5>
                                            <p style="padding: 0;margin: 0;line-height: 16px;font-size: 12px;">
                                                {{ $bestSeller->subtitle }}</p>
                                            <h6 class="price">
                                                @if ($bestSeller->price_old)
                                                    <del>@priceFormat($bestSeller->price_old)
                                                        {{ $currency }}</del>
                                                @endif
                                                @priceFormat($bestSeller->price)
                                                {{ $currency }}
                                            </h6>
                                            <p style="padding: 0;margin: 0;line-height: 16px;font-size: 12px;">
                                                {{ $bestSeller->quantity }}</p>
                                        </div>
                                        <div class="product-tag">
                                            <span class="badge badge-primary">Najprodavanije</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pagination-align">
                        <div class="tranding-button-prev btn-prev">
                            <i class="flaticon flaticon-left-chevron"></i>
                        </div>
                        <div class="tranding-button-next btn-next">
                            <i class="flaticon flaticon-chevron"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- #Bestseller Products -->

        <!-- Newsletter -->
        <section class="overlay-black-light newsletter-wrapper style-2"
            style="background-image: url('/themes/mooncart/assets/images/background/bg4.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="container">
                <div class="subscride-inner wow fadeInUp" data-wow-delay="0.2s">
                    <div class="row justify-content-center text-center">
                        <div class="col-xl-12 col-lg-12">
                            <div class="section-head">
                                <h3 class="title">PRIJAVITE SE NA NAŠU EMAIL LISTU</h3>
                                <p class="sub-title">Budite uvek u toku sa najnovijim proizvodima i popustima</p>
                            </div>
                            <form class="dzSubscribe" action="" method="post">
                                <div class="form-group">
                                    <div class="input-group mb-0">
                                        <input name="subscribe-email" required="required" type="email"
                                            class="form-control" placeholder="Unesite Vašu email adresu">
                                        <div class="input-group-addon">
                                            <button name="submit" value="Submit" type="submit" class="btn">
                                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none">
                                                    <path d="M4.20972 10.7344H15.8717" stroke="#0D775E" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M10.0408 4.90112L15.8718 10.7345L10.0408 16.5678"
                                                        stroke="#0D775E" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- #Newsletter -->

        <!-- Blog -->
        @if ($posts->count() > 0)
            <section class="content-inner overlay-white-middle">
                <div class="container">
                    <div class="section-head style-2 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="left-content">
                            <h2 class="title">Blog</h2>
                            <p>Najnoviji saveti i vodiči za nabavku reklamnog materijala.</p>
                        </div>
                        <a href="{{ route('frontend.posts') }}"
                            class="text-secondary font-14 d-flex align-items-center gap-1 text-nowrap">Pogledajte sve
                            savete
                            <i class="icon feather icon-chevron-right font-18"></i>
                        </a>
                    </div>
                    <div class="swiper swiper-blog-post">
                        <div class="swiper-wrapper">

                            @foreach ($posts as $post)
                                <div class="swiper-slide">
                                    <div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="dz-media">
                                            @if ($post->image)
                                                <img src="{{ $storageUrl . $post->image->path }}" alt="">
                                            @endif
                                            <div class="post-date d-none">17 May 2023</div>
                                        </div>
                                        <div class="dz-info">
                                            <div class="dz-meta">
                                                @if ($post->categories->count() > 0)
                                                    <ul>
                                                        @foreach ($post->categories as $category)
                                                            <li><a href="javascript:void(0);">{{ $category->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                            <h4 class="dz-title mb-0">
                                                <a href="{{ route('frontend.post', $post->slug) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- #Blog -->


    </div>
@endsection

@extends('frontend.themes.gold.layout.layout')
@section('title', isset($setting['setting_seo_title_opt']) ? $setting['setting_seo_title_opt'] : 'Zlatoteka')
@section('description', isset($setting['setting_seo_description_opt']) ? $setting['setting_seo_description_opt'] : '')
@section('keywords', isset($setting['setting_seo_keywords_opt']) ? $setting['setting_seo_keywords_opt'] : '')
@section('content')
    <div class="page-content bg-white">
        <!-- Companies -->
        <section class="content-inner-1 overlay-white-middle companies border-top">
            <div class="container">
                <div class="section-inner">
                    <div class="section-head style-2 p-lg-b0 p-md-b30 wow fadeInUp" data-wow-delay="0.1s"
                        style="visibility: hidden; animation-delay: 0.1s; animation-name: none;">
                        <h1 class="title wow fadeInUp text-primary">Kupite investiciono zlato u Srbiji online</h1>
                        <p>Zlatoteka poredi cene zlata u realnom vremenu na <b>devet najpovoljnijih online prodavnica
                                investicionog zlata u Srbiji</b>, štedi Vaše vreme i Vaš novac.</p>
                    </div>
                    <div class="row gx-3 companies-inner">
                        @foreach ($companies as $company)
                            <div class="col-md-4 col-sm-4 col-6 p-lg-b30 p-b20 wow fadeInUp" data-wow-delay="0.1s"
                                style="visibility: hidden; animation-delay: 0.1s; animation-name: none;">
                                <a target="_blank" href="{{ $company->url }}" class="companies-wrapper">
                                    <div class="companies-media">
                                        <img src="{{ $company->image_url }}" alt="">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Companies End -->

        <!-- Products -->
        <section class="content-inner-1 overlay-white-middle about-products2">
            <img src="/themes/gold/assets/images/bg-triangle3.png" class="bg-img" alt="">
            <img src="/themes/gold/assets/images/bg-triangle4.png" class="bg-img2" alt="">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-xl-6 col-lg-6">
                        <div class="section-head style-2 wow fadeInUp" data-wow-delay="0.2s"
                            style="visibility: hidden; animation-delay: 0.2s; animation-name: none;">
                            <h2 class="sub-title">Zlatne pločice</h2>
                            <p>Zlatne pločice deo su našeg bogatog asortimana proizvoda nastalih u globalno renomiranim
                                livnicama koje se pridržavaju najviših standarda proizvodnje. Kupce proizvoda u ponudi naših
                                najpovoljnijih online prodavnica investicionog zlata očekuju zlatne pločice težinskih
                                denominacija od 1g do 20g renomiranih svetskih brendova. Zbog svoje fine izrade i najviše
                                čistoće zlata („Fine Gold“) predstavljaju visoko likvidne investicione formate. </p>
                        </div>
                        <div class="product-specification wow fadeInUp" data-wow-delay="0.3s"
                            style="visibility: hidden; animation-delay: 0.3s; animation-name: none;">
                            <h4 class="specification-title">Specifikacije</h4>
                        </div>
                        <!-- Multiple table Prices -->
                        @foreach ($goldenPlates as $plate)
                            <div class="prices-table-gold wow fadeInUp" data-wow-delay="0.4s"
                                style="visibility: hidden; animation-delay: 0.4s; animation-name: none;">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-uppercase">Težina pločice <span>od
                                                {{ $plate['description'] }}:</span></h4>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold mb-2">
                                        Name
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold">
                                        Prodajna
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold">
                                        Otkupna
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold">
                                        Raspon
                                    </div>
                                    @foreach ($plate['products'] as $product)
                                        <div
                                            class="gold-column col-12 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column position-relative">
                                            <div class="d-md-none fw-bold"><small>Naziv</small></div>
                                            @if ($product->product_image_url && $product->product_image_url != '')
                                                <img class="table-product-image" src="{{ $product->product_image_url }}"
                                                    alt="">
                                            @endif

                                            <a target="_blank" class="table-product-name text-primary fw-bold"
                                                href="{{ $product['url'] }}">
                                                {{ $product['name'] }}
                                                <img width="45" src="{{ $product->company->image_url }}"
                                                    title="{{ $product->company->name }}" alt=""></a>

                                        </div>
                                        <div
                                            class="gold-column col-12 col-md-3 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column">
                                            <div class="d-md-none fw-bold"><small>Prodajna</small></div>
                                            @if ($product['selling_price'] != '0' && $product['selling_price'] != null)
                                                <div>
                                                    @priceFormat($product['selling_price'])
                                                    {{ $currency }} <br>
                                                    @if ((float) $product['selling_price_percentage_change'] > 0)
                                                        <small class="text-danger">@priceFormat($product['selling_price_percentage_change'])%
                                                            <i class="fa-solid fa-arrow-up"></i></small>
                                                    @endif
                                                    @if ((float) $product['selling_price_percentage_change'] < 0)
                                                        <small class="text-success">@priceFormat($product['selling_price_percentage_change'])%
                                                            <i class="fa-solid fa-arrow-down"></i></small>
                                                    @endif
                                                </div>
                                            @else
                                                <div>Trenutno nedostupno</div>
                                            @endif
                                        </div>
                                        <div
                                            class="gold-column col-12 col-md-3 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column">
                                            <div class="d-md-none fw-bold"><small>Otkupna</small></div>
                                            @if ($product['purchase_price'] != '0' && $product['purchase_price'] != null)
                                                <div>
                                                    @priceFormat($product['purchase_price'])
                                                    {{ $currency }} <br>
                                                    @if ((float) $product['purchase_price_percentage_change'] > 0)
                                                        <small class="text-danger">@priceFormat($product['purchase_price_percentage_change'])%
                                                            <i class="fa-solid fa-arrow-up"></i></small>
                                                    @endif
                                                    @if ((float) $product['purchase_price_percentage_change'] < 0)
                                                        <small class="text-success">@priceFormat($product['purchase_price_percentage_change'])%
                                                            <i class="fa-solid fa-arrow-down"></i></small>
                                                    @endif
                                                </div>
                                            @else
                                                <div>Trenutno nedostupno</div>
                                            @endif
                                        </div>
                                        <div
                                            class="gold-column col-12 col-md-3 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column">
                                            <div class="d-md-none fw-bold"><small>Raspon</small></div>
                                            @if ($product['selling_price'] > 0 && $product['purchase_price'] > 0)
                                                {{ round(($product['selling_price'] / $product['purchase_price'] - 1) * 100, 2) }}
                                                %
                                            @else
                                                Trenutno nedostupno
                                            @endif

                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 mb-4">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('frontend.category', $plate['slug']) }}">Sve
                                            zlatne pločice od
                                            {{ $plate['name'] }} u ponudi</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- #Multiple table Prices -->
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="section-head style-2 wow fadeInUp" data-wow-delay="0.2s"
                            style="visibility: hidden; animation-delay: 0.2s; animation-name: none;">
                            <h2 class="sub-title">Zlatne poluge</h2>
                            <p>Zlatne poluge su čest izbor ulagača zainteresovanih za investiciono zlato. One dolaze iz
                                pouzdanih livnica svetskog renomea, upakovane su u blister pakovanja u kojima se nalaze LBMA
                                sertifikati koji garantuju kvalitet proizvodnje i druge bitne parametre. Zlatne poluge
                                težinskih denominacija od 1unce do 1kg renomiranih svetskih brendova. Zbog svoje fine izrade
                                i najviše čistoće zlata („Fine Gold“) predstavljaju visoko likvidne investicione formate.
                            </p>
                        </div>
                        <div class="product-specification wow fadeInUp" data-wow-delay="0.3s"
                            style="visibility: hidden; animation-delay: 0.3s; animation-name: none;">
                            <h4 class="specification-title">Specifikacije</h4>
                        </div>

                        <!-- Multiple table Prices -->
                        @foreach ($goldenBars as $bar)
                            <div class="prices-table-gold wow fadeInUp" data-wow-delay="0.4s"
                                style="visibility: hidden; animation-delay: 0.4s; animation-name: none;">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-uppercase">Težina poluge <span>od
                                                {{ $bar['description'] }}:</span></h4>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold mb-2">
                                        Name
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold">
                                        Prodajna
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold">
                                        Otkupna
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold">
                                        Raspon
                                    </div>
                                    @foreach ($bar['products'] as $product)
                                        <div
                                            class="gold-column col-12 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column position-relative">
                                            <div class="d-md-none fw-bold"><small>Naziv</small></div>
                                            <!-- Hover Image -->
                                            @if ($product->product_image_url && $product->product_image_url != '')
                                                <img class="table-product-image" src="{{ $product->product_image_url }}"
                                                    alt="">
                                            @endif
                                            <a target="_blank" class="table-product-name text-primary fw-bold"
                                                href="{{ $product['url'] }}">
                                                {{ $product['name'] }} <img width="30"
                                                    src="{{ $product->company->image_url }}"
                                                    title="{{ $product->company->name }}" alt=""></a>
                                        </div>
                                        <div
                                            class="gold-column col-12 col-md-3 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column">
                                            <div class="d-md-none fw-bold"><small>Prodajna</small></div>
                                            @if ($product['selling_price'] != '0' && $product['selling_price'] != null)
                                                <div>
                                                    @priceFormat($product['selling_price'])
                                                    {{ $currency }} <br>
                                                    @if ((float) $product['selling_price_percentage_change'] > 0)
                                                        <small class="text-danger">@priceFormat($product['selling_price_percentage_change'])%
                                                            <i class="fa-solid fa-arrow-up"></i></small>
                                                    @endif
                                                    @if ((float) $product['selling_price_percentage_change'] < 0)
                                                        <small class="text-success">@priceFormat($product['selling_price_percentage_change'])%
                                                            <i class="fa-solid fa-arrow-down"></i></small>
                                                    @endif
                                                </div>
                                            @else
                                                <div>Trenutno nedostupno</div>
                                            @endif
                                        </div>
                                        <div
                                            class="gold-column col-12 col-md-3 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column">
                                            <div class="d-md-none fw-bold"><small>Otkupna</small></div>
                                            @if ($product['purchase_price'] != '0' && $product['purchase_price'] != null)
                                                <div>
                                                    @priceFormat($product['purchase_price'])
                                                    {{ $currency }} <br>
                                                    @if ((float) $product['purchase_price_percentage_change'] > 0)
                                                        <small class="text-danger">@priceFormat($product['purchase_price_percentage_change'])%
                                                            <i class="fa-solid fa-arrow-up"></i></small>
                                                    @endif
                                                    @if ((float) $product['purchase_price_percentage_change'] < 0)
                                                        <small class="text-success">@priceFormat($product['purchase_price_percentage_change'])%
                                                            <i class="fa-solid fa-arrow-down"></i></small>
                                                    @endif
                                                </div>
                                            @else
                                                <div>Trenutno nedostupno</div>
                                            @endif
                                        </div>
                                        <div
                                            class="gold-column col-12 col-md-3 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column">
                                            <div class="d-md-none fw-bold"><small>Raspon</small></div>
                                            @if ($product['selling_price'] > 0 && $product['purchase_price'] > 0)
                                                {{ round(($product['selling_price'] / $product['purchase_price'] - 1) * 100, 2) }}
                                                %
                                            @else
                                                Trenutno nedostupno
                                            @endif

                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 mb-4">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('frontend.category', $bar['slug']) }}">Sve zlatne poluge od
                                            {{ $bar['name'] }} u ponudi</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- #Multiple table Prices -->
                    </div>
                </div>
            </div>
        </section>
        <!-- About products2 End -->

        <!-- Get In Touch -->
        <section class="get-in-touch wow fadeIn" data-wow-delay="0.3s"
            style="visibility: hidden; animation-delay: 0.3s; animation-name: none;">
            <div class="m-r100 m-md-r0 m-sm-r0">
                <h3 class="dz-title mb-lg-0 mb-3">Imate pitanje ?
                    <span>Naše ljubazno osoblje, stoji Vam na raspolaganju.</span>
                </h3>
            </div>
            <a href="{{ route('frontend.contact') }}" class="btn btn-light">Postavi pitanje</a>
        </section>
        <!-- Get In Touch End -->
    </div>
@endsection

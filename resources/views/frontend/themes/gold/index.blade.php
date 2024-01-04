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
                        <!-- Category Prices -->
                        @foreach ($goldenPlates as $plate)
                            <div class="category-prices mb-3">
                                <h4 class="text-uppercase">Težina pločice <span>od {{ $plate['description'] }}:</span></h4>
                                <table class="table wow fadeInUp product-prices-table" data-wow-delay="0.4s"
                                    style="visibility: hidden; animation-delay: 0.4s; animation-name: none;">
                                    <thead>
                                        <td class="text-start fw-bold">Naziv</td>
                                        <td class="text-end fw-bold">Prodajna cena</td>
                                        <td class="text-end fw-bold">Otkupna cena</td>
                                    </thead>
                                    <tbody>
                                        @foreach ($plate['products'] as $product)
                                            <tr>
                                                <td class="text-start"><a target="_blank" class="text-primary fw-bold"
                                                        href="{{ $product['url'] }}">
                                                        {{ $product['name'] }}</a>
                                                </td>
                                                <td class="text-end">
                                                    @if ($product['selling_price'] != '0' && $product['selling_price'] != null)
                                                        @if ((float) $product['selling_price_percentage_change'] > 0)
                                                            <span class="text-primary">@priceFormat($product['selling_price_percentage_change'])%
                                                            </span>
                                                        @endif
                                                        @if ((float) $product['selling_price_percentage_change'] < 0)
                                                            <span class="text-danger">@priceFormat($product['selling_price_percentage_change'])%
                                                            </span>
                                                        @endif
                                                        @priceFormat($product['selling_price'])
                                                        {{ $currency }}
                                                    @else
                                                        Trenutno nedostupno
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    @if ($product['purchase_price'] != '0' && $product['purchase_price'] != null)
                                                        @if ((float) $product['purchase_price_percentage_change'] > 0)
                                                            <span class="text-primary">@priceFormat($product['purchase_price_percentage_change'])%
                                                            </span>
                                                        @endif
                                                        @if ((float) $product['purchase_price_percentage_change'] < 0)
                                                            <span class="text-danger">@priceFormat($product['purchase_price_percentage_change'])%
                                                            </span>
                                                        @endif
                                                        @priceFormat($product['purchase_price'])
                                                        {{ $currency }}
                                                    @else
                                                        Trenutno nedostupno
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-start mt-3 mb-4">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('frontend.category', $plate['slug']) }}">Sve
                                        zlatne pločice od
                                        {{ $plate['name'] }} u ponudi</a>
                                </div>
                            </div>
                        @endforeach
                        <!-- #Category Prices -->
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
                        <!-- Category Prices -->
                        @foreach ($goldenBars as $bar)
                            <div class="category-prices mb-3">
                                <h4 class="text-uppercase">Težina poluge <span>od {{ $bar['description'] }}:</span></h4>
                                <table class="table wow fadeInUp product-prices-table" data-wow-delay="0.4s"
                                    style="visibility: hidden; animation-delay: 0.4s; animation-name: none;">
                                    <thead>
                                        <td class="text-start fw-bold">Naziv</td>
                                        <td class="text-end fw-bold">Prodajna cena</td>
                                        <td class="text-end fw-bold">Otkupna cena</td>
                                    </thead>
                                    <tbody>
                                        @foreach ($bar['products'] as $product)
                                            <tr>
                                                <td class="text-start"><a target="_blank" class="text-primary fw-bold"
                                                        href="{{ $product['url'] }}">
                                                        {{ $product['name'] }}</a>
                                                </td>
                                                <td class="text-end">
                                                    @if ($product['selling_price'] != '0' && $product['selling_price'] != null)
                                                        @priceFormat($product['selling_price'])
                                                        {{ $currency }}
                                                    @else
                                                        Trenutno nedostupno
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    @if ($product['purchase_price'] != '0' && $product['purchase_price'] != null)
                                                        @priceFormat($product['purchase_price'])
                                                        {{ $currency }}
                                                    @else
                                                        Trenutno nedostupno
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-start mt-3 mb-4">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('frontend.category', $bar['slug']) }}">Sve zlatne poluge od
                                        {{ $bar['name'] }} u ponudi</a>
                                </div>
                            </div>
                        @endforeach
                        <!-- #Category Prices -->
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
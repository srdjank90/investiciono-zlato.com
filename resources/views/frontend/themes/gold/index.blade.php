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
                    <div class="section-head style-2 p-lg-b0 p-md-b30">
                        <h1 class="title">Kupite <span class="text-primary">investiciono zlato</span> u Srbiji
                            online</h1>
                        <p>Sezame, otvori se poredi cene zlata u realnom vremenu na <b>devet najpovoljnijih online
                                prodavnica
                                investicionog zlata u Srbiji</b>, štedi Vaše vreme i Vaš novac. U Srbiji, pod investicionim
                            zlatom se podrazumeva zlato u obliku zlatnih poluga ili zlatnih pločica, čistoće najmanje
                            995/1000, kao i obliku zlatnih dukata čistoće najmanje 900/1000, koji su kovani nakon 1800.
                            godine, i koji su bili ili su zakonsko sredstvo plaćanja u zemlji porekla.</p>
                    </div>
                    <div class="row gx-3 companies-inner">
                        @foreach ($companies as $company)
                            <div class="col-md-4 col-sm-4 col-6 p-lg-b30 p-b20">
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
            <img src="/themes/gold/assets/images/bg-triangle3.webp" class="bg-img" alt="">
            <img src="/themes/gold/assets/images/bg-triangle4.webp" class="bg-img2" alt="">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-xl-6 col-lg-6">
                        <div class="section-head style-2">
                            <h3 class="sub-title">Zlatne pločice</h3>
                            <div>Zlatne pločice su male zlatne poluge koje služe kao oblik investicionog zlata. Proizvode ih
                                renomirani proizvođači koristeći napredne tehnologije kako bi osigurali visok kvalitet. Neki
                                od istaknutih proizvođača uključuju Argor Heraeus, C.Hafner, Valcambi Suisse, PAMP, The
                                Royal Mint i Münze Österreich, svaki garantujući visok nivo sigurnosti i autentičnosti
                                svojih proizvoda. Svaka pločica je LBMA sertifikovana za svoju finoću, obično 999,9, i
                                poreklom su iz zemalja poput Nemačke, Austrije, Velike Britanije i Švajcarske. Cene ovih
                                zlatnih pločica variraju u zavisnosti od veličine i tržišnih uslova u trenutku kupovine.
                            </div>
                        </div>
                        <div class="product-specification d-none">
                            <h4 class="specification-title">Specifikacije</h4>
                        </div>
                        <!-- Multiple table Prices -->
                        @foreach ($goldenPlates as $plate)
                            <div class="prices-table-gold">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-uppercase">Cena zlatne pločice <span>od
                                                {{ $plate['description'] }}:</span></h4>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold mb-2">
                                        Naziv
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

                                            @php
                                                if (str_contains($product->unique_key, 'CH')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/CH.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'AH')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/AH.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'FJ')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/FJ.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'HM')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/HM.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'RM')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/RM.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'VP')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/VP.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'VS')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/VS.webp" alt="">';
                                                }
                                            @endphp

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
                                        <a class="btn btn-primary btn-sm w-sm-100"
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
                        <div class="section-head style-2">
                            <h3 class="sub-title">Zlatne poluge</h3>
                            <div>Zlatne poluge su su pravougaoni komadi zlata i kao takvi su čest izbor ulagača
                                zainteresovanih za investiciono zlato. One dolaze iz pouzdanih livnica svetskog renomea,
                                upakovane su u blister pakovanja, kao uostalom i zlatne pločice, u kojima se nalaze LBMA
                                sertifikati koji garantuju kvalitet proizvodnje. Zbog svoje fine izrade i najviše čistoće
                                zlata („Fine Gold“), zlatne poluge predstavljaju visoko likvidne investicione formate. Često
                                se smatraju opipljivom imovinom koja može zadržati svoju vrednost tokom vremena. Investitori
                                često kupuju i čuvaju ove poluge kao način zaštite od inflacije ili fluktuacija valuta.
                            </div>
                        </div>
                        <!-- Multiple table Prices -->
                        @foreach ($goldenBars as $bar)
                            <div class="prices-table-gold">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-uppercase">Cena zlatne poluge <span>od
                                                {{ $bar['description'] }}:</span></h4>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold mb-2">
                                        Naziv
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
                                            @php
                                                if (str_contains($product->unique_key, 'CH')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/CH.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'AH')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/AH.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'FJ')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/FJ.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'HM')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/HM.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'RM')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/RM.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'VP')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/VP.webp" alt="">';
                                                }
                                                if (str_contains($product->unique_key, 'VS')) {
                                                    echo '<img class="table-product-image" src="/storage/manufacturers/VS.webp" alt="">';
                                                }
                                            @endphp
                                            <a target="_blank" class="table-product-name text-primary fw-bold"
                                                href="{{ $product['url'] }}">
                                                {{ $product['name'] }} <img width="45"
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
                                        <a class="btn btn-primary btn-sm w-sm-100"
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
        <section class="get-in-touch wow fadeIn">
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

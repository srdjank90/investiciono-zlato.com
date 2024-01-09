@extends('frontend.themes.gold.layout.layout')
@section('title', 'Zlatne pločice')
@section('description', 'Zlatne pločice')
@section('keywords', '')
@section('content')
    <div class="page-content bg-white">
        <!-- Golden Plates -->
        <section class="content-inner-1 overlay-white-middle about-products2">
            <img src="/themes/gold/assets/images/bg-triangle3.png" class="bg-img" alt="">
            <img src="/themes/gold/assets/images/bg-triangle4.png" class="bg-img2" alt="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
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
                                            class="gold-column col-12 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column">
                                            <div class="d-md-none fw-bold"><small>Naziv</small></div>
                                            <a target="_blank" class="text-primary fw-bold" href="{{ $product['url'] }}">
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
                                            href="{{ route('frontend.category', $plate['slug']) }}">Sve
                                            zlatne pločice od
                                            {{ $plate['name'] }} u ponudi</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- #Multiple table Prices -->
                    </div>
                </div>
            </div>
        </section>
        <!-- #Golden Plates -->
    </div>
@endsection

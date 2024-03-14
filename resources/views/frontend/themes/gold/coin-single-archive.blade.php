@extends('frontend.themes.gold.layout.layout')
@section('title', $coinData->name . ' | Poredjenje cena investicionog zlata u realnom vremenu')
@section('description', $description)
@section('keywords', '')
@section('image', 'themes/gold/assets/images/demo/demo-3.webp')
@section('content')
    <div class="page-content bg-white">
        <!-- Golden Plates -->
        <section class="content-inner-1 overlay-white-middle about-products2">
            <img src="/themes/gold/assets/images/bg-triangle3.webp" class="bg-img" alt="">
            <img src="/themes/gold/assets/images/bg-triangle4.webp" class="bg-img2" alt="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="product-specification mb-3">
                            <h2 class="mb-4 fs-3">
                                {!! $coinData->name !!}
                            </h2>
                            <div>
                                {{ $description }}
                            </div>
                        </div>
                        <!-- Category table Prices -->
                        <div class="prices-table-gold">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-none d-md-block fw-bold mb-3">
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
                                @foreach ($products as $product)
                                    <div
                                        class="gold-column col-12 col-sm-6 col-md-3 col-lg-3 d-flex justify-content-center flex-column">
                                        <div class="d-md-none fw-bold"><small>Naziv</small></div>
                                        <a target="_blank" class="text-primary fw-bold" href="{{ $product['url'] }}">
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
                                                @if ((float) $product['selling_price_percentage_change'] > 0 && false)
                                                    <small class="text-danger">@priceFormat($product['selling_price_percentage_change'])%
                                                        <i class="fa-solid fa-arrow-up"></i></small>
                                                @endif
                                                @if ((float) $product['selling_price_percentage_change'] < 0 && false)
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
                                                @if ((float) $product['purchase_price_percentage_change'] > 0 && false)
                                                    <small class="text-danger">@priceFormat($product['purchase_price_percentage_change'])%
                                                        <i class="fa-solid fa-arrow-up"></i></small>
                                                @endif
                                                @if ((float) $product['purchase_price_percentage_change'] < 0 && false)
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
                            </div>
                        </div>
                        <!-- #Category table Prices -->
                    </div>
                </div>
            </div>
        </section>
        <!-- #Golden Plates -->
    </div>
@endsection

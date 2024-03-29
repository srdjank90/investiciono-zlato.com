@extends('frontend.themes.gold.layout.layout')
@section('title', 'Zlatne pločice | Poredjenje cena investicionog zlata u realnom vremenu')
@section('description',
    'Zlatne pločice su male zlatne poluge koje služe kao oblik investicionog zlata. Proizvode ih
    renomirani proizvođači koristeći napredne tehnologije kako bi osigurali visok kvalitet. Neki
    od istaknutih proizvođača uključuju Argor Heraeus, C.Hafner, Valcambi Suisse, PAMP, The
    Royal Mint i Münze Österreich, svaki garantujući visok nivo sigurnosti i autentičnosti
    svojih proizvoda. Svaka pločica je LBMA sertifikovana za svoju finoću, obično 999,9, i
    poreklom su iz zemalja poput Nemačke, Austrije, Velike Britanije i Švajcarske. Cene ovih
    zlatnih pločica variraju u zavisnosti od veličine i tržišnih uslova u trenutku kupovine.')
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
                        <div class="section-head style-2">
                            <h2 class="sub-title">Zlatne pločice</h2>
                            <p>Zlatne pločice su male zlatne poluge koje služe kao oblik investicionog zlata. Proizvode ih
                                renomirani proizvođači koristeći napredne tehnologije kako bi osigurali visok kvalitet. Neki
                                od istaknutih proizvođača uključuju Argor Heraeus, C.Hafner, Valcambi Suisse, PAMP, The
                                Royal Mint i Münze Österreich, svaki garantujući visok nivo sigurnosti i autentičnosti
                                svojih proizvoda. Svaka pločica je LBMA sertifikovana za svoju finoću, obično 999,9, i
                                poreklom su iz zemalja poput Nemačke, Austrije, Velike Britanije i Švajcarske. Cene ovih
                                zlatnih pločica variraju u zavisnosti od veličine i tržišnih uslova u trenutku kupovine.</p>
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

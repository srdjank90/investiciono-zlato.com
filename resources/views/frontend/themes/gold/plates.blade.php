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
                        <!-- Category Prices -->
                        @foreach ($goldenPlates as $plate)
                            <div class="category-prices mb-3">
                                <h5>Težina pločice <span>od {{ $plate['description'] }}:</span></h5>
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
                                                <td class="text-start"><a target="_blank" href="{{ $product['url'] }}">
                                                        {{ $product['name'] }}</a>
                                                </td>
                                                <td style="font-size: 12px" class="text-end">@priceFormat($product['selling_price'])
                                                    {{ $currency }}</td>
                                                <td class="text-end">@priceFormat($product['purchase_price'])
                                                    {{ $currency }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-3">
                                    <a href="{{ route('frontend.category', $plate['slug']) }}">Sve zlatne pločice u
                                        ponudi</a>
                                </div>
                            </div>
                        @endforeach
                        <!-- #Category Prices -->
                    </div>
                </div>
            </div>
        </section>
        <!-- #Golden Plates -->
    </div>
@endsection

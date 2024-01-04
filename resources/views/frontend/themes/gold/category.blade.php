@extends('frontend.themes.gold.layout.layout')
@section('title', $category->name)
@section('description', '')
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
                        <div class="product-specification wow fadeInUp" data-wow-delay="0.3s"
                            style="visibility: hidden; animation-delay: 0.3s; animation-name: none;">
                            <h4 class="specification-title">Kategorija {{ $category->name }}</h4>
                        </div>
                        <!-- Category Prices -->

                        <div class="category-prices mb-3">
                            <table class="table wow fadeInUp product-prices-table" data-wow-delay="0.4s"
                                style="visibility: hidden; animation-delay: 0.4s; animation-name: none;">
                                <thead>
                                    <td class="text-start fw-bold">Naziv</td>
                                    <td class="text-end fw-bold">Prodajna cena</td>
                                    <td class="text-end fw-bold">Otkupna cena</td>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="text-start"><a target="_blank" class="text-primary fw-bold"
                                                    href="{{ $product['url'] }}">
                                                    {{ $product['name'] }}</a>
                                            </td>
                                            <td class="text-end">
                                                @if ($product['selling_price'] != '0' && $product['selling_price'] != null)
                                                    @if ((float) $product['selling_price_percentage_change'] > 0)
                                                        <span class="text-success">@priceFormat($product['selling_price_percentage_change'])%
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
                                                        <span class="text-success">@priceFormat($product['purchase_price_percentage_change'])%
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
                        </div>
                        <!-- #Category Prices -->
                    </div>
                </div>
            </div>
        </section>
        <!-- #Golden Plates -->
    </div>
@endsection

@extends('frontend.themes.mooncart.layout.layout')
@section('title', $product->seo->title)
@section('description', $product->seo->description)
@section('keywords', $product->seo->keywords)
@section('content')
    <div class="page-content">

        <div class="d-sm-flex justify-content-between container-fluid py-3">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}"> Početna</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('frontend.products') }}"> Svi proizvodi</a></li>
                    @foreach ($product->categories as $cat)
                        <li class="breadcrumb-item"><a href="{{ route('frontend.category.products', $cat->slug) }}">
                                {{ $cat->name }}</a></li>
                    @endforeach
                    <li class="breadcrumb-item text-uppercase">{{ $product->name }}</li>
                </ul>
            </nav>
        </div>

        <section class="content-inner py-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-4">
                        <div class="dz-product-detail sticky-top">
                            <div class="swiper-btn-center-lr">
                                <div class="swiper product-gallery-swiper2">
                                    <div class="swiper-wrapper" id="lightgallery">
                                        @foreach ($product->files as $image)
                                            <div class="swiper-slide">
                                                <div class="dz-media DZoomImage">
                                                    <a class="mfp-link lg-item" href="{{ $storageUrl . $image->path }}"
                                                        data-src="{{ $storageUrl . $image->path }}">
                                                        <i class="feather icon-maximize dz-maximize top-left"></i>
                                                    </a>
                                                    <img src="{{ $storageUrl . $image->path }}" alt="image">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper product-gallery-swiper thumb-swiper-lg">
                                    <div class="swiper-wrapper" style="max-width: 450px">
                                        @foreach ($product->files as $image)
                                            <div class="swiper-slide">
                                                <img src="{{ $storageUrl . $image->path }}" alt="image">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-8">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="dz-product-detail style-2 p-t20 ps-0">
                                    <div class="dz-content">
                                        <form id="itemForm" class="meta-items" action="">
                                            <div class="dz-content-footer">
                                                <div class="dz-content-start">
                                                    <span class="badge bg-purple mb-2  d-none">SALE 20% Off</span>
                                                    <h4 class="title mb-1 text-uppercase"><a
                                                            href="#">{{ $product->name }}</a></h4>
                                                    <small>{{ $product->subtitle }}</small>
                                                </div>
                                            </div>
                                            <p class="para-text">

                                            </p>
                                            <div class="meta-content m-b20 d-flex align-items-end">
                                                <div class="me-3">
                                                    <span class="price-name">Cena</span>
                                                    <span class="price-num">{{ $product->price }} {{ $currency }}
                                                        @if (isset($product->price_old) && $product->price_old > 0)
                                                            <del>{{ $product->price_old }} {{ $currency }}</del>
                                                        @endif
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="product-num">
                                                <div class="btn-quantity light">
                                                    <label class="form-label">Količina</label>
                                                    @if ($product->name == 'Pravoslavni jednolisni')
                                                        <input type="number" class="quantity-input" min="500"
                                                            value="500" max="100000" name="">
                                                    @else
                                                        <input type="number" class="quantity-input"
                                                            min="{{ $product->categories[0]->min_order_quantity }}"
                                                            value="{{ $product->categories[0]->min_order_quantity }}"
                                                            max="100000" name="">
                                                    @endif

                                                </div>
                                                <!-- Product Meta -->
                                                @foreach ($productMetas as $key => $metaOption)
                                                    @if ($metaOption['name'] !== 'Dimenzija')
                                                        <div class="mb-2 py-2 meta-item w-100">
                                                            <h6>{{ $metaOption['name'] }} </h6>
                                                            @foreach ($product->meta as $pmKey => $meta)
                                                                @if ($meta->type == $metaOption['name'])
                                                                    <div
                                                                        class="form-check form-check-inline position-relative">
                                                                        <input class="form-check-input color-input" required
                                                                            style="z-index: -1"
                                                                            onchange="changeMetaValue('{{ $meta->type }}','{{ $meta->name }}','{{ $meta->id }}','{{ $meta->external_id }}','{{ $meta->stock }}')"
                                                                            value="{{ $meta->id }}" type="radio"
                                                                            name="{{ $metaOption['name'] }}"
                                                                            id="meta{{ $meta->type . $meta->id }}">
                                                                        <label
                                                                            class="form-check-label color-label cursor-pointer"
                                                                            for="meta{{ $meta->type . $meta->id }}">
                                                                            @if (isset($metaOption['valueType']) && $metaOption['valueType'] != '')
                                                                                <img width="36"
                                                                                    style="width: 36px;border-radius:3px;border:1px solid #ccc;cursor:pointer"
                                                                                    src="{{ $storageUrl }}/{{ $meta->value }}"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-title="{{ $meta->name }}"
                                                                                    class="cursor-pointer" alt="">
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @else
                                                    @endif
                                                @endforeach
                                                <!-- #Product Meta -->
                                            </div>
                                            <div class="dz-info">
                                                <ul>
                                                    <li>
                                                        <strong>Na stanju:</strong>
                                                        <span class="meta-stock">
                                                            1000
                                                        </span>

                                                    </li>
                                                    <li>
                                                        <strong>Šifra proizvoda:</strong>
                                                        <span class="meta-external-id">{{ $product->external_id }}</span>
                                                    </li>
                                                    <li>
                                                        @if ($product->name == 'Pravoslavni jednolisni')
                                                            <strong>Minimalna količina:</strong>
                                                            <span>500 kom</span>
                                                        @else
                                                            <strong>Minimalna količina:</strong>
                                                            <span>{{ $product->categories[0]->min_order_quantity }}
                                                                kom</span>
                                                        @endif

                                                    </li>
                                                    <li>
                                                        <strong>Tagovi:</strong>
                                                        <span>{{ $product->name }},</span>
                                                        @foreach ($product->categories as $category)
                                                            <span>{{ $category->name }},</span>
                                                        @endforeach

                                                        <span>Reklamni materijal</span>

                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="dz-description">
                                                <h3>Opis</h3>
                                                {!! $product->description !!}
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="cart-detail">
                                    <a href="javascript:void(0);" class="btn btn-outline-primary w-100 m-b20">Akcija
                                        5% za sve nove kupce</a>
                                    <div class="icon-bx-wraper style-4 m-b30">
                                        <div class="icon-bx">
                                            <img src="/themes/mooncart/assets/images/shop/shop-cart/icon-box/pic2.png"
                                                alt="/">
                                        </div>
                                        <div class="icon-content">
                                            <h6 class="dz-title">Isporuka i naručivanje proizvoda</h6>
                                            <p>Nakon dodavanja svih željenih proizvoda u korpu, dobićete ukupnu cenu
                                                koštanja sa troškovima štampe i isporuke poručene robe, imajte u vidu da
                                                određeni proizvod imaju minimalni broj komada koji je moguće poručiti.
                                                <br><br>
                                                Nakon
                                                potvrde porudžbine, na Vašu email adresu ćete dobiti konačan predračun za
                                                uplatu. Nakon uplate, dobićete mejl potvrde sa tačnim vremenom isporuke. Ako
                                                bilo gde zapnete, jednostavno nas kontaktirajte putem mejla ili telefonom.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="save-text d-none">
                                        <i class="icon feather icon-check-circle"></i>
                                        <span class="m-l10">You will save ₹504 on this order</span>
                                    </div>
                                    <table>
                                        <tbody>
                                            <tr class="total">
                                                <td>
                                                    <h6 class="mb-0">Ukupno</h6>
                                                </td>
                                                <td class="price">
                                                    {{ $product->price }} {{ $currency }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="javascript:void(0)" data-product="{{ $product }}"
                                        class="btn btn-secondary w-100 add-to-cart">Dodaj u
                                        korpu</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                                            <h5 class="title"><a
                                                    href="{{ route('frontend.product', $bestSeller->slug) }}">{{ $bestSeller->name }}</a>
                                            </h5>
                                            <h6 class="price">
                                                @if ($bestSeller->price_old)
                                                    <del>@priceFormat($bestSeller->price_old)
                                                        {{ $currency }}</del>
                                                @endif
                                                @priceFormat($bestSeller->price)
                                                {{ $currency }}
                                            </h6>
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
        <section class="container">
            <!-- Popular Categories -->
            <h4 class="mb-3">Najpopularnije kategorije</h4>
            <div class="row">
                <div class="col-xl-12">
                    <div class="swiper category-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <a href="{{ route('frontend.category.products', 'kalendari') }}">
                                            <img src="/themes/mooncart/assets/images/shop/product/1a.png" alt="image">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a
                                                href="{{ route('frontend.category.products', 'kalendari') }}">Kalendari
                                                2014</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <a href="{{ route('frontend.category.products', 'rokovnici-i-notesi') }}">
                                            <img src="/themes/mooncart/assets/images/shop/product/2a.png" alt="image">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a
                                                href="{{ route('frontend.category.products', 'rokovnici-i-notesi') }}">Rokovnici
                                                i notesi</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <a href="{{ route('frontend.category.products', 'olovke') }}">
                                            <img src="/themes/mooncart/assets/images/shop/product/3a.png" alt="image">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a
                                                href="{{ route('frontend.category.products', 'olovke') }}">Olovke</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <a href="{{ route('frontend.category.products', 'upaljaci') }}">
                                            <img src="/themes/mooncart/assets/images/shop/product/4a.png" alt="image">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a
                                                href="{{ route('frontend.category.products', 'upaljaci') }}">Upaljači</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <a href="{{ route('frontend.category.products', 'torbe') }}">
                                            <img src="/themes/mooncart/assets/images/shop/product/5a.png" alt="image">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a
                                                href="{{ route('frontend.category.products', 'torbe') }}">Torbe</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <a href="{{ route('frontend.category.products', 'satovi') }}">
                                            <img src="/themes/mooncart/assets/images/shop/product/6a.png" alt="image">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a
                                                href="{{ route('frontend.category.products', 'satovi') }}">Satovi</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <a href="{{ route('frontend.category.products', 'usb-i-tehnologija') }}">
                                            <img src="/themes/mooncart/assets/images/shop/product/7a.png" alt="image">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a
                                                href="{{ route('frontend.category.products', 'usb-i-tehnologija') }}">USB
                                                i tehnologija</a></h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #Popular Categories -->
        </section>

    </div>
@endsection

@section('scripts')
    <script>
        function updateValue() {
            console.log('Updated');
        }
    </script>
@endsection

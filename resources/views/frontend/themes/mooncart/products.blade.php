@extends('frontend.themes.mooncart.layout.layout')
@if (isset($selectedCategory))
    @section('title', $selectedCategory->name)
@else
    @section('title', 'Proizvodi')
@endif
@section('description', isset($setting['setting_seo_description_opt']) ? $setting['setting_seo_description_opt'] : '')
@section('keywords', isset($setting['setting_seo_keywords_opt']) ? $setting['setting_seo_keywords_opt'] : '')
@section('content')
    <div class="page-content">
        <div class="dz-bnr-inr style-1" style="background-image:url(/themes/mooncart/assets/images/background/bg-shape.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    @if (isset($selectedCategory))
                        <h1>{{ $selectedCategory->name }}</h1>
                    @else
                        <h1>Proizvodi</h1>
                    @endif
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}"> Početna</a></li>
                            @if (isset($selectedCategory))
                                <li class="breadcrumb-item"><a href="{{ route('frontend.products') }}"> Svi proizvodi</a>
                                </li>
                            @endif
                            @if (isset($selectedCategory))
                                <li class="breadcrumb-item">{{ $selectedCategory->name }}</li>
                            @else
                                <li class="breadcrumb-item">Svi proizvodi</li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <section class="content-inner-1 pt-3 z-index-unset">
            <div class="container-fluid">
                <div class="row mt-xl-2 mt-0">
                    <div class="col-20 col-xl-3">
                        <div class="sticky-xl-top">
                            <a href="javascript:void(0);" class="panel-close-btn">
                                <svg width="35" height="35" viewBox="0 0 51 50" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.748 12.5L12.748 37.5" stroke="white" stroke-width="1.25"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12.748 12.5L37.748 37.5" stroke="white" stroke-width="1.25"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <div class="shop-filter">
                                <aside>
                                    <div class="widget widget_categories">
                                        <h6 class="widget-title">Kategorije proizvoda</h6>
                                        <ul>
                                            @foreach ($categories as $category)
                                                <li class="cat-item cat-item-{{ $category->id }}"><a
                                                        href="{{ route('frontend.category.products', $category->slug) }}">{{ $category->name }}</a>
                                                    ({{ $category->products->count() }})</li>

                                                @if (isset($selectedCategory) && $category->id == $selectedCategory->id)
                                                    @foreach ($category->childs as $child)
                                                        <li class="cat-item cat-item-{{ $child->id }}"><a class="ps-3"
                                                                href="{{ route('frontend.category.products', $child->slug) }}">-
                                                                {{ $child->name }}</a>
                                                            ({{ $child->products->count() }})
                                                        </li>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>

                    <div class="col-80 col-xl-9">
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
                                                        <img src="/themes/mooncart/assets/images/shop/product/1a.png"
                                                            alt="image">
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
                                                    <a
                                                        href="{{ route('frontend.category.products', 'rokovnici-i-notesi') }}">
                                                        <img src="/themes/mooncart/assets/images/shop/product/2a.png"
                                                            alt="image">
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
                                                        <img src="/themes/mooncart/assets/images/shop/product/3a.png"
                                                            alt="image">
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
                                                        <img src="/themes/mooncart/assets/images/shop/product/4a.png"
                                                            alt="image">
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
                                                        <img src="/themes/mooncart/assets/images/shop/product/5a.png"
                                                            alt="image">
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
                                                        <img src="/themes/mooncart/assets/images/shop/product/6a.png"
                                                            alt="image">
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
                                                    <a
                                                        href="{{ route('frontend.category.products', 'usb-i-tehnologija') }}">
                                                        <img src="/themes/mooncart/assets/images/shop/product/7a.png"
                                                            alt="image">
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

                        <!-- Products -->
                        <div class="row">
                            <div class="col-12 tab-content shop-" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="tab-list-grid" role="tabpanel"
                                    aria-labelledby="tab-list-grid-btn">
                                    <div class="row gx-xl-4 g-3">
                                        @foreach ($products as $key => $product)
                                            <div class="col-12 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
                                                <div class="shop-card">
                                                    <div class="dz-media">
                                                        @if ($product->files && count($product->files) > 0)
                                                            <a href="{{ route('frontend.product', $product->slug) }}">
                                                                <img src="{{ $storageUrl . $product->files[0]['path'] }}"
                                                                    alt="image">
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="dz-content text-center">
                                                        <h5 class="title text-uppercase"><a
                                                                href="{{ route('frontend.product', $product->slug) }}">{{ $product->name }}</a>
                                                        </h5>
                                                        <p style="padding: 0;margin: 0;line-height: 16px;font-size: 12px;">
                                                            {{ $product->subtitle }}</p>
                                                        <h6 class="price">
                                                            @if (isset($product->price_old) && $product->price_old > 0)
                                                                <del>{{ $product->price_old }} {{ $currency }}</del>
                                                            @endif
                                                            {{ $product->price }} {{ $currency }}
                                                        </h6>
                                                        <div>
                                                            <!-- Product Meta -->
                                                            @foreach ($productMetas as $key => $metaOption)
                                                                @if ($metaOption['name'] !== 'Dimenzija')
                                                                    <h6 class="d-none">{{ $metaOption['name'] }} </h6>
                                                                    <ul class="color-wrapper text-center">
                                                                        @foreach ($product->meta as $pmKey => $meta)
                                                                            @if ($meta->type == $metaOption['name'])
                                                                                @if (isset($metaOption['valueType']) && $metaOption['valueType'] != '')
                                                                                    <li class="d-inline-block p-1">
                                                                                        <div
                                                                                            style="width:28px;height:28px">
                                                                                            <img data-bs-toggle="tooltip"
                                                                                                data-bs-title="{{ $meta->name }}"
                                                                                                src="{{ $storageUrl }}/{{ $meta->value }}"
                                                                                                style="border:1px solid #ccc;border-radius:3px"
                                                                                                alt="">
                                                                                        </div>
                                                                                    </li>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                @endif
                                                            @endforeach
                                                            <!-- #Product Meta -->
                                                        </div>
                                                        <p style="padding: 0;margin: 0;line-height: 16px;font-size: 12px;">
                                                            Trenutno ukupno na stanju: {{ $product->quantity }}</p>
                                                    </div>
                                                    <div class="product-tag">
                                                        <span class="badge badge-secondary d-none">-20%</span>
                                                        @foreach ($product->categories as $cat)
                                                            @if (
                                                                $cat->name == 'Kalendari' &&
                                                                    $product->name !== 'Mini calendar bag' &&
                                                                    $product->name !== 'Calendar bag' &&
                                                                    $product->name !== 'New year card')
                                                                <span class="badge badge-primary">Sa štampom</span>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-12">
                                            {!! $products->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Products -->
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

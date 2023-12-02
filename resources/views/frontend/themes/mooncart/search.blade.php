@extends('frontend.themes.mooncart.layout.layout')
@section('title', 'Pretraga')
@section('description', isset($setting['setting_seo_description_opt']) ? $setting['setting_seo_description_opt'] : '')
@section('keywords', isset($setting['setting_seo_keywords_opt']) ? $setting['setting_seo_keywords_opt'] : '')
@section('content')
    <div class="page-content">
        <div class="dz-bnr-inr style-1" style="background-image:url(/themes/mooncart/assets/images/background/bg-shape.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Pretraga: <span class="text-success">{{ $searchString }}</span> </h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}"> Početna</a></li>
                            <li class="breadcrumb-item">Pretraga</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <section class="content-inner-1 pt-3 z-index-unset">
            <div class="container-fluid">
                <div class="row mt-xl-2 mt-0">
                    <div class="col-80 col-xl-12">
                        <!-- Products -->
                        <div class="row">
                            <div class="col-12 tab-content shop-" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="tab-list-grid" role="tabpanel"
                                    aria-labelledby="tab-list-grid-btn">
                                    <div class="row gx-xl-4 g-3">
                                        @if ($products->count() > 0)
                                            @foreach ($products as $key => $product)
                                                <div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
                                                    <div class="shop-card">
                                                        <div class="dz-media">
                                                            @if ($product->files && count($product->files) > 0)
                                                                <a href="{{ route('frontend.product', $product->slug) }}">
                                                                    <img src="{{ $storageUrl . $product->files[0]['path'] }}"
                                                                        alt="image">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="dz-content">
                                                            <h5 class="title text-uppercase"><a
                                                                    href="{{ route('frontend.product', $product->slug) }}">{{ $product->name }}</a>
                                                            </h5>
                                                            <p
                                                                style="padding: 0;margin: 0;line-height: 16px;font-size: 12px;">
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
                                        @else
                                            <div class="col-md-12">
                                                <div class="alert alert-success bg-success text-center rounded text-white">
                                                    Nema
                                                    proizvoda za
                                                    željenu
                                                    pretragu</div>
                                            </div>
                                        @endif

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

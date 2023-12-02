@extends('frontend.themes.lika.layout.layout')

@section('content')
<!-- Hero -->
<div class="container content-space-t-1 content-space-t-sm-2">
    <div class="row">
        <div class="col-md-7 mb-7 mb-md-0">
            <div class="pe-md-4">
                <div class="card-pinned">
                    <!-- Swiper Main Slider -->
                    <div class="js-swiper-shop-product swiper">
                        <div class="swiper-wrapper">
                            @foreach($product->files as $image)
                            <!-- Slide -->
                            <div class="swiper-slide">
                                <div class="card card-bordered shadow-none">
                                    <img class="card-img" src="{{ $storageUrl.$image->path}}" alt="{{$image->name}}">
                                </div>
                            </div>
                            <!-- End Slide -->
                            @endforeach
                        </div>

                        <!-- Arrows -->
                        <div class="js-swiper-shop-product-button-next swiper-button-next"></div>
                        <div class="js-swiper-shop-product-button-prev swiper-button-prev"></div>
                    </div>
                    <!-- End Swiper Main Slider -->

                    <!-- Swiper Thumb Slider -->
                    <div class="position-absolute bottom-0 end-0 start-0 zi-1 p-4">
                        <div class="js-swiper-shop-product-thumb swiper" style="max-width: 15rem;">
                            <div class="swiper-wrapper">
                                @foreach($product->files as $image)
                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <a class="avatar avatar-circle" href="javascript:;">
                                        <img class="avatar-img" src="{{ $storageUrl.$image->path}}"
                                            alt="{{$image->name}}">
                                    </a>
                                </div>
                                <!-- End Slide -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- End Swiper Thumb Slider -->
                </div>
            </div>
        </div>
        <!-- End Col -->

        <div class="col-md-5">

            <!-- Heading -->
            <div class="mb-5">
                <h1 class="h2">{{$product->name}}</h1>
                <p>American label New Era manufacturing baseball hats for teams since the 1930s.</p>
            </div>
            <!-- End Heading -->

            <!-- Price -->
            <div class="mb-5">
                <span class="d-block mb-2">{{__('Price')}}:</span>
                <div class="d-flex align-items-center">
                    <h3 class="mb-0">{{$product->price}} {{$currency}}</h3>
                    <span class="ms-2"><del>{{$product->price_old}} {{$currency}}</del></span>
                </div>
            </div>
            <!-- End Price -->

            <!-- Product Meta -->
            @foreach($productMetas as $key => $metaOption)
            <div class="mb-2 py-2">
                <h4>{{ $metaOption['name']}} </h4>
                @foreach($product->meta as $pmKey => $meta)
                @if($meta->type == $metaOption['name'])
                <div class="form-check">
                    <input class="form-check-input" required checked
                        onchange="changeMetaValue('{{$meta->type}}','{{$meta->name}}','{{$meta->id}}')"
                        value="{{$meta->id}}" type="radio" name="{{ $metaOption['name'] }}"
                        id="meta{{$meta->type.$meta->id}}">
                    <label class="form-check-label" for="meta{{$meta->type.$meta->id}}">
                        {{$meta->name}}
                    </label>
                </div>
                @endif
                @endforeach
            </div>
            @endforeach
            <!-- #Product Meta -->


            <!-- Quantity -->
            <div class="quantity-counter mb-3">
                <div class="js-quantity-counter row align-items-center">
                    <div class="col">
                        <span class="d-block small">{{__('Select quantity')}}</span>
                        <input class="js-result form-control form-control-quantity-counter quantity-input" type="text"
                            value="1">
                    </div>
                    <!-- End Col -->

                    <div class="col-auto">
                        <a class="js-minus btn btn-outline-secondary btn-xs btn-icon rounded-circle"
                            href="javascript:;">
                            <svg width="8" height="2" viewBox="0 0 8 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 1C0 0.723858 0.223858 0.5 0.5 0.5H7.5C7.77614 0.5 8 0.723858 8 1C8 1.27614 7.77614 1.5 7.5 1.5H0.5C0.223858 1.5 0 1.27614 0 1Z"
                                    fill="currentColor" />
                            </svg>
                        </a>
                        <a class="js-plus btn btn-outline-secondary btn-xs btn-icon rounded-circle" href="javascript:;">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4 0C4.27614 0 4.5 0.223858 4.5 0.5V3.5H7.5C7.77614 3.5 8 3.72386 8 4C8 4.27614 7.77614 4.5 7.5 4.5H4.5V7.5C4.5 7.77614 4.27614 8 4 8C3.72386 8 3.5 7.77614 3.5 7.5V4.5H0.5C0.223858 4.5 0 4.27614 0 4C0 3.72386 0.223858 3.5 0.5 3.5H3.5V0.5C3.5 0.223858 3.72386 0 4 0Z"
                                    fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Quantity -->


            <div class="d-grid mb-4">
                <button type="button" data-product="{{ $product }}"
                    class="btn btn-primary btntransition add-to-cart">{{__('Add to cart')}}</button>
            </div>

        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>
<!-- End Hero -->

<!-- Content -->
<div class="container content-space-t-2 content-space-md-3">
    <div class="row">
        <div class="col-md-12 mb-5 mb-md-0">
            <div class="pe-lg-4">
                <h3>{{__('Details')}}</h3>
                <p>{!!$product->description!!}</p>
            </div>
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>
<!-- End Content -->

@endsection

@section('scripts')
<script>
    (function() {
        // INITIALIZATION OF SWIPER
        // =======================================================
        var swiper = new Swiper('.js-swiper-shop-product', {
            effect: 'fade'
            , autoplay: true
            , loop: true
            , navigation: {
                nextEl: '.js-swiper-shop-product-button-next'
                , prevEl: '.js-swiper-shop-product-button-prev'
            , }
            , thumbs: {
                swiper: sliderThumbs
            }
        });

        var sliderThumbs = new Swiper('.js-swiper-shop-product-thumb', {
            slidesPerView: 3
            , watchSlidesVisibility: true
            , watchSlidesProgress: true
            , history: false
        , });


        // INITIALIZATION OF QUANTITY COUNTER
        // =======================================================
        new HSQuantityCounter('.js-quantity-counter')
    })();

</script>

@endsection
@extends('frontend.themes.gold.layout.layout')
@section('title', 'Investiciono zlato | Poredjenje cena investicionog zlata u realnom vremenu')
@section('description', '')
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

                    <div class="col-md-3 col-6 text-center"><a class="fs-3" href="{{ route('frontend.plates') }}"><img
                                src="/themes/gold/assets/images/demo/demo-1.webp" alt="/"> <span
                                class="menu-title text-center">Zlatne pločice</span></a></div>
                    <div class="col-md-3 col-6 text-center"><a class="fs-3" href="{{ route('frontend.bars') }}"><img
                                src="/themes/gold/assets/images/demo/demo-2.webp" alt="/"> <span
                                class="menu-title text-center">Zlatne poluge</span></a>
                    </div>
                    <div class="col-md-3 col-6 text-center"><a class="fs-3" href="{{ route('frontend.coins') }}"><img
                                src="/themes/gold/assets/images/demo/demo-3.webp" alt="/">
                            <span class="menu-title text-center">Zlatni dukati</span></a>
                    </div>
                    <div class="col-md-3 col-6 text-center"><a class="fs-3"
                            href="https://forum.investiciono-zlato.com"><img
                                src="/themes/gold/assets/images/demo/demo-4.webp" alt="/">
                            <span class="menu-title text-center">Investicioni forum</span></a>
                    </div>

                </div>
            </div>
        </section>
        <!-- #Golden Plates -->
    </div>
@endsection

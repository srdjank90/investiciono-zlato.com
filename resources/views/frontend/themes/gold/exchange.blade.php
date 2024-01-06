@extends('frontend.themes.gold.layout.layout')
@section('title', 'Kursna lista')
@section('description', 'Kursna lista')
@section('keywords', '')
@section('content')
    <div class="page-content bg-white">
        <section class="content-inner-1 overlay-white-middle about-products2">
            <img src="/themes/gold/assets/images/bg-triangle3.png" class="bg-img" alt="">
            <img src="/themes/gold/assets/images/bg-triangle4.png" class="bg-img2" alt="">
            <div class="container">
                <iframe width="100%" scrolling="no" style="overflow-x: hidden;" height="2000px"
                    src="https://www.nbs.rs/kursnaListaModul/srednjiKurs.faces?lang=lat" frameborder="0"></iframe>
            </div>
        </section>
    </div>
@endsection

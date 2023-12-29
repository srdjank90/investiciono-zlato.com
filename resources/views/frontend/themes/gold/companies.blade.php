@extends('frontend.themes.gold.layout.layout')
@section('title', 'Prodavnice')
@section('description', 'Prodavnice')
@section('keywords', '')
@section('content')
    <div class="page-content bg-white">
        <!-- Golden Plates -->
        <section class="content-inner-1 overlay-white-middle about-products2">
            <img src="/themes/gold/assets/images/bg-triangle3.png" class="bg-img" alt="">
            <img src="/themes/gold/assets/images/bg-triangle4.png" class="bg-img2" alt="">
            <div class="container">
                <div class="row align-items-center">
                    @foreach ($companies as $company)
                        <div class="card shadow">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3 fw-bold d-flex justify-content-start align-items-center">
                                        {{ $company->name }}
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-start align-items-center">
                                        {{ $company->description }}
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end align-items-center">
                                        <a class="btn btn-primary" target="_blank" href="{{ $company->url }}">Poseti
                                            prodavnicu</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- #Golden Plates -->
    </div>
@endsection

@extends('frontend.themes.gold.layout.layout')
@section('title', 'Prodavnice | Poredjenje cena investicionog zlata u realnom vremenu')
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
                    <div class="col-md-12">
                        <h2>Devet najpovoljnijih online prodavnica investicionog zlata u Srbiji</h2>
                        <p>Online trgovci zlatom u Srbiji pružaju različite mogućnosti za one koji žele investirati ili
                            kupiti plemenite metale. Bez obzira da li ste iskusni investitor ili tek počinjete istraživati
                            ovu oblast, važno je pažljivo istražiti tržište i odabrati pouzdanog trgovca. Preporučujemo da
                            detaljno pregledate online trgovce koji se nalaze rangirani na našem sajtu, proverite njihovu
                            reputaciju, uporedite cene i naknade, i postavite pitanja o njihovoj ponudi i uslovima
                            poslovanja. Investiranje u zlato može biti pametan finansijski potez, ali je važno biti
                            informisan i pažljiv. Za početak pokušajte u nastavku teksta da sagledate nešto o online
                            trgovcima zlatom u Srbiji i započnete svoju investicionu avanturu danas!</p>
                    </div>
                    @foreach ($companies as $company)
                        <div class="card shadow">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3 fw-bold d-flex justify-content-start align-items-center">
                                        <img src="{{ $company->image_url }}" alt="">
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

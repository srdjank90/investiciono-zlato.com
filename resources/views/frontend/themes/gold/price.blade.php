@extends('frontend.themes.gold.layout.layout')
@section('title', 'Cena zlata | Poredjenje cena investicionog zlata u realnom vremenu')
@section('description', 'Cena zlata')
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
                    <div class="col-md-12">
                        <h2>Cena zlata</h2>
                        <div>Cena zlata je jedan od najvažnijih faktora u svetu investiranja i ekonomije. Ova plemenita
                            metal ima dugu istoriju kao sredstvo vrednosti i često se koristi kao siguran utoči&scaron;te
                            tokom ekonomske nestabilnosti. Cena zlata varira u zavisnosti od različitih faktora kao
                            &scaron;to su ponuda i potražnja, geopolitičke tenzije, inflacija i promene na globalnom
                            trži&scaron;tu.
                            <div>
                                <p>Jedan od načina za praćenje cene zlata je putem grafova. Grafikoni cena zlata pružaju
                                    vizuelni prikaz promena u vrednosti zlata tokom vremena. Ovi grafikoni omogućavaju
                                    investitorima da bolje razumeju dugoročne i kratkoročne trendove na trži&scaron;tu zlata
                                    i da donesu informisane odluke o kupovini ili prodaji.</p>
                                <p>Da biste pratili trenutne i istorijske cene zlata, možete koristiti online platforme ili
                                    aplikacije koje pružaju ažurirane informacije o trži&scaron;tu. Ili pogledajte u
                                    nastavku kako biste pristupili grafikonima cena zlata i ostali informisani o aktuelnom
                                    stanju na trži&scaron;tu plemenitih metala. Praćenje cena zlata može vam pomoći da bolje
                                    upravljate va&scaron;im investicijama i finansijskom budućno&scaron;ću.</p>
                            </div>
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-8">
                                <!-- TradingView Widget BEGIN -->
                                <div class="tradingview-widget-container">
                                    <div class="tradingview-widget-container__widget"></div>
                                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/"
                                            rel="noopener nofollow" target="_blank"><span class="blue-text">Track all
                                                markets on
                                                TradingView</span></a></div>
                                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js"
                                        async>
                                        {
                                            "symbols": [
                                                ["PYTH:XAUUSD|1D"]
                                            ],
                                            "chartOnly": false,
                                            "width": 1000,
                                            "height": 500,
                                            "locale": "en",
                                            "colorTheme": "light",
                                            "autosize": false,
                                            "showVolume": false,
                                            "showMA": false,
                                            "hideDateRanges": false,
                                            "hideMarketStatus": false,
                                            "hideSymbolLogo": false,
                                            "scalePosition": "right",
                                            "scaleMode": "Normal",
                                            "fontFamily": "-apple-system, BlinkMacSystemFont, Trebuchet MS, Roboto, Ubuntu, sans-serif",
                                            "fontSize": "10",
                                            "noTimeScale": false,
                                            "valuesTracking": "1",
                                            "changeMode": "price-and-percent",
                                            "chartType": "area",
                                            "maLineColor": "#2962FF",
                                            "maLineWidth": 1,
                                            "maLength": 9,
                                            "lineWidth": 2,
                                            "lineType": 0,
                                            "dateRanges": ["1d|1", "1m|30", "3m|60", "12m|1D", "60m|1W", "all|1M"]
                                        }
                                    </script>
                                </div> <!-- TradingView Widget END -->
                            </div>
                        </div>
                    </div>
        </section>
        <!-- #Golden Plates -->
    </div>
@endsection

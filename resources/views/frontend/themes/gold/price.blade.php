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
                            <div class="col-12 gold-price">
                                <div class="elementor-widget-container">
                                    <script src="https://charts.kt-solutions.de/assets/js/jquery.canvasjs.min.js"></script>
                                    <script src="https://charts.kt-solutions.de/assets/js/ktcharts.js"></script>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="">Period</label>
                                                <select name="" id="date-select" class="form-select">
                                                    <option value="1D">1 Dan</option>
                                                    <option value="1W" selected>1 Nedelja</option>
                                                    <option value="1M">1 Mesec</option>
                                                    <option value="1Y">1 Godina</option>
                                                    <option value="3M">1 Meseca</option>
                                                    <option value="3Y">3 Godine</option>
                                                    <option value="5Y">5 Godina</option>
                                                    <option value="10Y">10 Godina</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="">Period</label>
                                                <select name="" id="weight-select" class="form-select">
                                                    <option value="G">Gram</option>
                                                    <option value="KG">Kilogram</option>
                                                    <option value="OZ" selected>Unca</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="goldChart" style="width:100%;height:50vh">
                                        <div class="canvasjs-chart-container"
                                            style="position: relative; text-align: left; cursor: auto;"><canvas
                                                class="canvasjs-chart-canvas" width="1031" height="456"
                                                style="position: absolute; user-select: none;"></canvas><canvas
                                                class="canvasjs-chart-canvas" width="1031" height="456"
                                                style="position: absolute; -webkit-tap-highlight-color: transparent; user-select: none; cursor: default;"></canvas>
                                            <div class="canvasjs-chart-toolbar"
                                                style="position: absolute; right: 1px; top: 1px; border: 1px solid transparent;">
                                                <button state="pan" type="button" title="Pan"
                                                    style="display: none; background-color: white; color: black; border-top: none; border-right: 1px solid rgb(33, 150, 243); border-bottom: none; border-left: none; border-image: initial; user-select: none; padding: 5px 12px; cursor: pointer; float: left; width: 40px; height: 25px; outline: 0px; vertical-align: baseline; line-height: 0;"><img
                                                        style="height:95%; pointer-events: none;"
                                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAICSURBVEhLxZbPahNRGMUn/5MpuAiBEAIufQGfzr5E40YptBXajYzudCEuGqS+gGlrFwquDGRTutBdYfydzJ3LzeQmJGZue+Dw/Z17Mnfmu5Pof9Hr9Z61Wq0bWZMKj263O6xWq99wU9lOpzPMKgEhEcRucNOcioOK+0RzBhNvt9tPV4nmVF19+OWhVqt9xXgFXZq+8lCv119UKpUJ7iX2FmvFTKz8RH34YdBsNk8wVtjE4fGYwm8wrrDi3WBG5oKXZGRSS9hGuNFojLTe2lFz5xThWZIktayyiE2FdT3rzXBXz7krKiL8c17wAKFDjCus2AvW+YGZ9y2JF0VFRuMPfI//rsCE/C+s26s4gQu9ul7r4NteKx7H8XOC724xNNGbaNu++IrBqbOV7Tj3FgMRvc/YKOr3+3sE47wgEt/Bl/gaK5cHbNU11vYSXylfpK7XOvjuumPp4Wcoipu30Qsez2uMXYz4lfI+mOmwothY+SLiXJy7mKVpWs3Si0CoOMfeI9Od43Wic+jO+ZVv+crsm9QSNhUW9LXSeoPBYLXopthGuFQgdIxxhY+UDwlt1x5CZ1hX+NTUdt/OIvjKaDSmuOJfaIVNPKX+W18j/PLA2/kR44p5Sd8HbHngT/yTfNRWUXX14ZcL3wmX0+TLf8YO7CGT8yFE5zB3/gney25/OETRP9CtPDFe5jShAAAAAElFTkSuQmCC"
                                                        alt="Pan"></button><button state="reset" type="button"
                                                    title="Reset"
                                                    style="display: none; background-color: white; color: black; border-top: none; border-right: 0px solid rgb(33, 150, 243); border-bottom: none; border-left: none; border-image: initial; user-select: none; padding: 5px 12px; cursor: pointer; float: left; width: 40px; height: 25px; outline: 0px; vertical-align: baseline; line-height: 0;"><img
                                                        style="height:95%; pointer-events: none;"
                                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAeCAYAAABJ/8wUAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAPjSURBVFhHxVdJaFNRFP1J/jwkP5MxsbaC1WJEglSxOFAXIsFpVRE3ggi1K90obioRRBA33XXnQnciirhQcMCdorgQxBkXWlREkFKsWkv5npvckp/XnzRpKh64kLw733fffe9L/wrL0+mVUdO8uTSZ3MBL/we2qg4rkuSpodCELstXE46ziVkLQ6FQcGOmeSSq6wd4aV50d3drWjj8kQKZJTUc9kxFGenv79dZrDksTSTWWJp2QYtEPiErysyzdX0LsxsCQR8keX8gs6RHIk8ysdgKFg2G53mhuOPsshTlBjKaFo1g7SqLNoShKLdFXT8huQ/paLSbxatYnc2mHMM4hr18Vi8TIvCmXF3vYrW6cF23gGTOk0M1wA4RKvOmq6vLZRVJipvmSWT6tZ6CSEYkco5V50VPT4+D7RwOqi6RiSZm0fJ+vggSqkeoypdsNmuyelNwbXsbgvkWYMtzDWNvWaijoyOBqE+hVK8abcssUeXQ/YfKyi0gFYv1Ipgfoj34fYGTJLOYJA0ODirok32GLN8XhUWCwSes1hIwBg6LydJ/tEeRRapAdUp+wSAiZchtZZWWgAZ+JNpD8peYXQVK9UwUxNpzOK8pq97kURZhYTCKBwPD7h2zK+js7Myi7D8Fod+0TkMI8+EMAngLGc/WtBFWawkFHFnoj/t9KLgGmF0B3QfkxC+EarxkdhnFYlFLY06USqUwL7UMjICHfh/wOc2sCqhpxGbCkLvL7EUDbF73+6DkmVWB6zi7xUDQSLeYvWjAILvm9zEnkJhlbRcDQZcv6Kg2AipyT/Axw6wKlqVSqxDdjF8Izfod13qURdrG/nxehY+xGh+h0CSzKygGvSNQIcc097BI24jb9hax6kj2E7OrMFX1il+ICEf2NrPbhiXLl+fYl+U7zK4iYdsDcyLGf+ofFlkwcN+s10KhmpuYhhtm0hCLVIFL0MDsqNlDIqy9x2CLs1jL6OvrI7vPRbtohXG6eFmsFnHDGAp6n9AgyuVySRZrGvROxRgIfLXhzjrNYnNBUxNX/dMgRWT1mt4XLDovaApD53E9W3ilNX5M55LJHpRtIsgAvciR4WWcgK2Dvb1YqgXevmF8z2zEBTcKG39EfSKsT9EbhVUaI2FZO+oZIqImxol6j66/hcAu4sSN4vc1ZPoKeoE6RGhYL2YYA+ymOSSi0Z0wWntbtkGUWCvfSDXIxONraZ/FY90KUfNTpfC5spnNLgxoYNnR9RO4F8ofXEHOgogCQE99w+fF2Xw+b7O59rEOsyRqGEfpVoaDMQQ1CZrG46bcM6AZ0C/wPqNfHliqejyTySxh9TqQpL+xmbIlkB9SlAAAAABJRU5ErkJggg=="
                                                        alt="Reset"></button>
                                            </div>
                                            <div class="canvasjs-chart-tooltip"
                                                style="position: absolute; height: auto; box-shadow: rgba(0, 0, 0, 0.1) 1px 1px 2px 2px; z-index: 1000; pointer-events: none; display: none; border-radius: 5px;">
                                                <div
                                                    style=" width: auto;height: auto;min-width: 50px;line-height: auto;margin: 0px 0px 0px 0px;padding: 5px;font-family: Calibri, Arial, Georgia, serif;font-weight: normal;font-style: italic;font-size: 14px;color: #000000;text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);text-align: left;border: 2px solid gray;background: rgba(255,255,255,.9);text-indent: 0px;white-space: nowrap;border-radius: 5px;-moz-user-select:none;-khtml-user-select: none;-webkit-user-select: none;-ms-user-select: none;user-select: none;} ">
                                                    Sample Tooltip</div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        window.addEventListener('load', function() {
                                            const website = 'zlatnistandard';
                                            // General settings to configure the look of the charts
                                            options = {
                                                color: "#E0B649",
                                                backgroundColor: "#FFFFFF",
                                                showTitle: true,
                                                animationEnabled: true,
                                                language: "EN",
                                            }

                                            // Initialize Gold price, in EUR, 1 week, per ounce
                                            let chart = new KtsysChart(website, 'goldChart', 'GOLD', 'EUR', '1W', 'OZ', options);

                                            setInterval(() => {
                                                chart.interval = document?.querySelector('#interval')?.value || '1W';
                                                chart.weight = document?.querySelector('#weight')?.value || 'OZ';

                                            }, 30000);


                                            $('#date-select').on('change', function() {
                                                let period = $(this).val();
                                                let weight = $('#weight-select').val();
                                                chart.interval = period
                                                chart.weight = weight
                                            })

                                            $('#weight-select').on('change', function() {
                                                let period = $('#date-select').val();
                                                let weight = $(this).val();
                                                chart.interval = period
                                                chart.weight = weight
                                            })

                                            document.addEventListener('change', e => {
                                                if (!e.target.closest('#interval')) return;

                                                chart.interval = document?.querySelector('#interval')?.value || '1W';
                                                chart.weight = document?.querySelector('#weight')?.value || 'OZ';
                                            });

                                            document.addEventListener('change', e => {
                                                if (!e.target.closest('#weight')) return;

                                                chart.interval = document?.querySelector('#interval')?.value || '1W';
                                                chart.weight = document?.querySelector('#weight')?.value || 'OZ';
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-8 d-none">
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

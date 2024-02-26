@extends('frontend.themes.gold.layout.layout')
@section('title', 'Kursna lista | Poredjenje cena investicionog zlata u realnom vremenu')
@section('description', 'Kursna lista')
@section('keywords', '')
@section('image', 'themes/gold/assets/images/demo/demo-3.webp')
@section('content')
    <div class="page-content bg-white">
        <section class="content-inner-1 overlay-white-middle about-products2">
            <img src="/themes/gold/assets/images/bg-triangle3.webp" class="bg-img" alt="">
            <img src="/themes/gold/assets/images/bg-triangle4.webp" class="bg-img2" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Kursna lista Narodne banke Srbije<strong><br></strong></h2>
                        <p>Narodna banka Srbije (NBS) objavljuje dnevnu kursnu listu koja prikazuje zvanične kursne odnose
                            dinara (RSD) prema stranim valutama. Ova kursna lista je od izuzetne važnosti za ekonomiju
                            Srbije i za sve građane i firme koje se bave međunarodnom trgovinom ili finansijskim
                            transakcijama.</p>
                        <p>Kursna lista NBS obuhvata &scaron;irok spektar valuta, uključujući evro (EUR), američki dolar
                            (USD), &scaron;vajcarski franak (CHF), britansku funtu (GBP) i mnoge druge. Svaka valuta ima
                            svoj kurs prema dinaru, pri čemu se navodi i kupovni i prodajni kurs. Kupovni kurs je cena po
                            kojoj NBS kupuje strane valute, dok je prodajni kurs cena po kojoj NBS prodaje strane valute.
                        </p>
                        <p>Ovi kursni odnosi se redovno ažuriraju i objavljuju svakog radnog dana. Kursna lista omogućava
                            građanima i privredi da saznaju aktuelne vrednosti stranih valuta u odnosu na dinar i koriste ih
                            za različite finansijske transakcije, kao &scaron;to su plaćanja u inostranstvu, konverzija
                            valuta ili investiranje.</p>
                        <p>NBS pažljivo prati i interveni&scaron;e na deviznom trži&scaron;tu kako bi očuvala stabilnost
                            dinara i osigurala ravnotežu u spoljnotrgovinskim i finansijskim tokovima zemlje. Kursna lista
                            NBS je tako ključni instrument u održavanju stabilnosti domaće valute i podržava normalno
                            funkcionisanje privrede i međunarodne trgovine.</p>
                    </div>
                </div>
                <iframe width="100%" id="nbsIframe" scrolling="no" style="overflow-x: hidden;" height="2000px"
                    src="https://www.nbs.rs/kursnaListaModul/srednjiKurs.faces?lang=lat" frameborder="0"></iframe>

                <button onclick="changeIframeStyle">Test</button>

                <script>
                    function changeIframeStyle() {
                        var iframe = document.getElementById('myIframe');
                        var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

                        // Change font family and color of body in iframe
                        iframeDoc.body.style.fontFamily = 'Arial, sans-serif'; // Change to your desired font family
                        iframeDoc.body.style.color = 'red'; // Change to your desired color
                    }
                </script>
            </div>
        </section>
    </div>
@endsection

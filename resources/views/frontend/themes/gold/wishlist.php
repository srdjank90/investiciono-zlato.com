<!DOCTYPE html>
<html lang="en">
<?php require_once('head.php') ?>

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
                        <h1>Wishlist</h1>
                        <nav aria-label="breadcrumb" class="breadcrumb-row">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"> Home</a></li>
                                <li class="breadcrumb-item">Wishlist</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- inner page banner End-->
            <div class="content-inner-1">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="table-responsive">
                                <table class="table check-tbl style-1">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Product</th>
                                            <th></th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="product-item-close"><a href="javascript:void(0);"><i class="ti-close"></i></a></td>
                                            <td class="product-item-img"><img src="images/shop/shop-cart/pic1.jpg" alt="/"></td>
                                            <td class="product-item-name">Wooden Water Bottles </td>
                                            <td class="product-item-price"><span>$45.00</span><strong>$28.00</strong></td>
                                            <td class="product-item-stock text-primary">In Stock</td>
                                            <td class="product-item-totle"><a href="shop-cart.html" class="btn btn-gray btnhover text-nowrap">Add To Cart</a></td>
                                        </tr>
                                        <tr>
                                            <td class="product-item-close"><a href="javascript:void(0);"><i class="ti-close"></i></a></td>
                                            <td class="product-item-img"><img src="images/shop/shop-cart/pic2.jpg" alt="/"></td>
                                            <td class="product-item-name">Wooden Cup</td>
                                            <td class="product-item-price"><span>$95.00</span><strong>$56.00</strong></td>
                                            <td class="product-item-stock text-primary">In Stock</td>
                                            <td class="product-item-totle"><a href="shop-cart.html" class="btn btn-gray btnhover text-nowrap">Add To Cart</a></td>
                                        </tr>
                                        <tr>
                                            <td class="product-item-close"><a href="javascript:void(0);"><i class="ti-close"></i></a></td>
                                            <td class="product-item-img"><img src="images/shop/shop-cart/pic3.jpg" alt="/"></td>
                                            <td class="product-item-name">Bamboo toothbrushes</td>
                                            <td class="product-item-price"><span>$56.00</span><strong>$20.00</strong></td>
                                            <td class="product-item-stock text-primary">In Stock</td>
                                            <td class="product-item-totle"><a href="shop-cart.html" class="btn btn-gray btnhover text-nowrap">Add To Cart</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			// TradingViewWidget.jsx
import React, { useEffect, useRef, memo } from 'react';

function TradingViewWidget() {
  const container = useRef();

  useEffect(
    () => {
      const script = document.createElement("script");
      script.src = "https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js";
      script.type = "text/javascript";
      script.async = true;
      script.innerHTML = `
        {
          "symbols": [
            [
              "Zlato",
              "OANDA:XAUUSD|1D"
            ]
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
          "fontFamily": "Andale Mono, monospace",
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
          "dateRanges": [
            "1d|1",
            "1m|30",
            "3m|60",
            "12m|1D",
            "60m|1W",
            "all|1M"
          ],
          "dateFormat": "dd/MM/yyyy"
        }`;
      container.current.appendChild(script);
    },
    []
  );

  return (
    <div className="tradingview-widget-container" ref={container}>
      <div className="tradingview-widget-container__widget"></div>
      <div className="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span className="blue-text">Track all markets on TradingView</span></a></div>
    </div>
  );
}

export default memo(TradingViewWidget);

            <!-- Icon Box Start -->
            <section class="content-inner py-0">
                <div class="container-fluid px-0">
                    <div class="row gx-0">
                        <div class="col-xl-3 col-lg-3 col-sm-6">
                            <div class="icon-bx-wraper style-2 bg-light">
                                <div class="icon-bx">
                                    <img src="images/svg/icon-bx/password-check.svg" alt="/">
                                </div>
                                <div class="icon-content">
                                    <h5 class="dz-title">Filter &amp; Discover</h5>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                                </div>
                                <div class="data-text">01</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-6">
                            <div class="icon-bx-wraper style-2">
                                <div class="icon-bx">
                                    <img src="images/svg/icon-bx/cart.svg" alt="/">
                                </div>
                                <div class="icon-content">
                                    <h5 class="dz-title">Add to cart</h5>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                                </div>
                                <div class="data-text">02</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-6">
                            <div class="icon-bx-wraper style-2 bg-light">
                                <div class="icon-bx">
                                    <img src="images/svg/icon-bx/discovery.svg" alt="/">
                                </div>
                                <div class="icon-content">
                                    <h5 class="dz-title">Fast Shipping</h5>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                                </div>
                                <div class="data-text">03</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-6">
                            <div class="icon-bx-wraper style-2">
                                <div class="icon-bx">
                                    <img src="images/svg/icon-bx/box-tick.svg" alt="/">
                                </div>
                                <div class="icon-content">
                                    <h5 class="dz-title">Enjoy The Product</h5>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                                </div>
                                <div class="data-text">04</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Icon Box End -->

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
@extends('frontend.themes.mooncart.layout.layout')
@section('title', isset($setting['setting_seo_title_opt']) ? $setting['setting_seo_title_opt'] : 'MinuteSHOP')
@section('description', isset($setting['setting_seo_description_opt']) ? $setting['setting_seo_description_opt'] : '')
@section('keywords', isset($setting['setting_seo_keywords_opt']) ? $setting['setting_seo_keywords_opt'] : '')
@section('content')
    <div class="page-content">
        <!--banner-->
        <div class="dz-bnr-inr" style="background-image:url(/themes/mooncart/assets/images/background/bg-shape.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Korpa</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}"> Početna</a></li>
                            <li class="breadcrumb-item">Korpa</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>


        <!-- contact area -->
        <section class="content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table check-tbl">
                                <thead>
                                    <tr>
                                        <th>Proizvod</th>
                                        <th></th>
                                        <th>Cena</th>
                                        <th>Količina</th>
                                        <th>Međuzbir</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="products-row">

                                </tbody>
                            </table>
                        </div>
                        <div class="row shop-form m-t30 d-none">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-0">
                                        <input name="dzEmail" required="required" type="text" class="form-control"
                                            placeholder="Coupon Code">
                                        <div class="input-group-addon">
                                            <button name="submit" value="Submit" type="submit" class="btn coupon">
                                                Apply Coupon
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="shop-cart.html" class="btn btn-grey">UPDATE CART</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h4 class="title mb15">Ukupno</h4>
                        <div class="cart-detail">
                            <a href="javascript:void(0);" class="btn btn-outline-primary w-100 m-b20">Akcija
                                5% za sve nove kupce</a>
                            <div class="icon-bx-wraper style-4 m-b15 d-none">
                                <div class="icon-bx">
                                    <i class="flaticon flaticon-ship"></i>
                                </div>
                                <div class="icon-content">
                                    <span class="text-primary font-14">Dostava</span>
                                    <h6 class="dz-title">Enjoy The Product</h6>
                                </div>
                            </div>
                            <div class="icon-bx-wraper style-4 m-b30">
                                <div class="icon-bx">
                                    <img src="/themes/mooncart/assets/images/shop/shop-cart/icon-box/pic2.png"
                                        alt="/">
                                </div>
                                <div class="icon-content">
                                    <h6 class="dz-title">Isporuka i naručivanje proizvoda</h6>
                                    <p>Nakon dodavanja svih željenih proizvoda u korpu, dobićete ukupnu cenu
                                        koštanja sa troškovima štampe i isporuke poručene robe, imajte u vidu da
                                        određeni proizvod imaju minimalni broj komada koji je moguće poručiti.
                                        <br><br>
                                        Nakon
                                        potvrde porudžbine, na Vašu email adresu ćete dobiti konačan predračun za
                                        uplatu. Nakon uplate, dobićete mejl potvrde sa tačnim vremenom isporuke. Ako
                                        bilo gde zapnete, jednostavno nas kontaktirajte putem mejla ili telefonom.
                                    </p>
                                </div>
                            </div>
                            {{-- <div class="icon-bx-wraper style-4 m-b30">
                                <div class="icon-bx">
                                    <img src="/themes/mooncart/assets/images/shop/shop-cart/icon-box/pic2.png"
                                        alt="/">
                                </div>
                                <div class="icon-content">
                                    <h6 class="dz-title">Enjoy The Product</h6>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                                </div>
                            </div> --}}
                            {{-- <div class="save-text d-none">
                                <i class="icon feather icon-check-circle"></i>
                                <span class="m-l10">You will save ₹504 on this order</span>
                            </div> --}}
                            <table>
                                <tbody>
                                    <tr class="total">
                                        <td>
                                            <h6 class="mb-0">Ukupno</h6>
                                        </td>
                                        <td class="price">
                                            <span class="total-price"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{ route('frontend.checkout') }}" class="btn btn-secondary w-100">Predračun</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product END -->
        </section>
        <!-- contact area End-->

    </div>
@endsection

@section('scripts')
    <script>
        function changeProductQuantityCartPage(id, i) {
            let cartData = JSON.parse(localStorage.getItem('cart'));
            let qInput = $('#qty-' + id + '-' + i);
            cartData.products.forEach((product, ind) => {
                if (product.id == id && ind == i) {
                    product.quantity = qInput.val();
                }
            })
            localStorage.setItem('cart', JSON.stringify(cartData))
            printCartPageItems()
            drawCartItems(cartData.products)
        }

        function deleteProductCartPage(id, i) {
            let cartData = JSON.parse(localStorage.getItem('cart'));
            cartData.products.forEach((product, ind) => {
                if (product.id == id && ind == i) {
                    cartData.products.splice(ind, 1);
                }
            })
            localStorage.setItem('cart', JSON.stringify(cartData))
            printCartPageItems()
            drawCartItems(cartData.products)
        }

        function printCartPageItems() {
            let currency = '{{ $currency }}';
            let total = $(".total-price")
            let shipping = $(".shipping-price")
            let subtotal = $(".subtotal-price")
            let subtotalQuantityPlace = $(".checkout-total-quantity")
            let productsJSON = $("#products");
            let shippingPriceInfo = $(".shipping-price-info");

            let totalPrice = 0;
            let subtotalPrice = 0;
            let shippingPrice = 0;
            let subtotalQuantity = 0;

            let cart = JSON.parse(localStorage.getItem('cart'));
            productsJSON.val(JSON.stringify(cart.products))
            let productsRow = $(".products-row");
            productsRow.html('')
            let productsHtml = "";

            cart.products.forEach((product, i) => {
                subtotalPrice += product.price * product.quantity;
                subtotalQuantity += product.quantity

                productsHtml += '<tr>' +
                    '<td class="product-item-img">' +
                    '<img src="{{ $storageUrl }}' + product.files[0].path + '" alt="/">' +
                    '</td>' +
                    '<td class="product-item-name text-uppercase">' + product.name + ' <br>'
                product.meta.forEach(m => {

                    productsHtml += '<small>' + m.name + ':' +
                        m.value + ' </small>';
                });
                '</td>';
                productsHtml += '<td class="product-item-price">' + formatPrice(product.price) + '</td>' +
                    '<td class="product-item-quantity">' +
                    '<div class="quantity btn-quantity style-1 me-3">' +
                    '<input type="number" class="form-control" onchange="changeProductQuantityCartPage(' +
                    product
                    .id +
                    ',' + i + ')" min="' + product.categories[0].min_order_quantity + '" data-id="' +
                    product.id +
                    '" value="' + product.quantity +
                    '" id="qty-' + product.id + '-' + i + '" name="demo_vertical2">' +
                    '</div>' +
                    '</td>' +
                    '<td class="product-item-totle">' + formatPrice(product.price * product.quantity) +
                    '</td>' +
                    '<td class="product-item-close"><a onclick="deleteProductCartPage(' + product.id +
                    ',' + i + ')"  href="javascript:void(0);"><i class="ti-close"></i></a></td>' +
                    '</tr>';
            })

            if (subtotalPrice > 199) {
                shippingPrice = 0;
            } else {
                shippingPrice = 0
            }
            totalPrice = subtotalPrice + shippingPrice;

            // Set prices
            subtotalQuantityPlace.html(subtotalQuantity)
            subtotal.html(formatPrice(subtotalPrice) + ' ');
            shipping.html(formatPrice(shippingPrice));
            shippingPriceInfo.html(formatPrice(shippingPrice));
            total.html(formatPrice(totalPrice))

            productsRow.append(productsHtml)
        }

        $(document).ready(function() {
            printCartPageItems()
            $(".submit-checkout-btn").on('click', function() {
                localStorage.removeItem('cart');
                $("#checkoutForm").submit();
            });
        });
    </script>

@endsection

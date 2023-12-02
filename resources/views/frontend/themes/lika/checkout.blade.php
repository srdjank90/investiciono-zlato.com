@extends('frontend.themes.lika.layout.layout')

@section('content')
<div class="container content-space-1 content-space-lg-2">
    <div class="row">
        <div class="col-lg-8 mb-7 mb-lg-0">
            <h4 class="mb-3">Billing address</h4>

            <!-- Form -->
            <form id="checkoutForm" class="needs-validation" action="/checkout/store" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstNameShopCheckout" class="form-label">{{__('First name')}}</label>
                        <input type="text" name="first_name" class="form-control form-control-lg"
                            id="firstNameShopCheckout" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-6">
                        <label for="lastNameShopCheckout" class="form-label">{{__('Last name')}}</label>
                        <input type="text" name="last_name" class="form-control form-control-lg"
                            id="lastNameShopCheckout" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-12">
                        <label for="emailShopCheckout" class="form-label">{{__('Email')}}</label>
                        <input type="email" name="email" class="form-control form-control-lg" id="emailShopCheckout"
                            placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-12">
                        <label for="phone" class="form-label">{{__('Phone')}} <span
                                class="form-label-secondary">(Optional)</span></label>
                        <input type="text" name="phone" class="form-control form-control-lg" id="phone"
                            placeholder="Apartment or suite">
                    </div>
                    <!-- End Col -->

                    <div class="col-12">
                        <label for="address" class="form-label">{{__('Address')}}</label>
                        <input type="text" name="address" class="form-control form-control-lg" id="address"
                            placeholder="" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-12">
                        <label for="city" class="form-label">{{__('City')}}</label>
                        <input type="text" name="city" class="form-control form-control-lg" id="city" placeholder=""
                            required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-12">
                        <label for="zipShopCheckout" class="form-label">{{__('Zip')}}</label>
                        <input type="text" name="zip" class="form-control form-control-lg" id="zipShopCheckout"
                            placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                    <!-- End Col -->
                </div>
                <hr class="my-4">
                <div class="row align-items-center">
                    <div class="col-sm-6 order-sm-1 mb-3 mb-sm-0">

                    </div>
                    <!-- End Col -->
                    <input type="hidden" name="products" id="products">
                    <div class="col-sm text-center text-sm-start">
                        <a class="link" href="{{ route('frontend.cart') }}">
                            <i class="bi-chevron-left small ms-1"></i> {{__('Return to cart')}}
                        </a>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </form>
            <!-- End Form -->
        </div>
        <!-- End Col -->

        <div class="col-lg-4">
            <div class="ps-lg-4">
                <!-- Card -->
                <div class="card card-sm shadow-sm mb-4">
                    <div class="card-body">
                        <div class="border-bottom pb-4 mb-4">
                            <h3 class="card-header-title">{{ __('Order Summary') }}</h3>
                        </div>


                        <!-- Product -->
                        <div class="products-row">

                        </div>

                        <!-- End Product -->

                        <div class="border-bottom pb-4 mb-4">
                            <div class="d-grid gap-3">
                                <dl class="row">
                                    <dt class="col-sm-6">{{ __('Item Subtotal')}} (<span
                                            class="checkout-total-quantity"></span>)</dt>
                                    <dd class="col-sm-6 text-sm-end mb-0 subtotal-price"></dd>
                                </dl>
                                <!-- End Row -->

                                <dl class="row">
                                    <dt class="col-sm-6">Delivery</dt>
                                    <dd class="col-sm-6 text-sm-end mb-0">Free</dd>
                                </dl>
                                <!-- End Row -->
                            </div>
                        </div>

                        <div class="border-bottom pb-4 mb-4">
                            <div class="d-grid gap-3">
                                <!-- All shipments -->
                                <!-- Check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="deliveryRadioName"
                                        id="deliveryRadio1" checked>
                                    <label class="form-check-label text-dark" for="deliveryRadio1">
                                        BEX (Free for orders > 4000 RSD)
                                        <span class="d-block text-muted small">{{ __('Shipment may take 5-6 business
                                            days')}}</span>
                                    </label>
                                </div>
                                <!-- End Check -->
                            </div>
                        </div>

                        <h4 class="mb-3">{{__('Payment')}}</h4>

                        <div class="my-3 border-bottom pb-3">
                            <!-- List all payment options -->
                            <!-- Check -->
                            <div class="form-check">
                                <input id="cacheOnDelivery" name="paymentMethod" value="cacheOnDelivery" type="radio"
                                    class="form-check-input" checked required>
                                <label class="form-check-label" for="cacheOnDelivery">{{__('Cache on
                                    Delivery')}}</label>
                            </div>
                            <!-- End Check -->

                            <!-- Check -->
                            <div class="form-check">
                                <input id="creditCard" name="paymentMethod" value="creditCard" type="radio"
                                    class="form-check-input" required>
                                <label class="form-check-label" for="creditCard">{{__('Credit card')}}</label>
                            </div>
                            <!-- End Check -->
                        </div>

                        <div class="d-grid gap-3 mb-4">
                            <dl class="row">
                                <dt class="col-sm-6">{{ __('Total') }}</dt>
                                <dd class="col-sm-6 text-sm-end mb-0 total-price"></dd>
                            </dl>
                            <!-- End Row -->
                        </div>
                        <div class="d-grid">
                            <button type="button" class="btn btn-primary btn-lg submit-checkout-btn">{{__('Confirm
                                Order')}}</button>
                        </div>

                    </div>
                    <!-- End Card -->
                </div>

            </div>
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        let currency = '{{$currency}}';
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
        let productsHtml = "";

        cart.products.forEach(product => {
            subtotalPrice += product.price * product.quantity;
            subtotalQuantity += product.quantity
            productsHtml += '<div class="border-bottom pb-4 mb-4">' +
                '<div class="d-flex">' +
                '<div class="flex-shrink-0">' +
                '<div class="avatar avatar-lg me-3">' +
                '<img class="avatar-img" src="{{$storageUrl}}' + product.files[0].path + '" alt="' + product.name + '">' +
                '<sup class="avatar-status avatar-status-primary">' + product.quantity + '</sup>' +
                '</div>' +
                '</div>' +
                '<div class="flex-grow-1">' +
                '<h6>' + product.name + '</h6>' +
                '<div class="d-grid">';
                
            product.meta.forEach(m => {
                productsHtml += '<div class="text-body">';
                productsHtml += '   <span class="small">'+m.name+'</span>';
                productsHtml += '   <span class="small">'+m.value+'</span>';
                productsHtml += '</div>';
            });

            productsHtml +=    '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
        })

        if (subtotalPrice > 3999) {
            shippingPrice = 0;
        } else {
            shippingPrice = 390
        }
        totalPrice = subtotalPrice + shippingPrice;

        // Set prices
        subtotalQuantityPlace.html(subtotalQuantity)
        subtotal.html(formatPrice(subtotalPrice) + ' ');
        shipping.html(formatPrice(shippingPrice));
        shippingPriceInfo.html(formatPrice(shippingPrice));
        total.html(formatPrice(totalPrice))

        productsRow.append(productsHtml)

        $(".submit-checkout-btn").on('click', function() {
            console.log('Submit order')
            localStorage.removeItem('cart');
            $("#checkoutForm").submit();
        });

    });

</script>
@endsection
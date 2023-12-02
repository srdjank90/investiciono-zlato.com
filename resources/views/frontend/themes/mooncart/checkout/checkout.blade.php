@extends('frontend.themes.mooncart.layout.layout')
@section('title', isset($setting['setting_seo_title_opt']) ? $setting['setting_seo_title_opt'] : 'MinuteSHOP')
@section('description', isset($setting['setting_seo_description_opt']) ? $setting['setting_seo_description_opt'] : '')
@section('keywords', isset($setting['setting_seo_keywords_opt']) ? $setting['setting_seo_keywords_opt'] : '')
@section('content')
    <div class="page-content">
        <!--banner-->
        <div class="dz-bnr-inr" style="background-image:url(images/background/bg-shape.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>{{ __('Checkout') }}</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Početna</a></li>
                            <li class="breadcrumb-item">{{ __('Checkout') }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner End-->
        <div class="content-inner-1">
            <form id="checkoutForm" class="" action="{{ route('frontend.checkout.store') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row shop-checkout">
                        <div class="col-xl-8">
                            <h4 class="title m-b15">Vaši podaci</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Ime</label>
                                        <input name="first_name" id="first_name" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Prezime</label>
                                        <input name="last_name" id="last_name" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Naziv firme</label>
                                        <input name="company" id="company" required class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Adresa firme</label>
                                        <input name="company_address" id="company_address" required class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group m-b25">
                                        <label class="label-title">PIB</label>
                                        <input name="pib" id="pib" required class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Telefon</label>
                                        <input name="phone" id="phone" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Email</label>
                                        <input name="email" type="email" id="email" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Napomena</label>
                                        <textarea cols="4" rows="3"
                                            placeholder="Za sve proizvode na kojima nije upisan način štampe i cena ili želite da se štampa u više boja, molim Vas da upišete u ovu napomenu."
                                            name="note" id="note" class="form-control"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="products" id="products">
                                <input type="hidden" name="subtotal" id="subtotal-value">
                                <input type="hidden" name="total" id="total-value">
                                <input type="hidden" name="checkoutHtml" id="checkoutHtml">
                            </div>
                        </div>
                        <div class="col-xl-4 side-bar">
                            <h4 class="title m-b15">Vaša porudžbina</h4>
                            <div class="order-detail sticky-top" id="products-checkout-table">
                                <div class="products-row">

                                </div>
                                <table>
                                    <tbody>
                                        <tr class="subtotal">
                                            <td>{{ __('Subtotal') }}</td>
                                            <td class="price"><span class="subtotal-price"></span></td>
                                        </tr>
                                        <tr class="title">
                                            <td colspan="2" class="text-end"><i
                                                    class="icon feather icon-check-circle text-success"></i><span
                                                    class="m-l10 text-success">Ovom kupovinom štedite</span> <span
                                                    class="save-price text-success"></span></td>

                                        </tr>
                                        <tr class="shipping-text d-none">
                                            <td>Dostava</td>
                                            <td class="price"><span>Besplatna</span></td>
                                        </tr>
                                        {{-- <tr class="shipping">
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="form-check-input radio" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{ __('Shipping') }}
                                                </label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="form-check-input radio" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Flat Rate:
                                                </label>
                                            </div>
                                        </td>
                                        <td class="price">25.75</td>
                                    </tr> --}}
                                        <tr class="total">
                                            <td>{{ __('Total') }}</td>
                                            <td class="price"><span class="total-price"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="text">
                                    Nakon potvrde porudžbine, na Vašu email adresu ćete dobiti konačan predračun za uplatu.
                                </p>
                                <button type="button"
                                    class="btn btn-secondary w-100 submit-checkout-btn">{{ __('Confirm Order') }} <i
                                        class="fa-solid fa-spinner fa-spin d-none loading-order ms-2"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let currency = '{{ $currency }}';
            let total = $(".total-price")
            let shipping = $(".shipping-price")
            let subtotal = $(".subtotal-price")
            let subtotalQuantityPlace = $(".checkout-total-quantity")
            let productsJSON = $("#products");
            let shippingPriceInfo = $(".shipping-price-info");
            let savePriceContainer = $(".save-price");

            let totalPrice = 0;
            let subtotalPrice = 0;
            let shippingPrice = 0;
            let subtotalQuantity = 0;

            let cart = JSON.parse(localStorage.getItem('cart'));
            productsJSON.val(JSON.stringify(cart.products))
            let productsRow = $(".products-row");
            let productsHtml = "";

            cart.products.forEach(product => {

                subtotalQuantity += product.quantity
                let printPrice = 0;
                let printText = 'Bez štampe'

                upaljaci = product.categories.find(category => category.id == 9)
                if (upaljaci) {
                    printPrice = 0.1
                    printText = 'Cena štampe 0.1€ kom'
                }
                olovke = product.categories.find(category => category.name == 'Olovke')
                if (olovke) {
                    printPrice = 0.1
                    printText = 'Cena štampe 0.1€ kom'
                }
                notes = product.categories.find(category => category.name == 'Rokovnici i notesi')
                if (notes) {
                    printPrice = 0.5
                    printText = 'Cena štampe 0.5€ kom'
                }
                kalendari = product.categories.find(category => category.name == 'Kalendari')
                if (kalendari) {
                    printPrice = 0
                    printText = 'Uračunata cena štampe'
                }
                papirneKese = product.categories.find(category => category.name == 'Papirne kese')
                if (papirneKese) {
                    printPrice = 0.5
                    printText = 'Cena štampe 0.5€ kom'
                }
                biorazgradiveKese = product.categories.find(category => category.name ==
                    'Biorazgradive kese')
                if (biorazgradiveKese) {
                    printPrice = 0.5
                    printText = 'Cena štampe 0.5€ kom'
                }

                subtotalPrice += (product.price + printPrice) * product.quantity;

                productsHtml += '<div class="cart-item style-1">' +
                    '<div class="dz-media">' +
                    '<img src="{{ $storageUrl }}' + product.files[0].path + '" alt="/">' +
                    '</div>' +
                    '<div class="dz-content">' +
                    '<h6 class="title mb-0"><span class="text-uppercase">' + product.name + '</span> x' +
                    product.quantity +
                    '<br>';
                product.meta.forEach(m => {

                    productsHtml += '       <p class="fs-14px text-body-emphasis mb-0 mt-1">' + m
                        .name + ':';
                    productsHtml += '           <span class="text-body">' + m.value +
                        ' <br><small class="text-success">' +
                        printText + '</small></span>';
                    productsHtml += '       </p>';
                });
                productsHtml += '</h6>' +
                    '<span class="price">' + formatPrice(product.price) + '<br> ' + formatPrice(printPrice *
                        product
                        .quantity) + '</span>' +
                    '</div>';

                productsHtml += '</div>'
            })

            if (subtotalPrice > 199) {
                shippingPrice = 0;
                $('.shipping-text').removeClass('d-none')
            } else {
                shippingPrice = 0
            }
            totalPrice = subtotalPrice + shippingPrice;
            let totalNotSave = totalPrice;
            totalPrice = totalPrice * 0.95
            let savePrice = totalNotSave - totalPrice;
            savePriceContainer.html(formatPrice(savePrice))

            // Set prices
            subtotalQuantityPlace.html(subtotalQuantity)
            subtotal.html(formatPrice(subtotalPrice) + ' ');
            $('#subtotal-value').val(subtotalPrice)
            shipping.html(formatPrice(shippingPrice));
            shippingPriceInfo.html(formatPrice(shippingPrice));
            total.html(formatPrice(totalPrice))
            $('#total-value').val(totalPrice)

            productsRow.append(productsHtml)

            $(".submit-checkout-btn").on('click', function() {
                let firstName = $('#first_name');
                let lastName = $('#last_name');
                let company = $('#company');
                let companyAddress = $('#company_address');
                let pib = $('#pib');
                let phone = $('#phone');
                let email = $('#email');

                // Product condition
                let calendarsQuantity = 0
                let hasCalendars = false
                cart.products.forEach(product => {
                    if (product.categories[0].name == 'Kalendari') {
                        hasCalendars = true
                        calendarsQuantity = calendarsQuantity + product.quantity
                    }
                });

                if (calendarsQuantity < 100) {
                    alert(
                        'Da bi potvrdili porudžbinu, morate ispuniti uslov o poručivanju minimalnog broja kalendara (100 kom).')
                    productCondition = false
                } else {
                    productCondition = true
                }

                if (firstName.val().length > 0 && lastName.val().length > 0 && company.val().length > 0 &&
                    companyAddress.val().length > 0 && pib.val().length > 0 && phone.val().length > 0 &&
                    email.val()
                    .length > 0 && productCondition == true) {
                    localStorage.removeItem('cart');
                    $('#checkoutHtml').val($('#products-checkout-table').html())
                    $('.loading-order').removeClass('d-none')
                    $("#checkoutForm").submit();
                } else {
                    if (!productCondition) {
                        alert('Molimo Vas popunite sva polja!')
                    }
                }
            });
        });
    </script>
@endsection

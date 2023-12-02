<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- JS Global Compulsory  -->
<script src="/themes/lika/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- JS Implementing Plugins -->
<script src="/themes/lika/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js"></script>
<script src="/themes/lika/assets/vendor/hs-show-animation/dist/hs-show-animation.min.js"></script>
<script src="/themes/lika/assets/vendor/hs-go-to/dist/hs-go-to.min.js"></script>
<script src="/themes/lika/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/themes/lika/assets/vendor/countdown/countdown.js"></script>
<script src="/themes/lika/assets/vendor/hs-quantity-counter/dist/hs-quantity-counter.min.js"></script>
<!-- JS Front -->
<script src="/themes/lika/assets/js/theme.min.js"></script>
<!-- JS Plugins Init. -->
<script>
    (function() {
        // INITIALIZATION OF MEGA MENU
        new HSMegaMenu(".js-mega-menu", {
            desktop: {
                position: "left",
            },
        });
        new HSShowAnimation(".js-animation-link");
        HSBsValidation.init(".js-validate", {
            onSubmit: (data) => {
                data.event.preventDefault();
                alert("Submited");
            },
        });
        HSBsDropdown.init();
        new HSGoTo(".js-go-to");
    })();
</script>

<!-- Chart Scripts -->
<script>
    let APP_URL = "{{ env('APP_URL') }}";
    let APP_STORAGE_URL = "{{ $storageUrl }}";
    let CURRENCY = "{{ $currency }}";
    let itemSizeId = null
    let itemSizeName = ''
    let itemQuantity = 1
    let cart = JSON.parse(localStorage.getItem('cart')) || {
        products: []
    }
    let meta = @json($productMetas);
    let cartContainer = $(".cart-container");
    let cartNumberContainer = $(".cart-number-container");
    let cartNumberEmpty = '<i class="bi-basket"></i>';
    let cartEmpty = '<div class="text-center">' +
        '<div class="mb-5">' +
        '<img class="avatar avatar-xl avatar-4x3" src="/themes/lika/assets/svg/illustrations/oc-empty-cart.svg" alt="SVG">' +
        '</div>' +
        '<div class="mb-5">' +
        '<h3>Your cart is currently empty</h3>' +
        '<p>Before proceed to checkout you must add some products to your shopping cart. You will find a lot of interesting products on our "Products" page.</p>' +
        '</div>' +
        '<a class="btn btn-dark border-0 px-6" href="{{ route('frontend.products') }}">{{ __('Start shopping') }}</a>' +
        '</div>';

    function changeMetaValue(type, value, valueId) {
        meta.forEach(m => {
            if (type == m.name) {
                m.value = value
                m.valueId = valueId
            }
        });
    }

    // Draw Items in Cart
    function drawCartItems(products) {
        let productsHTML = ''
        let totalCart = 0
        products.forEach(product => {
            let productImage = '';
            if (product.files.length > 0) {
                productImage = '<img width="128" src="' + APP_STORAGE_URL + product.files[0].path + '" alt="">'
            }

            let pMetaString = '';
            product.meta.forEach(pMeta => {
                pMetaString += pMeta.valueId + "-"
            });

            totalCart += product.price;
            productsHTML += '<li class="cart-item cart-item-' + product.id + '-meta-' + pMetaString + '">' +
                '<div class="cart-img">' +
                productImage +
                '</div>' +
                '<div class="cart-details">' +
                '<a href="#">' + product.name + '</a>' +
                '<p class="m-0"> ' + product.quantity + ' x ' + formatPrice(product.price) + '</p>';
            product.meta.forEach(m => {
                productsHTML += '<p class="m-0"> ' + m.name + ': ' + m.value + '</p>';
            });

            productsHTML += '</div>' +
                '<div data-id="' + product.id + '"  data-meta="' + pMetaString +
                '" class="btn-remove remove-from-cart">x</div>' +
                '</li>';
        });

        let fullCartHTML = '<div class="cart-info">' +
            '<ul class="p-0">' +
            productsHTML +
            '</ul>' +
            '<h3><b>{{ __('Total') }}: <span class="total-cart"> </span></b></h3>' +
            '<a href="{{ route('frontend.checkout') }}" class="checkout">{{ __('Checkout') }}</a>' +
            '</div>';
        cartContainer.html("");
        cartContainer.html(fullCartHTML);

        let totalProductsNumber = 0;
        products.forEach(p => {
            totalProductsNumber = totalProductsNumber + p.quantity
        })

        cartNumberContainer.html("");
        cartNumberContainer.html('<i class="bi-basket"></i> <span style="position:absolute;top:0;right: 5px;">' +
            totalProductsNumber + '</span>');
        $('.total-cart').html(formatPrice(totalCart))
    }

    // Calculate Total Price of Products in Cart
    function calculateTotalCart(products) {
        $('.total-cart').html('')
        totalCart = 0;
        products.forEach(product => {
            totalCart += product.price * product.quantity;
        })
        $('.total-cart').html(formatPrice(totalCart))
    }

    // Product Exists
    function productExist(product, products) {
        let exist = false;
        let pMetaString = '';
        product.meta.forEach(pMeta => {
            pMetaString += pMeta.valueId + "-"
        });
        products.forEach(p => {
            let pMetaCartString = '';
            p.meta.forEach(pMetaCart => {
                pMetaCartString += pMetaCart.valueId + "-"
            });
            if (p.id === product.id && pMetaString == pMetaCartString) {
                exist = true
            }
        })
        return exist;
    }

    // Update Quantity
    function updateQuantity(product, products, quantity) {
        let pMetaString = '';
        product.meta.forEach(pMeta => {
            pMetaString += pMeta.valueId + "-"
        });

        products.forEach(p => {
            let pMetaCartString = '';
            p.meta.forEach(pMetaCart => {
                pMetaCartString += pMetaCart.valueId + "-"
            });
            if (p.id === product.id && pMetaString == pMetaCartString) {
                p.quantity = p.quantity + quantity
            }
        })
        cart.products = products
        localStorage.setItem('cart', JSON.stringify(cart));

        drawCartItems(products)
        calculateTotalCart(products)
    }

    // Format Price
    function formatPrice(number) {
        let decimals = 2
        let decpoint = '.' // Or Number(0.1).toLocaleString().substring(1, 2)
        let thousand = ',' // Or Number(10000).toLocaleString().substring(2, 3)
        let n = Math.abs(number).toFixed(decimals).split('.')
        n[0] = n[0].split('').reverse().map((c, i, a) =>
            i > 0 && i < a.length && i % 3 == 0 ? c + thousand : c
        ).reverse().join('')
        let final = (Math.sign(number) < 0 ? '-' : '') + n.join(decpoint)
        return final + " " + CURRENCY;
    }

    function metaStringGenerate(p) {
        let pMetaString = '';
        p.meta.forEach(pMeta => {
            pMetaString += pMeta.valueId + "-"
        });
        return pMetaString;
    }

    $(document).ready(function() {

        if (cart.products.length > 0) {
            drawCartItems(cart.products)
        } else {
            cartContainer.append(cartEmpty)
            cartNumberContainer.append(cartNumberEmpty)
        }

        $(".add-to-cart").on('click', function() {
            itemQuantity = parseInt($('.quantity-input').val())
            localStorage.removeItem('product');
            let product = $(this).data('product')
            product.quantity = itemQuantity
            product.meta = meta

            if (productExist(product, cart.products)) {
                updateQuantity(product, cart.products, itemQuantity)
            } else {
                cart.products.push(JSON.parse(JSON.stringify(product)))
                localStorage.setItem('cart', JSON.stringify(cart));
                drawCartItems(cart.products)
                calculateTotalCart(cart.products)
            }
            console.log('Added to chart');
            $('.size-item').each(function() {
                $(this).removeClass('active')
            });

        })

        $(document).on('click', '.remove-from-cart', function() {
            let id = $(this).data('id');
            let metaString = $(this).data('meta')
            $('.cart-item-' + id + '-meta-' + metaString).remove();
            $('.checkout-item-' + id + '-meta-' + metaString).remove();
            productsNew = cart.products.filter(p => (metaStringGenerate(p) !== metaString));
            cart.products = productsNew;
            calculateTotalCart(productsNew)
            localStorage.setItem('cart', JSON.stringify(cart));
            if (productsNew.length === 0) {
                cartContainer.html("")
                cartContainer.append(cartEmpty)
                cartNumberContainer.html("")
                cartNumberContainer.append(cartNumberEmpty)
            } else {
                let totalProductsNumber = 0;
                productsNew.forEach(p => {
                    totalProductsNumber = totalProductsNumber + p.quantity
                })
                cartNumberContainer.html("")
                cartNumberContainer.html(
                    '<i class="bi-basket"></i> <span style="position:absolute;top:0;right: 5px;">' +
                    totalProductsNumber + '</span>');
            }
        })

    });
</script>

<!-- JAVASCRIPT FILES ========================================= -->
<script src="/themes/gold/assets/js/jquery.min.js"></script><!-- JQUERY MIN JS -->
<script src="/themes/gold/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP MIN JS -->
<script src="/themes/gold/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="/themes/gold/assets/vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/themes/gold/assets/js/custom.js"></script><!-- CUSTOMJS-->

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
    let cartNumberEmpty = '';

    let cartEmpty =
        '<div class="text-center"><h3>{{ __('Your cart is currently empty') }}</h3>' +
        '<p>{{ __('Before proceed to checkout you must add some products to your shopping cart. You will find a lot of interesting products on our "Products" page.') }}</p>' +
        '<a class="btn btn-dark border-0 px-6" href="{{ route('frontend.products') }}">{{ __('Start shopping') }}</a></div>';

    function changeMetaValue(type, value, valueId, externalId, stock) {
        if (stock == 0) {
            $(".meta-stock").html('Nema na stanju')
        } else {
            $(".meta-stock").html(stock)
        }

        $(".meta-external-id").html(externalId)
        meta.forEach(m => {
            if (type == m.name) {
                m.value = value
                m.valueId = valueId
                m.stock = stock
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
                productImage = '<img width="80" height="80" src="' + APP_STORAGE_URL + product.files[0].path +
                    '" alt="">';
            }

            let pMetaString = '';
            product.meta.forEach(pMeta => {
                pMetaString += pMeta.valueId + "-"
            });

            totalCart += (product.price * product.quantity);

            productsHTML += '<li class="d-flex cart-item-' + product.id + '-meta-' + pMetaString + '">' +
                '<div class="cart-widget">' +
                '<div class="dz-media-back me-3">' +
                productImage +
                '</div>' +
                '<div class="cart-content">' +
                '<h6 class="title text-uppercase"><a href="javascript:void(0)">' + product.name + ' x ' +
                product.quantity +
                '</a></h6>' +
                '<div class="">';
            product.meta.forEach(m => {
                productsHTML += '<p class="m-0"> ' + m.name + ': ' + m.value + '</p>';
            });
            productsHTML += '<h6 class="dz-price text-primary mb-0">' + formatPrice(product.price) + '</h6>' +
                '</div>' +
                '</div>' +
                '<a  href="#" data-id="' + product.id + '"  data-meta="' + pMetaString +
                '" class="dz-close clear-product remove-from-cart ms-2">' +
                '<i class="ti-close"></i>' +
                '</a>' +
                '</div>' +
                '</li>';
        });

        let fullCartHTML = '<div class="shop-sidebar-cart">' +
            '<ul class="sidebar-cart-list">' +
            productsHTML +
            '</ul>' +
            '<div class="cart-total ">' +
            '<h5 class="mb-0">Ukupno:</h5>' +
            '<h5 class="mb-0 total-cart"></h5>' +
            '</div>' +
            '<div class="mt-auto">';
        if (totalCart > 199) {
            fullCartHTML += '<div class="shipping-time">' +
                '<div class="dz-icon">' +
                '<i class="flaticon flaticon-fast-delivery"></i>' +
                '</div>' +
                '<div class="shipping-content">' +
                '<h6 class="title pe-4">Čestitamo, dobili ste besplatnu isporuku!</h6>' +
                '</div>';
        }

        fullCartHTML += '</div>' +
            '<a href="{{ route('frontend.cart') }}" class="btn btn-secondary btn-block">Pogledaj korpu</a>' +
            '<a href="{{ route('frontend.checkout') }}" class="btn btn-light btn-block m-b20">Predračun</a>' +
            '</div>' +
            '</div>';


        cartContainer.html("");
        cartContainer.html(fullCartHTML);

        let totalProductsNumber = 0;
        products.forEach(p => {
            totalProductsNumber = parseInt(totalProductsNumber) + parseInt(p.quantity)
        })

        cartNumberContainer.html("");
        cartNumberContainer.html('<span class="badge badge-circle">' + totalProductsNumber + '</span>');
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
        return final + "" + CURRENCY;
    }

    function metaStringGenerate(p) {
        let pMetaString = '';
        p.meta.forEach(pMeta => {
            pMetaString += pMeta.valueId + "-"
        });
        return pMetaString;
    }

    // Autocomplete search
    $(function() {
        $(".autocomplete-search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('frontend.autocomplete') }}",
                    dataType: "json",
                    data: {
                        query: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                console.log(event)
                console.log(ui.item.value)
                $('.autocomplete-search').val(ui.item.value)
                $('.form-search').submit();
            },
            minLength: 1
        });
    });

    var div = document.getElementById("prices-updated");
    div.textContent = "Cene zlata upravo ažurirane"; // Set text content to empty string

    // Function to remove text after 5 seconds
    setTimeout(function() {
        var div = document.getElementById("prices-updated");
        div.textContent = ""; // Set text content to empty string
    }, 5000); // 5000 milliseconds = 5 seconds

    // Function to reload the page
    function reloadPage() {
        location.reload();
    }

    // Set interval to reload the page every 2 minutes (120000 milliseconds)
    setInterval(reloadPage, 120000);

    window.addEventListener('DOMContentLoaded', function() {
        var iframe = document.getElementById('nbsIframe');
        var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
        if (iframeDoc) {
            // Update background color of iframe body
            iframeDoc.body.style.backgroundColor = 'red';
        }
    });

    $(document).ready(function() {



        var header = $('.site-header');
        var headerOffset = header.offset().top;

        $(window).scroll(function() {
            if ($(window).scrollTop() > headerOffset) {
                //header.addClass('header-fixed');
            } else {
                //header.removeClass('header-fixed');
            }
        });


        $('.color-label:first').click();
        $('.color-input:first').next().children().addClass('checked-color');

        $('.color-input').change(function() {
            $('.checked-color').removeClass('checked-color')
            if ($(this).prop('checked')) {
                $(this).next().children().addClass('checked-color');
            }
        });

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
            tooltipTriggerEl))

        var offcanvasCart = document.getElementById('shoppingCart')

        if (cart.products.length > 0) {
            drawCartItems(cart.products)
        } else {
            cartContainer.append(cartEmpty)
            cartNumberContainer.append(cartNumberEmpty)
        }

        $(".add-to-cart").on('click', function() {
            if ($('#itemForm')[0].checkValidity()) {
                itemQuantity = parseInt($('.quantity-input').val())
                localStorage.removeItem('product');
                let product = $(this).data('product')
                product.quantity = itemQuantity
                product.meta = meta

                if (product.meta[0].stock > itemQuantity) {
                    if (productExist(product, cart.products)) {
                        updateQuantity(product, cart.products, itemQuantity)
                    } else {
                        cart.products.push(JSON.parse(JSON.stringify(product)))
                        localStorage.setItem('cart', JSON.stringify(cart));
                        drawCartItems(cart.products)
                        calculateTotalCart(cart.products)
                    }

                    var bsOffcanvas = new bootstrap.Offcanvas(offcanvasCart)
                    bsOffcanvas.show()
                } else {
                    alert('Nema dovoljno proizvoda na stanju');
                }

            } else {
                alert('Morate izabrati sve opcije!');
            }

        })

        $(document).on('click', '.remove-from-cart', function() {
            let id = $(this).data('id');
            let metaString = $(this).data('meta')
            $('.cart-item-' + id + '-meta-' + metaString).remove();
            $('.checkout-item-' + id + '-meta-' + metaString).remove();
            productsNew = cart.products.filter(p => (metaStringGenerate(p) !== metaString));
            cart.products = productsNew;
            calculateTotalCart(productsNew)
            drawCartItems(cart.products)

            localStorage.setItem('cart', JSON.stringify(cart));
            if (productsNew.length === 0) {
                cartContainer.html("")
                cartContainer.append(cartEmpty)
                cartNumberContainer.html("")
                cartNumberContainer.append(cartNumberEmpty)
            } else {
                let totalProductsNumber = 0;
                productsNew.forEach(p => {
                    totalProductsNumber = parseInt(totalProductsNumber) + parseInt(p.quantity)
                })
                cartNumberContainer.html("")
                cartNumberContainer.html('<span class="badge badge-circle">' + totalProductsNumber +
                    '</span>');

            }

        })



        $('.table-product-name').hover(
            function() {
                // On hover, remove the 'hidden' class from the previous sibling
                console.log($(this).width())
                $(this).prev().css({
                    left: $(this).width() + 'px'
                })
                $(this).prev().show();
            },
            function() {
                // On hover out, add the 'hidden' class back to the previous sibling
                $(this).prev().hide();
            }
        );

    });
</script>

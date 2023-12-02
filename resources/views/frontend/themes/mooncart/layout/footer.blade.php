<!-- Shoping Features -->
<section class="content-inner py-0">
    <div class="container-fluid px-0">
        <div class="row gx-0">
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="icon-bx-wraper style-2 bg-light wow fadeInUp" data-wow-delay="0.1s">
                    <div class="icon-bx">
                        <img src="/themes/mooncart/assets/images/svg/icon-bx/password-check.svg" alt="">
                    </div>
                    <div class="icon-content">
                        <h5 class="dz-title">Odaberite proizvode</h5>
                        <p>Izaberite željene proizvode i odgovarajuće opcije štampe</p>
                    </div>
                    <div class="data-text">01</div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="icon-bx-wraper style-2 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="icon-bx">
                        <img src="/themes/mooncart/assets/images/svg/icon-bx/cart.svg" alt="">
                    </div>
                    <div class="icon-content">
                        <h5 class="dz-title">Platite proizvode</h5>
                        <p>Nakon dobijanja predračuna na Vašu email adresu, izvršite uplatu</p>
                    </div>
                    <div class="data-text">02</div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="icon-bx-wraper style-2 bg-light wow fadeInUp" data-wow-delay="0.3s">
                    <div class="icon-bx">
                        <img src="/themes/mooncart/assets/images/svg/icon-bx/discovery.svg" alt="">
                    </div>
                    <div class="icon-content">
                        <h5 class="dz-title">Besplatna dostava</h5>
                        <p>Poručene i izrađene proizvode šaljemo u najkraćem mogućem roku</p>
                    </div>
                    <div class="data-text">03</div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="icon-bx-wraper style-2 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="icon-bx">
                        <img src="/themes/mooncart/assets/images/svg/icon-bx/box-tick.svg" alt="">
                    </div>
                    <div class="icon-content">
                        <h5 class="dz-title">Isporuka proizvoda</h5>
                        <p>Kurir će Vašu porudžbinu dostaviti na Vašu adresu</p>
                    </div>
                    <div class="data-text">04</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- #Shoping Features -->
<!-- Footer -->
<footer class="site-footer footer-dark style-1">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="widget widget_about me-2">
                        <div class="footer-logo logo-white">
                            <a href="index.html"><img src="/themes/mooncart/assets/images/logo-white.png"
                                    alt=""></a>
                        </div>
                        <ul class="widget-address">
                            <li>
                                <p><span>Adresa</span> : Rajka Mihailovića 10, 14210 Ub</p>
                            </li>
                            <li>
                                <p><span>E-mail</span> : office@reklamni-materijal.com</p>
                            </li>
                            <li>
                                <p><span>Telefon</span> : (060) 011-1448</p>
                            </li>
                        </ul>
                        <div class="subscribe_widget">
                            <h6 class="title fw-medium">Prijavite se na našu email listu</h6>
                            <form class="dzSubscribe"
                                action="https://mooncart.dexignzone.com/xhtml/script/mailchamp.php" method="post">
                                <div class="dzSubscribeMsg"></div>
                                <div class="form-group">
                                    <div class="input-group mb-0">
                                        <input name="dzEmail" required="required" type="email" class="form-control"
                                            placeholder="Unesite Vašu Email adresu">
                                        <div class="input-group-addon">
                                            <button name="submit" value="Submit" type="submit" class="btn">
                                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none">
                                                    <path d="M4.20972 10.7344H15.8717" stroke="#0D775E" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M10.0408 4.90112L15.8718 10.7345L10.0408 16.5678"
                                                        stroke="#0D775E" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                    @if ($posts->count() > 0)
                        <div class="widget widget_post">
                            <h5 class="footer-title">Najnoviji saveti</h5>
                            <ul>
                                <li>
                                    <div class="dz-media">
                                        <img src="/themes/mooncart/assets/images/shop/product/small/1.png"
                                            alt="">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="name"><a href="javascript:void(0);">Wooden Water Bottles</a></h6>
                                        <span class="time">July 23, 2023</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="col-xl-2 col-md-3 col-sm-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="widget widget_services">
                        <h5 class="footer-title">Brzi meni</h5>
                        <ul>
                            <li><a href="">Štampa i dizajn kalendara</a></li>
                            <li><a
                                    href="https://studiozadizajn.rs/izrada-dizajn-logotipa-najkvalitetnije-najpovoljnije">Logo
                                    dizajn</a></li>
                            <li><a href="https://studiozadizajn.rs/izrada-dizajn-web-shopa-prodavnice-custom-CMS">Web
                                    dizajn</a></li>
                            <li><a href="https://studiozadizajn.rs/izrada-dizajn-knjige-grafickih-standarda-brand-book">Knjiga
                                    grafičkih standarda</a></li>
                            <li><a href="https://studiozadizajn.rs/graficki-dizajn-stampa-reklamni-materijal">Grafički
                                    dizajn</a></li>
                            <li><a href="{{ route('frontend.contact') }}">Imate pitanje</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Top End -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row fb-inner wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6 col-md-12 text-start">
                    <p class="copyright-text">© 2023 <a href="https://allinclusive.agency">Allinclusive.</a> just work
                        it.</p>
                </div>
                <div class="col-lg-6 col-md-12 text-end">
                    <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-end">
                        <span class="me-3"></span>
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->

</footer>
<!-- Footer End -->

<button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>

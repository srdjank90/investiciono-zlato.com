@extends('frontend.themes.gold.layout.layout')
@section('title', 'Kontakt | Poredjenje cena investicionog zlata u realnom vremenu')
@section('description', 'Kontakt')
@section('keywords', '')
@section('content')
    <div class="page-content" style="min-height: 800px">
        <!--banner-->
        <div class="contact-bnr bg-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-info style-1 text-start text-white">
                            <h2 class="title wow fadeInUp" data-wow-delay="0.1s">Kontaktirajte nas</h2>
                            <div class="text-white mt-4">
                                Zainteresovani za praćenje cena zlata i donošenje pametnih investicionih odluka? Posetite
                                našu
                                kontakt stranicu i javite nam se danas! Naš tim stručnjaka će vam pružiti informacije o
                                najnovijim cenama zlata i pomoći vam da pronađete najbolje investicione prilike. Ne
                                propustite
                                šansu da ostvarite profit na tržištu plemenitih metala. Kontaktirajte nas sada!
                            </div>
                            <div class="wow fadeInUp text-white mt-4" data-wow-delay="0.3s">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="text-white">E-mail</h3>
                                        <a class="text-white"
                                            href="mailto:office@investiciono-zlato.com">office@investiciono-zlato.com</a>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="text-white">Adresa</h3>
                                        Nemanjina 25, 11080 Zemun
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="contact-area1 style-1 m-r20 m-md-r0 wow fadeInUp" data-wow-delay="0.5s">
                            <form class="dz-form dzForm" method="POST"
                                action="https://mooncart.dexignzone.com/xhtml/script/contact_smtp.php">
                                <input type="hidden" class="form-control" name="dzToDo" value="Contact">
                                <input type="hidden" class="form-control" name="reCaptchaEnable" value="0">
                                <div class="dzFormMsg"></div>
                                <label class="form-label">Ime</label>
                                <div class="input-group">
                                    <input required type="text" class="form-control" name="dzName">
                                </div>
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <input required type="text" class="form-control" name="dzEmail">
                                </div>
                                <label class="form-label">Telefon</label>
                                <div class="input-group">
                                    <input required type="text" class="form-control" name="dzPhoneNumber">
                                </div>
                                <label class="form-label">Poruka</label>
                                <div class="input-group m-b30">
                                    <textarea name="dzMessage" rows="4" required class="form-control m-b10"></textarea>
                                </div>
                                <div>
                                    <button name="submit" type="submit" value="submit"
                                        class="btn w-100 btn-secondary btnhover">Pošalji</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-inner-2 pt-0">
            <div class="map-iframe map d-none">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.3825624477!2d75.65046970649679!3d26.88544791796718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C+Rajasthan!5e0!3m2!1sen!2sin!4v1500819483219"
                    style="border:0; width:100%; min-height:100%; margin-bottom: -8px;" allowfullscreen></iframe>
            </div>
        </div>

    </div>
@endsection

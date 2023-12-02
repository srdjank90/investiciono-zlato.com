@extends('frontend.themes.mooncart.layout.layout')
@section('title', isset($setting['setting_seo_title_opt']) ? $setting['setting_seo_title_opt'] : 'MinuteSHOP')
@section('description', isset($setting['setting_seo_description_opt']) ? $setting['setting_seo_description_opt'] : '')
@section('keywords', isset($setting['setting_seo_keywords_opt']) ? $setting['setting_seo_keywords_opt'] : '')
@section('content')
    <div class="page-content">
        <!--banner-->
        <div class="contact-bnr bg-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-info style-1 text-start text-white">
                            <h2 class="title wow fadeInUp" data-wow-delay="0.1s">IMATE PITANJE?</h2>
                            <p class="text wow fadeInUp" data-wow-delay="0.2s"><span
                                    class="text-decoration-underline text-white"><a class="text-white"
                                        href=""></a></span> <br> Stojimo Vam na raspolaganju za sva Vaša pitanja i
                                nedoumice.</p>
                            <div class="contact-bottom wow fadeInUp" data-wow-delay="0.3s">
                                <div class="contact-left">
                                    <h3>Pozovite nas</h3>
                                    <ul>
                                        <li>+381-60-011-1448</li>

                                    </ul>
                                </div>
                                <div class="contact-right">
                                    <h3>Pošaljite nam email</h3>
                                    <ul>
                                        <li>office@reklamni-materijal.com</li>
                                    </ul>
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
                                <label class="form-label">Unesite Vaše ime</label>
                                <div class="input-group">
                                    <input required type="text" class="form-control" name="dzName">
                                </div>
                                <label class="form-label">Unesite Email adresu</label>
                                <div class="input-group">
                                    <input required type="text" class="form-control" name="dzEmail">
                                </div>
                                <label class="form-label">Unesite broj telefona</label>
                                <div class="input-group">
                                    <input required type="text" class="form-control" name="dzPhoneNumber">
                                </div>
                                <label class="form-label">Upišite Vašu poruku</label>
                                <div class="input-group m-b30">
                                    <textarea name="dzMessage" rows="4" required class="form-control m-b10"></textarea>
                                </div>
                                <div>
                                    <button name="submit" type="submit" value="submit"
                                        class="btn w-100 btn-secondary btnhover">POŠALJITE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-inner-2 pt-0">
            <div class="map-iframe map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11391.052363243638!2d20.0648311!3d44.4585289!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a1e88aa1e3323%3A0x449de9b98601340f!2z0IjQtdGE0LjQvNC40ZjQsA!5e0!3m2!1sen!2srs!4v1697908597692!5m2!1sen!2srs"
                    style="border:0; width:100%; min-height:100%; margin-bottom: -8px;" allowfullscreen></iframe>
            </div>
        </div>

    </div>
@endsection

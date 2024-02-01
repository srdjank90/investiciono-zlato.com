<!-- Footer -->
<footer class="site-footer footer-dark style-1">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="widget widget_about me-2">
                        <div class="footer-logo logo-white">
                            <a href="index"><img src="/themes/gold/assets/images/footer-logo.webp" alt=""></a>
                        </div>
                        <ul class="widget-address">
                            <li class="d-none">
                                <p><span>Adresa</span> : Nemanjina 25, 11080 Zemun</p>
                            </li>
                            <li>
                                <p><span>E-mail</span> : <a
                                        href="mailto:kontakt@investiciono-zlato.com">kontakt@investiciono-zlato.com</a>
                                </p>
                            </li>
                        </ul>
                        <div class="subscribe_widget">
                            <h6 class="title fw-medium">Prijavite se na mejl listu</h6>
                            <form id="newsletterForm" class="dzSubscribe" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-0">
                                        <input name="email" id="newsletterEmail" required="required" type="email"
                                            class="form-control text-dark" placeholder="Upišite email adresu">
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
                                <div class="newsletterMsg">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="widget widget_post">
                        <h5 class="footer-title">Najbolji saveti</h5>
                        <ul>
                            @foreach ($najboljiSaveti as $post)
                                <li>
                                    <div class="dz-media">
                                        @if ($post->image)
                                            <img src="{{ $storageUrl . $post->image->path }}"
                                                style="width:50px;height:50px;object-fit:cover" alt="/">
                                        @endif
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="name"><a
                                                href="{{ route('frontend.post', $post->slug) }}">{{ $post->title }}</a>
                                        </h6>
                                        <span class="time d-none">23.jul 2023.</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="widget widget_post">
                        <h5 class="footer-title">Najnoviji tekstovi</h5>
                        <ul>
                            @foreach ($najnovijiTekstovi as $post)
                                <li>
                                    <div class="dz-media">
                                        @if ($post->image)
                                            <img src="{{ $storageUrl . $post->image->path }}"
                                                style="width:50px;height:50px;object-fit:cover" alt="/">
                                        @endif
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="name"><a
                                                href="{{ route('frontend.post', $post->slug) }}">{{ $post->title }}</a>
                                        </h6>
                                        <span class="time d-none">23.jul 2023.</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-md-3 col-sm-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="widget widget_services">
                        <h5 class="footer-title">TOP 3 prodavaca</h5>
                        <ul>
                            @foreach ($companies as $key => $company)
                                @if ($key < 3)
                                    <li>
                                        <a href="{{ $company->url }}">{{ $company->name }}</a>
                                    </li>
                                @endif
                            @endforeach
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
                    <p class="copyright-text">© 2024 investiciono-zlato, Poredjenje cena zlata u realnom vremenu.</p>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->

</footer>
<!-- Footer End -->

<button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#newsletterForm').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    type: 'POST',
                    url: '/subscribe', // Change this to your backend endpoint
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('.newsletterMsg').html(response.message)
                        setTimeout(function() {
                            $('.newsletterMsg').html('')
                            $('#newsletterEmail').val('')
                        }, 3000)
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                    }
                });
            });
        });
    </script>
@endsection

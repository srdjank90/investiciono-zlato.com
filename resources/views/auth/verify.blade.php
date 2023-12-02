<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        MinuteSHOP®
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    @vite(['resources/sass/app.scss'])
</head>

<body>
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <div class="col-xl-4 col-lg-8 col-md-8 col-sm-10 col-xs-12">
                <div class="card p-4 rounded shadow">
                    <h3 class="text-center">MinuteSHOP®️</h3>
                    <h5 class="text-center">{{ __('Verify Your Email Address') }}</h5>
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request
                            another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset(" js/app.js") }}"></script>
</body>

</html>
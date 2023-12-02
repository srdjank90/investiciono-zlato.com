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
                    <div style="padding:0px 15px">
                        <img style="width:100%" src="{{ asset(" minuteshop/logo.png") }}" alt="">
                    </div>

                    <h5 class="text-center">MinuteSHOP®</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email -->
                        <div class="form-group mb-2">
                            <label class="form-label" for="email">{{ trans('Email') }}</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="enter your email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="password">{{ trans('Password') }}</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="password"
                                required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">
                                        {{ trans('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary color-white">{{ trans('Login') }}</button>
                        </div>

                    </form>
                </div>
                <div class="text-center pt-2">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ trans('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>AIHUT &ndash; Agent</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('css/agent/login/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/agent/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/agent/login/font/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/agent/login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('js/agent/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/agent/login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/agent/login/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/agent/login/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('css/agent/login/images/img-01.png') }}" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST"
                    action="{{ route('agent.submitResetPasswordForm') }}">
                    @csrf
                    <span class="login100-form-title">Reset Password</span>

                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="wrap-input100 validate-input" data-validate="New password is required">
                        <input class="input100" type="password" name="new_password" placeholder="new password"
                            autocomplete="off" maxlength="20">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('new_password')
                        <span class="invalid-attempt" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="wrap-input100 validate-input" data-validate="Confirm password is required">
                        <input class="input100" type="password" name="confirm_password" placeholder="Confirm Password"
                            autocomplete="off" maxlength="20">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('confirm_password')
                        <span class="invalid-attempt" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Submit
                        </button>
                    </div>
                    <div class="text-center p-t-12">
                        <a class="txt2" href="{{ route('agent.login') }}">
                            Already have an account? Log In
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="{{ asset('js/agent/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/agent/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('js/agent/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/agent/login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/agent/login/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/agent/login/main.js') }}"></script>

</body>

</html>

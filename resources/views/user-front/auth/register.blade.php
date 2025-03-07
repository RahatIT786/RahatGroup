<!DOCTYPE html>
<html lang="en">

{{-- <head>
    <title>AIHUT &ndash; User</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rahat</title>
    <meta name="description" content="Rahat">
    <meta name="keywords" content="Rahat">
    <link href="{{ asset('assets/user-front/stylesheets/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user-front/stylesheets/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user-front/stylesheets/icomoon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user-front/stylesheets/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user-front/stylesheets/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/slick-theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/splitting-cells.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user-front/stylesheets/fullcalendar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user-front/stylesheets/fullcalendar.print.css') }}"
        media="print" />
    <link href="{{ asset('assets/user-front/stylesheets/general.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,1000"
        rel="stylesheet">

    <style>
        :root {
            --ligthgreen: #ffa500;
            --darkgreen: #2D6F76;
        }

        .containerbox {
            background-color: var(--ligthgreen);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            width: 650px;
            height: 450px;
            margin: auto;
            max-widtg: 100%;
            box-shadow: 5px 5px 10px 0px grey;
            padding: 50px 0px;
            text-align: center;
        }

        .containerbox p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
        }

        .forgetpass {
            margin-top: 20px;
        }

        .forgetpass a {
            color: #000000;
        }

        .containerbox button.hidden {
            background-color: transparent;
            background-color: black;
        }

        .icons i {
            margin: 10px 3px 20px 3px;
        }

        .containerbox form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            /*height:100%;*/
            padding: 20px 40px;
        }

        .containerbox button {
            font-size: 14px;
            padding: 10px 20px;
            margin: 20px 0px;
        }

        .containerbox form input {
            width: 100%;
            height: 40px;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            margin: 10px 0px;
            outline: none;
            border: 2px solid white;
        }

        .containerbox form select {

            width: 100%;
            height: 40px;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            margin: 10px 0px;
            outline: none;
            border: 2px solid white;
        }

        .passdiv {
            width: 100%;
            height: 43px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: white;
            border-radius: 15px;
            margin: 10px 0;
        }

        .passdiv i {
            padding-right: 15px;
            cursor: pointer;
            transition: .2s ease;
        }

        .form_container {
            position: absolute;
            top: 0;
            height: 100%;
        }

        .sign_in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .containerbox.active .sign_in {
            transform: translateX(100%);
            opacity: 0;
        }

        .sign_up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .containerbox.active .sign_up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
            overflow: auto;
        }

        .text {
            display: none;
            padding: 0px 2px;
            color: brown;
        }

        @keyframes move {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .toggle_container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 130px 0 0 130px;
            z-index: 1000;
        }

        .containerbox.active .toggle_container {
            transform: translateX(-100%);
            border-radius: 0 130px 130px 0;
        }

        .toggle {
            background-color: var(--darkgreen);
            height: 100%;
            color: #fff;
            position: relative;
            left: -100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle p {
            padding-top: 20px;
        }

        .containerbox.active .toggle {
            transform: translateX(50%);
        }

        .toggle_panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle_left {
            transform: translateX(-200%);
        }

        .containerbox.active .toggle_left {
            transform: translateX(0);
        }

        .toggle_right {
            right: 0;
            transform: translateX(0);
        }

        .containerbox.active .toggle_right {
            transform: translateX(200%);
        }

        @media (max-width:868px) {
            .containerbox {
                width: 100%;
                height: 570px;
            }

            .sign_up,
            .sign_in {
                width: 100%;
                height: calc(100% - 200px);
            }

            .sign_up {
                right: 100%;
                left: auto;
            }

            .toggle_container {
                width: 100%;
                height: 200px;
                border-radius: 20px 20px 0 0px;
                top: auto;
                bottom: 0px;
                left: 0%;
            }

            .containerbox.active .toggle_container {
                transform: translateX(0%);
                border-radius: 20px 20px 0px 0;
            }

            .toggle h4 {
                margin-bottom: 10px;
            }

            .toggle p {
                padding-top: 10px;
                margin-bottom: 10px;
            }

            .containerbox button {
                margin: 10px 0px;
            }
        }
    </style>



</head> --}}
@include('user-front.includes.header')
<body>

    <div class="bg-light py-5"
        style="background:url({{ asset('img/login-bg-b2c.jpg') }}) no-repeat;background-size:cover;">
        <div class="container">
            <div class="containerbox active">
                <div class="sign_up form_container">
                    <form class="validate-form" method="POST"
                        action="{{ route('customer.postRegister') }}">

                        @if (session('user_register_success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="color: #1d6119;border: 1px solid #1d6119;">
                                {!! session('user_register_success') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    style="color: #1d6119;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @csrf
                        @method('post')
                      <h4>
                            User Registration
                      </h4>

                        <input class="name" type="text" id="name" name="name" maxlength="100" placeholder="{{ __('tablevars.name') }}" autocomplete="off">
                            <p class="namefield text">
                                <i class="fa fa-circle-exclamation"></i>
                                Please enter a valid username
                            </p>
                            @error('name')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror

                        <input class="city" name="city" type="text" id="city" maxlength="100"
                            placeholder="{{ __('tablevars.city') }}" autocomplete="off">
                        <p class="cityfield text"><i class="fa fa-circle-exclamation"></i> Please enter a city
                        </p>
                        @error('city')
                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                    @enderror
                        <select style="border: 0" class="input100" id="state_id" name="state_id">
                            <option value="">{{ __('tablevars.select') }}
                                {{ __('tablevars.state') }}</option>
                            @foreach ($QsStates as $RsCity)
                                <option value="{{ $RsCity->id }}">{{ $RsCity->state_name }}</option>
                            @endforeach
                        </select>
                        @error('state_id')
                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                    @enderror
                        <input class="email" type="email" name="email" maxlength="100" placeholder="{{ __('tablevars.email') }}"
                            autocomplete="off">
                        <p class="emailfield text"><i class="fa fa-circle-exclamation"></i> Please enter a valid
                            email-address</p>
                            @error('email')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>

                        @enderror

                        <input class="mobile" type="mobile" name="mobile" placeholder="{{ __('tablevars.mobile') }}" maxlength="10"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off">
                        <p class="mobilefield text"><i class="fa fa-circle-exclamation"></i> Please enter a valid
                            phone-no</p>
                            @error('mobile')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>

                        @enderror

                        <button type="submit" class="btn secondary-btn">Submit</button>
                    </form>
                </div>
                <div class="sign_in form_container">
                    <form class="login100-form validate-form" method="POST"
                        action="{{ route('customer.postLogin') }}">

                        @csrf
                        @method('post')

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <h4>Sign In</h4>
                        <p>Use your email password</p>
                        <input class="email1" name="email" type="email" placeholder="Email" autocomplete="off">

                        <p class="emailfield1 text"><i class="fa fa-circle-exclamation"></i> Please enter a valid
                            email-address</p>
                        <div class="passdiv">
                            <input class="pass1" type="password"  name="password" placeholder="Password" autocomplete="off"><i
                                class="fa fa-lock show-hide"></i>
                        </div>


                        <p class="passfield1 text"><i class="fa fa-circle-exclamation"></i> Please enter a valid
                            password</p>
                        <p class="forgetpass"><a href="{{ route('customer.forgotPassword') }}">Forget Your
                                Password?</a></p>
                        <button class="btn secondary-btn">SIGN IN</button>
                    </form>
                </div>
                <div class="toggle_container">
                    <div class="toggle">
                        <div class="toggle_panel toggle_left">

                            <a href="{{route('customer.login')}}" class="hidden btn default-btn" id="login">SIGN IN</a>
                            <p class="forgetpass"><a href="{{ route('customer.forgotPassword') }}" style="color: white; font-weight: bold;"><strong>Forget Your Password?</strong></a></p>
                        {{-- <p class="forgetpass"><a href="{{ route('customer.login') }}" style="color: white; font-weight: bold;"><strong>Already have an account ? <br>sign
                                in</strong></a></p> --}}
                        </div>
                        <div class="toggle_panel toggle_right">
                            <h4>Hello, Friend!</h4>
                            <p>Register with your personal details to use all of the site features</p>
                            <a href="{{ route('customer.register') }}" class="hidden btn default-btn" id="register">SIGN UP</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="{{ asset('assets/user-front/javascripts/jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/agent/login/main.js') }}"></script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
        const container = document.querySelector('.containerbox');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');
        const form = document.querySelector("form");

        const inputs = {
            name: document.querySelector(".name"),
            email: document.querySelector(".email"),
            pass: document.querySelector('.pass'),
            pass2: document.querySelector('.pass2'),
            mobile: document.querySelector('.mobile'),
            city: document.querySelector('.city'),
            email1: document.querySelector(".email1"),
            pass1: document.querySelector(".pass1")
        };

        const errorFields = {
            name: document.querySelector(".namefield"),
            email: document.querySelector(".emailfield"),
            mobile: document.querySelector(".mobilefield"),
            city: document.querySelector(".cityfield"),
            pass: document.querySelector(".passfield"),
            pass2: document.querySelector(".passfield2"),
            email1: document.querySelector(".emailfield1"),
            pass1: document.querySelector(".passfield1")
        };

        const patterns = {
            name: /^[a-z\d]{6,12}$/i,
            email: /^[^ ]+@[^ ]+\.[a-z]{2,3}$/,
            pass: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,12}$/,
            mobile: /^[+]?[0-9]{1,4}?[0-9]{7,12}$/,
            city: /^[a-z\d]{6,12}$/i
        };

        // Toggle between register and login views
        registerBtn.addEventListener('click', () => container.classList.add('active'));
        loginBtn.addEventListener('click', () => container.classList.remove('active'));

        // Toggle password visibility
        document.querySelectorAll(".show-hide").forEach(icon => {
            icon.addEventListener("click", () => {
                const input = icon.parentElement.querySelector("input");
                const isPassword = input.type === "password";
                input.type = isPassword ? "text" : "password";
                icon.classList.toggle("fa-lock", !isPassword);
                icon.classList.toggle("fa-unlock", isPassword);
            });
        });

        // Validate individual fields
        function validateField(input, pattern, errorField) {
            const isValid = pattern.test(input.value);
            errorField.style.display = isValid ? "none" : "inline";
            return isValid;
        }

        // Handle validation for each input
        function validateInputs() {
            return (
                validateField(inputs.name, patterns.name, errorFields.name) &&
                validateField(inputs.email, patterns.email, errorFields.email) &&
                validateField(inputs.pass, patterns.pass, errorFields.pass) &&
                validateField(inputs.pass2, patterns.pass, errorFields.pass2) &&
                validateField(inputs.mobile, patterns.mobile, errorFields.mobile) &&
                validateField(inputs.city, patterns.city, errorFields.city) &&
                validateField(inputs.email1, patterns.email, errorFields.email1) &&
                validateField(inputs.pass1, patterns.pass, errorFields.pass1)
            );
        }

        // Attach event listeners to fields for real-time validation
        Object.keys(inputs).forEach(key => {
            const inputElement = inputs[key];
            const pattern = patterns[key] || patterns.pass; // Use `pass` pattern as default for passwords
            const errorElement = errorFields[key];
            inputElement.addEventListener("keyup", () => validateField(inputElement, pattern, errorElement));
        });

        // Form submission with validation check
        // form.addEventListener("submit", (e) => {
        //     if (!validateInputs()) {
        //         e.preventDefault(); // Prevent form submission if validation fails
        //     }
        // });
    });
    </script> --}}

</body>

</html>


@include('user-front.includes.footer')

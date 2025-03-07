<!DOCTYPE html>
<html lang="en">

<head>
    <title>AIHUT &ndash; Agent</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('css/agent/login/images/icons/favicon.ico') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/agent/login/font/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/agent/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700,800,900.1000"
        rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-position: bottom;
            background-size: cover;
            background-color: #fdffff !important;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            overflow-x: hidden;
            font-weight: 600;
            color: #000000;
            height: 100%;
            margin: 0;
            padding: 0;
            font-size: 14px;
            font-family: "Cairo", Helvetica, sans-serif;
            line-height: 1.5;
        }

        .l-login-reg {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            position: relative;
            z-index: 1;
            padding: 15px 100px;
            background: rgba(0, 0, 0, .1);
            -webkit-backdrop-filter: blur(5px);
            backdrop-filter: blur(5px);
            color: #fff;
            height: 100vh;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 580px;
        }

        .l-login-reg .select2-container--default .select2-results__option {
            color: #000;
        }

        .l-login-reg .logo-wrapper {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .l-login-reg .logo-wrapper img {
            width: 110px;
        }

        .l-login-reg .logo-wrapper .txt {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            color: #b49164;
            font-size: 18px;
        }

        .l-login-reg__portal-name {
            text-align: center;
            font-size: 24px;
            margin-top: 15px;
            color: #b49164;
        }

        .c-login-form {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .c-login-form__title {
            font-size: 20px;
            margin: 30px 0 15px;
            font-weight: 700;
        }

        .c-login-form__control {
            border: 1px solid #e8e8e8;
            background: #ffffff;
            height: 45px;
            border-radius: 9px;
            padding: 0 15px;
            -webkit-transition: all .2s;
            transition: all .2s;
            display: block;
            width: 100%;
        }

        .c-login-form__control:focus,
        .c-login-form__control:focus-visible {
            border: 1px solid #b49164 !important;
            -webkit-box-shadow: 0 0 14px rgba(180, 145, 100, .2);
            box-shadow: 0 0 14px rgba(180, 145, 100, .2);
            outline: 0;
        }

        .c-login-form .select2-selection--single {
            border: 1px solid #e8e8e8;
            height: 45px;
            border-radius: 9px;
            padding: 0 15px;
            -webkit-transition: all .2s;
            transition: all .2s;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            width: 100%;
        }

        .c-login-form .select2-selection--single .select2-selection__rendered {
            padding: 0 !important;
            height: auto;
        }

        .c-login-form__login-btn {
            background: #b49164;
            border: #366362;
            height: 60px;
            margin-bottom: 20px;
            -webkit-box-shadow: 0 0 14px #b49164;
            box-shadow: 0 0 14px #b49164;
            color: #fff;
            border-radius: 9px;
            -webkit-transition: all .2s;
            transition: all .2s;
            background-image: -webkit-gradient(linear, left top, right top, from(#b49164), to(#7a603e));
            background-image: linear-gradient(to right, #b49164, #7a603e);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-top: 25px;
            cursor:pointer;
        }

        .c-login-form__login-btn:hover .c-login-form__login-btn__icon {
            margin-left: 20px;
        }

        .c-login-form__login-btn__icon {
            fill: #fff;
            width: 30px;
            -webkit-transition: all .2s;
            transition: all .2s;
            margin-left: 10px;
        }

        .c-login-form__back {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .c-login-form__back svg {
            width: 30px;
            -webkit-transition: all .2s;
            transition: all .2s;
            -webkit-transform: scale(-1);
            transform: scale(-1);
            fill: #ffffff;
        }

        .c-login-form__new-user {
            -webkit-transition: all .2s;
            transition: all .2s;
            border-bottom: 1px dashed transparent;
        }

        .c-login-form__new-user:hover {
            border-bottom: 1px dashed #366362;
        }

        .c-login-form__store-btns {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-top: 1rem;
        }

        .c-login-form__store-btns__btn {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-right: .5rem;
            border-radius: 25px;
        }

        .c-lang {
            margin-top: 15px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            color: #fff;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: flex-end;
        }

        .c-lang svg {
            display: none;
        }

        .c-lang g [fill] {
            fill: #ffffff;
        }

        .button-actions {
            position: relative;
            z-index: 10;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end
        }

        .button-actions a {
            color: #ffffff;
        }

        svg {
            overflow: hidden;
            vertical-align: middle;
        }

        .kt-svg-icon {
            height: 23px;
            width: 23px;
        }

        .kt-svg-icon g [fill] {
            fill: #b49164;
        }

        a {
            color: #b49164;
            text-decoration: none;
            background-color: transparent;
        }

        body a:active,
        body a:focus,
        body a:hover,
        html a:active,
        html a:focus,
        html a:hover {
            text-decoration: none !important;
        }

        a:hover {
            color: #896a42;
            text-decoration: underline;
        }
    </style>
</head>

<body style="background-image: url({{ asset('img/login-bg.jpeg') }}) !important;">
    <div class="l-login-reg">
        <div class="logo-wrapper">
            <a href="{{ route('userHome') }}" ><img alt="Logo" src="{{ asset('/assets/images/logo.png') }}"></a>
            <h3 class="txt" style="margin-bottom: -10px;">
                <b>
                    Business Solutions Platform
                </b>
            </h3>
        </div>
        <div class="l-login-reg__form">
            <form class="c-login-form" method="POST" novalidate="novalidate" name="form1" id="form1"
                autocomplete="off" action="{{ route('agent.ForgotPasswordPost') }}">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h1 class="c-login-form__title">Forgot Password?</h1>

                <div class="form-group">
                    <input class="c-login-form__control" type="text" name="email" placeholder="Email ID"
                        id="email" autocomplete="off" maxlength="40" required="required" autofocus="">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button id="kt_login_signin_submit" class="c-login-form__login-btn" onclick="$('#form1').submit()">
                    <span>
                        Submit
                        <svg class="c-login-form__login-btn__icon" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; " xml:space="preserve">
                            <path
                                d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068    c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557    l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104    c0.006-0.006,0.011-0.013,0.018-0.019C513.968,262.339,513.943,249.635,506.134,241.843z">
                            </path>
                        </svg>
                    </span>
                </button>

                <div class="w-100 button-actions mt-3">
                    <a href="{{ route('agent.login') }}" class="float-right kt-login__link-forgot">
                        Already have an account? Login
                    </a>
                </div>
            </form>
        </div>
        <div class="kt-footer__copyright" style="margin-top:20px;">
            <div>
                <div class="fadeInDown  animate10 d-flex">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path
                                    d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                        Technical Support E-mail:
                    </span>
                    <a href={{$adminmail}}>
                        <b> {{$adminmail}}</b>
                    </a>
                </div>
                <div class="fadeInDown  animate11 d-flex">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path
                                    d="M11.914857,14.1427403 L14.1188827,11.9387145 C14.7276032,11.329994 14.8785122,10.4000511 14.4935235,9.63007378 L14.3686433,9.38031323 C13.9836546,8.61033591 14.1345636,7.680393 14.7432841,7.07167248 L17.4760882,4.33886839 C17.6713503,4.14360624 17.9879328,4.14360624 18.183195,4.33886839 C18.2211956,4.37686904 18.2528214,4.42074752 18.2768552,4.46881498 L19.3808309,6.67676638 C20.2253855,8.3658756 19.8943345,10.4059034 18.5589765,11.7412615 L12.560151,17.740087 C11.1066115,19.1936265 8.95659008,19.7011777 7.00646221,19.0511351 L4.5919826,18.2463085 C4.33001094,18.1589846 4.18843095,17.8758246 4.27575484,17.613853 C4.30030124,17.5402138 4.34165566,17.4733009 4.39654309,17.4184135 L7.04781491,14.7671417 C7.65653544,14.1584211 8.58647835,14.0075122 9.35645567,14.3925008 L9.60621621,14.5173811 C10.3761935,14.9023698 11.3061364,14.7514608 11.914857,14.1427403 Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                        Call center:
                    </span>
                    <a href={{$adminmobile}}>
                        <b>{{$adminmobile}}</b>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/agent/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('js/agent/login/vendor/bootstrap/js/popper.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/agent/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>

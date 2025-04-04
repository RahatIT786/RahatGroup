<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <title>AIHUT &ndash; User</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.svg" />

    <link rel="stylesheet" href="{{ asset('css/agent/bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/agent/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/agent/owl.theme.default.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('js/agent/plugins/slick/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/agent/plugins/slick/slick-theme.css') }}" />

    <link rel="stylesheet" href="{{ asset('js/agent/plugins/select2/css/select2.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('js/agent/plugins/aos/aos.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/agent/summernote-lite.min.css') }}" />

    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('css/agent/style.css') }}" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
    @stack('extra_css')
    @vite([])

    <style>
        .la-ball-fussion,
        .la-ball-fussion>div {
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .la-ball-fussion {
            display: block;
            font-size: 0;
            color: #fff;
        }

        .la-ball-fussion.la-dark {
            color: #333;
        }

        .la-ball-fussion>div {
            display: inline-block;
            float: none;
            background-color: currentColor;
            border: 0 solid currentColor;
        }

        .la-ball-fussion {
            width: 8px;
            height: 8px;
        }

        .la-ball-fussion>div {
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 100%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            -webkit-animation: ball-fussion-ball1 1s 0s ease infinite;
            -moz-animation: ball-fussion-ball1 1s 0s ease infinite;
            -o-animation: ball-fussion-ball1 1s 0s ease infinite;
            animation: ball-fussion-ball1 1s 0s ease infinite;
        }

        .la-ball-fussion>div:nth-child(1) {
            top: 0;
            left: 50%;
            z-index: 1;
        }

        .la-ball-fussion>div:nth-child(2) {
            top: 50%;
            left: 100%;
            z-index: 2;
            -webkit-animation-name: ball-fussion-ball2;
            -moz-animation-name: ball-fussion-ball2;
            -o-animation-name: ball-fussion-ball2;
            animation-name: ball-fussion-ball2;
        }

        .la-ball-fussion>div:nth-child(3) {
            top: 100%;
            left: 50%;
            z-index: 1;
            -webkit-animation-name: ball-fussion-ball3;
            -moz-animation-name: ball-fussion-ball3;
            -o-animation-name: ball-fussion-ball3;
            animation-name: ball-fussion-ball3;
        }

        .la-ball-fussion>div:nth-child(4) {
            top: 50%;
            left: 0;
            z-index: 2;
            -webkit-animation-name: ball-fussion-ball4;
            -moz-animation-name: ball-fussion-ball4;
            -o-animation-name: ball-fussion-ball4;
            animation-name: ball-fussion-ball4;
        }

        .la-ball-fussion.la-sm {
            width: 4px;
            height: 4px;
        }

        .la-ball-fussion.la-sm>div {
            width: 6px;
            height: 6px;
        }

        .la-ball-fussion.la-2x {
            width: 16px;
            height: 16px;
        }

        .la-ball-fussion.la-2x>div {
            width: 24px;
            height: 24px;
        }

        .la-ball-fussion.la-3x {
            width: 24px;
            height: 24px;
        }

        .la-ball-fussion.la-3x>div {
            width: 36px;
            height: 36px;
        }

        /*
        * Animations
        */
        @-webkit-keyframes ball-fussion-ball1 {
            0% {
                opacity: .35;
            }

            50% {
                top: -100%;
                left: 200%;
                opacity: 1;
            }

            100% {
                top: 50%;
                left: 100%;
                z-index: 2;
                opacity: .35;
            }
        }

        @-moz-keyframes ball-fussion-ball1 {
            0% {
                opacity: .35;
            }

            50% {
                top: -100%;
                left: 200%;
                opacity: 1;
            }

            100% {
                top: 50%;
                left: 100%;
                z-index: 2;
                opacity: .35;
            }
        }

        @-o-keyframes ball-fussion-ball1 {
            0% {
                opacity: .35;
            }

            50% {
                top: -100%;
                left: 200%;
                opacity: 1;
            }

            100% {
                top: 50%;
                left: 100%;
                z-index: 2;
                opacity: .35;
            }
        }

        @keyframes ball-fussion-ball1 {
            0% {
                opacity: .35;
            }

            50% {
                top: -100%;
                left: 200%;
                opacity: 1;
            }

            100% {
                top: 50%;
                left: 100%;
                z-index: 2;
                opacity: .35;
            }
        }

        @-webkit-keyframes ball-fussion-ball2 {
            0% {
                opacity: .35;
            }

            50% {
                top: 200%;
                left: 200%;
                opacity: 1;
            }

            100% {
                top: 100%;
                left: 50%;
                z-index: 1;
                opacity: .35;
            }
        }

        @-moz-keyframes ball-fussion-ball2 {
            0% {
                opacity: .35;
            }

            50% {
                top: 200%;
                left: 200%;
                opacity: 1;
            }

            100% {
                top: 100%;
                left: 50%;
                z-index: 1;
                opacity: .35;
            }
        }

        @-o-keyframes ball-fussion-ball2 {
            0% {
                opacity: .35;
            }

            50% {
                top: 200%;
                left: 200%;
                opacity: 1;
            }

            100% {
                top: 100%;
                left: 50%;
                z-index: 1;
                opacity: .35;
            }
        }

        @keyframes ball-fussion-ball2 {
            0% {
                opacity: .35;
            }

            50% {
                top: 200%;
                left: 200%;
                opacity: 1;
            }

            100% {
                top: 100%;
                left: 50%;
                z-index: 1;
                opacity: .35;
            }
        }

        @-webkit-keyframes ball-fussion-ball3 {
            0% {
                opacity: .35;
            }

            50% {
                top: 200%;
                left: -100%;
                opacity: 1;
            }

            100% {
                top: 50%;
                left: 0;
                z-index: 2;
                opacity: .35;
            }
        }

        @-moz-keyframes ball-fussion-ball3 {
            0% {
                opacity: .35;
            }

            50% {
                top: 200%;
                left: -100%;
                opacity: 1;
            }

            100% {
                top: 50%;
                left: 0;
                z-index: 2;
                opacity: .35;
            }
        }

        @-o-keyframes ball-fussion-ball3 {
            0% {
                opacity: .35;
            }

            50% {
                top: 200%;
                left: -100%;
                opacity: 1;
            }

            100% {
                top: 50%;
                left: 0;
                z-index: 2;
                opacity: .35;
            }
        }

        @keyframes ball-fussion-ball3 {
            0% {
                opacity: .35;
            }

            50% {
                top: 200%;
                left: -100%;
                opacity: 1;
            }

            100% {
                top: 50%;
                left: 0;
                z-index: 2;
                opacity: .35;
            }
        }

        @-webkit-keyframes ball-fussion-ball4 {
            0% {
                opacity: .35;
            }

            50% {
                top: -100%;
                left: -100%;
                opacity: 1;
            }

            100% {
                top: 0;
                left: 50%;
                z-index: 1;
                opacity: .35;
            }
        }

        @-moz-keyframes ball-fussion-ball4 {
            0% {
                opacity: .35;
            }

            50% {
                top: -100%;
                left: -100%;
                opacity: 1;
            }

            100% {
                top: 0;
                left: 50%;
                z-index: 1;
                opacity: .35;
            }
        }

        @-o-keyframes ball-fussion-ball4 {
            0% {
                opacity: .35;
            }

            50% {
                top: -100%;
                left: -100%;
                opacity: 1;
            }

            100% {
                top: 0;
                left: 50%;
                z-index: 1;
                opacity: .35;
            }
        }

        @keyframes ball-fussion-ball4 {
            0% {
                opacity: .35;
            }

            50% {
                top: -100%;
                left: -100%;
                opacity: 1;
            }

            100% {
                top: 0;
                left: 50%;
                z-index: 1;
                opacity: .35;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('user-front.layouts.nav')

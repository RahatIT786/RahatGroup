<!DOCTYPE html>
<html lang="en" style="overflow-y: unset;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="index,follow">
    <meta name="description"
        content="Use Rahat, the first-ever official planning, booking and experience platform, to create your Hajj or Umrah itinerary to Makkah, Al Madinah, and beyond. With Rahat, travelers from all over the world can easily organize their entire visit, from applying for an eVisa to booking hotels and flights. Rahat can also be used to schedule visits to important sites, find transportation, curate itineraries, and access on-ground tools such as the Tawaf tracker and more.">
    <title>Aihut</title>
    <link rel="shortcut icon" href="assets/user/images/favicon.ico" />
    <link href="{{ asset('assets/user/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/flaticon.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('assets/user/css/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/settings.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/navstylechange.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/fullcalendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/fullcalendar.print.css') }}" rel="stylesheet" media="print" />
    <link href="{{ asset('assets/user/css/style.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/user/js/jquery.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="shortcut icon" href="public/images/favicon.ico" />
    <link href="public/css/font-awesome.min.css" rel="stylesheet" />
    <!-- <link href="public/css/bootstrap.min.css" rel="stylesheet"/> -->
    <link href="public/css/swiper-bundle.min.css" rel="stylesheet" />
    <link href="public/css/settings.css" rel="stylesheet" />
    <link href="public/css/navstylechange.css" rel="stylesheet" />
    <link href="public/css/style.css" rel="stylesheet" />
    <style>
        /* Define keyframes for the Ken Burns effect */
        @keyframes kenburns {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1.2);
            }
        }

        /* Apply the animation to the image
       .tp-bgimg.defaultimg {
            animation: kenburns 15s infinite alternate; /* Adjust the duration and other properties
        } */

        */
    </style>
</head>

<body>
    <div style="overflow: visible;" class="fAWLEZ" id="scroll-top">
        <header class="hqczHk">
            <div class="jrGDTn">
                <div id="top-bar" class="gmbkKe"
                    style="translate: none; rotate: none; scale: none; transform: translate(0px); opacity: 1; visibility: inherit;">
                    <div class="container">
                        <ul>
                            <li><a href="{{ route('contactUs') }}" target="_blank" rel="noreferrer">Contact Us</a></li>
                            <li><span>Call Center: +971 56 786 6713</span></li>
                        </ul>

                        <div class="language-button LanguageDropdown_customDropdown__bQ6Zy dropdown">

                            <button class="LanguageDropdown_button__dfi8p" type="button" id="language"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="LanguageDropdown_placeholderContainer__PKrf5">
                                    <div class="LanguageDropdown_placeholderText__hljkg" data-name="placeholderText">
                                        <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                            stroke-linecap="round" stroke-linejoin="round" color="#FFFFFF"
                                            style="color: rgb(255, 255, 255);" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path
                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                            </path>
                                        </svg>
                                        <div>en</div>
                                    </div><svg
                                        class="LanguageDropdown_chevron__DUiel LanguageDropdown_chevronOpen__9oVGp chevron"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#FFFFFF">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </button>

                            <div style="position: relative;" class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="language">
                                <div class="LanguageDropdown_drawer__QJrxQ language-button-drawer">
                                    <div class="LanguageDropdown_items__t69Nc ">
                                        <div class="LanguageDropdown_dropdownItem__0PFeS">
                                            <div class="cbkdPY">
                                                <div><strong>en</strong> — English</div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="LanguageDropdown_dropdownItem__0PFeS">
                                            <div class="cbkdPY">
                                                <div><strong>ar</strong> — العربية</div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="wTfxL">
                    <div class="container">
                        <div class="left">
                            <h1><a font-size="smallest" class="gnRJtI" href=""><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: 50px; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><img
                                            alt="Rahat" src="{{ asset('assets/user/images/logo.png') }}"
                                            style="inset: 0px; box-sizing: border-box; padding: 0px; border: medium; margin: auto; display: block; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"></span></a>
                            </h1>

                            <ul id="navLinks">
                                <li class="">
                                    <a font-size="smallest" class="gnRJtI" href="#">Home</a>
                                </li>
                                <li class="">
                                    <a font-size="smallest" class="gnRJtI"
                                        href="{{ Route('hajjPackages') }}">Hajj</a>
                                </li>
                                <li class="">
                                    <a font-size="smallest" class="gnRJtI" href="#">Umrah</a>
                                </li>
                                <li class="">
                                    <a font-size="smallest" class="gnRJtI" href="#">Ramzaan</a>
                                </li>
                                <li class="">
                                    <a font-size="smallest" class="gnRJtI" href="#">Tours</a>
                                </li>
                                <li class="">
                                    <a font-size="smallest" class="gnRJtI" href="#">Gallery</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('imageGallery') }}">Image</a></li>
                                        <li><a href="{{ route('videoGallery') }}">Video</a></li>
                                        <li><a href="#">Testimonial</a></li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a font-size="smallest" class="gnRJtI" href="#">Hotel</a>
                                </li>
                                <li class="">
                                    <a font-size="smallest" class="gnRJtI" href="#">Visa</a>
                                </li>
                            </ul>
                        </div>
                        <button id="btn" style="color: rgb(35, 40, 44); font-weight: 600;" class="bFTLdA"
                            data-toggle="modal" data-target="#applyVisaModal">Apply for Visa</button>
                        {{-- <a href="route('agent.login')" cla> <button id="btn"
                                style="color: rgb(35, 40, 44); font-weight: 600;" class="bFTLdA">Agent
                                Login</button></a> --}}


                        <button class="iiRkyB toggleNav">
                            <span
                                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><img
                                    alt="menu" src="{{asset('assets/user/svg/hamburger.svg')}}"
                                    style="inset: 0px; box-sizing: border-box; padding: 0px; border: medium; margin: auto; display: block; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"></span></button>
                    </div>
                </div>
            </div>
            <nav class="iqwyV" data-nav>
                <div>
                    <a><span
                            style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: 50px; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><img
                                alt="Rahat" src="{{ asset('assets/user/images/logo.png') }}"
                                style="inset: 0px; box-sizing: border-box; padding: 0px; border: medium; margin: auto; display: block; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"></span></a>
                    <button class="iiRkyB closeNav">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                            height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="language-button LanguageDropdown_customDropdown__bQ6Zy dropdown">
                    <button class="LanguageDropdown_button__dfi8p" type="button" id="language"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="LanguageDropdown_placeholderContainer__PKrf5">
                            <div class="LanguageDropdown_placeholderText__hljkg" data-name="placeholderText"><svg
                                    stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                    stroke-linecap="round" stroke-linejoin="round" color="#FFFFFF"
                                    style="color: rgb(255, 255, 255);" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>
                                <div>en</div>
                            </div><svg
                                class="LanguageDropdown_chevron__DUiel LanguageDropdown_chevronOpen__9oVGp chevron"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#FFFFFF">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </button>
                    <div style="position: relative;" class="dropdown-menu dropdown-menu-right"
                        aria-labelledby="language">
                        <div class="LanguageDropdown_drawer__QJrxQ language-button-drawer">
                            <div class="LanguageDropdown_items__t69Nc ">
                                <div class="LanguageDropdown_dropdownItem__0PFeS">
                                    <div class="cbkdPY">
                                        <div><strong>en</strong> — English</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="LanguageDropdown_dropdownItem__0PFeS">
                                    <div class="cbkdPY">
                                        <div><strong>ar</strong> — العربية</div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="btn" class="hxenFL" data-toggle="modal" data-target="#applyVisaModal">Apply for
                    Visa</button>
                <ul class="navlinks">
                    <li class="">
                        <a href="#">Home</a>
                    </li>
                    <li class="">
                        <a href="#">Hajj</a>
                    </li>
                    <li class="">
                        <a href="#">Umrah</a>
                    </li>
                    <li class="">
                        <a href="#">Ramzaan</a>
                    </li>
                    <li class="">
                        <a href="#">Tours</a>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Gallery</a>
                        <ul class="submenu dropdown-menu">
                            <li><a href="#">Image</a></li>
                            <li><a href="#">Video</a></li>
                            <li><a href="#">Testimonial</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#">Hotel</a>
                    </li>
                    <li class="">
                        <a href="#">Visa</a>
                    </li>
                </ul>
                <div class="gpRWBp">
                    <div>
                        <p>Connect with us</p>
                        <ul>
                            <li>
                                <a target="_blank" href="https://www.facebook.com/rahattravelsofindia/"
                                    rel="noopener noreferrer">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 16 16" style="width: 1.2rem; height: 1.2rem;" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/rahattravelsofindia/"
                                    rel="noopener noreferrer">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 16 16" style="width: 1.2rem; height: 1.2rem;" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com/RahatTravelsInd"
                                    rel="noopener noreferrer">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 16 16" style="width: 1.2rem; height: 1.2rem;" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://youtube.com/@RahatGroup" rel="noopener noreferrer">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 16 16" style="width: 1.2rem; height: 1.2rem;" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" rel="noopener noreferrer"
                                    href="https://linkedin.com/in/imran-rahat-00267274">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 448 512" style="width: 1rem; height: 1rem;" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor"
                                            d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <p style="line-height: 1.4rem;">Local Call Center <a href="#">+971 56 786 6713</a></p>
                </div>
            </nav>
        </header>

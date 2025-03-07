<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url('https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp');">
        <div class="container">
            <h1>CONTACT US</h1>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <!-- Contact Form -->
                <div class="col-md-8">
                    <div class="well well-sm contactus">
                        <form wire:submit.prevent="save">


                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="color: #1d6119;border: 1px solid #1d6119;">
                            {!! session('success') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                style="color: #1d6119;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                            <div class="row">
                                <div class="col-sm-3 col-xl-2 col-4">
                                    <div class="form-group">
                                        <label for="salutation">Salutation</label>


                                        <select class="custom-select form-control" name="salutation" id="salutation"
                                            wire:model="salutation">
                                            <option value="">Choose</option>
                                            <option value="1">Mr</option>
                                            <option value="2">Mrs</option>
                                            <option value="3">Miss</option>

                                        </select>
                                        @error('salutation')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xl-4 col-8">
                                    <div class="form-group">
                                        <label for="firstName">First Name</label>
                                        <input type="text" name="name" id="fname" class="form-control"
                                            value="" placeholder="First Name" wire:model="fname" maxlength="100">
                                        @error('fname')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xl-6 col-12">
                                    <div class="form-group">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" name="name" id="lname" class="form-control"
                                            value="" placeholder="Last Name" wire:model="lname"maxlength="100">
                                        @error('lname')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email" wire:model="email" maxlength="199">
                                        @error('email')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone_no" id="phone_no"
                                            placeholder="Mobile" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" wire:model="phone">
                                        @error('phone')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" rows="10" name="message" id="message" placeholder="Your message"
                                            wire:model="message" style="width: 100%; height: 70px;"></textarea>
                                        @error('message')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                {{-- <div class="col-sm-8 mb-2" style="display: flex;">
                                    <!-- CAPTCHA input and image -->
                                    <input type="text" wire:model="userInput" class="form-control"
                                        placeholder="Enter CAPTCHA">
                                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                    <div>
                                        <button wire:click="generateCaptcha" type="button"><i
                                                class="fa fa-refresh"></i></button>
                                    </div>
                                    <div>
                                        @error('userInput')
                                            <br>
                                            <span class="mt-2 block text-red"
                                                style="color: red;font-weight: 500;">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div> --}}


                                <div class="form-group col-md-8" style="display: flex">
                                    <input type="text" wire:model="userInput" class="form-control"
                                        placeholder="Enter CAPTCHA">
                                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                </div>
                                <div class="d-flex flex-row justify-content-start align-items-center">
                                    <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-6 mb-2">
                                    @error('userInput')
                                        <br>
                                        <span class="mt-2 block text-red"
                                            style="color: red;font-weight: 500;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="hidden" name="currentPageUrl" id="currentPageUrl" value="/contact-us">
                                <div class="col-md-12 d-flex text-center">
                                    <button type="submit" class="submit-btn">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Details -->
                <div class="col-md-4 cont-details">
                    <form autocomplete="off">
                        <legend class="c-dt-1"><i class="fa fa-globe"></i> &nbsp; Our Office </legend>
                        <address class="ct-inner-dt">
                            Head Office: 305 SVP Road, Dongri, Mumbai - 3, Next to Insha Allah Mashallah Perfumers
                        </address>
                        <legend class="c-dt-1"><i class="fa fa-phone"></i> &nbsp; Phone No:</legend>
                        <address class="ct-inner-dt">
                            <a href="tel:+91 7861078617">+91 7861078617</a>,
                            <a href="tel:+01123232384">01123232384</a>
                        </address>
                        <legend class="c-dt-1"><i class="fa fa-envelope"></i> &nbsp; Email Id:</legend>
                        <address class="ct-inner-dt">
                            <a href="mailto:info@rahat.in">info@rahat.com</a>
                        </address>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Office Locations Section -->
    <section class="locations-section">
        <div class="container">
            <div class="row">
                <div class="col=lg-12 col-sm-12 col-md-12 col-12 col-12">

                    <div class="mutliple_address">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs mutliple-address-tabs" role="tablist">

                            @foreach ($contacts as $index => $contact)
                                <li>
                                    <a href="#tab{{ $contact->id }}" aria-controls="tab{{ $contact->id }}"
                                        role="tab" data-toggle="tab" class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">{{ $contact->city->city_name }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Tab panes -->

                        <div class="tab-content mutliple-address-content multiplecontactborder">
                            @foreach ($contacts as $index => $contact)
                                <div role="tabpanel" class="tab-pane  {{ $index === 0 ? 'show active' : '' }}"
                                    id="tab{{ $contact->id }}">
                                    <div class="multiplecontact dd">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                <img src="{{ asset('assets/user/images/1709412674_blog.jpg') }}"
                                                    title="btpyatra" alt="bookoair">
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                <ul class="list-unstyled">

                                                    <li><span><i class="fa fa-map-marker"></i></span><a
                                                            href="">{{ $contact->address }}</a>
                                                    </li>

                                                    <li><span><i class="fa fa-phone"></i></span><a
                                                            href="">{{ $contact->phone_no }}</a>
                                                    </li>

                                                    <li><span><i class="fa fa-phone"></i></span><a
                                                            href="">{{ $contact->tollfree_no }}</a>
                                                        <span style="font-size: 12px;">(Toll Free)</span>
                                                    </li>

                                                    <li><span><i class="fa fa-envelope-o"></i></span><a
                                                            href="">{{ $contact->email }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            @if (!empty($contact->map_address))
                                                <div class="col-12">
                                                    <div class="google-map">
                                                        <iframe src="{{ $contact->map_address }}" width="600"
                                                            height="450" style="border:0;" allowfullscreen=""
                                                            loading="lazy"
                                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> <!-- col=lg-12 col-sm-12 col-md-12 col-12 col-12 section -->
            </div>
        </div>
    </section>
</main>

@push('extra_css')
    <style>
        .contact-section {
            padding: 50px 0;
            background-color: #f7f7f7;
        }

        .contactus {
            background: #fff;
            padding: 20px;
            border: 1px solid #d7d7d7;
            border-radius: 5px;
            -o-border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
        }

        .cont-details {
            background: #fff;
            border-radius: 6px;
            border: 1px solid #d7d7d7;
            padding-top: 20px;
        }

        .c-dt-1 {
            font-size: 16px;
            font-weight: 700;
        }

        legend {
            display: block;
            width: 100%;
            max-width: 100%;
            padding: 0;
            margin-bottom: .5rem;
            font-size: 1.5rem;
            line-height: inherit;
            color: inherit;
            white-space: normal;
        }

        .ct-inner-dt {
            border-bottom: 1px solid #eee;
            margin-top: 10px;
            padding-bottom: 10px;
            font-size: 14px;
        }

        address {
            margin-bottom: 1rem;
            font-style: normal;
            line-height: inherit;
        }


        .mutliple_address {
            margin: 2px;
            background: #e7e7e7;
            padding: 10px;
        }

        .mutliple_address {
            margin: 2px;
        }

        .nav {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }

        ul.nav.nav-tabs.mutliple-address-tabs {
            margin-bottom: 10px !important;
            border-bottom: none !important;
        }

        .mutliple_address li {
            margin: 10px 0;
        }

        .mutliple_address .nav-tabs li a {
            font-size: 14px;
            padding-top: 10px;
            padding-right: 15px;
            padding-bottom: 10px;
            padding-left: 15px;
            color: rgb(0, 0, 0);
        }

        .nav-tabs li.active a,
        .nav-tabs li.active a:hover,
        .nav-tabs li.active a:focus {
            color: #555555;
            border-bottom-color: transparent;
            cursor: default;
        }

        .nav li a:hover,
        .nav li a:focus {
            text-decoration: none;
            background-color: #eeeeee;
        }

        .mutliple_address .nav-tabs li a.active {
            background: rgb(180, 145, 100) !important;
            color: #fff;
            border-bottom: 1px solid #ddd !important;
        }

        .multiplecontactborder {
            border: 1px solid #ddd;
            border-top: 0px;
            box-shadow: 0 5px 25px 0 rgb(50 50 50 / 20%);
            padding: 10px;
            margin-bottom: 1.5rem;
        }

        .multiplecontact {
            display: inline-block;
            width: 100%;
            margin-left: -8px !important;
            margin-right: -8px !important;
        }

        .multiplecontact img {
            margin: 0 15px 15px 15px;
            width: 100%;
            max-width: 380px;
            padding: 7px;
            border: #ccc solid 1px;
            vertical-align: middle;
        }

        .multiplecontact iframe {
            margin-top: 20px;
            width: 100%;
            height: 300px;
        }

        .multiplecontact ul {
            margin: 0 0 0 60px;
        }

        .mutliple_address li {
            margin: 10px 0;
        }

        .multiplecontact ul li {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .multiplecontact ul li span {
            width: 70px;
        }

        .multiplecontact ul li i {
            font-size: 16px;
            background-color: rgb(180, 145, 100);
            color: #eeeeee;
            padding: 7px;
            width: 35px;
            text-align: center;
            position: absolute;
            left: 25px;
        }

        @media (max-width: 992px) {
            .mutliple_address .nav-tabs {
                overflow-x: auto;
                overflow-y: hidden;
                white-space: nowrap;
                padding-bottom: 5px;
            }

            .mutliple_address .nav-tabs li {
                float: none !important;
                display: inline-block;
            }
        }



    </style>
@endpush
@push('extra_js')
    <script></script>
@endpush

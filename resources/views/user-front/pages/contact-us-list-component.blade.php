<div>
    <div class="bannercls">
        <picture>
            <source media="(min-width:980px)" src="{{ asset('/assets/user-front/images/contact-us-header.jpg') }}">
            <source media="(min-width:400px)" src="{{ asset('/assets/user-front/images/contact-us-header.jpg') }}">
        </picture>
        <img src="{{ asset('/assets/user-front/images/contact-us-header.jpg') }}" title="" alt="" border="0">
        <div class="box">
            <div class="container">
                <div class="animate-box">
                    <nav class="breadcrumbs">
                        <span>
                            <span class="breadcrumb-text">
                                <a href="#">Home</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">Contact Us</span>
                        </span>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-4 mb-md-0">
                    <div class="well well-sm contactus">
                        <form wire:submit.prevent="save">
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
                                            value="" placeholder="Last Name" wire:model="lname" maxlength="100">
                                        @error('lname')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email" wire:model="email">
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

                                <div class="col-md-12 mb-3" style="display: flex">
                                    <!-- CAPTCHA input and image -->
                                    <input type="text" wire:model="userInput" class="form-control mr-2"
                                        placeholder="Enter CAPTCHA">
                                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" style="max-height: 50px;"
                                        class="mr-2" alt="Captcha Image">
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
                                </div>

                                {{-- <div class="col-md-12 text-right">
                                    <button type="submit" class="btn default-btn" value="">Submit
                                        Form</button>
                                </div> --}}

                                <input type="hidden" name="currentPageUrl" id="currentPageUrl" value="/contact-us">
                                <div class="col-md-12" style="text-align:right;">
                                    <button type="submit" class="btn default-btn">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cont-details h-100">
                        <form autocomplete="off" class="ng-pristine ng-valid">
                            <legend class="c-dt-1"><i class="fa fa-globe"></i> &nbsp; Our office </legend>
                            <address class="ct-inner-dt">
                                Head Office :- 305 SVP Road, Dongri, Mumbai - 3, Next to Insha Allah Mashallah Perfumers
                            </address>
                            <legend class="c-dt-1"><i class="fa fa-phone"></i> &nbsp; Phone No:</legend>
                            <address class="ct-inner-dt">
                                <a style="color:#333 !important;background:none;" href="tel:+91 9967786446">+91
                                    9967786446</a>, <a style="color:#333 !important;background:none;"
                                    href="tel:+91-8097734658">+91-8097734658</a>
                            </address>
                            <legend class="c-dt-1"><i class="fa fa-envelope"></i> &nbsp; Email Id:</legend>
                            <address class="ct-inner-dt">
                                <a style="color:#333 !important;background:none;"
                                    href="mailto:info@rahat.in">info@rahat.in</a>
                            </address>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mutliple_address">
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
                                                <img src="{{ asset('assets/user-front/images/1709412674_blog.jpg') }}"
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
                                                        <iframe src="{{ $contact->map_address }}" width="100%"
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
    </div>
</div>


@push('extra_css')
    <style>
        .contact-section {
            padding: 50px 0;
            background-color: #f7f7f7;
        }

        .mutliple_address {
            padding: 10px;
            background-image: linear-gradient(to right, #2D6F76, #7E9680);
        }

        ul.nav.nav-tabs.mutliple-address-tabs {
            margin-bottom: 10px !important;
            border-bottom: none !important;
        }

        .mutliple_address li {
            margin: 10px 0;
        }

        .mutliple_address .nav-tabs li a.active {
            background-image: linear-gradient(to right, #ffa500, #e67717, #2D6F76, #7E9680) !important;
            background-size: 300% 100% !important;
            color: #fff;
            border-bottom: 1px solid #ddd !important;
        }

        .mutliple_address .nav-tabs li a {
            font-size: 14px;
            padding-top: 10px;
            padding-right: 15px;
            padding-bottom: 10px;
            padding-left: 15px;
            color: rgb(255, 255, 255);
            border-radius: 20px;
        }

        .tab-content>.active {
            display: block;
        }

        .multiplecontact {
            display: block;
            width: 100%;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .multiplecontact img {
            margin: 0 15px 15px 0px;
            width: 100%;
            max-width: 380px;
            padding: 7px;
            border: #ccc solid 1px;
            vertical-align: middle;
        }

        .multiplecontact ul {
            margin: 0 0 0 60px;
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none;
        }

        .multiplecontact ul li {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .mutliple_address li {
            margin: 10px 0;
        }

        .multiplecontact ul li {
            font-size: 14px;
        }

        .multiplecontact ul li i {
            font-size: 16px;
            color: #eeeeee;
            padding: 9px;
            width: 35px;
            height: 35px;
            text-align: center;
            position: absolute;
            left: 25px;
            background-image: linear-gradient(to right, #2D6F76, #7E9680) !important;
            border-radius: 50%;
        }

        .fa-map-marker:before {
            content: "\f041";
        }

        .multiplecontact ul li i {
            font-size: 16px;
            color: #eeeeee;
            padding: 9px;
            width: 35px;
            height: 35px;
            text-align: center;
            position: absolute;
            left: 25px;
            background-image: linear-gradient(to right, #2D6F76, #7E9680) !important;
            border-radius: 50%;
        }

        .multiplecontactborder {
            border: 1px solid #ddd;
            border-top: 0px;
            box-shadow: 0 5px 25px 0 rgb(50 50 50 / 20%);
            padding: 10px;
            background: #ffffff;
            border-radius: 10px;
        }

        .contactus {
            background: #fff;
            padding: 20px;
            border: 1px solid #d7d7d7;
        }

        .cont-details {
            background: #fff;
            border-radius: 6px;
            border: 1px solid #d7d7d7;
            padding: 20px;
        }

        .cont-details {
            background: #fff;
            border-radius: 6px;
            border: 1px solid #d7d7d7;
            padding: 20px;
        }

        .c-dt-1 {
            font-size: 16px;
            font-weight: 700;
            color: #2D6F76;
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

        .form-control {
            height: calc(3rem + 2px);
            font-size: 16px;
            border-radius: 10px;
            border: 1px solid #EBEBEB;
            padding: .375rem 1.2rem;
        }

        button {
            all: unset;
            cursor: pointer;
        }
    </style>
@endpush

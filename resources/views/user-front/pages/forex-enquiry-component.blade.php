<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="breadcrumbs mb-4">
                    <span>
                        <span class="breadcrumb-text">
                            <a href="#">Home</a>
                        </span>
                        <span class="breadcrumb-separator"></span>
                        {{-- <span class="breadcrumb-text">
                            <a href="{{ route('customer.service', ['slug' => $service->slug]) }}">Service</a>
                        </span> --}}
                        @if ($service)
                            <span class="breadcrumb-text">
                                <a href="{{ route('customer.service', ['slug' => $service->slug]) }}">Service</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">{{ $serviceName }}</span>
                        @else
                            <span class="breadcrumb-text">
                                Service Not Found
                            </span>
                        @endif
                    </span>
                    {{-- <span class="breadcrumb-separator">
                    </span>
                    <span class="breadcrumb-text">{{ $serviceName }} </span> --}}
                </nav>
            </div>
        </div>
        <h3>{{ $serviceName }} Enquiry Form</h3>
        <ul class="list-group shadow-sm">
            <li class="list-group-item bg-gradient text-white font-weight-bold"><span class="icon mr-2"><i
                        class="icon-users"></i></span>Service Name : {{ $serviceName }}</li>
        </ul>

        <div class="bg-white shadow-sm rounded p-3 mt-3 mb-4">
            <form name="frm_service_booking" wire:submit.prevent="save">
                <div>
                    @if (session('forex_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="color: #1d6119;border: 1px solid #1d6119;">
                            {!! session('forex_success') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                style="color: #1d6119;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif


                    <div class="colspan-enquiry">
                        <div class="row sendEnquiry-row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 no-padding">
                                <div class="form-group ">
                                    {{-- <select class="form-control" name="salutation"> --}}
                                    <select
                                        class="custom-select form-control @error('title')  validation-border @enderror"
                                        name="title " id="title" wire:model="title">

                                        <option value="1">Mr.</option>
                                        <option value="2">Mrs</option>
                                        <option value="3">Miss</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group ">
                                    <input type="text" name="full_name" id="full_name"
                                        class="form-control  @error('full_name')  validation-border @enderror"
                                        placeholder="Enter Full Name" wire:model="full_name">
                                </div>
                            </div>
                            {{-- <div class="col-sm-12 col-md-4 col-12 no-padding">
                            <div class="form-group ">
                                <input autocomplete="off" type="text" name="lname"
                                    id="lname" class="en_customername form-control"
                                    placeholder="Last Name *" aria-label="name"
                                    maxlength="50" value="">
                            </div>
                        </div> --}}
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group ">
                                <div class="txtfieldMain textfieldMain_mobile"
                                    style="border-radius: 4px !important; position: relative;">
                                    <div class="country_details">
                                        <div id="iti-flag3" class="iti-flag in"></div>
                                        <div class="iti-arrow"></div>
                                    </div>

                                    <input type="text"
                                        class="form-control  @error('mob_num')  validation-border @enderror"
                                        placeholder="Enter Mobile Number" name="mob_num" id="mob_num" maxlength="10"
                                        wire:model="mob_num">

                                    {{-- <input class="form-control numericonly mr-sm-2 sign-in-form-input-width1 en_customermobile"
                                    autocomplete="off" name="mobile" maxlength="10"
                                    placeholder="Enter Mobile Number *" type="tel" value="" validation-border @enderror"  name="contact" id="contact" wire:model="mob_num"> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group ">
                                <div class="colspan-enquiry">
                                    <div class="">
                                        <div class="">
                                            <input type="text" name="email_id" id="email_id"
                                                class="form-control @error('email_id')  validation-border @enderror"
                                                placeholder="Enter Email" wire:model="email_id">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group ">
                                {{-- <select class="form-control" name="CurrencyType"> --}}
                                <select
                                    class="custom-select form-control @error('currency_id')  validation-border @enderror"
                                    name="currency_id " id="catagory" wire:model="currency_id">

                                    <option value="1">INR</option>
                                    <option value="2">USD</option>
                                    <option value="3">AUD</option>
                                    <option value="4">CNY</option>
                                    <option value="5">GBP</option>
                                    <option value="6">JPY</option>
                                    <option value="7">SGD</option>
                                    <option value="8">THB</option>
                                    <option value="9">EUR</option>
                                    <option value="10">AED</option>
                                    <option value="11">KES</option>
                                    <option value="12">SAR</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group ">
                                <input type="text" name="amount" id="amount"
                                    class="form-control @error('amount')  validation-border @enderror"
                                    placeholder="Amount Required" wire:model="amount">
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group ">
                                {{-- <select class="form-control" name="InventoryType" id="delivery"> --}}
                                <select
                                    class="custom-select form-control @error('delivery')  validation-border @enderror"
                                    name="delivery " id="catagory" wire:model="delivery">

                                    <option value="1" selected="">Home Delivery
                                    </option>
                                    <option value="2">Pick Up</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group ">
                                {{-- <textarea class="form-control" name="address" id="message" placeholder="Address" style="height: 100px"></textarea> --}}
                                <textarea class="form-control @error('address')  validation-border @enderror" name="address" id="address"
                                    placeholder="Address" wire:model="address" style="height: 100px"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" style="display: flex;">
                            <input type="text" wire:model="userInput" class="form-control"
                                placeholder="Enter CAPTCHA" required>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                            <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
                        </div>
                    </div>





                </div>

                <div style="display: flex; justify-content: center; margin-top: 20px;">
                    <button type="submit" class="btn secondary-btn"
                        style="background-position: 300% 100% !important; margin-left: 10px;">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

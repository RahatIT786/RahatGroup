<div class="modal fade" id="ForexEnquiryModal" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Forex Enquiry Form</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body package-enquiry-form forex-enquiry-form">
                <form name="frm_quick_enquiry" wire:submit.prevent='save'>
                    <div class="row">
                        <div class=" col-lg-8 col-sm-12 col-12 ml-auto">
                            <form id="sendForex" class="sendForex ng-pristine ng-valid" method="post"
                                autocomplete="off">
                                <div>
                                    @if (session('forex_success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                                            style="color: #1d6119;border: 1px solid #1d6119;">
                                            {!! session('forex_success') !!}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close" style="color: #1d6119;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <h5 class="alert custom-success mb-2"> <a href="tel:+91 9967786446">
                                            <strong><i class="fa fa-phone-square"></i>
                                                Call us at : </strong> <span class="tollfreenumbersize">+91
                                                9967786446</span> <span></span></a></h5>
                                    <p class="or-txt text-center">OR</p>
                                    <h6 class="giveus">Give us your requirement for Forex Exchange </h6>

                                    <div class="colspan-enquiry">
                                        <div class="row sendEnquiry-row">
                                            <div class="col-sm-4 col-md-3 col-4 no-padding">
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
                                            <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                                                <div class="form-group ">
                                                    <!--<input class="form-control" type="text" name="dates" placeholder="When..">-->
                                                    {{-- <input autocomplete="off" type="text" name="fname"
                                                        id="mname"
                                                        class="en_customername2 form-control name_ladkh fullname_border"
                                                        placeholder="Full Name *" aria-label="name"
                                                        maxlength="50" value="" @error('full_name')  validation-border @enderror" placeholder="Enter Full Name"
                                                        wire:model="full_name"> --}}

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
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group ">
                                                <div class="txtfieldMain textfieldMain_mobile"
                                                    style="border-radius: 4px !important; position: relative;">
                                                    <div class="country_details">
                                                        <div id="iti-flag3" class="iti-flag in"></div>
                                                        <div class="iti-arrow"></div>
                                                    </div>

                                                    <input type="text"
                                                        class="form-control  @error('mob_num')  validation-border @enderror"
                                                        placeholder="Enter Mobile Number" name="mob_num" id="mob_num"
                                                        maxlength="10" wire:model="mob_num">

                                                    {{-- <input class="form-control numericonly mr-sm-2 sign-in-form-input-width1 en_customermobile"
                                                        autocomplete="off" name="mobile" maxlength="10"
                                                        placeholder="Enter Mobile Number *" type="tel" value="" validation-border @enderror"  name="contact" id="contact" wire:model="mob_num"> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group ">
                                                <div class="colspan-enquiry">
                                                    <div class="">
                                                        <div class="">
                                                            {{-- <input autocomplete="off" type="text" name="email"
                                                                id="inputEmail" class="txtField form-control"
                                                                placeholder="Email Address *" aria-label="Email ID"
                                                                value=""> --}}

                                                            <input type="text" name="email_id" id="email_id"
                                                                class="form-control @error('email_id')  validation-border @enderror"
                                                                placeholder="Enter Email" wire:model="email_id">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

                                    <div class="form-group ">
                                        <input type="text" name="amount" id="amount"
                                            class="form-control @error('amount')  validation-border @enderror"
                                            placeholder="Amount Required" wire:model="amount">

                                    </div>

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

                                    <div class="row" id="address">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group ">
                                                {{-- <textarea class="form-control" name="address" id="message" placeholder="Address" style="height: 100px"></textarea> --}}
                                                <textarea class="form-control @error('address')  validation-border @enderror" name="address" id="address"
                                                    placeholder="Address" wire:model="address" style="height: 100px"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-8" style="display: flex">
                                            <input type=""
                                                class="form-control  @error('userInput')  validation-border @enderror"
                                                name="userInput" id="userInput" wire:model.live="userInput"
                                                placeholder="Enter CAPTCHA">
                                            <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                        </div>

                                        <div class="d-flex flex-row justify-content-start align-items-center">
                                            <i wire:click="generateCaptcha" class="fa fa-refresh"
                                                aria-hidden="true"></i>
                                        </div>
                                    </div>

                                    <label class="checkbox inlinebl mb-0">
                                        <!--                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <input type="checkbox" name="optionscheckbox" id="optionscheckbox1"
                                            value="option1" class="icheck-green optionscheckbox1" checked=""
                                            autocomplete="off">
                                        <span
                                            style="font-size: 13px; cursor: pointer;font-weight: 600;color: var(--black-bg-color);">
                                            Documents required: Pan Card, Passport Copy, Flight Ticket, Visa
                                            Copy</span>
                                    </label>
                                </div>

                                <div class="modal-footer p-0 mt-4">
                                    <p><button type="submit" class="btn default-btn">Send
                                            Enquiry</button></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .custom-control-input {
            position: absolute;
            left: 0;
            z-index: -1;
            width: 1rem;
            height: 1.25rem;
            opacity: 0;
        }

        .alert {
            text-align: center;
        }

        .forex-enquiry-form {
            background: url({{ asset('/assets/user-front/images/modal-bg.jpg') }}) left top no-repeat;
            background-size: cover;
            background-position: left;
        }
    </style>
</div>
@push('extra_js')
    <script>
        document.addEventListener('livewire:initialized', function() {
            window.addEventListener('reload-page', function() {
                setTimeout(() => {
                    location.reload();
                }, 4000);
            });
        });
    </script>
@endpush

@push('extra_css')
@endpush

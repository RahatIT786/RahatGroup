<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="settings-widget profile-details">
                                <div class="settings-menu p-0">
                                    <div class="profile-heading">
                                        <h3 class="m-0">Payment Confirmation</h3>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="settings-widget profile-details">
                                <div class="settings-menu p-0">
                                    <div class="profile-heading">
                                        <h3>{{ __('tablevars.quote') }} {{ __('tablevars.details') }}
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2 mb-4">
                                                <h6>Dept Date </h6>
                                                <span>{{ $quote->travel_date ? Helper::appDateFormat($quote->travel_date) : 'N/A' }}</span>
                                            </div>
                                            <div class="col-2 mb-4">
                                                <h6>Starting Point </h6>
                                                <span>{{ $quote->city->city_name ?? '' }}</span>
                                            </div>
                                            <div class="col-2 mb-4">
                                                <h6>Quoted Fare </h6>
                                                <span>{{ Aihut::get('currency') }}
                                                    {{ number_format($quote->tot_cost, 2) }}</span>
                                            </div>
                                            <div class="col-2 mb-4">
                                                <h6>Balance </h6>
                                                <span>{{ Aihut::get('currency') }}
                                                    {{ number_format($balance, 2) }}</span>
                                            </div>

                                            <div class="col-4 mb-4">
                                                <div class="form-group">
                                                    <h6>Amount to be Paid</h6>
                                                    <select class="form-select " name="payment_amount"
                                                        wire:model='payment_amount' wire:change='changes'>
                                                        <option value="">{{ __('tablevars.select') }}
                                                            {{ __('tablevars.amount') }}</option>
                                                        <option value="{{ $this->advance }}">
                                                            {{ Aihut::get('currency') }}
                                                            {{ number_format($this->advance, 2) }} (Advance Payment)
                                                        </option>
                                                        <option value="{{ $this->quote->tot_cost }}">
                                                            {{ Aihut::get('currency') }}
                                                            {{ number_format($this->quote->tot_cost, 2) }} (Full
                                                            Payment)
                                                        </option>
                                                    </select>
                                                    @error('payment_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <span class="text-purple"> NOTE : Get 1% Discount when you pay full
                                                    amount </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Payment Summery --}}
                    {{-- <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="settings-widget profile-details">
                                <div class="settings-menu p-0">
                                    <div class="profile-heading">
                                        <h3>{{ __('tablevars.payment') }} {{ __('tablevars.summery') }}
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 mb-4">
                                                <h6>Selected Amount</h6>
                                                <span>{{ $payment_amount ? number_format($payment_amount, 2) : '' }}</span>
                                            </div>
                                            <div class="col-3 mb-4">
                                                <h6>Balance Amount to be Paid</h6>
                                                <span>{{ $payment_amount != '' ? number_format($quote->tot_cost - $payment_amount, 2) : number_format($quote->tot_cost, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="settings-widget profile-details">
                                <div class="settings-menu p-0">
                                    <div class="profile-heading">
                                        <h3>GST Details
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-3 mb-4">
                                                <h6>GST Number</h6>
                                                <span>{{ $quote->travel_date ? Helper::appDateFormat($quote->travel_date) : 'N/A' }}</span>
                                            </div>
                                            <div class="col-3 mb-4">
                                                <h6>GST Name</h6>
                                                <span></span>
                                            </div>
                                            <div class="col-3 mb-4">
                                                <h6>GST Email</h6>
                                                <span>{{ $quote->agency->email ?? '' }}</span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- check terms and condition --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-secondary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="checkout-form personal-address secure-alert border-line">
                                                <div class="personal-info-head">
                                                    <h4>Confirmation</h4>
                                                    <p class="text-danger">"I have read, understood, and agree to all
                                                        the terms and conditions of the group. Additionally, I agree to
                                                        comply with the payment terms and make payments accordingly."
                                                    </p>
                                                </div>
                                                <div class="form-check form-switch check-on">
                                                    <input class="form-check-input mr-2" type="checkbox"
                                                        id="confirmationCheckbox" wire:model="confirmationChecked"
                                                        wire:change='checked'>
                                                    <label class="form-check-label">Please check to proceed</label>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($confirmationChecked)
                                            <div class="address-check-widget comman-space">
                                                <div class="check-bill-address">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div
                                                                class="add-new-address grad-border hvr-sweep-to-right mt-4">
                                                                <a href="javascript:void(0);"
                                                                    wire:click="proceed('Offline', {{ $quote->id }})"
                                                                    class="btn btn-primary">Offline</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div
                                                                class="add-new-address grad-border hvr-sweep-to-right mt-4">
                                                                <a href="javascript:void(0);"
                                                                    wire:click="proceed('paymentGateway', {{ $quote->id }})"
                                                                    class="btn btn-primary">Online</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('payment_amount')
                                                        <span class="text-danger">{{ $message . ' to proceed' }}</span>
                                                    @enderror
                                                </div>

                                                {{-- <div class="address-check-widget comman-space">
                                                <div class="check-bill-address">

                                                    <div
                                                        class="edit-new-address wallet-method wallet-radio-blk d-flex align-items-center">
                                                        <label class="radio-inline custom_radio me-4">
                                                            <input type="radio" name="optradio" checked="">
                                                            <span class="checkmark"></span> Online
                                                        </label>

                                                    </div>
                                                    <div
                                                        class="edit-new-address wallet-method wallet-radio-blk d-flex align-items-center mb-0">
                                                        <label class="radio-inline custom_radio me-4">
                                                            <input type="radio" name="optradio">
                                                            <span class="checkmark"></span> Offline
                                                        </label>

                                                    </div>
                                                    <div class="add-new-address grad-border hvr-sweep-to-right mt-4">
                                                        <a href="javascript:void(0);" class="btn btn-primary">Pay</a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('extra_js')
    {{-- <script src="https://pgtest.atomtech.in/staticdata/ots/js/atomcheckout.js"></script>
<script>
    function openPay() {
        const options = {
            "atomTokenId": "{{$atomTokenId}}",
            "merchId": "{{$data['login']}}",
            "custEmail": "{{$data['email']}}",
            "custMobile": "{{$data['mobile']}}",
            "returnUrl": "{{$data['return_url']}}",
        }
        let atom = new AtomPaynetz(options, 'uat');
    }
</script> --}}
@endpush

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
                        <div class="col-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h4>{{ __('tablevars.quote') }} {{ __('tablevars.details') }}
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 mb-4">
                                            <h6>Dept Date </h6>
                                            <span>{{ $quote->travel_date ? Helper::appDateFormat($quote->travel_date) : 'N/A' }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>Starting Point </h6>
                                            <span>{{ optional($quote->city)->city_name }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>Quoted Fare </h6>
                                            <span>{{ number_format($quote->tot_cost, 2) }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>Balance </h6>
                                            <span>{{ number_format($balance, 2) }}</span>
                                        </div>


                                        <div class="col-3 mb-4">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.payment') }}
                                                    {{ __('tablevars.amount') }}<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    wire:model.blur='payment_amount' name="payment_amount"
                                                    wire:change='changes'
                                                    onkeypress="return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)"
                                                    maxlength="10">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h4>{{ __('tablevars.agency') }} {{ __('tablevars.details') }}
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 mb-4">
                                            <h6>Agency ID</h6>
                                            <span>{{ $quote->agency_id ?? '' }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>Email ID</h6>
                                            <span>{{ $quote->agency->email ?? '' }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>Contact No.</h6>
                                            <span>{{ $quote->agency->mobile ?? '' }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>GST Number</h6>
                                            <span>{{ $quote->agency->gst ?? '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h4>GST Details
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 mb-4">
                                            <h4>GST Number</h4>
                                            <span>{{ $quote->agency->gst }}</span>
                                        </div>

                                        <div class="col-2 mb-4">
                                            <h4>GST Email</h4>
                                            <span>{{ $quote->agency->email ?? '' }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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

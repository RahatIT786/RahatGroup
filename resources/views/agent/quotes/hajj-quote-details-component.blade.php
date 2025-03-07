<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="settings-widget profile-details">
                                <div class="settings-menu p-0">
                                    <div class="profile-heading">
                                        <h3 class="m-0">Payment Details</h3>
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
                                            <span>{{ $quote->city->city_name }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>Quoted Fare </h6>
                                            <span>{{ number_format($quote->tot_cost, 2) }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <div class="form-group">
                                                <h6>Amount Paid</h6>
                                                <span>{{ $payment_amount ? number_format($payment_amount, 2) : '-' }}</span>
                                            </div>
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
                                    <h5>{{ __('tablevars.payment') }} {{ __('tablevars.summery') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 mb-4">
                                            <h6>Selected Amount</h6>
                                            <span>{{ $payment_amount ? number_format($payment_amount, 2) : '' }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>Total Amount to be Paid</h6>
                                            <span>{{ $payment_amount != '' ? number_format($quote->tot_cost - $payment_amount, 2) : number_format($quote->tot_cost, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                                            <h6>Agency Name</h6>
                                            <span>{{ $quote->agency->agency_name ?? '' }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>Email ID</h6>
                                            <span>{{ $quote->agency->email ?? '' }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>Contact No.</h6>
                                            <span>{{ $quote->agency->mobile ?? '' }}</span>
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
                                    <h4>Enter GST Details (Optional)
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 mb-4">
                                            <h6>GST Number</h6>
                                            <span>{{ $quote->travel_date ? Helper::appDateFormat($quote->travel_date) : 'N/A' }}</span>
                                        </div>
                                        <div class="col-3 mb-4">
                                            <h6>GST Name</h6>
                                            <span>{{ $quote->agency->agency_name ?? '' }}</span>
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
                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="card card-secondary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Confirmation</h4>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" wire:model="confirmationChecked" wire:change='checked'>
                                                <label class="form-check-label text-danger" for="confirmationCheckbox">
                                                    I have read and understood and agree to all the terms and conditions for the group and agree to pay the payment as the payment terms
                                                </label>
                                            </div>
                                        </div>
                                        @if($confirmationChecked)
                                        <div class="comman-space pb-0">
                                            <div class="mb-2">
                                                <a href="{{ route('agent.quotes.offline-payment', ['quote_id' => $quote->id]) }}"
                                                    class="btn btn-primary" title="Proceed">Offline</a>
                                                <a href="{{ route('agent.quotes.payment-gateway', ['quote_id' => $quote->id]) }}"
                                                    class="btn btn-primary" title="Proceed">Payment Gateway</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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

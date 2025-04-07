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
                                        <h3 class="m-0">Payment Gateway</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-secondary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container my-5">
                                            <h3 class="">Merchant Shop</h3>
                                            <p>Transaction Id: {{ $data['txnId'] }}</p>
                                            <p>Atom Token Id: {{ $atomTokenId }}</p>
                                            <p>Pay Rs. {{ $data['amount'] }}</p>
                                            <a name="" id="" class="btn btn-primary"
                                                href="javascript:openPay()" role="button">Pay Now</a>
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
</div>
@push('extra_js')
    {{-- <script src="https://pgtest.atomtech.in/staticdata/ots/js/atomcheckout.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    {{-- <script src="https://pgtest.atomtech.in/staticdata/ots/js/atomcheckout.js"></script> --}}
    <script src="https://psa.atomtech.in/staticdata/ots/js/atomcheckout.js"></script>
    <script>
        function openPay() {
            //console.log('hi');
            const options = {
                "atomTokenId": "{{ $atomTokenId }}",
                "merchId": "{{ $data['login'] }}",
                "custEmail": "{{ $data['email'] }}",
                "custMobile": "{{ $data['mobile'] }}",
                "returnUrl": "{{ $data['return_url'] }}",
            }
            // let atom = new AtomPaynetz(options, 'uat'); //test env
            let atom = new AtomPaynetz(options); //prod env
        }
    </script>
@endpush

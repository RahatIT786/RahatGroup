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
                                    <div class="container my-5">
                                        <h3>Merchant Shop</h3>
                                        <p>Order ID: {{ $razorpayOrderId }}</p>
                                        <p>Pay Rs. {{ $payment_amount }}</p>
                                        <button id="pay-btn" class="btn btn-primary">Pay Now</button>

                                        <form id="razorpay-form" action="{{ route('agent.payment.response') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                                            <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                                            <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                                        </form>
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
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('pay-btn').onclick = function(e) {
            e.preventDefault();

            var options = {
                "key": "{{ $razorpayKey }}",
                "amount": "{{ $amountInPaise }}",
                "currency": "INR",
                "name": "Merchant Shop",
                "description": "Booking Payment",
                "order_id": "{{ $razorpayOrderId }}",
                "handler": function (response){
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    document.getElementById('razorpay-form').submit();
                },
                "prefill": {
                    "name": "{{ $agent->name }}",
                    "email": "{{ $agent->email }}",
                    "contact": "{{ $agent->mobile }}"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        }
    </script>
@endpush

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                @if(session('booking_id') && session('txn_id') && session('order_id') && session('paid_amount') && session('status') == 'success')
                <div class="container text-center content">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-success py-4">
                                <i class="bi bi-check-circle-fill success-icon"></i>
                                <h1 class="mt-3">Transaction Successful</h1>
                                <p class="lead">Your payment has been processed successfully. Thank you for your purchase!</p>
                            </div>
                            <div class="order-details">
                                <h4 class="mb-3">Order Details</h4>
                                <p><strong>Booking ID:</strong> {{ session('booking_id') }}</p>
                                <p><strong>Order ID:</strong> {{ session('order_id') }}</p>
                                <p><strong>Transaction ID:</strong> {{ session('txn_id') }}</p>
                                <p><strong>Amount:</strong> {{ number_format(session('paid_amount'),2) }}</p>
                                <p><strong>Status:</strong> Success</p>
                            </div>
                            <a href="{{ route('agent.bookings.index') }}" class="btn btn-primary mt-4">Back to Booking List</a>
                        </div>
                    </div>
                </div>
                @else
                <div class="container text-center content">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-danger py-4">
                                <i class="bi bi-x-circle-fill success-icon"></i>
                                <h1 class="mt-3">Transaction Failed</h1>
                                <p class="lead">Your payment is Failed! Please Try Again</p>
                            </div>
                            <a href="{{ route('agent.quotes.index') }}" class="btn btn-primary mt-4">Back to Quotes List</a>
                        </div>
                    </div>
                </div>
                @php
                session()->forget('booking_id');
                session()->forget('txn_id');
                session()->forget('order_id');
                @endphp
                @endif
            </div>
        </div>
    </div>
</div>
@push('extra_css')
<style>
    .success-icon {
        font-size: 4rem;
        color: #28a745;
    }

    .content {
        margin-top: 100px;
    }

    .order-details {
        margin-top: 30px;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

</style>
@endpush

<div class="col-12">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-trunks">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Quotes</h4>
                    </div>
                    <div class="card-body">
                        {{ $quotes }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-itadori">
                    <i class="fas fa-book"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Confirmed Bookings</h4>
                    </div>
                    <div class="card-body">
                        {{ $confirmedBookings }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-saitama">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pending Bookings</h4>
                    </div>
                    <div class="card-body">
                        {{ $pendingBookings }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-temple">
                    <i class="fas fa-ban"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Cancelled Bookings</h4>
                    </div>
                    <div class="card-body">
                        {{ $cancelledBookings }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-deku">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Payments</h4>
                    </div>
                    <div class="card-body">
                        &#x20b9;{{ Helper::convertCurrency($totalPayments) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-beerus">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pending Payments</h4>
                    </div>
                    <div class="card-body">
                        &#x20b9;{{ Helper::convertCurrency($pendingPayments) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-instinct">
                    <i class="fas fa-money-bill-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pending Approvals</h4>
                    </div>
                    <div class="card-body">
                        &#x20b9;{{ Helper::convertCurrency($pendingApprovals) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-ego">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Agent Wallet</h4>
                    </div>
                    <div class="card-body">
                        &#x20b9; {{ $agentWallet }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

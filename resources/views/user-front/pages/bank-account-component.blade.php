<div>
    <div>
        <div class="bannercls">
            <picture>
                <source media="(min-width:980px)" src="{{ asset('/assets/user-front/images/about-us-header.jpg') }}">
                <source media="(min-width:400px)" src="{{ asset('/assets/user-front/images/about-us-header.jpg') }}">
                <img src="{{ asset('/assets/user-front/images/about-us-header.jpg') }}">
            </picture>
            <div class="box">
                <div class="container">
                    <div class="animate-box">
                        <nav class="breadcrumbs">
                            <span>
                                <span class="breadcrumb-text">
                                    <a href="#">Home</a>
                                </span>
                                <span class="breadcrumb-separator"></span>
                                <span class="breadcrumb-text">Bank Accounts</span>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-section">
            <div class="container">
                <div class="row">
                    @forelse ($bankaccounts as $account)
                        <div class="col-md-6">
                            <div class="bankdetbox">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="bankdetboxtext">
                                            <p style="color: #000;"><strong>Bank Name</strong></p>
                                            <span
                                                id="MainContent_rptBankDetails_lblBankName_{{ $loop->index }}">{{ $account->bank_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bankdetboxtext">
                                            <p style="color: #000;"><strong>Account Number</strong></p>
                                            <span
                                                id="MainContent_rptBankDetails_lblAccountNo_{{ $loop->index }}">{{ $account->account_number }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bankdetboxtext">
                                            <p style="color: #000;"><strong>IFSC Code</strong></p>
                                            <span
                                                id="MainContent_rptBankDetails_lblIFSC_{{ $loop->index }}">{{ $account->ifsc_code }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bankdetboxtext">
                                            <p style="color: #000;"><strong>Bank Address</strong></p>
                                            <span
                                                id="MainContent_rptBankDetails_lblBranchName_{{ $loop->index }}">{{ $account->bank_address }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <p>No bank accounts found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('extra_css')
        <style>
            .animate-box {
                padding: 20px 0 !important;
            }

            .bannercls .box {
                background: rgba(0, 0, 0, .5) !important;
            }

            .bannercls .box {
                position: absolute;
                z-index: 999;
                bottom: 0;
                display: block;
                color: #ffffff;
                padding: 0;
                width: 100%;
            }

            .breadcrumbs {
                font-size: 14px;
                font-weight: normal !important;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: none;
                scrollbar-width: none;
                width: 100%;
            }

            .animate-box {
                padding: 20px 0 !important;
            }

            .breadcrumbs {
                font-size: 14px;
                font-weight: normal !important;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: none;
                scrollbar-width: none;
                width: 100%;
            }

            .about-section {
                padding: 50px 0;
                background-color: #f8f8f8;
            }

            .bankdetbox {
                margin-bottom: 30px;
                background-color: #ffffff;
                border-radius: 12px;
                padding: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .bankdetbox p {
                margin-bottom: 4px;
                font-size: 14px;
                color: #888;
            }

            .bankdetboxtext span {
                font-size: 15px;
                color: #000;
                font-weight: 400;
            }

            .bankdetboxtext {
                margin-bottom: 8px;
            }
        </style>
    @endpush

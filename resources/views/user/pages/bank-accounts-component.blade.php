<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Bank Accounts</h1>
        </div>
    </section>
    <section class="innercontarea">
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
    </section>
</main>

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
                                        <h3 class="m-0">{{ __('tablevars.add_new') }} {{ __('tablevars.payment') }}
                                        </h3>
                                    </div>
                                    <div class="checkout-form personal-address add-course-info">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-label">{{ __('tablevars.booking_id') }}</label><span
                                                            class="text-danger">*</span>
                                                        <select class="form-select select country-select"
                                                            name="sellist1">
                                                            <option>Select {{ __('tablevars.booking_id') }}</option>
                                                            <option value="1">10276 / TAIBHA BARUCH</option>
                                                            <option value="2">10980 / IQRA TRAVELS (RAJU)</option>
                                                            <option value="3">15447 / Narendra</option>
                                                            <option value="4">15730 / immu</option>
                                                            <option value="5">15820 / SAIF TESTING 11</option>
                                                            <option value="6">15943 / Nasir Siddiqui</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.balance_amount') }}</label><span
                                                            class="text-danger">*</span>
                                                        <input type="text" class="form-control" placeholder=""
                                                            readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-label">{{ __('tablevars.deposite_type') }}</label><span
                                                            class="text-danger">*</span>
                                                        <select class="form-select select country-select"
                                                            name="sellist1">
                                                            <option>Select {{ __('tablevars.deposite_type') }}</option>
                                                            <option value="1">Cheque Deposit</option>
                                                            <option value="2">RTGS</option>
                                                            <option value="3">NEFT</option>
                                                            <option value="4">IMPS</option>
                                                            <option value="5">Cash in Hand</option>
                                                            <option value="6">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.amount') }}</label><span
                                                            class="text-danger">*</span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Amount" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-label">{{ __('tablevars.company_name') }}</label><span
                                                            class="text-danger">*</span>
                                                        <select class="form-select select country-select"
                                                            name="sellist1">
                                                            <option>{{ __('tablevars.select') }}
                                                                {{ __('tablevars.company_name') }}</option>
                                                            <option value="1">AL DEAFAH INTERNATIONAL PVT LTD
                                                            </option>
                                                            <option value="2">All India Hajj And Umrah Tours Pvt.
                                                                Ltd.</option>
                                                            <option value="3">AwSm International</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-label">{{ __('tablevars.bankname') }}</label>
                                                        <select class="form-select select country-select"
                                                            name="sellist1">
                                                            <option>{{ __('tablevars.select') }}
                                                                {{ __('tablevars.bankname') }}</option>
                                                            <option value="1">HDFC</option>
                                                            <option value="2">PUNB</option>
                                                            <option value="2">SBI</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.beneficiary_account_no') }}</label><span
                                                            class="text-danger">*</span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Account No" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.check_txn') }}</label><span
                                                            class="text-danger">*</span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Check or Txn No" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.date_time') }}</label>
                                                        <input type="date" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.person_if_pay') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Name" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.comments') }}</label>
                                                        <textarea class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="update-profile">
                                                    <button type="button" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
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

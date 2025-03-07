<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Pay Now Form</h1>
        </div>
    </section>
    <div class="feedback_wrapper FeedBackFormHtml" id="feedback_wrapperMain">
        <div class="container">
            <div class="row top-space">
                <div class="col-md-8 mx-auto form-container">
                    <form name="frm_quick_enquiry" wire:submit.prevent='save'>
                        <input type="hidden" name="paymentType" id="paymentType" value="ATOM">
                        <input type="hidden" name="AgencySysId" id="AgencySysId" value="111380">
                        <input type="hidden" name="crs" id="crs" value="0">
                        <input type="hidden" name="AgentSysId" id="AgentSysId" value="0">
                        <div class="form-group">
                            <div class="row">
                                <label for="name" class="col-sm-3 control-label  ">Full Name<span
                                        style="color:red;font-weight:300;">*</span> :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name" id="full_name"
                                        class="form-control  @error('full_name')  validation-border @enderror"
                                        placeholder="Enter Last Name" wire:model.live="full_name">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <label for="email" class="col-sm-3 control-label  ">Email<span
                                        style="color:red;font-weight:300;">*</span> :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" id="email"
                                        class="form-control @error('email')  validation-border @enderror"
                                        placeholder="Enter Email" wire:model.live="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="email" class="col-sm-3 control-label  ">Phone<span
                                        style="color:red;font-weight:300;">*</span> :</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control  @error('mob_num')  validation-border @enderror"
                                        placeholder="Enter Mobile Number" name="mob_num" id="mob_num" maxlength="10"
                                        wire:model.live="mob_num">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="destination" class="col-sm-3 control-label  ">Invoice Number
                                    :</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control  @error('invoice_num')  validation-border @enderror"
                                        placeholder="Enter Invoice Number" name="invoice_num" id="invoice_num"
                                        maxlength="10" wire:model.live="invoice_num">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="destination" class="col-sm-3 control-label  ">Amount to be Paid<span
                                        style="color:red;font-weight:300;">*</span> :</label>
                                <div class="col-sm-2">
                                    <select
                                        class="custom-select form-control @error('currency_type')  validation-border @enderror"
                                        name="currency_type " id="currency_type" wire:model.live="currency_type">
                                        <option value="1">INR</option>
                                    </select>
                                </div>
                                <div class="col-sm-7">
                                    <input type="number" name="amount" id="amount"
                                        class="form-control @error('amount')  validation-border @enderror"
                                        placeholder="Enter Amount" wire:model.live="amount">
                                    {{-- <input type="number" class="form-control commanClass" id="Amount"
                                    placeholder="Enter Amount " name="Amount"> --}}

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <label for="NameonBill" class="col-sm-3 control-label  " style="line-height: 20px;">Name
                                    / Company Name on Bill
                                    :</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control  @error('company_name')  validation-border @enderror"
                                        placeholder="Enter Invoice Number" name="company_name" id="company_name"
                                        wire:model.live="company_name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="Address" class="col-sm-3 control-label  ">Address
                                    :</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('address')  validation-border @enderror" name="address" id="address"
                                        placeholder="Address" wire:model.live="address" style="height: 100px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="reviewtitle" class="col-sm-3 control-label  ">City<span
                                        style="color:red;font-weight:300;">*</span>
                                    :</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control  @error('city')  validation-border @enderror"
                                        placeholder="Enter City" name="city" id="city"
                                        wire:model.live="city">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="reviewtitle" class="col-sm-3 control-label  ">Pincode<span
                                        style="color:red;font-weight:300;">*</span>
                                    :</label>
                                <div class="col-sm-9">
                                    <input type="number" name="pincode" id="pincode"
                                        class="form-control @error('pincode')  validation-border @enderror"
                                        placeholder="Enter Pincode" wire:model.live="pincode">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="reviewtitle" class="col-sm-3 control-label  ">Country
                                    :</label>
                                <div class="col-sm-9">
                                    <select class="form-control  @error('country_id')  validation-border @enderror"
                                        name="country_id" id="country_id" wire:model.live="country_id">
                                        <option value="" selected>Select Country</option>
                                        @foreach ($countries as $id => $countryname)
                                            <option value="{{ $id }}">{{ $countryname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="reviewtitle" class="col-sm-3 control-label  ">Additional Notes
                                    :</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('additional_notes')  validation-border @enderror" name="additional_notes"
                                        id="additional_notes" placeholder="Additional Notes" wire:model.live="additional_notes" style="height: 100px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="checkbox" name="term" id="term" value="1"
                                        checked=""> I Accept Terms &amp; Conditions<br>
                                    <span class="payFormMsg"></span>
                                </div>
                                <div class="col-sm-6">
                                    <button href="javascript://" class="btn btn-feedbacksubmit payFormSubmitBtn"
                                        id="payFormSubmitBtn">Pay </button>
                                </div>
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</main>
@push('extra_css')
    <style>
        .feedback_wrapper {
            width: 100%;
            padding: 50px 0px;
            background: #fafafa;
        }

        .feedback_wrapper .form-container {
            background-color: #fff;
            padding-top: 20px;
            box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 20px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }

        .feedback_wrapper .form-container .btn-feedbacksubmit {
            background: #FB5A2D;
            border-radius: 30px;
            -moz-border-radius: 30px;
            -webkit-border-radius: 30px;
            -o-border-radius: 30px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            float: none;
            padding: 12px 55px;
        }
    </style>
@endpush

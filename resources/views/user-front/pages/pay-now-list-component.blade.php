<main class="cAJbgc" style="margin-top: 0px;">
    <div>
        <section class="bg-light py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="breadcrumbs mb-4">
                            <span>
                                <span class="breadcrumb-text">
                                    <a href="#">Home</a>
                                </span>
                                <span class="breadcrumb-separator"></span>
                                <span class="breadcrumb-text">Pay Now</span>
                            </span>
                        </nav>
                    </div>
                </div>
                <h3>Pay Now Form</h3>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item bg-gradient text-white font-weight-bold"><span class="icon mr-2"><i
                                class="icon-users"></i></span>Service Name : Pay Now</li>
                </ul>

                <form name="frm_quick_enquiry" wire:submit.prevent='save'>
                    @if (session('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    <input type="hidden" name="paymentType" id="paymentType" value="ATOM">
                    <input type="hidden" name="AgencySysId" id="AgencySysId" value="111380">
                    <input type="hidden" name="crs" id="crs" value="0">
                    <input type="hidden" name="AgentSysId" id="AgentSysId" value="0">

                    <div class="bg-white shadow-sm rounded p-3 mt-3 mb-4">
                        <h5>All fields are mandatory</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="full_name" id="full_name"
                                    value="" @error('full_name')  validation-border @enderror
                                    placeholder="Full Name" wire:model.live="full_name">
                                @error('full_name')
                                    <span class="validation-msg"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" name="email" id="email" value=""
                                    @error('email')  validation-border @enderror placeholder="Email"
                                    wire:model.live="email">
                                @error('email')
                                    <span class="validation-msg"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="number" class="form-control" name="mob_num" id="mob_num" value=""
                                    @error('mob_num')  validation-border @enderror placeholder="Phone"
                                    wire:model.live="mob_num">
                                @error('mob_num')
                                    <span class="validation-msg"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="invoice_num" id="invoice_num"
                                    value="" @error('invoice_num')  validation-border @enderror
                                    placeholder="Invoice Number" wire:model.live="invoice_num">
                                @error('invoice_num')
                                    <span class="validation-msg"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select
                                            class="custom-select form-control @error('currency_type')  validation-border @enderror"
                                            name="currency_type " id="currency_type" wire:model.live="currency_type">
                                            <option value="1">INR</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="number" name="amount" id="amount"
                                            class="form-control @error('amount')  validation-border @enderror"
                                            placeholder="Enter Amount" wire:model.live="amount">
                                        @error('amount')
                                            <span class="validation-msg"
                                                style="color: red;font-weight: 500;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="company_name" id="company_name"
                                    value="" @error('company_name')  validation-border @enderror
                                    placeholder="Enter Company Name" wire:model.live="company_name">
                                @error('company_name')
                                    <span class="validation-msg"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="city" id="city"
                                    value="" @error('city')  validation-border @enderror
                                    placeholder="Enter City" wire:model.live="city">
                                @error('city')
                                    <span class="validation-msg"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="number" class="form-control" name="pincode" id="pincode"
                                    value="" @error('pincode')  validation-border @enderror
                                    placeholder="Enter Pincode" wire:model.live="pincode">
                                @error('pincode')
                                    <span class="validation-msg"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <select class="form-control  @error('country_id')  validation-border @enderror"
                                            name="country_id" id="country_id" wire:model.live="country_id">
                                            <option value="" selected>Select Country</option>
                                            @foreach ($countries as $id => $countryname)
                                                <option value="{{ $id }}">{{ $countryname }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <span class="validation-msg"
                                                style="color: red;font-weight: 500;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <textarea type="text" class="form-control" name="address" id="address" value=""
                                    @error('address')  validation-border @enderror placeholder="Enter Address" wire:model.live="address"></textarea>
                                @error('address')
                                    <span class="validation-msg"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <textarea type="text" class="form-control" name="additional_notes" id="additional_notes" value=""
                                    @error('additional_notes')  validation-border @enderror placeholder="Additional Notes"
                                    wire:model.live="additional_notes"></textarea>
                                @error('additional_notes')
                                    <span class="validation-msg"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="term" id="term" value="1"
                                            checked=""> I Accept Terms &amp; Conditions<br>
                                        <span class="payFormMsg"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: center; margin-top: 20px;">
                            <button type="submit" name="btn_submit" href="javascript://" class="btn secondary-btn"
                                style="background-position: 300% 100% !important; margin-left: 10px;"
                                id="payFormSubmitBtn">Pay</button>
                        </div>

                        {{-- <button type="submit" name="btn_submit" class="btn default-btn">Send Enquiry</button> --}}

                    </div>
                </form>
            </div>
        </section>
    </div>
</main>

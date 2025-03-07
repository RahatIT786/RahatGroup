<div>
    <section class="bg-light py-5">
        <div class="container">
            <div class="customize-box">
                @if (session('customer_visa_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="color: #1d6119;border: 1px solid #1d6119;">
                        {!! session('customer_visa_success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="color: #1d6119;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <nav class="breadcrumbs mb-4">
                            <span>
                                <span class="breadcrumb-text">
                                    <a href="{{ route('customer.homepage') }}">Home</a>
                                </span>
                                <span class="breadcrumb-separator"></span>
                                <span class="breadcrumb-text">Tourist Visa</span>
                            </span>
                        </nav>
                    </div>
                </div>
                <div class="modal-header bg-gradient">
                    <h3 class="modal-title h5 mb-0 text-white">Tourist Visa Form</h3>
                </div>
                <div class="bg-white shadow-sm rounded p-3 mt-3 mb-4">
                    <form name="form" wire:submit.prevent="save">
                        <h5>All fields are mandatory</h5>
                        <div class="row">
                            {{-- <div class="col-md-6 mb-3">
                                <label>{{ __('tablevars.select') }} {{ __('tablevars.country') }}<span
                                        class="text-red">*</span></label>
                                <select class="custom-select form-control" name="country_id" id="country_id"
                                    wire:model='country_id'>
                                    <option value="">Select Country</option>
                                    @foreach ($country as $CountryId => $CountryName)
                                        <option value="{{ $CountryId }}">{{ $CountryName }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>{{ __('tablevars.select') }} {{ __('tablevars.visa') }}
                                        {{ __('tablevars.type') }}<span class="text-red">*</span></label>
                                    <select class="custom-select form-control" name="visa_type" id="visa_type"
                                        wire:model='visa_type'>
                                        <option value="" selected>Select Visa Type</option>
                                        <option value="Tourist Visa">Tourist Visa</option>
                                        <option value="Personal Visit">Personal Visit</option>
                                        <option value="Visit Visa">Visit Visa</option>
                                        <option value="Umrah Visa">Umrah Visa</option>
                                        <option value="Family Visa">Family Visa</option>
                                    </select>
                                    @error('visa_type')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-6 mb-3">
                                <label>{{ __('tablevars.select') }} {{ __('tablevars.country') }}<span class="text-red">*</span></label>
                                <select class="custom-select form-control" name="country_id" id="country_id" wire:model.defer="country_id">
                                    <option value="">{{ __('Select Country') }}</option>
                                    @foreach ($country as $CountryId => $CountryName)
                                        <option value="{{ $CountryId }}">{{ $CountryName }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-3">
                                <label>{{ __('tablevars.select') }} {{ __('tablevars.visa') }}
                                    {{ __('tablevars.type') }}<span class="text-red">*</span></label>
                                <select class="custom-select form-control" name="visa_type" id="visa_type"
                                    wire:model='visa_type'>
                                    <option value="">Select Visa Type</option>
                                    <option value="Tourist Visa" {{ $visa_type == 'Tourist Visa' ? 'selected' : '' }}>
                                        Tourist Visa</option>
                                    <option value="Personal Visit"
                                        {{ $visa_type == 'Personal Visit' ? 'selected' : '' }}>Personal Visit</option>
                                    <option value="Visit Visa" {{ $visa_type == 'Visit Visa' ? 'selected' : '' }}>Visit
                                        Visa</option>
                                    <option value="Umrah Visa" {{ $visa_type == 'Umrah Visa' ? 'selected' : '' }}>Umrah
                                        Visa</option>
                                    <option value="Family Visa" {{ $visa_type == 'Family Visa' ? 'selected' : '' }}>
                                        Family Visa</option>
                                </select>
                                @error('visa_type')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{ __('tablevars.name') }}<span class="text-red">*</span></label>
                                <input type="text" name="cust_name" id="cust_name" class="form-control"
                                    wire:model='cust_name' placeholder="Name">
                                @error('cust_name')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('tablevars.email') }}<span class="text-red">*</span></label>
                                <input type="email" class="form-control" name="cust_email" id="cust_email"
                                    wire:model='cust_email' placeholder="Email">
                                @error('cust_email')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('tablevars.mobile') }}<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="cust_mob" id="cust_mob"
                                    wire:model='cust_mob' oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    maxlength="10" placeholder="Mobile No">
                                @error('cust_mob')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('tablevars.nationality') }}<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="cust_nationality" id="cust_nationality"
                                    wire:model='cust_nationality' placeholder="Nationality">
                                @error('cust_nationality')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cust_pp_front">{{ __('tablevars.passport_front') }}<span class="text-red">*</span></label>
                                <input type="file" class="form-control" name="cust_pp_front" id="cust_pp_front"
                                    placeholder="Upload Passport Front" accept=".jpg, .jpeg, .png, .pdf"
                                    wire:model="cust_pp_front">
                                @error('cust_pp_front')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                                @if ($cust_pp_front)
                                    <img src="{{ $cust_pp_front->temporaryUrl() }}" style="height: 100px;">
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('tablevars.passport_back') }}<span class="text-red">*</span></label>
                                <input type="file" class="form-control" name="cust_pp_back" id="cust_pp_back"
                                    placeholder="Upload Passport Back" accept=".jpg, .jpeg, .png, .pdf"
                                    wire:model="cust_pp_back">
                                @error('cust_pp_back')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                                @if ($cust_pp_back)
                                    <img src="{{ $cust_pp_back->temporaryUrl() }}" style="height: 100px;">
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('tablevars.emirate_id') }}<span class="text-red">*</span></label>
                                <input type="file" class="form-control" name="cust_emirate_id"
                                    id="cust_emirate_id" placeholder="Upload Emirate ID"
                                    accept=".jpg, .jpeg, .png, .pdf" wire:model="cust_emirate_id">
                                @error('cust_emirate_id')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                                @if ($cust_emirate_id)
                                    <img src="{{ $cust_emirate_id->temporaryUrl() }}" style="height: 100px;">
                                @endif
                            </div>

                            <div class="form-group col-md-6 captcha">
                                <label>{{ __('tablevars.captcha') }}<span class="text-red">*</span></label>
                                <div>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <input type="text" wire:model.lazy="userInput" class="form-control"
                                            placeholder="Enter CAPTCHA">
                                        <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                        <div>
                                            <i wire:click="generateCaptcha" class="fa fa-refresh fa-lg"
                                                style="cursor: pointer" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    @error('userInput')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: center; margin-top: 20px;">
                            <button type="submit" class="btn secondary-btn"
                                style="background-position: 300% 100% !important; margin-left: 10px;">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </section>
</div>

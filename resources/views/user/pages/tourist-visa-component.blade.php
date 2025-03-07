<main class="cAJbgc" style="margin-top: 0px;">

    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>UMRAH & SAUDI TOURIST VISA</h1>
        </div>
    </section>
    <section class="customize-umrah">
        <div class="container">
            <div class="customize-box">
                @if (session('visa_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="color: #1d6119;border: 1px solid #1d6119;">
                        {!! session('visa_success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="color: #1d6119;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <h4 class="h5" style="text-align: center;">UMRAH & SAUDI TOURIST VISA</h4>

                <hr style="border-bottom: 1px solid #e4e4e4;border-top: 0px;margin: 20px 0px;" />
                <form id="form" wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-md-6 form-group">
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

                        <div class="col-md-6 form-group">
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
                            <label for="cust_pp_front">{{ __('tablevars.passport_front') }}</label>
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
                            <label>{{ __('tablevars.passport_back') }}</label>
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
                            <label>{{ __('tablevars.emirate_id') }}</label>
                            <input type="file" class="form-control" name="cust_emirate_id" id="cust_emirate_id"
                                placeholder="Upload Emirate ID" accept=".jpg, .jpeg, .png, .pdf"
                                wire:model="cust_emirate_id">
                            @if ($cust_emirate_id)
                                <img src="{{ $cust_emirate_id->temporaryUrl() }}" style="height: 100px;">
                            @endif
                        </div>

                        <div class="form-group col-md-6 captcha">
                            <label>{{ __('tablevars.captcha') }}</label>
                            <div>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <input type="text" wire:model.lazy="userInput" class="form-control"
                                        placeholder="Enter CAPTCHA">
                                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                    <div>
                                        <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @error('userInput')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex text-center" style="margin-top:20px;">
                        <button type="submit" class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

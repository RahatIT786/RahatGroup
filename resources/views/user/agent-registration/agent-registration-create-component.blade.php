<main class="cAJbgc shortinnerheader" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
        </div>
    </section>
    <section class="detail-sec detail-secbox">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6 col-12">
                    <div class="packageformbox mb-4">
                        <form wire:submit.prevent="save">
                            <div class="row">
                                @if (session('success'))
                                    <div class="col-md-12">
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                @endif
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.agency_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="agency_name" id="agency_name" class="form-control"
                                            wire:model="agency_name" maxlength="150">
                                        @error('agency_name')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Owner Name<span class="text-danger">*</span></label>
                                        <input type="text" name="owner_name" id="owner_name" class="form-control"
                                            wire:model="owner_name" maxlength="150">
                                        @error('owner_name')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.state') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='state_id'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.state') }}</option>
                                            @foreach ($state as $stateId => $stateName)
                                                <option value="{{ $stateId }}">{{ $stateName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.city') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="city" id="city" class="form-control"
                                            wire:model="city" maxlength="150">
                                        @error('city')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.mobile') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" id="mobile" class="form-control"
                                            wire:model="mobile" maxlength="10">
                                        @error('mobile')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            wire:model="email" maxlength="150">
                                        @error('email')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.password') }}<span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            wire:model="password" maxlength="150">
                                        @error('password')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.pan') }}<span class="text-danger">*</span></label>
                                        <input type="pan" name="pan" id="pan" class="form-control"
                                            wire:model="pan" maxlength="45">
                                        @error('pan')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.gst') }}<span class="text-danger">*</span></label>
                                        <input type="gst" name="gst" id="gst" class="form-control"
                                            wire:model="gst" maxlength="45">
                                        @error('gst')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.website') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="website_name" id="website_name"
                                            class="form-control" wire:model="website_name" maxlength="150">
                                        @error('website_name')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.company_logo') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="company_logo" id="company_logo"
                                            class="form-control" wire:model="company_logo">
                                        @error('company_logo')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($company_logo)
                                        <img src="{{ $company_logo->temporaryUrl() }}"
                                            style="height: 100px;width: 150px;">
                                    @endif
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

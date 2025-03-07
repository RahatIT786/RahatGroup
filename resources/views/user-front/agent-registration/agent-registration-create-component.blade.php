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
                                <span class="breadcrumb-text">Partner With Us</span>
                            </span>
                        </nav>
                    </div>
                </div>
                <h3>Partner With Us Form</h3>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item bg-gradient text-white font-weight-bold"><span class="icon mr-2"><i
                                class="icon-users"></i></span>Service Name : Partner With Us</li>
                </ul>

                <form name="frm_quick_enquiry" wire:submit.prevent='save'>
                    <div class="bg-white shadow-sm rounded p-3 mt-3 mb-4">
                        <h5>All fields are mandatory</h5>
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
                                    <label>{{ __('tablevars.agency_name') }} <span class="text-danger">*</span></label>
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
                                    <input type="text" name="website_name" id="website_name" class="form-control"
                                        wire:model="website_name" maxlength="150">
                                    @error('website_name')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('tablevars.company_logo') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="company_logo" id="company_logo" class="form-control"
                                        wire:model="company_logo">
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
                            <button type="submit" class="btn default-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>

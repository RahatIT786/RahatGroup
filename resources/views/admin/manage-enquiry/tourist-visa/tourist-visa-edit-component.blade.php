<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.tourist-visa') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage-enquiry') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.touristVisa.index') }}"
                        wire:navigate>{{ __('tablevars.tourist-visa') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.tourist-visa') }}</h4>
                            <a href="{{ route('admin.touristVisa.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.country') }}</label><span class="text-danger">*</span>
                                        <select class="form-control" name='country_id' id="country_id"
                                            wire:model='country_id' disabled>
                                            <option value="">Country Name</option>
                                            @foreach ($country as $CountryId => $CountryName)
                                            <option value="{{ $CountryId }}">{{ $CountryName }}</option>
                                        @endforeach
                                        </select>
                                        @error('country_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.visa') }} {{ __('tablevars.type') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Visa Type"
                                            wire:model='visa_type'disabled>
                                        @error('visa_type')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name"
                                            wire:model='cust_name'disabled>
                                        @error('cust_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Email"
                                            wire:model='cust_email'disabled>
                                        @error('cust_email')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.mobile') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Mobile No"
                                            wire:model='cust_mob'disabled>
                                        @error('cust_mob')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.nationality') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Nationality"
                                            wire:model='cust_nationality'disabled>
                                        @error('cust_nationality')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.support_team') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Support Team"
                                            wire:model='support_team'>
                                        @error('support_team')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-left">
                                <button class="btn btn-primary" title="Update">{{ __('tablevars.update') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </from>
    </section>
</div>

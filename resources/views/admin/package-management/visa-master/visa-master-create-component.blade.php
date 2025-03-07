<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.visa') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.visaMaster.index') }}"
                        wire:navigate>{{ __('tablevars.visa') }} {{ __('tablevars.master') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.visa') }}</h4>
                            <a href="{{ route('admin.visaMaster.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('tablevars.country') }}</label><span class="text-danger">*</span>
                                    <select class="form-control" name='country_id' id="country_id"
                                        wire:model='country_id'>
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
                                    <input type="text" class="form-control" placeholder="Enter visa type"  wire:model='visa_name'>
                                    
                                    @error('visa_name')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('tablevars.entry_type') }} <span class="text-danger">*</span></label>
                                    <select class="form-control" wire:model='entry_type'>
                                        <option value="Single">Single</option>
                                        <option value="Dual">Dual</option>
                                        <option value="Multiple">Multiple</option>
                                    </select>
                                    @error('entry_type')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('tablevars.visa') }} {{ __('tablevars.validity') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter visa validity" wire:model='visa_validity'>
                                    @error('visa_validity')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('tablevars.validity_period') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter days" wire:model='stay_period'>
                                    @error('stay_period')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('tablevars.visa') }} {{ __('tablevars.price') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Visa Price" wire:model='visa_price'  onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    @error('visa_price.')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer align-right">
                        <button class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                    </div>
                </div>
            </div>
        </from>
    </section>
</div>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.manage-enquiry') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage-enquiry') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manageEnquiry.index') }}"
                        wire:navigate>{{ __('tablevars.manage-enquiry') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.manage-enquiry') }}</h4>
                            <a href="{{ route('admin.manageEnquiry.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.service_type') }}</label><span class="text-danger">*</span>
                                        <select class="form-control" name='cat_id' id="cat_id"
                                            wire:model='cat_id' disabled>
                                            <option value="">Service Type</option>
                                            @foreach ($servicetype as $servicetypeId => $ServiceTypeName)
                                            <option value="{{ $servicetypeId }}">{{ $ServiceTypeName }}</option>
                                        @endforeach
                                        </select>
                                        @error('cat_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.city') }}</label><span class="text-danger">*</span>
                                        <select class="form-control" name='city_id' id="city_id"
                                            wire:model='city_id' disabled>
                                            <option value="">City</option>
                                            @foreach ($city as $cityId => $CityName)
                                            <option value="{{ $cityId }}">{{ $CityName }}</option>
                                        @endforeach
                                        </select>
                                        @error('city_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name"
                                            wire:model='name'disabled>
                                        @error('name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Email"
                                            wire:model='email'disabled>
                                        @error('email')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.mobile_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Mobile No"
                                            wire:model='mobile_num'disabled>
                                        @error('mobile_num')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.whatsapp_number') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Nationality"
                                            wire:model='whatsapp_num'disabled>
                                        @error('whatsapp_num')
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

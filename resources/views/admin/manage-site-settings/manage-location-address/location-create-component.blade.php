<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.location_address') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage_site_settings') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.location.index') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.location') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.location') }}</h4>
                            <a href="{{ route('admin.location.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left" title="Back"></i>
                                {{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.country') }}
                                            <span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='country_id' id="country_id">
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

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.city') }}
                                            <span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='city_id' id="city_id">
                                            <option value="">City Name</option>
                                            @foreach ($city as $CityId => $CityName)
                                                <option value="{{ $CityId }}">{{ $CityName }}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.phone_no') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone_no" wire:model="phone_no"
                                            id="phone_no" placeholder="Please enter phone number" maxlength="20"
                                            autocomplete="off">
                                        @error('phone_no')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.tollfree_no') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tollfree_no"
                                            wire:model="tollfree_no" id="tollfree_no"
                                            placeholder="Please enter tollfree number" maxlength="20"
                                            autocomplete="off">
                                        @error('tollfree_no')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.address') }}<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="address" wire:model="address" id="address" placeholder="Please enter address"
                                            autocomplete="off">
                                    </textarea>
                                        @error('address')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.map_address') }}<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="map_address" wire:model="map_address" id="map_address"
                                            placeholder="Please enter map address" autocomplete="off"></textarea>
                                        @error('map_address')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email" wire:model="email"
                                            id="email" placeholder="Please enter email" maxlength="20"
                                            autocomplete="off">
                                        @error('tollfree_no')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-left">
                                        <button class="btn btn-primary" data-toggle="tooltip" id="saveForm"
                                            title="submit">{{ __('tablevars.submit') }}</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>

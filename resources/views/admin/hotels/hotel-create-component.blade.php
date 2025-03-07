<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.hotel') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.hotel.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.hotel') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.hotel') }}</h4>
                            <a href="{{ route('admin.hotel.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.hotel') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="hotel_name" id="hotel_name" class="form-control"
                                            wire:model="hotel_name" maxlength="200" placeholder="Enter hotel name">
                                        @error('hotel_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.hotel') }} {{ __('tablevars.star') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="star_rating">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.rating') }}</option>
                                            <option value="1">One Star</option>
                                            <option value="2">Two Star</option>
                                            <option value="3">Three Star</option>
                                            <option value="4">Four Star</option>
                                            <option value="5">Five Star</option>
                                            <option value="Standard Hotel">Standard Hotel</option>
                                            <option value="Building Accommodation">Building Accommodation</option>
                                        </select>
                                        @error('star_rating')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.city') }} <span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="city_id">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.city') }}</option>
                                            @foreach ($cityData as $id => $city_name)
                                                <option value="{{ $id }}">{{ $city_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.hotel') }} {{ __('tablevars.distance') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="distance" id="distance" class="form-control"
                                            wire:model="distance" maxlength="50"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            placeholder="Enter hotel distance">
                                        @error('distance')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.hotel') }} {{ __('tablevars.contact') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="contact" id="contact" class="form-control"
                                            wire:model="contact" maxlength="12"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            placeholder="Enter contact">
                                        @error('contact')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.g_maps') }}<span class="text-danger">*</span></label>
                                        <textarea name="google_map" id="google_map" class="form-control" wire:model="google_map"></textarea>
                                        @error('google_map')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.address') }}<span class="text-danger">*</span></label>
                                        <textarea name="address" id="address" class="form-control" wire:model="address"></textarea>
                                        @error('address')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.hotel') }} {{ __('tablevars.photo') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="hotel_img[]" id="hotel_img" class="form-control"
                                            wire:model="hotel_img" multiple>
                                        @error('hotel_img')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($hotel_img)
                                        @foreach ($hotel_img as $img)
                                            <img src="{{ $img->temporaryUrl() }}" style="height: 100px;">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h4>{{ __('tablevars.hotel') }} {{ __('tablevars.price') }}
                                {{ __('tablevars.details') }}<span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="high_start_date">{{ __('tablevars.high') }}
                                        {{ __('tablevars.season_start') }}<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control " name="high_start_date"
                                        wire:model="high_start_date" autocomplete="off">
                                    @error('high_start_date')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="high_end_date">{{ __('tablevars.high') }}
                                        {{ __('tablevars.season_end') }}<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control " name="high_end_date"
                                        wire:model="high_end_date" autocomplete="off">
                                    @error('high_end_date')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="label-header"
                                            for="high_season_price">{{ __('tablevars.high_season_price') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="high_season_price" id="high_season_price"
                                            class="form-control" wire:model="high_season_price" maxlength="8"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            placeholder="Enter High Season Price">
                                        @error('high_season_price')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="medium_start_date">{{ __('tablevars.mid') }}
                                        {{ __('tablevars.season_start') }}<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control " name="medium_start_date"
                                        wire:model="medium_start_date" autocomplete="off">
                                    @error('medium_start_date')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="medium_end_date">{{ __('tablevars.mid') }}
                                        {{ __('tablevars.season_end') }}<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control " name="medium_end_date"
                                        wire:model="medium_end_date" autocomplete="off">
                                    @error('medium_end_date')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.medium_season_price') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="medium_season_price" id="medium_season_price"
                                            class="form-control" wire:model="medium_season_price" maxlength="8"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            placeholder="Enter Midium Season Price">
                                        @error('medium_season_price')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="low_start_date">{{ __('tablevars.low') }}
                                        {{ __('tablevars.season_start') }}<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control " name="low_start_date"
                                        wire:model="low_start_date" autocomplete="off">
                                    @error('low_start_date')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="low_end_date">{{ __('tablevars.low') }}
                                        {{ __('tablevars.season_end') }}<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control " name="low_end_date"
                                        wire:model="low_end_date" autocomplete="off">
                                    @error('low_end_date')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.low_season_price') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="low_season_price" id="low_season_price"
                                            class="form-control" wire:model="low_season_price" maxlength="8"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            placeholder="Enter Low Season Price">
                                        @error('low_season_price')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer align-right">
                                    <button class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
</section>
</div>

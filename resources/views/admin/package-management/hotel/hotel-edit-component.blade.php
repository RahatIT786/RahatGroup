<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.hotel') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.hotel.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.hotel') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.hotel') }}</h4>
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
                                        <label for="country">Country</label><span class="text-red">*</span>
                                        <select class="form-control" id="country" wire:model="country_id"
                                            wire:change="changeCountry">
                                            <option value="" selected>Select Country</option>
                                            @foreach ($countries as $id => $countryname)
                                                <option value="{{ $id }}">{{ $countryname }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="city">{{ __('tablevars.city') }}</label><span
                                            class="text-red">*</span>
                                        <select class="form-control" id="city" wire:model="city_id">
                                            <option value="" selected>{{ __('tablevars.select') }}
                                                {{ __('tablevars.city') }}</option>
                                            @foreach ($cities as $id => $city_name)
                                                <option value="{{ $id }}">{{ $city_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <span class="v-msg-500">{{ $message }}</span>
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
                                            wire:model="contact" maxlength="18" placeholder="Enter contact">
                                        @error('contact')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            wire:model="email" maxlength="200" placeholder="Enter Email">
                                        @error('email')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.website_url') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="website_url" id="website_url"
                                            class="form-control" wire:model="website_url" maxlength="200"
                                            placeholder="Enter Website URL">
                                        @error('website_url')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.check_in') }}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="time" wire:model="check_in" class="form-control">
                                            @error('return_time')
                                                <span class="v-msg-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.check_out') }}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="time" wire:model="check_out" class="form-control">
                                            @error('return_time')
                                                <span class="v-msg-500">{{ $message }}</span>
                                            @enderror
                                        </div>
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.hotel_overview') }}<span
                                                class="text-danger">*</span></label>
                                        <textarea name="hotel_overview" id="hotel_overview" class="form-control" wire:model="hotel_overview"></textarea>
                                        @error('hotel_overview')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.hotel') }}
                                            {{ __('tablevars.photo') }}<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="hotel_img"
                                            wire:model="hotel_img" multiple />
                                        @error('hotel_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if (is_object($hotel_img))
                                        <img src="{{ $hotel_img->temporaryUrl() }}"
                                            style="height: 100px;width: 150px;padding: 10px;border-radius: 15px;">
                                    @elseif (!empty($photoEdit))
                                        @foreach ($photoEdit as $img)
                                            <div style="display: inline-block; position: relative;">
                                                <img src="{{ asset('storage/hotel_photo/' . $img) }}"
                                                    style="height: 100px;width: 150px;padding: 10px;border-radius: 15px;">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    style="position: absolute; top: 0; right: 0;"
                                                    wire:click="deleteImage('{{ $img }}')">X</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.video_url') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="url" name="video" id="video" class="form-control"
                                            wire:model="video" maxlength="200" placeholder="Enter video URL">
                                        @error('video')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
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
                                {{ __('tablevars.details') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="high_start_date">{{ __('tablevars.high') }}
                                        {{ __('tablevars.season_start') }}</label>
                                    <input type="date" class="form-control " name="high_start_date"
                                        wire:model="high_start_date" autocomplete="off">

                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="high_end_date">{{ __('tablevars.high') }}
                                        {{ __('tablevars.season_end') }}</label>
                                    <input type="date" class="form-control " name="high_end_date"
                                        wire:model="high_end_date" autocomplete="off">

                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="label-header"
                                            for="high_season_price">{{ __('tablevars.high_season_price') }}</label>
                                        <input type="text" name="high_season_price" id="high_season_price"
                                            class="form-control" wire:model="high_season_price" maxlength="8"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            placeholder="Enter High Season Price">
                                    </div>
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="medium_start_date">{{ __('tablevars.mid') }}
                                        {{ __('tablevars.season_start') }}</label>
                                    <input type="date" class="form-control " name="medium_start_date"
                                        wire:model="medium_start_date" autocomplete="off">

                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="medium_end_date">{{ __('tablevars.mid') }}
                                        {{ __('tablevars.season_end') }}</label>
                                    <input type="date" class="form-control " name="medium_end_date"
                                        wire:model="medium_end_date" autocomplete="off">

                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.medium_season_price') }}</label>
                                        <input type="text" name="medium_season_price" id="medium_season_price"
                                            class="form-control" wire:model="medium_season_price" maxlength="8"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            placeholder="Enter Midium Season Price">

                                    </div>
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="low_start_date">{{ __('tablevars.low') }}
                                        {{ __('tablevars.season_start') }}</label>
                                    <input type="date" class="form-control " name="low_start_date"
                                        wire:model="low_start_date" autocomplete="off">

                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="low_end_date">{{ __('tablevars.low') }}
                                        {{ __('tablevars.season_end') }}</label>
                                    <input type="date" class="form-control " name="low_end_date"
                                        wire:model="low_end_date" autocomplete="off">

                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.low_season_price') }}</label>
                                        <input type="text" name="low_season_price" id="low_season_price"
                                            class="form-control" wire:model="low_season_price" maxlength="8"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            placeholder="Enter Low Season Price">

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

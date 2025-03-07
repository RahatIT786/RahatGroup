<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.image_gallery') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.gallery') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.imageGallery.index') }}"
                        wire:navigate>{{ __('tablevars.image_gallery') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.image_gallery') }}</h4>
                            <a href="{{ route('admin.imageGallery.index') }}" class="btn btn-danger" wire:navigate>
                                <i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.tour_type') }}<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="service_id" name="service_id"
                                            wire:model="service_id">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.tour_type') }}</option>
                                            @foreach (Helper::service() as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('service_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.pkg_category') }}<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="package_id" name="package_id"
                                            wire:model="package_id">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.pkg_category') }}</option>
                                            @foreach ($packageType as $packageTypeId => $packageType)
                                                <option value="{{ $packageTypeId }}">{{ $packageType }}</option>
                                            @endforeach
                                        </select>
                                        @error('package_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.type') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" id="type" name="type" wire:model="type">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.type') }}</option>
                                            @foreach (Helper::type() as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.image') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image[]" wire:model="image"
                                            multiple />
                                        @error('image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($image)
                                        @foreach ($image as $img)
                                            <img src="{{ $img->temporaryUrl() }}" style="height: 100px;">
                                        @endforeach
                                    @endif
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.facebook_link') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="facebook_link"
                                            name="facebook_link" wire:model="facebook_link"
                                            placeholder="Select Facebook Link">
                                        @error('facebook_link')
                                            <span class="text-danger">{{ $message }}</span>
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
            </div>
        </form>

    </section>
</div>

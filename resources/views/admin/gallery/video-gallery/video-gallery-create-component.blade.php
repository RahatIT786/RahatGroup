<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.video_gallery') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.gallery') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.videoGallery.index') }}"
                        wire:navigate>{{ __('tablevars.video_gallery') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.video_gallery') }}</h4>
                            <a href="{{ route('admin.videoGallery.index') }}" class="btn btn-danger">
                                <i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.tour_type') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" id="service_id" name="service_id" wire:model="service_id">
                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.tour_type') }}</option>
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
                                        <label>{{ __('tablevars.pkg_category') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" id="package_id" name="package_id" wire:model="package_id">
                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.pkg_category') }}</option>
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
                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.type') }}</option>
                                            @foreach (Helper::type() as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.video_url') }}<span class="text-danger">*</span></label>
                                        @foreach ($video as $index => $videoUrl)
                                            <div class="d-flex mb-2">
                                                <input type="text" name="video[{{ $index }}]" class="form-control" wire:model="video.{{ $index }}">
                                                <button type="button" class="btn btn-danger ml-2" wire:click="removeVideo({{ $index }})">Remove</button>
                                            </div>
                                            @error('video.' . $index)
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2" wire:click="addVideo">Add Video URL</button>
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

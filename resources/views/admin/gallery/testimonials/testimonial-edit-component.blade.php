<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.testimonial') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.gallery') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.testimonial.index') }}"
                        wire:navigate>{{ __('tablevars.testimonial') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.testimonial') }}</h4>
                            <a href="{{ route('admin.testimonial.index') }}" class="btn btn-danger" wire:navigate>
                                <i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.title') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" wire:model="title">
                                    </div>
                                    @error('title')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.tour_type') }}<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="tour_type" name="tour_type"
                                            wire:model="tour_type">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.tour_type') }}</option>
                                            @foreach (Helper::service() as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('tour_type')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.city') }} <span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='city_id'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.city') }}</option>
                                            @foreach ($city as $cityId => $cityName)
                                                <option value="{{ $cityId }}">{{ $cityName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.video_url') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="video_url" class="form-control"
                                            wire:model="video_url">
                                    </div>
                                    @error('video_url')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.desc') }}<span class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control" wire:model="description"></textarea>
                                    </div>
                                    @error('description')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.image') }}<span class="text-danger">*</span></label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            wire:model='image'>
                                        @error('image')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($image)
                                        @if (is_object($image))
                                            <img src="{{ $image->temporaryUrl() }}" style="height: 100px;">
                                        @endif
                                    @elseif ($photoEdit)
                                        <img src="{{ asset('storage/testimonial_image/' . $photoEdit) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="card-footer align-right">
                            <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

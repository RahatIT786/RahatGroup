<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="settings-widget profile-details">
                                <div class="settings-menu p-0">
                                    <div class="profile-heading">
                                        <h3 class="m-0">{{ __('tablevars.add_new') }}
                                            {{ __('tablevars.image_gallery') }}</h3>
                                    </div>
                                    <div class="checkout-form personal-address add-course-info">
                                        <form wire:submit.prevent="save">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.event') }}
                                                            {{ __('tablevars.name') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="title"
                                                            placeholder="Enter Event Name" wire:model="title"
                                                            maxlength="100" />
                                                        @error('title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.event') }}
                                                            {{ __('tablevars.date') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" name="event_date" class="form-control"
                                                            wire:model="event_date" />
                                                        @error('event_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.upload_multiple') }}
                                                            {{ __('tablevars.event_image') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" name="event_img[]"
                                                            wire:model="event_img" multiple />
                                                        @error('event_img')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($event_img)
                                                        @foreach ($event_img as $img)
                                                            <img src="{{ $img->temporaryUrl() }}"
                                                                style="height: 100px;">
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="card-footer text-left">
                                                    <button
                                                        class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                                                    <a class="btn btn-warning"
                                                        href="{{ route('agent.imageGallery.index') }}">{{ __('tablevars.back') }}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

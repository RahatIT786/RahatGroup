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
                                        <h3 class="m-0">{{ __('tablevars.edit') }}
                                            {{ __('tablevars.image_gallery') }}</h3>
                                    </div>
                                    <div class="checkout-form personal-address add-course-info">
                                        <form wire:submit.prevent="update">
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

                                                {{-- <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.upload_multiple') }}
                                                            {{ __('tablevars.event_image') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" name="event_img"
                                                            wire:model="event_img" multiple />
                                                        @error('event_img')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if (is_object($event_img))
                                                        <img src="{{ $event_img->temporaryUrl() }}"
                                                            style="height: 100px;">
                                                    @elseif (!empty($eventimage))
                                                        @foreach ($eventimage as $img)
                                                            <img src="{{ asset('storage/event_image/' . $img) }}"
                                                                style="height: 100px;">
                                                        @endforeach
                                                    @else
                                                        <span class="no-image">No images found</span>
                                                    @endif
                                                </div> --}}

                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.upload_multiple') }}
                                                            {{ __('tablevars.event_image') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" name="event_img"
                                                            wire:model="event_img" multiple />
                                                        @error('event_img')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($event_img)
                                                        @foreach ($event_img as $img)
                                                            <img src="{{ $img->temporaryUrl() }}"
                                                                style="height: 100px;width: 150px;padding: 10px;border-radius: 15px;">
                                                        @endforeach
                                                    @endif
                                                    @if (is_object($event_img))
                                                        <img src="{{ $event_img->temporaryUrl() }}"
                                                            style="height: 100px;width: 150px;padding: 10px;border-radius: 15px;">
                                                    @elseif (!empty($eventimage))
                                                        @foreach ($eventimage as $imgId => $img)
                                                            <div style="display: inline-block; position: relative;">
                                                                <img src="{{ asset('storage/event_image/' . $img) }}"
                                                                    style="height: 100px;width: 150px;padding: 10px;border-radius: 15px;">
                                                                <button type="button"
                                                                    wire:click="deleteImage({{ $imgId }})"
                                                                    style="position: absolute; top: 5px; right: 5px;"
                                                                    class="btn btn-danger btn-sm">&times;</button>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <span class="no-image">No images found</span>
                                                    @endif
                                                </div>

                                                <div class="card-footer text-left">
                                                    <button
                                                        class="btn btn-primary">{{ __('tablevars.update') }}</button>
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

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
                                    <div class="profile-heading d-flex justify-content-between">
                                        <h3 class="m-0">Add New Video Gallery</h3>
                                        <div class="ticket-btn-grp">
                                            <a href="{{ route('agent.videoGallery.index') }}">Back</a>
                                        </div>
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
                                                            wire:model="title" placeholder="Enter Event"
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
                                                        <label class="form-control-label">Upload Image of Video<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" name="image"
                                                            wire:model="image" />
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($image)
                                                        <img src="{{ $image->temporaryUrl() }}" style="height: 100px;">
                                                    @endif
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">Video URL<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="video" wire:model="video" rows="3"></textarea>
                                                        @error('video')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="update-profile">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
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

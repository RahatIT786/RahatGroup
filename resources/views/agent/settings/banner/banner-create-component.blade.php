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
                                    <div class="filter-grp ticket-grp d-flex justify-content-between profile-heading">
                                        <h3 class="m-0">{{ __('tablevars.add_new') }} {{ __('tablevars.banner') }}
                                        </h3>
                                        <div>
                                            <a class="btn btn-primary" title="Back"
                                                href="{{ route('agent.banner.index') }}">{{ __('tablevars.back') }}</a>
                                        </div>
                                    </div>
                                    <div class="checkout-form personal-address add-course-info">
                                        <form wire:submit.prevent="save">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.banner_title') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="banner_title"
                                                            id="banner_title" placeholder="Enter Title"
                                                            wire:model="banner_title" maxlength="100" />
                                                        @error('banner_title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.banner_image') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" name="banner_img"
                                                            wire:model="banner_img">
                                                        @error('banner_img')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($banner_img)
                                                        <img src="{{ $banner_img->temporaryUrl() }}"
                                                            style="height: 100px;">
                                                    @endif
                                                </div>

                                                <div class="card-footer text-left">
                                                    <button title="Submit"
                                                        class="btn btn-primary">{{ __('tablevars.submit') }}</button>
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

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.banner') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage_site_settings') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.banner') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.banner') }}</h4>
                            <a href="{{ route('admin.banner.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left" title="Back"></i>
                                {{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.banner_title') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="banner_title" id="banner_title"
                                            placeholder="Enter Title" wire:model="banner_title" maxlength="100" />
                                        @error('banner_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.banner_image') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="banner_img"
                                            wire:model="banner_img">
                                        @error('banner_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($banner_img)
                                        <img src="{{ $banner_img->temporaryUrl() }}" style="height: 100px;">
                                    @endif
                                </div>

                                <div class="card-footer text-left">
                                    <button title="Submit"
                                        class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>

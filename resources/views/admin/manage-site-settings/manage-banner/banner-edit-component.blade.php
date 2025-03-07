<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.banner') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage_site_settings') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.banner') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.banner') }}</h4>
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
                                            <span class="v-msg-500">{{ $message }}</span>
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
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if (is_object($banner_img))
                                        <img src="{{ $banner_img->temporaryUrl() }}" style="height: 100px;">
                                    @elseif (!empty($banner_imgEdit))
                                        <img src="{{ asset('storage/banner_image/' . $banner_imgEdit) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>

                                <div class="card-footer text-left">
                                    <button title="Update"
                                        class="btn btn-primary">{{ __('tablevars.update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

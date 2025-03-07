<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.flier') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.resources') }}
                    {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manageFlier.index') }}"
                        wire:navigate>{{ __('tablevars.manage_flier') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.flier') }}</h4>
                            <a href="{{ route('admin.manageFlier.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.flier_code') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="flier_code" class="form-control"
                                            wire:model="flier_code" maxlength="40">
                                        @error('flier_code')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.service_name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="service_name" class="form-control"
                                            wire:model="service_name" maxlength="200">
                                        @error('service_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.image_file') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            wire:model='image'>
                                        @error('image')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" style="height: 100px;">
                                    @endif
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.comments') }} <span
                                                class="text-danger">*</span></label>
                                        <textarea name="comments" class="form-control" wire:model="comments"></textarea>
                                        @error('comments')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>

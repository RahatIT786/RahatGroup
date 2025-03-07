<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.partner') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.partner') }} </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.managePartner.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.partner') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.partner') }}</h4>
                            <a href="{{ route('admin.managePartner.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            wire:model="name" maxlength="150">
                                        @error('name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.website') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="website" id="website" class="form-control"
                                            wire:model="website" maxlength="150">
                                        @error('website')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.image') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image" wire:model="image">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" style="height: 100px;">
                                    @elseif (!empty($imageEdit))
                                        <img src="{{ asset('storage/partner_image/' . $imageEdit) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer text-left">
                                <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>

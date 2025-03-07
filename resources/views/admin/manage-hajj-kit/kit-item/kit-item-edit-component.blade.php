<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.kit_item') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage') }} {{ __('tablevars.kit_item') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.kitItem.index') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.kit_item') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.kit_item') }}</h4>
                            <a href="{{ route('admin.kitItem.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left" title="Back"></i>
                                {{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.kit_item') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="kit_name" id="kit_name"
                                            placeholder="Enter Kit Name" wire:model="kit_name" maxlength="100" />
                                        @error('kit_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.price') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="price" class="form-control" wire:model="price"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57 step="0.01"'
                                            maxlength="7">
                                        @error('price')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.service') }}
                                            {{ __('tablevars.kit_img') }}<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="kit_img" wire:model="kit_img">
                                        @error('kit_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if (is_object($kit_img))
                                        <img src="{{ $kit_img->temporaryUrl() }}" style="height: 100px;">
                                    @elseif (!empty($kit_imgEdit))
                                        <img src="{{ asset('storage/kit_image/' . $kit_imgEdit) }}"
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

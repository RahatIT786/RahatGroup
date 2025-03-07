<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.voucher_content') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.user') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                        wire:navigate>{{ __('tablevars.voucher_content') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.voucher_content') }}</h4>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.voucher_content') }}</label><span
                                            class="text-danger">*</span>
                                        <textarea name="voucher_content" class="form-control summernote-simple" wire:model="voucher_content"></textarea>
                                        @error('voucher_content')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

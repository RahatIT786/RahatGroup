<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.site_bank_info') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.finance') }}
                    {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.siteBankInfo.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.site_bank_info') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.site_bank_info') }}</h4>
                            <a href="{{ route('admin.siteBankInfo.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.bank') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="bank_name" class="form-control"
                                            wire:model="bank_name" maxlength="100" autocomplete="off">
                                        @error('bank_name')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.account_number') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="account_number" class="form-control"
                                            wire:model="account_number" maxlength="30" autocomplete="off">
                                        @error('account_number')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.bank_address') }}</label><span class="text-danger">*</span>
                                        <textarea name="bank_address" wire:model="bank_address" class="form-control" maxlength="255"></textarea>
                                        @error('bank_address')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.ifsc_code') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="ifsc_code" class="form-control"
                                            wire:model="ifsc_code" maxlength="20" autocomplete="off">
                                        @error('ifsc_code')
                                            <span class="v-msg">{{ $message }}</span>
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
</div>
</section>
</div>


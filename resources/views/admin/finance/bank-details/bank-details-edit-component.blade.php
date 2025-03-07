<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.bank_details') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.finance') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.bankDetails.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.bank_details') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.bank_details') }}</h4>
                            <a href="{{ route('admin.bankDetails.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.company') }} {{ __('tablevars.name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="company_name" class="form-control"
                                            wire:model="company_name" maxlength="200">
                                        @error('company_name')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.bank') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="bank_name" class="form-control"
                                            wire:model="bank_name" maxlength="200">
                                        @error('bank_name')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.account_holder') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="account_holder" class="form-control"
                                            wire:model="account_holder" maxlength="200">
                                        @error('account_holder')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.city') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="city">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.city') }}</option>
                                            @foreach ($citydata as $cityId => $cityName)
                                                <option value="{{ $cityId }}">{{ $cityName }}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.address') }}</label><span class="text-danger">*</span>
                                        <textarea name="address" wire:model="address" class="form-control"></textarea>
                                        @error('address')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.bank_details') }}</label><span
                                            class="text-danger">*</span>
                                        <textarea name="bank_details" wire:model="bank_details" class="form-control"></textarea>
                                        @error('bank_details')
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

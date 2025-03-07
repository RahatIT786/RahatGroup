{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.bank_details') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.bank_details') }}
                    {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item">
                    {{ __('tablevars.bank_details') }}</div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    {{-- <form wire:submit.prevent="save"> --}}
                    <form>
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.bank_details') }}</h4>
                            <a href="{{ route('admin.bankDetails.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.company') }} {{ __('tablevars.name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="company" class="form-control" wire:model="company">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.bank') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="bank" class="form-control" wire:model="bank">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.account_holder') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="account_holder" class="form-control"
                                            wire:model="account_holder">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.city') }} <span class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.city') }}</option>
                                            <option value="1">Delhi</option>
                                            <option value="2">Mumbai</option>
                                            <option value="3">Hydrabad</option>
                                            <option value="4">Ahemdabad</option>
                                            <option value="5">Jaipur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.address') }}</label><span class="text-danger">*</span>
                                        <textarea name="address" class="form-control"></textarea>
                                        @error('address')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.bank_details') }}</label><span
                                            class="text-danger">*</span>
                                        <textarea name="bank_details" class="form-control"></textarea>
                                        @error('bank_details')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>

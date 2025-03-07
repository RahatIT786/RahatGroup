<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.forex') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.forex') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.forex.index') }}"
                        wire:navigate>{{ __('tablevars.forex') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.forex') }}</h4>
                            <a href="{{ route('admin.forex.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.date') }} <span class="text-danger">*</span></label>
                                        <input type="date" name="date" class="form-control" wire:model="txn_date">
                                        @error('txn_date')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.type') }}</label>
                                        <select class="form-control" wire:model="types">
                                            <option value="CREDIT">CREDIT</option>
                                            <option value="DEBIT">DEBIT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.beneficiary') }} {{ __('tablevars.name') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="beneficiary_id">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.beneficiary') }} {{ __('tablevars.name') }}</option>
                                            @foreach ($beneficiary as $id => $beneficiary_name)
                                                <option value="{{ $id }}">{{ $beneficiary_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('beneficiary_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.company') }} {{ __('tablevars.name') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="company_id">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.company') }} {{ __('tablevars.name') }}</option>
                                            @foreach ($companyData as $id => $company_name)
                                                <option value="{{ $id }}">{{ $company_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.sar') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="sar" class="form-control" wire:model="sar"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength="8" wire:keydown="calculateAmount">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.sar') }} {{ __('tablevars.rate') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="sar_rate" class="form-control" wire:model="sar_rate"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength="8" wire:keydown="calculateAmount">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.amount') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="amount" class="form-control" wire:model="amount"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.gst') }}</label>
                                        <input type="text" name="gst" class="form-control" wire:model="gst"
                                            wire:keydown="calculateTotalAmount"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength="8">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.handling_charges') }}</label>
                                        <input type="text" name="handling_charges" class="form-control"
                                            wire:model="handling_charges" wire:keydown="calculateTotalAmount"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength="8">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.total') }} {{ __('tablevars.amount') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="total_amount" class="form-control"
                                            wire:model="total_amount" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.bank') }} {{ __('tablevars.name') }}</label>
                                        <input type="text" name="bank_name" maxlength="150" class="form-control"
                                            wire:model="bank_name" maxlength="150">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.particulars') }} {{ __('tablevars.name') }}</label>
                                        <input type="text" name="particularts" maxlength="150"
                                            class="form-control" wire:model="particularts" maxlength="150">
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

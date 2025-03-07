<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <form wire:submit.prevent="save">
                                    <div class="card-header d-flex justify-content-between">
                                        <h3 class="m-0">{{ __('tablevars.add_new') }} {{ __('tablevars.payment') }}</h3>
                                        <a href="{{ route('agent.payment.index') }}" class="btn btn-danger" wire:navigate>
                                            <i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="checkout-form personal-address add-course-info">
                                            <div class="row">
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.booking_id') }} <span class="text-danger">*</span></label>
                                                        <select class="form-select" name="booking_id" wire:change='getBalance($event.target.value)' wire:model='booking_id'>
                                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.booking_id') }}</option>

                                                            @if ($bookings && count($bookings) > 0)
                                                                @foreach ($bookings as $booking)
                                                                    <option value="{{ $booking->booking_id }}">{{ $booking->booking_id }} / {{ $booking->mehram_name }}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="">No bookings available</option>
                                                            @endif
                                                        </select>
                                                        @error('booking_id')
                                                            <span class="text-danger v-msg-500">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.balance_amount') }} <span class="text-danger">*</span></label>
                                                        <input type="number" name="amount" class="form-control" wire:model="balance" readonly >
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.deposite_type') }} <span class="text-danger">*</span></label>
                                                        <select class="form-select" wire:model='deposite_type'>
                                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.deposite_type') }}</option>
                                                            @foreach (Helper::depositeType() as $key => $val)
                                                                <option value="{{ $key }}">{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('deposite_type')
                                                            <span class="text-danger v-msg-500">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.amount') }} <span class="text-danger">*</span></label>
                                                        <input type="text" name="amount" class="form-control" wire:model="amount" maxlength="9" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                        @error('amount')
                                                            <span class="text-danger v-msg-500">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.company_name') }} <span class="text-danger">*</span></label>
                                                        <select class="form-select" wire:model='company_name' wire:change='getBank'>
                                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.company_name') }}</option>
                                                            @foreach ($companies as $company)
                                                                <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('company_name')
                                                            <span class="text-danger v-msg-500">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.bankname') }} <span class="text-danger">*</span></label>
                                                        <select class="form-select" wire:model='bank_name' wire:change='getBeneficiaryDetails'>
                                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.bankname') }}</option>
                                                            @if ($banks)
                                                                @foreach ($banks as $bank)
                                                                    <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('bank_name')
                                                            <span class="text-danger v-msg-500">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.beneficiary_account_no') }} <span class="text-danger">*</span></label>
                                                        <input type="text" name="beneficiary_account_no" class="form-control" wire:model="acountDetails" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>Cheque no. or Txn No<span class="text-danger">*</span></label>
                                                        <input type="text" name="txn_id" class="form-control" wire:model="txn_id" maxlength="50">
                                                        @error('txn_id')
                                                            <span class="text-danger v-msg-500">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>Transaction Date<span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="txn_date" wire:model="txn_date">
                                                        @error('txn_date')
                                                            <span class="text-danger v-msg-500">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>Person Name (if pay by cash in hand)</label>
                                                        <input type="text" name="name" class="form-control" wire:model="personName" maxlength="100">
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label>Comments</label>
                                                        <textarea id="comments" name="comments" class="form-control" wire:model="comment"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-left">
                                        <button type="submit" class="btn btn-primary">{{ __('tablevars.save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

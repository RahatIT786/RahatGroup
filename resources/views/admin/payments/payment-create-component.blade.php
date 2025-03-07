{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.payment') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.payment') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.payment.index') }}"
                        wire:navigate>{{ __('tablevars.payment') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.payment') }}</h4>
                            <a href="{{ route('admin.payment.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.agency_name') }} <span
                                                class="text-danger">*</span></label>
                                        {{-- select2-Single , this class is for select 2 features --}}
                                        <select class="form-control " wire:change='getBookings' wire:model='agency_id'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.agency_name') }}</option>
                                            @foreach ($agencies as $agency)
                                                <option value="{{ $agency->id }}">{{ $agency->agency_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('agency_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.booking_id') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="booking_id"
                                            wire:change='getBalance($event.target.value)' wire:model='booking_id'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.booking_id') }}</option>
                                            @if ($bookings)
                                                @foreach ($bookings as $booking)
                                                    <option value="{{ $booking->id }}">
                                                        {{ $booking->request_id }} / {{ $booking->mehram_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('booking_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.balance_amount') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="amount" class="form-control" wire:model="balance"
                                            readonly>
                                        {{-- wire:model="balance" --}}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.deposite_type') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='deposite_type'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.deposite_type') }}</option>
                                            @foreach (Helper::depositeType() as $key => $val)
                                                <option value="{{ $key }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                        @error('deposite_type')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.amount') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="amount" class="form-control" wire:model="amount">
                                        @error('amount')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.company_name') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='company_name' wire:change='getBank'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.company_name') }}</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->company_name }}">
                                                    {{ $company->company_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('company_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- {{ print_r($banks) }} --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.bankname') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='bank_name'
                                            wire:change='getBeneficiaryDetails'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.bankname') }}</option>
                                            @if ($banks)
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('bank_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.beneficiary_account_no') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="beneficiary_account_no" class="form-control"
                                            wire:model="acountDetails" readonly>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Cheque no. or Txn No<span class="text-danger">*</span></label>
                                        <input type="text" name="amount" class="form-control" wire:model="txn_id">
                                        @error('txn_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Payment Date<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control " name="payment_date"
                                            wire:model="txn_date">
                                        @error('txn_date')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Person Name(if pay by cash in hand)</label>
                                        <input type="text" name="payee_name" class="form-control"
                                            wire:model="personName">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <textarea id="comments" name="comments" class="form-control" wire:model="comment"></textarea>
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

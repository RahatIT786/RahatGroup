{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.payment') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.payment') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.payment.index') }}"
                        wire:navigate>{{ __('tablevars.payment') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.payment') }}</h4>
                            <a href="{{ route('admin.payment.pending') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.agency_name') }} <span
                                                class="text-danger">*</span></label>
                                        {{-- select2-Single , this class is for select 2 features --}}
                                        <select class="form-control " wire:change='getBookings' wire:model='agency_id' disabled>
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
                                        <label>{{ __('tablevars.booking_id') }} <span class="text-danger">*</span></label>
                                        <select class="form-control" name="booking_id" wire:change='getBalance($event.target.value)' wire:model='booking_id' disabled>
                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.booking_id') }}</option>
                                            @if ($bookings)
                                                @foreach ($bookings as $booking)
                                                    <option value="{{ $booking->booking_id }}">{{ $booking->booking_id }} / {{ $booking->mehram_name }}</option>
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
                                        <input type="text" name="balance" class="form-control" wire:model="balance" disabled>
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
                                        <input type="text" name="amount" class="form-control" wire:model="amount"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        maxlength="7">
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
                                        <label>{{ __('tablevars.bankname') }}<span
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
                                        <label>{{ __('tablevars.chq_txn_no') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="txn_id" class="form-control" wire:model="txn_id" maxlength="50">
                                        @error('txn_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.payment_date') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control " name="payment_date"
                                            wire:model="txn_date">
                                        @error('txn_date')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.person_name') }}</label>
                                        <input type="text" name="payee_name" class="form-control"
                                            wire:model="personName">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.comments') }}</label>
                                        <textarea id="comments" name="comments" class="form-control" wire:model="comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Paid Status <span class="text-danger">*</span></label>
                                        {{-- select2-Single , this class is for select 2 features --}}
                                        <select class="form-control " wire:model='paidStatus'>
                                            <option value="0">Not Paid</option>
                                            <option value="1">Paid</option>

                                        </select>
                                        @error('agency_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Payment Status<span class="text-danger">*</span></label>
                                        {{-- select2-Single , this class is for select 2 features --}}
                                        <select class="form-control " wire:model='paymentStatus'>
                                            <option value="0">Pending</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Unclear</option>
                                            <option value="3">Bounce</option>
                                            <option value="4">Not received</option>

                                        </select>
                                        @error('agency_id')
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
</div>
</section>
</div>

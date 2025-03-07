{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.forex') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.forex') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.forex.index') }}"
                        wire:navigate>{{ __('tablevars.forex') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.forex') }}</h4>
                            <a href="{{ route('admin.forex.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.date') }} <span class="text-danger">*</span></label>
                                        <input type="date" name="date" class="form-control" wire:model="date">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.beneficiary') }} {{ __('tablevars.name') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.beneficiary') }} {{ __('tablevars.name') }}</option>
                                            <option value="1">HOTEL-Mira Ajyaad</option>
                                            <option value="2">HOTEL- LULU MUBARAK</option>
                                            <option value="3">HOTEL - JULNAR TAIBAH</option>
                                            <option value="3">HOTEL - PULLMAN MAKKAH </option>
                                            <option value="3">HOTEL - PULLMAN MADINA</option>
                                            <option value="3">HOTEL - RAWDA AL SAFWA</option>
                                            <option value="3">HOTEL - JAWHARAT AL RASHEED</option>
                                            <option value="3">VISA - MAKARIM (OJOUR)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.company') }} {{ __('tablevars.name') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.company') }} {{ __('tablevars.name') }}</option>
                                            <option value="1">AMAZON INTERTNATIONAL</option>
                                            <option value="2">ALL INDIA HAJJ AND UMRAH TOURS PVT LTD</option>
                                            <option value="2">HAJJ AND UMRAH TRAVEL GROUP INDIA LLP </option>
                                            <option value="2">ALDEAFAH INTERNATIONAL GROUP</option>
                                            <option value="2">Rahat Corporate Service</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.sar') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="sar" class="form-control" wire:model="sar">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.sar') }} {{ __('tablevars.rate') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="sar_rate" class="form-control"
                                            wire:model="sar_rate">
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
                                        <label>{{ __('tablevars.gst') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="gst" class="form-control" wire:model="gst">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.handling_charges') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="handling_charges" class="form-control"
                                            wire:model="handling_charges">
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
                                        <label>{{ __('tablevars.type') }} <span class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.type') }}</option>
                                            <option value="1">CREDIT</option>
                                            <option value="2">DEBIT</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.bank') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="bank_name" class="form-control"
                                            wire:model="bank_name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.particulars') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="particulars" class="form-control"
                                            wire:model="particulars">
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

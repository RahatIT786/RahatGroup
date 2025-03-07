{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.flight') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ 'Pnr' }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.flight.index') }}"
                        wire:navigate>{{ __('tablevars.flight') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.flight') }}</h4>
                            <a href="{{ route('admin.flight.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.flight_name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="flight_name" class="form-control" wire:model="flight_name" maxlength="100">
                                        @error('flight_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.flight_code') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="flight_code" class="form-control" wire:model="flight_code" maxlength="2">
                                        @error('flight_code')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.carrier') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="carrier">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.carrier') }}</option>
                                            <option value="full carrier">Full Carrier</option>
                                            <option value="low cost carrier">LCC - Low Cost Carrier</option>
                                        </select>
                                        @error('carrier')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.flight_logo') }} <span class="text-danger">*</span></label>
                                        <input type="file" name="flight_logo" class="form-control" wire:model="flight_logo">
                                        @error('flight_logo')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($flight_logo) 
                                        <img src="{{ $flight_logo->temporaryUrl() }}" style="height: 100px;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('tablevars.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>

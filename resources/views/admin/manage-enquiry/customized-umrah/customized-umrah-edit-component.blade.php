<!-- request-quote-edit-component.blade.php -->

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.umrah') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.CustomizedUmrah') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.umrah.index') }}" wire:navigate>{{ __('tablevars.umrah') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.umrah') }}</h4>
                            <a href="{{ route('admin.umrah.index') }}" class="btn btn-danger" wire:navigate><i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                               
                               

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.nightsmakkah') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="nights_makkah" class="form-control" wire:model.lazy="nights_makkah" disabled>
                                        @error('nights_makkah') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.nightsmedina') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="nights_medina" class="form-control" wire:model.lazy="nights_medina" disabled>
                                        @error('nights_medina') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.hoteltype') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="hotel_type" class="form-control" wire:model.lazy="hotel_type" disabled>
                                        @error('hotel_type') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.adults') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="adults" class="form-control" wire:model.lazy="adults" disabled>
                                        @error('adults') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.sharingtype') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="sharing_type" class="form-control" wire:model.lazy="sharing_type" disabled>
                                        @error('sharing_type') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                               

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.dateoftravel') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="travel_date" class="form-control" wire:model.lazy="travel_date" disabled>
                                        @error('travel_date') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.supportteam') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="support_team" class="form-control" wire:model.lazy="support_team" >
                                        @error('support_team') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                               
                                <!-- Repeat similar structure for other fields -->
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


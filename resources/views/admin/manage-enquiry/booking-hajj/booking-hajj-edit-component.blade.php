<!-- request-quote-edit-component.blade.php -->

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.bookinghajj') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageSiteSettings') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.bookinghajj.index') }}" wire:navigate>{{ __('tablevars.bookinghajj') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.bookinghajj') }}</h4>
                            <a href="{{ route('admin.bookinghajj.index') }}" class="btn btn-danger" wire:navigate><i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                               
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.service_type') }}</label><span class="text-danger">*</span>
                                        <select class="form-control" name='cat_id' id="cat_id"
                                            wire:model='cat_id' disabled>
                                            <option value="">Service Type</option>
                                            @foreach ($servicetype as $servicetypeId => $ServiceTypeName)
                                            <option value="{{ $servicetypeId }}">{{ $ServiceTypeName }}</option>
                                        @endforeach
                                        </select>
                                        @error('cat_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.name') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="cust_name" class="form-control" wire:model.lazy="cust_name" disabled>
                                        @error('cust_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="cust_email" class="form-control" wire:model.lazy="cust_email" disabled>
                                        @error('cust_email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.phone') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="cust_num" class="form-control" wire:model.lazy="cust_num" disabled>
                                        @error('cust_num') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.traveldate') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="travel_date" class="form-control" wire:model.lazy="travel_date" disabled>
                                        @error('travel_date') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.food') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="food" class="form-control" wire:model.lazy="food" disabled>
                                        @error('food') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.visa') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="visa" class="form-control" wire:model.lazy="visa" disabled>
                                        @error('visa') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.airticket') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="airticket" class="form-control" wire:model.lazy="air_ticket" disabled>
                                        @error('airticket') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
    <div class="form-group">
        <label>{{ __('tablevars.support_team') }}<span class="text-danger">*</span></label>
        <input type="text" name="support_team" class="form-control" wire:model.lazy="support_team">
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



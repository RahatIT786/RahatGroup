<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.add') }} {{ __('tablevars.new') }} {{ __('tablevars.pnr') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.pnr') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.pnr.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.pnr') }} {{ __('tablevars.list') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>

        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.add') }} {{ __('tablevars.pnr') }}</h4>
                            <a href="{{ route('admin.pnr.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>PNR Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="pnr_code"
                                            placeholder="Enter PNR Code">
                                        @error('pnr_code')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- {{-- <div class="col-4">
                                    <div class="form-group">
                                        <label>Package Name <span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="pack_id" id="pack_id">
                                            <option value="">{{ __('tablevars.select') }} Package</option>
                                            @foreach ($packageNames as $id => $package_name)
                                                <option value="{{ $id }}">{{ $package_name }}</option>
                                            @endforeach

                                        </select>
                                        @error('pack_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}} -->

                                <div class="col-4">
                                    <div class="form-group" wire:ignore>
                                        <label>{{ 'Package Name ' }}<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="pack_id"  id="pack_id" name="pack_id"
                                            multiple data-height="100%" style="height: 100%;">
                                            <option value="">{{ __('tablevars.select') }} Package</option>
                                            @foreach ($packageNames as $id => $package_name)
                                                <option value="{{ $id }}">{{ $package_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pack_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Group Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Group Name"
                                            wire:model="group_name">
                                        @error('group_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Flight Name <span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="flight_id">
                                            <option value="">{{ __('tablevars.select') }}Flight</option>
                                            @foreach ($flights as $id => $flight_name)
                                                <option value="{{ $id }}">{{ $flight_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('flight_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Departure City<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="dept_city_id">
                                            <option value="">{{ __('tablevars.select') }} City</option>
                                            @foreach ($citys as $id => $city_name)
                                                <option value="{{ $id }}">{{ $city_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('dept_city_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tour Leader<span class="text-danger">*</span></label>
                                        <input type="text" id="tour_leader" name="tour_leader" class="form-control"
                                            placeholder="Enter Tour Leader" wire:model="tour_leader">
                                        @error('tour_leader')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Group Number<span class="text-danger">*</span></label>
                                        <input type="text" id="group_no" name="group_no" class="form-control"
                                            placeholder="Enter Group Number" wire:model="group_no">
                                        @error('group_no')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Contact Number<span class="text-danger">*</span></label>
                                        <input type="text" id="contact_no" name="contact_no" class="form-control"
                                            placeholder="Enter Contact Number" wire:model="contact_no"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength="12">
                                        @error('contact_no')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>SubAgent Name<span class="text-danger">*</span></label>
                                        <input type="text" id="sub_agent_name" name="sub_agent_name"
                                            class="form-control" placeholder="Enter Contact Number"
                                            wire:model="sub_agent_name">
                                        @error('sub_agent_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Rawda Permit<span class="text-danger">*</span></label>
                                        <input type="date" id="rawda_permit" name="rawda_permit"
                                            class="form-control" wire:model="rawda_permit">
                                        @error('rawda_permit')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="control-label">Type<span class="text-danger">*</span></div>
                                        <div class="">
                                            <label class="custom-switch">
                                                <input type="radio" name="type" value="Saleable"
                                                    class="custom-switch-input" wire:model="pnr_pack_type">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Saleable</span>
                                            </label>
                                            <label class="custom-switch">
                                                <input type="radio" name="type" value="Non-Saleable"
                                                    class="custom-switch-input" wire:model="pnr_pack_type">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Non Saleable</span>
                                            </label>
                                            <label class="custom-switch">
                                                <input type="radio" name="type" value="Both"
                                                    class="custom-switch-input" wire:model="pnr_pack_type" checked>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Both</span>
                                            </label>
                                        </div>
                                        @error('pnr_pack_type')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="control-label">Flight Type<span class="text-danger">*</span></div>
                                        <div class="">
                                            <label class="custom-switch">
                                                <input type="radio" name="flight_type" wire:model="flight_type"
                                                    value="Non-Stop" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Non Stop</span>
                                            </label>
                                            <label class="custom-switch">
                                                <input type="radio" name="flight_type" wire:model="flight_type"
                                                    value="Stop" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Stop</span>
                                            </label>
                                        </div>
                                        @error('flight_type')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h4>Date , Time & Seats Details<span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Departure Sector<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="departure_sector">
                                            <option value="">{{ __('tablevars.select') }} Departure Sector
                                            </option>
                                            @foreach ($sectorData as $id => $sector_name)
                                                <option value="{{ $id }}">{{ $sector_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('departure_sector')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Departure Date<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" wire:model="dept_date"
                                            wire:change='daysCounts'>
                                        @error('dept_date')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Departure Time<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="time" wire:model="dept_time" class="form-control">
                                            @error('return_time')
                                                <span class="v-msg-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Return Sector<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="return_sector">
                                            <option value="">{{ __('tablevars.select') }} Return Sector</option>
                                            @foreach ($sectorData as $id => $sector_name)
                                                <option value="{{ $id }}">{{ $sector_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('return_sector')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Return Date<span class="text-danger">*</span></label>
                                        <input type="date" wire:model="return_date" wire:change='daysCounts'
                                            class="form-control" min="{{ $dept_date }}">
                                        @error('return_date')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Return Time<span class="text-danger">*</span></label>
                                        <div class="input-group">

                                            <input type="time" wire:model="return_time" class="form-control">
                                            @error('return_time')
                                                <span class="v-msg-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Number of Days</label>
                                        <input type="text" wire:model="days" class="form-control"
                                            placeholder="Auto calculated" readonly>
                                        @error('days')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Number of Seats<span class="text-danger">*</span></label>
                                        <input type="text" wire:model="seats" class="form-control"
                                            placeholder="Enter Number of Seats" wire:keyup='availSeats'
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        @error('seats')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Available Seats<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter Number of Available Seats" wire:model="avai_seats"
                                            readonly>
                                        @error('avai_seats')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h4>User Cost Details<span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Adult Price<span class="text-danger">*</span></label>
                                        <input type="text" wire:model="adult_cost" class="form-control"
                                            placeholder="Enter Adult Price"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength="8">
                                        @error('adult_cost')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Child Price<span class="text-danger">*</span></label>
                                        <input type="text" wire:model="child_cost" class="form-control"
                                            placeholder="Enter Child Price"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength="8">
                                        @error('child_cost')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Infant Price<span class="text-danger">*</span></label>
                                        <input type="text" wire:model="infant_cost" class="form-control"
                                            placeholder="Enter Infant Price"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength="8">
                                        @error('infant_cost')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Itenary</label><span class="text-danger">*</span>
                                        <textarea name="itenary" wire:model="itenary" class="form-control" placeholder="Enter Itenary"></textarea>
                                        @error('itenary')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Baggage Details</label><span class="text-danger">*</span>
                                        <textarea name="baggage" wire:model="baggage" class="form-control" placeholder="Enter Baggage Details"></textarea>
                                        @error('baggage')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Cancellation Fee</label><span class="text-danger">*</span>
                                        <textarea name="cancel_fee" wire:model="cancel_fee" class="form-control" placeholder="Enter Cancellation Fee"></textarea>
                                        @error('cancel_fee')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer align-right">
                            <button class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
@push('extra_js')
    <script>
        $(document).ready(function() {
            $('#pack_id').select2();

            $('#pack_id').on('change', function(e) {
                var data = $('#pack_id').val(); // Get selected values as an array
                @this.set('pack_id', data); // Pass the array of selected values to Livewire
            });
        });
    </script>
  

@endpush

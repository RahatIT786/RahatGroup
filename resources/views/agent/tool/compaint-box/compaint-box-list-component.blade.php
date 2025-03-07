<div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                @include('agent.layouts.sidebar')
                <div class="col-xl-10 col-lg-9 col-md-12">
                    <div class="settings-widget">
                        <div class="settings-inner-blk p-0">
                            <div class="comman-space">
                                @if (session('umrah_success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                                        style="color: #1d6119;border: 1px solid #1d6119;">
                                        {!! session('umrah_success') !!}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                            style="color: #1d6119;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <h4 class="h5" style="text-align: center;">Complaint Box</h4>
                                <hr style="border-bottom: 1px solid #e4e4e4;border-top: 0px;margin: 20px 0px;" />
                                <form id="form" wire:submit.prevent="save">
                                    @csrf

                                    <div class="row">

                                        <div class="form-group col-md-6 name mb-3">
                                            <label>Agency Name</label><span class="text-danger">*</span>
                                            <input wire:model.defer="agency_name" type="text" class="form-control"
                                                placeholder="Agency Name" disabled>
                                            @error('agency_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 name mb-3">
                                            <label>Guest Name</label><span class="text-danger">*</span>
                                            <input wire:model.defer="guest_name" type="text" class="form-control"
                                                placeholder="Guest Name">
                                            @error('guest_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group nights_makkah mb-3">
                                            <label for="nights_makkah">Booking Id</label><span
                                                class="text-danger">*</span>
                                            <select class="form-control form-select" id="booking" wire:model="booking_id">
                                                <option value="" selected>Select Booking</option>
                                                @foreach ($bookings as $id => $booking_id)
                                                    <option value="{{ $id }}">{{ $booking_id }}</option>
                                                @endforeach
                                            </select>
                                            @error('booking_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group nights_makkah mb-3">
                                            <label for="nights_makkah">Hotel</label><span class="text-danger">*</span>
                                            <select class="form-control form-select" id="booking" wire:model="hotel_id">
                                                <option value="" selected>Select Hotel</option>
                                                @foreach ($hotels as $id => $hotel_name)
                                                    <option value="{{ $id }}">{{ $hotel_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('hotel_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group departure_date mb-3">
                                            <label>Departure Date</label><span class="text-danger">*</span>
                                            <input type="date" class="form-control" name="departure_date"
                                                id="departure_date" wire:model="departure_date">
                                            @error('departure_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 room_no mb-3">
                                            <label>Room No</label><span class="text-danger">*</span>
                                            <input wire:model.defer="room_no" type="number" class="form-control"
                                                placeholder="Room No">
                                            @error('room_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mobile mb-3">
                                            <label>Mobile</label><span class="text-danger">*</span>
                                            <input wire:model.defer="mobile" type="text" class="form-control"
                                                maxlength="10" placeholder="Mobile"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            @error('mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 airport mb-3">
                                            <label>Airport</label><span class="text-danger">*</span>
                                            <input wire:model.defer="airport" type="airport" class="form-control"
                                                placeholder="Airport">
                                            @error('airport')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12 description mb-3">
                                            <label>Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" rows="10" name="description" id="description" placeholder="Your description"
                                                wire:model="description" style="width: 100%; height: 70px;"></textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div style="margin-top:20px; display: flex; justify-content: center;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

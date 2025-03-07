<div class="modal fade" id="BookingModal" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Book Now</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frm_quick_enquiry" wire:submit.prevent='save'>
                    @if (session('booking_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="color: #1d6119;border: 1px solid #1d6119;">
                            {!! session('booking_success') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                style="color: #1d6119;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="quick_name" id="name" class="form-control"
                                placeholder="Name" wire:model.live='cust_name'>
                            @error('cust_name')
                            <span class="text-red"
                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="emailid" id="emailid" placeholder="Email"
                                wire:model.live='cust_email'>
                            @error('cust_email')
                            <span class="text-red"
                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="mobile" id="mobile"
                                placeholder="Mobile" wire:model.live='cust_num' maxlength="10">
                            @error('cust_num')
                            <span class="text-red"
                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="date" class="form-control" name="dateoftravel" id="dateoftravel"
                                placeholder="Date Of Travel" wire:model.live='travel_date'>
                            @error('travel_date')
                            <span class="text-red"
                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control" wire:model.live="service_id" id="service_id"
                                wire:change='changeServiceType'>
                                <option value="">Select Service Type</option>
                                @foreach ($serviceArray as $id => $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                            @error('service_id')
                            <span class="text-red"
                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control" wire:model.live="pkg_type_id" id="pkg_type_id"
                                wire:change='changePackageType'>
                                <option value="">Select Package</option>
                                @foreach ($packageArray as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                            @error('pkg_type_id')
                            <span class="text-red"
                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control" wire:model.live="pkg_flavour_id" id="pkg_flavour_id">
                                <option value="">Select Package Type</option>
                                @foreach ($subPackageArray as $package)
                                    <option value="{{ $package->id }}">{{ $package->package_type }}</option>
                                @endforeach
                            </select>
                            @error('pkg_flavour_id')
                            <span class="text-red"
                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">

                                <div class="custom-control custom-radio">
                                    <input type="radio" name="food_type" class="custom-control-input" id="withfood2"
                                        value="1" wire:model.live='food'>
                                    <label class="custom-control-label" for="withfood2">With
                                        Food</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="food_type" class="custom-control-input"
                                        id="withoutfood2" value="0" autocomplete="off" wire:model.live='food'>
                                    <label class="custom-control-label" for="withoutfood2">Without Food</label>
                                </div>
                                @error('food')
                                <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="visa_type" class="custom-control-input"
                                        id="withvisa2" value="1" autocomplete="off" wire:model.live='visa'>
                                    <label class="custom-control-label" for="withvisa2">With Visa</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" name="visa_type" class="custom-control-input"
                                        id="withoutvisa2" value="0" autocomplete="off" wire:model.live='visa'>
                                    <label class="custom-control-label" for="withoutvisa2">Without Visa</label>
                                </div>
                                @error('visa')
                                <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="airlineticket_type" class="custom-control-input"
                                        id="withairlineticket2" value="1" autocomplete="off"
                                        wire:model.live='air_ticket'>
                                    <label class="custom-control-label" for="withairlineticket2">With Airline
                                        Ticket</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="airlineticket_type" class="custom-control-input"
                                        id="withoutairlineticket2" value="0" autocomplete="off"
                                        wire:model.live='air_ticket'>
                                    <label class="custom-control-label" for="withoutairlineticket2">Without Airline
                                        Ticket</label>
                                </div>
                                @error('air_ticket')
                                <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="form-control-label">Adults
                                <span class="text-danger"></span></label>
                                <select wire:model.live="adults" class="custom-select form-control" id="adults">
                                    <option value="" selected>Adults</option>
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('adults')
                                <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            {{-- @error('airline_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>


                        <div class="form-group col-md-4">
                            <label class="form-control-label">Children</label>
                                <select wire:model.live="children" class="custom-select form-control" id="children">
                                    <option value="" selected>children</option>
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('children')
                                <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            {{-- @error('airline_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-control-label">Infants</label>
                                <select wire:model.live="infants" class="custom-select form-control" id="infants">
                                    <option value="" selected>Infants</option>
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('infants')
                                <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            {{-- @error('airline_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>






                        <div class="form-group col-md-12">
                            <label>Message</label><span class="text-red">*</span>
                            <textarea class="form-control" name="message" id="message" placeholder="Message" wire:model.live='cust_msg'
                                style="height: 120px"></textarea>
                            @error('cust_msg')
                            <span class="text-red"
                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-8" style="display: flex">
                            <input class="form-control" type="text" wire:model.live="userInput"
                                placeholder="Enter CAPTCHA">
                            <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                        </div>
                        <div class="d-flex flex-row justify-content-start align-items-center">
                            <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-12 mb-2">
                            @error('userInput')
                            <span class="text-red"
                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; margin-top: 20px;">
                    <button type="submit"  class="btn secondary-btn"
                    style="background-position: 300% 100% !important; margin-left: 10px;">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('extra_js')
    <script>
        document.addEventListener('livewire:initialized', function() {
            window.addEventListener('reload-page', function() {
                setTimeout(() => {
                    location.reload();
                }, 4000);
            });
        });
    </script>
@endpush

@push('extra_css')
    <style>
        .custom-control-input {
            position: absolute;
            left: 0;
            z-index: -1;
            width: 1rem;
            height: 1.25rem;
            opacity: 0;
        }
    </style>
@endpush

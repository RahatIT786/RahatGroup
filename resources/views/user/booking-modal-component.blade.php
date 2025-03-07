<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#B49164;color:#ffffff;">
                <h3 class="modal-title h5 mb-0 text-white">Book Now</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body package-enquiry-form">
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
                        {{-- @if (session('success'))
                            <div class="col-md-12">
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif --}}

                        <div class="form-group col-md-6">
                            <input type="text" name="quick_name" id="name" class="form-control"
                                placeholder="Name" wire:model.live='cust_name'>
                            @error('cust_name')
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="emailid" id="emailid" placeholder="Email"
                                wire:model.live='cust_email'>
                            @error('cust_email')
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="mobile" id="mobile"
                                placeholder="Mobile" wire:model.live='cust_num' maxlength="10">
                            @error('cust_num')
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="date" class="form-control" name="dateoftravel" id="dateoftravel"
                                placeholder="Date Of Travel" wire:model.live='travel_date'>
                            @error('travel_date')
                                <span class="validation-msg">{{ $message }}</span>
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
                                <span class="validation-msg">{{ $message }}</span>
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
                                <span class="validation-msg">{{ $message }}</span>
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
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="food_type" class="custom-control-input" id="withfood"
                                        value="1" autocomplete="off" wire:model.live='food'>
                                    <label class="custom-control-label" for="withfood">With Food</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="food_type" class="custom-control-input"
                                        id="withoutfood" value="0" autocomplete="off" wire:model.live='food'>
                                    <label class="custom-control-label" for="withoutfood">Without Food</label>
                                </div>
                                @error('food')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="visa_type" class="custom-control-input"
                                        id="withvisa" value="1" autocomplete="off" wire:model.live='visa'>
                                    <label class="custom-control-label" for="withvisa">With Visa</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="visa_type" class="custom-control-input"
                                        id="withoutvisa" value="0" autocomplete="off" wire:model.live='visa'>
                                    <label class="custom-control-label" for="withoutvisa">Without Visa</label>
                                </div>
                                @error('visa')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="airlineticket_type" class="custom-control-input"
                                        id="withairlineticket" value="1" autocomplete="off"
                                        wire:model.live='air_ticket'>
                                    <label class="custom-control-label" for="withairlineticket">With Airline
                                        Ticket</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="airlineticket_type" class="custom-control-input"
                                        id="withoutairlineticket" value="0" autocomplete="off"
                                        wire:model.live='air_ticket'>
                                    <label class="custom-control-label" for="withoutairlineticket">Without Airline
                                        Ticket</label>
                                </div>
                                @error('air_ticket')
                                    <span class="validation-msg">{{ $message }}</span>
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
                                <span class="validation-msg">{{ $message }}</span>
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
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6" style="display: flex">
                            <input type="text" wire:model="userInput" class="form-control"
                            placeholder="Enter CAPTCHA">
                        <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                        </div>
                        <div class="d-flex flex-row justify-content-start align-items-center">

                            <button wire:click="generateCaptcha" type="button"><i
                                class="fa fa-refresh"></i></button>
                        </div>
                        <div class="col-md-12 mb-2">
                            @error('userInput')
                            <br>
                            <span class="mt-2 block text-red"
                                style="color: red;font-weight: 500;">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <button type="submit" name="btn_quick_submit" class="btn btn-enquiry">Book Now</button>
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

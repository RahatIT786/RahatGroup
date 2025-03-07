<div class="modal fade" id="hajjModal" tabindex="-1" aria-labelledby="hajjModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#B49164;color:#ffffff;">
                <h3 class="modal-title h5 mb-0 text-white">Package Inquiry</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body package-enquiry-form">
                <form name="frm_quick_enquiry" wire:submit.prevent="save">
                    @csrf
                    @if (session('hajj_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="color: #1d6119;border: 1px solid #1d6119;display: flex;justify-content: space-between;">
                            <div style="margin-left: auto;">{!! session('hajj_success') !!}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="color: #1d6119;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-control-label">{{ 'Departure City' }}
                                <span class="text-danger"></span></label>
                            <select class="form-control" wire:model='city_id' id="city_id">
                                <option value="">City Name</option>
                                @if (!empty($city))
                                    @foreach ($city as $CityId => $CityName)
                                        <option value="{{ $CityId }}">{{ $CityName }}</option>
                                    @endforeach
                                @else
                                    <option value="">No cities available</option>
                                @endif
                            </select>
                            {{-- @error('city_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ 'Departure Date' }}<span class="text-danger">*</span></label>
                            <input type="date" name="travel_date" id="travel_date" class="form-control"
                                wire:model="travel_date">
                            @error('travel_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label">{{ 'Airline' }}
                                <span class="text-danger">*</span></label>
                            <select class="form-control" wire:model='airline_id' id="airline_id">
                                <option value="">Airline Name</option>
                                @if (!empty($flight))
                                    @foreach ($flight as $FlightId => $FlightName)
                                        <option value="{{ $FlightId }}">{{ $FlightName }}</option>
                                    @endforeach
                                @else
                                    <option value="">No flights available</option>
                                @endif
                            </select>
                            {{-- @error('airline_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ 'Package Type' }}<span class="text-danger">*</span></label>
                            <select class="form-control" wire:model="pkg_flavour_id" id="pkg_flavour_id">
                                <option value="">Select Package Type</option>
                                @if (!empty($packageType))
                                    @foreach ($packageType as $id => $type)
                                        <option value="{{ $id }}">{{ $type }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('pkg_flavour_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.name') }}<span class="text-danger">*</span></label>
                            <input type="text" name="cust_name" id="cust_name" class="form-control"
                                placeholder="Name" wire:model="cust_name" maxlength="30">
                            @error('cust_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.phone') }}<span class="text-danger">*</span></label>
                            <input type="text" name="cust_num" id="cust_num" class="form-control"
                                placeholder="Mobile number" wire:model="cust_num" maxlength="10">
                            @error('cust_num')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.email') }}<span class="text-danger">*</span></label>
                            <input type="text" name="cust_email" id="cust_email" class="form-control"
                                placeholder="Email" wire:model="cust_email" maxlength="30">
                            @error('cust_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ 'Message' }}<span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control" wire:model="cust_msg"></textarea>
                            @error('cust_msg')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="food_type" class="custom-control-input"
                                        id="withfood1" value="1" wire:model="food">
                                    <label class="custom-control-label" for="withfood1">With
                                        Food</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="food_type" class="custom-control-input"
                                        id="withoutfood1" value="0" wire:model="food">
                                    <label class="custom-control-label" for="withoutfood1">Without
                                        Food</label>
                                </div>
                                @error('food')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="visa_type" class="custom-control-input"
                                        id="withvisa1" value="1" wire:model="visa">
                                    <label class="custom-control-label" for="withvisa1">With
                                        Visa</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="visa_type" class="custom-control-input"
                                        id="withoutvisa1" value="0" wire:model="visa">
                                    <label class="custom-control-label" for="withoutvisa1">Without
                                        Visa</label>
                                </div>
                                @error('visa')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="airlineticket_type" class="custom-control-input"
                                        id="withairlineticket1" value="1" wire:model="air_ticket">
                                    <label class="custom-control-label" for="withairlineticket1">With
                                        Airline
                                        Ticket</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="airlineticket_type" class="custom-control-input"
                                        id="withoutairlineticket1" value="0" wire:model="air_ticket">
                                    <label class="custom-control-label" for="withoutairlineticket1">Without
                                        Airline Ticket</label>
                                </div>
                                @error('air_ticket')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" wire:model.live="userInput"
                                placeholder="Enter CAPTCHA">
                            <div class="mb-2">
                                @error('userInput')
                                    <span class="block text-danger"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div style="display:flex;">
                                <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                <button wire:click="generateCaptcha" type="button" class="ml-2"><i
                                        class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

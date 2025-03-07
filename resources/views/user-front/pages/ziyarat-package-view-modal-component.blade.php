<div class="modal fade" id="ziyaratModal" tabindex="-1" aria-labelledby="hajjModalTitle" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frm_food_enquiry" wire:submit.prevent="save">
                    @csrf
                    {{-- <div class="mb-2 text-default">All fields are mandatory</div> --}}
                    <div class="row">
                        @if (session('hajj_success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="color: #1d6119;border: 1px solid #1d6119;display: flex;justify-content: space-between;">
                                <div style="margin-left: auto;">{!! session('hajj_success') !!}</div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    style="color: #1d6119;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        {{-- <div class="col-md-6 mb-3">
                            <label class="form-control-label">{{ 'Departure City' }}
                                <span class="text-danger">*</span></label>
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
                            @error('city_id')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="form-group col-md-6">
                            <label class="form-control-label">{{ 'Departure City' }}
                                <span class="text-red">*</span></label>
                            <select class="form-control" wire:model='city_id' id="city_id" disabled>
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
                               <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror --}}
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ 'Departure Date' }}<span class="text-red">*</span></label>
                            <input type="date" name="travel_date" id="travel_date" class="form-control"
                                wire:model="travel_date" disabled>
                            {{-- @error('travel_date')
                               <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror --}}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label">{{ 'Airline' }}
                                <span class="text-red">*</span></label>
                            <select class="form-control" wire:model='airline_id' id="airline_id" disabled>
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
                               <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror --}}
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ 'Package Type' }}<span class="text-red">*</span></label>
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
                               <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.name') }}<span class="text-red">*</span></label>
                            <input type="text" name="cust_name" id="cust_name" class="form-control"
                                placeholder="Name" wire:model="cust_name" maxlength="30">
                            @error('cust_name')
                               <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.phone') }}<span class="text-red">*</span></label>
                            <input type="text" name="cust_num" id="cust_num" class="form-control"
                                placeholder="Mobile number" wire:model="cust_num" maxlength="10">
                            @error('cust_num')
                               <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.email') }}<span class="text-red">*</span></label>
                            <input type="text" name="cust_email" id="cust_email" class="form-control"
                                placeholder="Email" wire:model="cust_email" maxlength="30">
                            @error('cust_email')
                               <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ 'Message' }}<span class="text-red">*</span></label>
                            <textarea name="message" class="form-control" wire:model="cust_msg"></textarea>
                            @error('cust_msg')
                               <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="food_type" class="custom-control-input"
                                        id="withfood1" value="1" wire:model="food">
                                    <label class="custom-control-label" for="withfood1">With
                                        Food</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="food_type" class="custom-control-input"
                                        id="withoutfood1" value="0" wire:model="food">
                                    <label class="custom-control-label" for="withoutfood1">Without
                                        Food</label>
                                </div>
                                @error('food')
                                   <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="visa_type" class="custom-control-input"
                                        id="withvisa1" value="1" wire:model="visa">
                                    <label class="custom-control-label" for="withvisa1">With
                                        Visa</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="visa_type" class="custom-control-input"
                                        id="withoutvisa1" value="0" wire:model="visa">
                                    <label class="custom-control-label" for="withoutvisa1">Without
                                        Visa</label>
                                </div>
                                @error('visa')
                                   <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="airlineticket_type" class="custom-control-input"
                                        id="withairlineticket1" value="1" wire:model="air_ticket">
                                    <label class="custom-control-label" for="withairlineticket1">With
                                        Airline
                                        Ticket</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="airlineticket_type" class="custom-control-input"
                                        id="withoutairlineticket1" value="0" wire:model="air_ticket">
                                    <label class="custom-control-label" for="withoutairlineticket1">Without
                                        Airline Ticket</label>
                                </div>
                                @error('air_ticket')
                                   <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-control-label">Passenger
                                <span class="text-danger">*</span></label>
                                <select wire:model.live="passengers" class="custom-select form-control" id="passengers">
                                    <option value="" selected>Passenger</option>
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('passengers')
                                <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            {{-- @error('airline_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>


                        <div class="form-group col-md-4">
                            <label class="form-control-label">Adults
                                <span class="text-danger">*</span></label>
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
                            <label class="form-control-label">Infants
                                <span class="text-danger">*</span></label>
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

                        <div class="form-group col-md-8" style="display: flex">
                            <input class="form-control" type="text" wire:model.live="userInput"
                                placeholder="Enter CAPTCHA">
                            <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                        </div>
                        <div class="d-flex flex-row justify-content-start align-items-center">
                            <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-6 mb-2">
                            @error('userInput')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="btn_quick_submit" class="btn secondary-btn" style="background-position: 300% 100% !important;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

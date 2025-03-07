<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#B49164;color:#ffffff;">
                <h3 class="modal-title h5 mb-0 text-white">Ticket Inquiry</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body package-enquiry-form">
                <form name="frm_quick_enquiry" wire:submit.prevent="save">
                    @csrf
                    @if (session('ticketenq_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="color: #1d6119;border: 1px solid #1d6119;display: flex;justify-content: space-between;">
                            <div style="margin-left: auto;">{!! session('ticketenq_success') !!}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                style="color: #1d6119;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-control-label">{{ 'Departure City' }}
                                <span class="text-red">*</span></label>
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
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label">{{ 'Airline' }}
                                <span class="text-red">*</span></label>
                            <select class="form-control" wire:model='flight_id' id="flight_id">
                                <option value="">Airline Name</option>
                                @if (!empty($flight))
                                    @foreach ($flight as $FlightId => $FlightName)
                                        <option value="{{ $FlightId }}">{{ $FlightName }}</option>
                                    @endforeach
                                @else
                                    <option value="">No flights available</option>
                                @endif
                            </select>
                            @error('flight_id')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ 'Departure Date' }}<span class="text-red">*</span></label>
                            <input type="date" name="travel_date" id="travel_date" class="form-control"
                                wire:model="travel_date">
                            @error('travel_date')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.name') }}<span class="text-red">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                wire:model="name" maxlength="40">
                            @error('name')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.email') }}<span class="text-red">*</span></label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                                wire:model="email" maxlength="30">
                            @error('email')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.phone') }}<span class="text-red">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                placeholder="Mobile number" wire:model="phone" maxlength="10">
                            @error('phone')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group col-md-6 adults">
                            <label>Adults</label><span class="text-red">*</span>
                            <select wire:model="adults" class="custom-select form-control" name="adults"
                                id="adults">
                                <option value="" selected>Select Adults</option>
                                @for ($i = 1; $i <= 50; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('adults')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 children">
                            <label>Children</label><span class="text-red">*</span>
                            <select wire:model="children" class="custom-select form-control" name="children"
                                id="children">
                                <option value="" selected>Select Children</option>
                                @for ($i = 0; $i <= 50; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('children')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 infants">
                            <label>Infants</label><span class="text-red">*</span>
                            <select wire:model="infants" class="custom-select form-control" name="infants"
                                id="infants">
                                <option value="" selected>Select Infants</option>
                                @for ($i = 0; $i <= 50; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('infants')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ 'Message' }}<span class="text-red">*</span></label>
                            <textarea name="message" class="form-control" wire:model="message"></textarea>
                            @error('message')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            {{-- <label>Captcha<span class="text-red">*</span></label> --}}
                            <input type="text" class="form-control" wire:model.live="userInput"
                                placeholder="Enter CAPTCHA">
                            <div class="mb-2">
                                @error('userInput')
                                    <span class="block text-red"
                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div style="display:flex;">
                                <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
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

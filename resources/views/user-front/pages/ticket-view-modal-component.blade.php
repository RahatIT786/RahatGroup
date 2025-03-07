<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h3 class="modal-title h5 mb-0 text-white">Ticket Inquiry</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body package-enquiry-form">
                <form name="frm_ticket_enquiry" wire:submit.prevent="save">
                    @if (session('customer_ticket'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="color: #1d6119;border: 1px solid #1d6119;display: flex;justify-content: space-between;">
                            <div style="margin-left: auto;">{!! session('customer_ticket') !!}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                style="color: #1d6119;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row mb-5">
                        <div class="col-md-1 p-0">
                            <div class="flbg1 text-center"><strong>{{ $flightName }}</strong></div>
                            <div class="flbg1 text-center"><strong>{{ $pnrCode }}</strong></div>
                        </div>
                        <div class="col-md-1 p-0">
                            <div class="flbg1 text-center"><strong>{{ $departureName }}</strong>
                            </div>
                            <div class="flbg1 text-center"><strong>{{ $returnsectorName }}</strong>
                            </div>
                        </div>
                        <div class="col-md-1 p-0">
                            <div class="flbg1 text-center">
                                <strong>{{ $deptDate }}</strong>
                            </div>
                            <div class="flbg1 text-center"><strong>{{ $returnDate }}</strong>
                            </div>
                        </div>
                        <div class="col-md-1 p-0">
                            <div class="flbg1 text-center"><strong>{{ $deptTime }}</strong></div>
                            <div class="flbg1 text-center"><strong>{{ $returnTime }}</strong></div>
                        </div>
                        <div class="col-md-2 p-0">
                            <div class="flbg1 text-center"><strong>Adult Price</strong></div>
                            <div class="flbg1 text-center"><strong>{{ number_format($adultCost, 2) }}</strong>
                            </div>
                        </div>
                        <div class="col-md-2 p-0">
                            <div class="flbg1 text-center"><strong>Child Price</strong></div>
                            <div class="flbg1 text-center"><strong>{{ number_format($childCost, 2) }}</strong>
                            </div>
                        </div>
                        <div class="col-md-2 p-0">
                            <div class="flbg1 text-center"><strong>Infant Price</strong></div>
                            <div class="flbg1 text-center"><strong>{{ number_format($infantCost, 2) }}</strong>
                            </div>
                        </div>
                        <div class="col-md-2 p-0">
                            <div class="flbg1 text-center"><strong>Available</strong></div>
                            <div class="flbg1 text-center"><strong>{{ $avaiSeats }} Seat(s)</strong></div>
                        </div>

                    </div>


                    {{-- <div class="col-md-1 p-0">
                        <div class="flbg text-center">{{ $pnrCode}}</div>

                    </div>
                    <div class="col-md-1 p-0">

                        <div class="flbg text-center">{{ $flightName }}</div>
                    </div> --}}


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-control-label">{{ 'Departure City' }}
                                <span class="text-danger">*</span></label>
                            <select wire:model="city_id" class="form-control" disabled>
                                <option value="">Select City</option>
                                @if (!empty($cities) && $cities->count())
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if ($city->id == $city_id) selected @endif>
                                            {{ $city->city_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label">{{ 'Airline' }}
                                <span class="text-danger">*</span></label>
                            <select wire:model="flight_id" class="form-control" disabled>
                                <option value="">Select Flight</option>
                                @if (!empty($flight))
                                    @foreach ($flight as $id => $name)
                                        <option value="{{ $id }}" {{ $flight_id == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>


                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ 'Departure Date' }}<span class="text-red">*</span></label>
                            <input type="date" name="travel_date" id="travel_date" class="form-control"
                                wire:model="travel_date">
                            @error('travel_date')
                                <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.name') }}<span class="text-red">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                wire:model="name" maxlength="40">
                            @error('name')
                                <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.email') }}<span class="text-red">*</span></label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                                wire:model="email" maxlength="30">
                            @error('email')
                                <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('tablevars.phone') }}<span class="text-red">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                placeholder="Mobile number" wire:model="phone"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
                            @error('phone')
                                <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
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
                                <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
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
                                <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
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
                                <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ 'Message' }}<span class="text-red">*</span></label>
                            <textarea name="message" class="form-control" wire:model="message"></textarea>
                            @error('message')
                                <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-8" style="display: flex">
                            <input type="text" wire:model.live="userInput" class="form-control"
                                placeholder="Enter CAPTCHA">
                            <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <i wire:click="generateCaptcha" class="fa fa-refresh fa-lg" style="cursor: pointer"
                                aria-hidden="true"></i>
                        </div>
                        <div class="col-md-3">
                            @error('userInput')
                                <br>
                                <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; margin-top: 20px;">
                        <button type="submit" class="btn secondary-btn"
                            style="background-position: 300% 100% !important; margin-left: 10px;">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('extra_css')
    <style>
        .flbg1 {
            border: 1px solid #ffffff;
            width: 100%;
            height: 45px;
            background-color: #568787;
            color: #ffffff;
            border-radius: 2px;
            font-size: 12px;
            line-height: 1.2;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

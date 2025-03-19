<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <section class="section">
                    <div class="section-header">
                        <h4>{{ __('tablevars.add_pax') }} - {{ __('tablevars.booking') }} ID {{ $bookingID }}</h4>
                        <div class="section-header-button">

                        </div>
                </section>
                <form wire:submit.prevent="update">
                    @foreach ($passengerDetails as $i => $passenger)
                        {{-- {{ dd($passenger) }} --}}
                        <div class="row">
                            <div class="col-12 ">
                                <div class="card card-primary">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4>Passenger Information Details - {{ $i }} </h4>
                                        @if ($i == 1)
                                            <a href="{{ route('agent.bookings.index') }}" class="btn btn-danger"><i
                                                    class="fas fa-long-arrow-alt-left"></i>
                                                &nbsp;{{ __('tablevars.back') }}</a>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 ">
                                                <div class="form-group">
                                                    <label>Surrname<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="surrname"
                                                        wire:model='passengerDetails.{{ $i }}.surrname'>
                                                    @error("passengerDetails.$i.surrname")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>Given Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="given_name"
                                                        wire:model='passengerDetails.{{ $i }}.given_name'>

                                                    @error("passengerDetails.$i.given_name")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>Passport Number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="passport_num"
                                                        wire:model='passengerDetails.{{ $i }}.passport_num'>
                                                    @error("passengerDetails.$i.passport_num")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="d-block">Gender<span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            id="male{{ $i }}"
                                                            name="gender_{{ $i }}" value="Male"
                                                            wire:model="passengerDetails.{{ $i }}.gender"
                                                            {{ $passengerDetails[$i]['gender'] === 'Male' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="male{{ $i }}">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            id="female{{ $i }}"
                                                            name="gender_{{ $i }}" value="Female"
                                                            wire:model="passengerDetails.{{ $i }}.gender"
                                                            {{ $passengerDetails[$i]['gender'] === 'Female' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="female{{ $i }}">Female</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            id="others{{ $i }}"
                                                            name="gender_{{ $i }}" value="Others"
                                                            wire:model="passengerDetails.{{ $i }}.gender"
                                                            {{ $passengerDetails[$i]['gender'] === 'Others' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="others{{ $i }}">Others</label>
                                                    </div>
                                                    @error("passengerDetails.$i.gender")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4 mb-2">
                                                <div class="form-group">
                                                    <label>Nationality<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nationality"
                                                        value="Indian"
                                                        wire:model='passengerDetails.{{ $i }}.nationality'>
                                                    @error("passengerDetails.$i.nationality")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4 mb-2">
                                                <div class="form-group">
                                                    <label>Date of Birth<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="dateOfBirth"
                                                        id="dateOfBirth"
                                                        wire:model='passengerDetails.{{ $i }}.dateOfBirth'
                                                        wire:change='ageValidation({{ $i }})'>
                                                    @error("passengerDetails.$i.dateOfBirth")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div>
                                                        @if ($passengerDetails[$i]['dateOfBirth'])
                                                            <span
                                                                class="v-msg-500 text-danger">{{ $agevalidation[$i] }}</span>
                                                            <span
                                                                class="text-primary v-msg-500">{{ $mehramMessage[$i] }}</span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-4 mb-2">
                                                <div class="form-group">
                                                    <label>Passport Date of Expiry<span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="passport_exp"
                                                        passport_exp
                                                        wire:model='passengerDetails.{{ $i }}.passport_exp'
                                                        wire:change='expiryCheck({{ $i }})'>
                                                    @error("passengerDetails.$i.passport_exp")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-4 mb-2">
                                                <div class="form-group">
                                                    <label>Pan Card Image<span class="text-danger">*</span></label>
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control"
                                                            id="photo_{{ $i }}"
                                                            wire:model="passengerDetails.{{ $i }}.photo">
                                                        <span class="v-msg-500 text-danger">Acceptable Formats : (.jpg
                                                            or
                                                            .png
                                                            max
                                                            size less than 20kb)</span>
                                                    </div>
                                                    @error("passengerDetails.$i.photo")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                @if (is_object($passengerDetails[$i]['photo']))
                                                    <img src="{{ $passengerDetails[$i]['photo']->temporaryUrl() }}"
                                                        style="height: 100px;">
                                                @endif

                                                @if (!is_object($passengerDetails[$i]['photo']) && !empty($passengerDetails[$i]['photo']))
                                                    <img src="{{ asset('storage/photos/passenger_photo/' . $passengerDetails[$i]['photo']) }}"
                                                        style="height: 100px;">
                                                    {{-- @else
                                            <span class="v-msg-500 text-danger">No images found</span> --}}
                                                @endif
                                            </div>

                                            <div class="col-3 mb-2">
                                                <div class="form-group">
                                                    <label>Passport Scan Front<span
                                                            class="text-danger">*</span></label>
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control"
                                                            id="passport_front_{{ $i }}"
                                                            wire:model="passengerDetails.{{ $i }}.passport_front">

                                                        <span class="v-msg-500 text-danger">Acceptable Formats : (.jpg
                                                            or
                                                            .pdf
                                                            max
                                                            size less than 100kb)</span>

                                                        <span
                                                            class="v-msg-500 text-danger text-black font-weight-bold">
                                                            Note :: First Upload the Photo and then Click on Fetch to
                                                            read the Passport details and Populate the Fields
                                                        </span>
                                                    </div>
                                                    @error("passengerDetails.$i.passport_front")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if (is_object($passengerDetails[$i]['passport_front']))
                                                    <img src="{{ $passengerDetails[$i]['passport_front']->temporaryUrl() }}"
                                                        style="height: 100px;">
                                                @endif

                                                @if (!is_object($passengerDetails[$i]['passport_front']) && !empty($passengerDetails[$i]['passport_front']))
                                                    <img src="{{ asset('storage/photos/passport_front/' . $passengerDetails[$i]['passport_front']) }}"
                                                        style="height: 100px;">
                                                @endif
                                            </div>
                                            <div class="col-1 mb-2">
                                                <label class="w-100"> &nbsp;</label>
                                                <button type="button" class="btn btn-info text-white"
                                                    wire:click='onPassportDocumentChange({{ $i }})'>Fetch</button>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Passport Scan Back<span class="text-danger">*</span></label>
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control"
                                                            id="passport_back_{{ $i }}"
                                                            wire:model="passengerDetails.{{ $i }}.passport_back">

                                                        <span class="v-msg-500 text-danger">Acceptable Formats: (.jpg
                                                            or .pdf, max size less than 100kb)</span><br>
                                                        <span class="v-msg-500 text-danger text-black font-weight-bold"
                                                            style="margin-top: 10px;">
                                                            Note :: First Upload the Photo and then Click on Fetch to
                                                            read the Passport details and Populate the Fields
                                                        </span>

                                                    </div>
                                                    @error("passengerDetails.$i.passport_back")
                                                        <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if (is_object($passengerDetails[$i]['passport_back']))
                                                    <img src="{{ $passengerDetails[$i]['passport_back']->temporaryUrl() }}"
                                                        style="height: 100px;">
                                                @endif

                                                @if (!is_object($passengerDetails[$i]['passport_back']) && !empty($passengerDetails[$i]['passport_back']))
                                                    <img src="{{ asset('storage/photos/passport_back/' . $passengerDetails[$i]['passport_back']) }}"
                                                        style="height: 100px;">
                                                    {{-- @else
                                        <span class="v-msg-500 text-danger">No images found</span> --}}
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    @if ($i == count($passengerDetails))
                                        @if ($passenger['surrname'] == '' && $passenger['given_name'] == '')
                                            <div class="card-footer text-left">
                                                <button class="btn btn-primary">{{ __('tablevars.save') }}</button>
                                            </div>
                                        @else
                                            <div class="card-footer text-left">

                                                <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>

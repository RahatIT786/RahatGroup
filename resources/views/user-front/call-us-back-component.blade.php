<div class="modal fade" id="callusbackModal" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Request a Callback</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @if (session('callus_back_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    style="color: #1d6119;border: 1px solid #1d6119;">
                    {!! session('callus_back_success') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                        style="color: #1d6119;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="modal-body">
                <form name="frm_quick_enquiry" wire:submit.prevent='save'>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select
                                            class="custom-select form-control @error('title')  validation-border @enderror"
                                            name="title " id="title" wire:model="title">

                                            <option value="1">Mr.</option>
                                            <option value="2">Mrs</option>
                                            <option value="3">Miss</option>

                                        </select>
                                        @error('title')
                                        <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="f_name" id="f_name"
                                            class="form-control  @error('f_name')  validation-border @enderror"
                                            placeholder="Enter First Name" wire:model.live="f_name">
                                    </div>
                                </div> --}}
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" name="full_name" id="full_name"
                                            class="form-control  @error('full_name')  validation-border @enderror"
                                            placeholder="Enter  Name" wire:model="full_name">
                                    </div>
                                    @error('full_name')
                                    <span class="text-red"
                                    style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control  @error('country_id')  validation-border @enderror"
                                            name="country_id" id="country_id" wire:model.live="country_id">
                                            <option value="" selected>Select Country</option>
                                            @foreach ($countries as $id => $countryname)
                                                <option value="{{ $id }}">{{ $countryname }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control  @error('city_id')  validation-border @enderror"
                                            name="city" id="city" wire:model.live="city_id">
                                            <option value="" selected>Select City</option>
                                            @foreach ($cities as $id => $city_name)
                                                <option value="{{ $id }}">{{ $city_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control  @error('mob_num')  validation-border @enderror"
                                            placeholder="Enter Mobile Number" name="mob_num" id="mob_num"
                                            maxlength="10" wire:model.live="mob_num">
                                        @error('mob_num')
                                        <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="email_id" id="email_id"
                                            class="form-control @error('email_id')  validation-border @enderror"
                                            placeholder="Enter Email" wire:model.live="email_id">
                                        @error('email_id')
                                        <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="time"
                                            class="form-control  @error('callback_time')  validation-border @enderror"
                                            name="callback_time" id="callback_time" wire:model.live="callback_time">
                                        @error('callback_time')
                                        <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class=" date bindcalendar">
                                            <input type="date"
                                                class="form-control  @error('callback_date')  validation-border @enderror"
                                                name="callback_date" id="callback_date"
                                                wire:model.live="callback_date">
                                            @error('callback_date')
                                            <span class="text-red"
                                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control @error('address')  validation-border @enderror" name="address" id="address"
                                            placeholder="Message" wire:model.live="address" style="height: 100px"></textarea>
                                        @error('address')
                                        <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6" style="display: flex">
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
                        </div>
                        <div style="display: flex; justify-content: center; margin-top: 20px;">
                            <button onclick="validateCallback();" id="lnkSend" class="btn secondary-btn"
                                    style="background-position: 300% 100% !important; margin-left: 10px;">
                                Send
                            </button>
                        </div>


                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

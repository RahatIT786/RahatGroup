<div class="modal fade" id="callusbackModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#B49164;color:#ffffff;">
                <h3 class="modal-title h5 mb-0 text-white">Request a Callback</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if (session('callus_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    style="color: #1d6119;border: 1px solid #1d6119;">
                    {!! session('callus_success') !!}
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
                                            name="title " id="title" wire:model.live="title">
                                            <option value="1">Mr.</option>
                                            <option value="2">Mrs</option>
                                            <option value="3">Miss</option>
                                        </select>
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
                                            placeholder="Enter  Name" wire:model.live="full_name">
                                    </div>
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
                                        {{-- @error('country_id')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror --}}
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
                                        {{-- @error('city_id')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control  @error('mob_num')  validation-border @enderror"
                                            placeholder="Enter Mobile Number" name="mob_num" id="mob_num"
                                            maxlength="10" wire:model.live="mob_num">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="email_id" id="email_id"
                                            class="form-control @error('email_id')  validation-border @enderror"
                                            placeholder="Enter Email" wire:model.live="email_id">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="time"
                                            class="form-control  @error('callback_time')  validation-border @enderror"
                                            name="callback_time" id="callback_time" wire:model.live="callback_time">
                                        {{-- @error('callback_time')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror --}}


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class=" date bindcalendar">
                                            <input type="date"
                                                class="form-control  @error('callback_date')  validation-border @enderror"
                                                name="callback_date" id="callback_date" wire:model.live="callback_date">
                                            {{-- @error('callback_date')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control @error('address')  validation-border @enderror" name="address" id="address"
                                            placeholder="Message" wire:model.live="address" style="height: 100px"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12 mb-3" style="display: flex">
                                    <!-- CAPTCHA input and image -->
                                    <input type="text" wire:model="userInput" class="form-control"
                                        placeholder="Enter CAPTCHA">
                                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                    <div>
                                        <button wire:click="generateCaptcha" type="button"><i
                                                class="fa fa-refresh"></i></button>
                                    </div>
                                    {{-- <div>
                                        @error('userInput')
                                            <br>
                                            <span class="mt-2 block text-red"
                                                style="color: red;font-weight: 500;">{{ $message }}</span>
                                        @enderror

                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 d-flex text-center">
                            <button onclick="return validateCallback();" id="lnkSend" class="submit-btn"
                                href="javascript:__doPostBack('lnkSend','')">Send</button>
                        </div>


                    </div>
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

<div class="modal fade" id="EnquiryModal" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Quick Enquiry</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" wire:submit.prevent="save">
                    @if (session('enquiry_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="color: #1d6119; border: 1px solid #1d6119;">
                            {!! session('enquiry_success') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                style="color: #1d6119;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Category Selection -->
                    <div class="form-group">
                        <label>I am interested in</label>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="cat_id" class="custom-control-input" id="Hajj2"
                                    value="1" autocomplete="off" wire:model='cat_id'>
                                <label class="custom-control-label" for="Hajj2">Hajj</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" name="cat_id" class="custom-control-input" id="Umrah2"
                                    value="2" autocomplete="off" wire:model='cat_id'>
                                <label class="custom-control-label" for="Umrah2">Umrah</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" name="cat_id" class="custom-control-input" id="Ramzaan2"
                                    value="3" autocomplete="off" wire:model='cat_id'>
                                <label class="custom-control-label" for="Ramzaan2">Ramzaan</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" name="cat_id" class="custom-control-input" id="Ziarat2"
                                    value="4" autocomplete="off" wire:model='cat_id'>
                                <label class="custom-control-label" for="Ziarat2">Ziarat</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" name="cat_id" class="custom-control-input" id="Other2"
                                    value="5" autocomplete="off" wire:model='cat_id'>
                                <label class="custom-control-label" for="Other2">Other</label>
                            </div>
                        </div>
                        @error('cat_id')
                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Name Input -->
                    <div class="form-group">
                        <input type="text" name="name" id="quick_name"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                            wire:model='name' maxlength="50">
                        @error('name')
                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="form-group">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="quick_emailid" placeholder="Email" wire:model='email' maxlength="50">
                        @error('email')
                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mobile Number Input -->
                    <div class="form-group">
                        <input type="text" class="form-control @error('mobile_num') is-invalid @enderror"
                            name="mobile_num" id="quick_mobile" placeholder="Mobile" wire:model='mobile_num'
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
                        @error('mobile_num')
                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Whatsapp Number Input -->
                    <div class="form-group">
                        <input type="text" class="form-control @error('whatsapp_num') is-invalid @enderror"
                            name="whatsapp_num" id="quick_whatsappno" placeholder="Whatsapp No"
                            wire:model='whatsapp_num' maxlength="10">
                        @error('whatsapp_num')
                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City Input -->
                    <div class="form-group">
                        <input type="text" class="form-control @error('city_name') is-invalid @enderror"
                            name="city_name" id="city_name" placeholder="City" wire:model='city_name'
                            maxlength="50">
                        @error('city_name')
                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- CAPTCHA Input -->
                    <div class="row">
                        <div class="form-group col-md-8" style="display: flex; align-items: center;">
                            <input class="form-control @error('userInput') is-invalid @enderror" type="text"
                                wire:model.live="userInput" placeholder="Enter CAPTCHA">
                            <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image"
                                style="margin-left: 10px;">
                        </div>
                        <div class="d-flex flex-row justify-content-start align-items-center">
                            <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"
                                style="cursor: pointer;"></i>
                        </div>
                    </div>
                    @error('userInput')
                    <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                    @enderror
            </div>

            <!-- Submit Button -->
            <div style="display: flex; justify-content: center;">
                <button type="submit" class="btn secondary-btn" style="background-position: 300% 100% !important;">Submit</button>
            </div>
            </form>
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

<div class="modal fade" id="foodenquiryModal" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Food Enquiry Form</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @if (session('foodenquiry_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="color: #1d6119;border: 1px solid #1d6119;">
                {!! session('foodenquiry_success') !!}
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
                                    <input type="text" name="name" id="name"
                                        class="form-control  @error('name')  validation-border @enderror"
                                        placeholder="Enter  Name" wire:model.live="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="email" id="email"
                                        class="form-control @error('email')  validation-border @enderror"
                                        placeholder="Enter Email" wire:model.live="email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control  @error('mobile')  validation-border @enderror"
                                        placeholder="Enter Mobile Number" name="mobile" id="mobile"
                                        maxlength="10" wire:model.live="mobile">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="date"
                                        class="form-control  @error('travel_date')  validation-border @enderror"
                                        placeholder="Enter travel date" name="travel_date" id="travel_date"
                                        wire:model.live="travel_date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control  @error('makkah_hotel')  validation-border @enderror"
                                        placeholder="Enter Makka hotel" name="makkah_hotel" id="makkah_hotel"
                                        maxlength="10" wire:model.live="makkah_hotel">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="madinah_hotel" id="madinah_hotel"
                                        class="form-control @error('madinah_hotel')  validation-border @enderror"
                                        placeholder="Enter Madinah Hotel" wire:model.live="madinah_hotel">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="adults" id="adults"
                                        class="form-control @error('adults')  validation-border @enderror"
                                        placeholder="Enter Adults" wire:model.live="adults">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="children" id="children"
                                        class="form-control @error('children')  validation-border @enderror"
                                        placeholder="Enter Children" wire:model.live="children">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="infants" id="infants"
                                        class="form-control @error('infants')  validation-border @enderror"
                                        placeholder="Enter Infants" wire:model.live="infants">
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
                            <div class="form-group col-md-6" style="display: flex">
                                <input type=""
                                    class="form-control  @error('userInput')  validation-border @enderror"
                                    name="userInput" id="userInput" wire:model.live="userInput">
                                <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <button type="button" wire:click="generateCaptcha" >Refresh Captcha</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
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

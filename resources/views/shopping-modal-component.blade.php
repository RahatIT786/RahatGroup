<div class="modal fade" id="shoppingModal" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Shopping Enquiry</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frm_quick_enquiry" wire:submit.prevent='save'>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label><span class="text-red">*</span>
                                        <input type="text" name="name" id="name"
                                            class="form-control  @error('name')  validation-border @enderror"
                                            placeholder="Enter  Name" wire:model.live="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label><span class="text-red">*</span>
                                        <input type="text" name="email" id="email"
                                            class="form-control @error('email')  validation-border @enderror"
                                            placeholder="Enter Email" wire:model.live="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile</label><span class="text-red">*</span>
                                        <input type="text" name="mobile" id="mobile"
                                            class="form-control  @error('mobile')  validation-border @enderror"
                                            placeholder="Enter Mobile Number" wire:model.live="mobile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Delivery date</label><span class="text-red">*</span>
                                            <input type="date" name="delivery_date" id="delivery_date"
                                                class="form-control  @error('delivery_date')  validation-border @enderror"
                                                placeholder="Delivery date" wire:model.live="delivery_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label><span class="text-red">*</span>
                                        <textarea class="form-control @error('address')  validation-border @enderror" name="address" id="address"
                                            placeholder="Message" wire:model.live="address" style="height: 100px"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label><span class="text-red">*</span>
                                        <textarea class="form-control @error('description')  validation-border @enderror" name="description" id="description"
                                            placeholder="Description" wire:model.live="description" style="height: 100px"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6" style="display: flex">
                                    <input type=""
                                        class="form-control  @error('userInput')  validation-border @enderror"
                                        name="userInput" id="userInput" placeholder="Enter CAPTCHA" wire:model.live="userInput">
                                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                </div>
                                <div class="col-md-6 d-flex flex-row justify-content-start align-items-center">
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                    <button wire:click="generateCaptcha" type="button">Refresh Captcha</button>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button onclick="return validateCallback();" id="lnkSend" class="submit-btn"
                                href="javascript:__doPostBack('lnkSend','')">Send</button>
                        </div>
                    </div>
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

{{-- @push('extra_css')
    <style>
        .custom-control-input {
            position: absolute;
            left: 0;
            z-index: -1;
            width: 1rem;
            height: 1.25rem;
            opacity: 0;
        }
    </style>
@endpush --}}

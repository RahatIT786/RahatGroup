<div class="modal fade" id="custPublicationModal" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Publication Enquiry</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @if (session('publication_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    style="color: #1d6119;border: 1px solid #1d6119;">
                    {!! session('publication_success') !!}
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label><span class="text-red">*</span>
                                        <input type="text" name="name" id="name"
                                            class="form-control  @error('name')  validation-border @enderror"
                                            placeholder="Enter  Name" wire:model.live="name">
                                        @error('name')
                                           <span class="text-red"
                                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label><span class="text-red">*</span>
                                        <input type="text" name="email" id="email"
                                            class="form-control @error('email')  validation-border @enderror"
                                            placeholder="Enter Email" wire:model.live="email">
                                        @error('email')
                                           <span class="text-red"
                                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile</label><span class="text-red">*</span>
                                        <input type="text" name="mobile" id="mobile"
                                            class="form-control  @error('mobile')  validation-border @enderror"
                                            placeholder="Enter Mobile Number" wire:model.live="mobile" maxlength="10"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        @error('mobile')
                                           <span class="text-red"
                                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Delivery date</label><span class="text-red">*</span>
                                        <input type="date" name="delivery_date" id="delivery_date"
                                            class="form-control  @error('delivery_date')  validation-border @enderror"
                                            placeholder="Delivery date" wire:model.live="delivery_date">
                                        @error('delivery_date')
                                           <span class="text-red"
                                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label><span class="text-red">*</span>
                                        <textarea class="form-control @error('address')  validation-border @enderror" name="address" id="address"
                                            placeholder="Message" wire:model.live="address" style="height: 100px"></textarea>
                                        @error('address')
                                           <span class="text-red"
                                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label><span class="text-red">*</span>
                                        <textarea class="form-control @error('description')  validation-border @enderror" name="description" id="description"
                                            placeholder="Description" wire:model.live="description" style="height: 100px"></textarea>
                                        @error('description')
                                           <span class="text-red"
                                            style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8" style="display: flex">
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
                            <div class="text-center" style="text-align: center;">
                            <button onclick="return validateCallback();" id="lnkSend" class="btn secondary-btn"
                                href="javascript:__doPostBack('lnkSend','')" style="background-position: 300% 100% !important;">Send</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

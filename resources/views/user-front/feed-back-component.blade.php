<div class="modal fade" id="feedbackModal" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Feedback</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frm_food_enquiry" wire:submit.prevent="save">
                    @if (session('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="cust_name" id="cust_name"
                                class="form-control @error('cust_name')  validation-border @enderror"
                                placeholder="Enter Name" wire:model="cust_name" maxlength="30">
                            @error('cust_name')
                                <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" name="cust_email" id="cust_email"
                                class="form-control @error('cust_email')  validation-border @enderror"
                                placeholder="Enter Email" wire:model="cust_email" maxlength="20">
                            @error('cust_email')
                                <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <select
                                class="custom-select form-control @error('feedback_cat')  validation-border @enderror"
                                name="feedback_cat " id="catagory" wire:model="feedback_cat">
                                <option value="">Select Category</option>
                                <option value="Problem">Problem</option>
                                <option value="Suggestion">Suggestion</option>
                                <option value="Complain">Complain</option>
                                <option value="Question">Question</option>
                                <option value="Appreciation">Appreciation</option>
                            </select>
                            @error('feedback_cat')
                                <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control @error('cust_num')  validation-border @enderror"
                                placeholder="Enter Contact Number" name="contact" id="contact" wire:model="cust_num" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
                            @error('cust_num')
                                <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <textarea class="form-control @error('cust_msg')  validation-border @enderror" name="cust_msg" id="cust_msg"
                                placeholder="Message" wire:model="cust_msg" style="height: 120px"></textarea>
                            @error('cust_msg')
                                <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                            @enderror
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

                        <div class="text-right">
                            <button type="submit" name="btn_quick_submit" class="btn secondary-btn" style="background-position: 300% 100% !important;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

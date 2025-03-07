<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#B49164;color:#ffffff;">
                <h3 class="modal-title h5 mb-0 text-white">Feedback</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body package-enquiry-form">
                <form name="frm_quick_enquiry" wire:submit.prevent='save'>
                    @if (session('feed_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="color: #1d6119;border: 1px solid #1d6119;">
                            {!! session('feed_success') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                style="color: #1d6119;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">


                        <div class="form-group col-md-6">
                            <input type="text" name="cust_name" id="cust_name" class="form-control"
                                placeholder="Name" wire:model.live='cust_name'>
                            @error('cust_name')
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="cust_email" id="cust_email"
                                placeholder="Email" wire:model.live='cust_email'>
                            @error('cust_email')
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control" id="feedback_cat" wire:model="feedback_cat">
                                <option value="">Select Category</option>
                                <option value="Problem">Problem</option>
                                <option value="Suggestion">Suggestion</option>
                                <option value="Complain">Complain</option>
                                <option value="Question">Question</option>
                                <option value="Appreciation">Appreciation</option>
                            </select>
                            @error('feedback_cat')
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="cust_num" id="cust_num"
                                placeholder="Mobile Number" wire:model.live='cust_num' maxlength="10"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            @error('cust_num')
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>Message</label><span class="text-red">*</span>
                            <textarea class="form-control" name="cust_msg" id="cust_msg" placeholder="Message" wire:model.live='cust_msg'
                                style="height: 120px"></textarea>
                            @error('cust_msg')
                                <span class="validation-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-8" style="display: flex">
                            <input type="text" wire:model="userInput" class="form-control"
                                placeholder="Enter CAPTCHA">
                            <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                        </div>
                        <div class="d-flex flex-row justify-content-start align-items-center">
                            <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-6 mb-2">
                            @error('userInput')
                                <br>
                                <span class="mt-2 block text-red"
                                    style="color: red;font-weight: 500;">{{ $message }}</span>
                            @enderror
                        </div>



                    </div>
                    <div class="col-md-12 d-flex text-center">
                        <button type="submit" name="btn_quick_submit" class="btn btn-enquiry">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- @push('extra_css')
    <style>
        .alert-danger {
            color: red !important;
        }
    </style>
@endpush --}}
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

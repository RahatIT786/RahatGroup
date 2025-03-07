<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>{{ $kitName }} Form</h1>
        </div>
    </section>
    <div class="feedback_wrapper FeedBackFormHtml" id="feedback_wrapperMain">
        <div class="container">
            <div class="row top-space">
                <div class="col-md-8 mx-auto form-container">
                    <form name="frm_service_booking" wire:submit.prevent="save">
                        @csrf
                        <h5>All fields are mandatory</h5>
                        <div class="row">
                            @if (session('enquiry_success'))
                                <div class="col-12 alert alert-success alert-dismissible fade show" role="alert"
                                    style="color: #1d6119;border: 1px solid #1d6119;display: flex;justify-content: space-between;">
                                    <div>{!! session('enquiry_success') !!}</div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                        style="color: #1d6119;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="col-md-12 mb-3">
                                <input type="date" class="form-control" placeholder="Delivery Date"
                                    name="delivery_date" id="delivery_date" value="" wire:model="delivery_date"
                                    onfocus="(this.type='date')" onblur="(this.type='text')">
                                @error('delivery_date')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" placeholder="Full Name" name="name"
                                    id="name" value="" wire:model="name" maxlength="50">
                                @error('name')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" placeholder="Email" name="email"
                                    id="email" value="" wire:model="email" maxlength="50">
                                @error('email')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <input type="number" class="form-control" placeholder="Mobile No" name="mobile_num"
                                    id="mobile_num" value="" wire:model="mobile_num" maxlength="10">
                                @error('mobile_num')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control" placeholder="Address" name="address" id="address" value="" wire:model="address"></textarea>
                                @error('address')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control" placeholder="Description" name="description" id="description" value=""
                                    wire:model="description"></textarea>
                                @error('description')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <input type="text" class="form-control" wire:model.live="userInput"
                                    placeholder="Enter CAPTCHA">
                                <div class="mb-2">
                                    @error('userInput')
                                        <span class="block text-red"
                                            style="color: red;font-weight: 500;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div style="display:flex;">
                                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                    <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
                                </div>
                            </div> --}}


                            <div class="col-md-12 mb-3" style="display: flex">
                                <!-- CAPTCHA input and image -->
                                <input type="text" wire:model="userInput" class="form-control"
                                    placeholder="Enter CAPTCHA">
                                <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                <div>
                                    <button wire:click="generateCaptcha" type="button"><i
                                            class="fa fa-refresh"></i></button>
                                </div>
                                <div>
                                    @error('userInput')
                                        <br>
                                        <span class="mt-2 block text-red"
                                            style="color: red;font-weight: 500;">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex text-center">
                            <button type="submit" class="btn submit-btn">Send Enquiry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@push('extra_css')
    <style>
        .feedback_wrapper {
            width: 100%;
            padding: 50px 0px;
            background: #fafafa;
        }

        .feedback_wrapper .form-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 20px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }
    </style>
@endpush

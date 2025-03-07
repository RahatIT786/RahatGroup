<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="breadcrumbs mb-4">
                    <span>
                        <span class="breadcrumb-text">
                            <a href="#">Home</a>
                        </span>
                        <span class="breadcrumb-separator"></span>
                        {{-- <span class="breadcrumb-text">
                            <a href="{{ route('customer.service', ['slug' => $service->slug]) }}">Service</a>
                        </span> --}}
                        @if ($service)
                            <span class="breadcrumb-text">
                                <a href="{{ route('customer.service', ['slug' => $service->slug]) }}">Service</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">{{ $serviceName }}</span>
                        @else
                            <span class="breadcrumb-text">
                                Service Not Found
                            </span>
                        @endif
                    </span>
                    {{-- <span class="breadcrumb-separator">
                    </span>
                    <span class="breadcrumb-text">{{ $serviceName }} </span> --}}
                </nav>
            </div>
        </div>
        <h3>{{ $serviceName }} Enquiry Form</h3>
        <ul class="list-group shadow-sm">
            <li class="list-group-item bg-gradient text-white font-weight-bold"><span class="icon mr-2"><i
                        class="icon-users"></i></span>Service Name : {{ $serviceName }}</li>
        </ul>

        <div class="bg-white shadow-sm rounded p-3 mt-3 mb-4">
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
                    <div class="col-md-6 mb-3">
                        <input type="date" class="form-control" placeholder="Booking Date" name="booking_date"
                            id="booking_date" value="" wire:model="booking_date" onfocus="(this.type='date')"
                            onblur="(this.type='text')">
                        @error('booking_date')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="No of guest" name="no_of_guest"
                                id="no_of_guest" value="" wire:model="no_of_guest">
                        </div>
                        @error('no_of_guest')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Full Name" name="name" id="name"
                            value="" wire:model="name" maxlength="100">
                        @error('name')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email"
                            value="" wire:model="email" maxlength="100">
                        @error('email')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Mobile Without Country Code"
                            name="mobile" id="mobile" value="" wire:model="mobile"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
                        @error('mobile')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Whatsapp Without Country Code"
                            name="whatsapp" id="whatsapp" value="" wire:model="whatsapp"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
                        @error('whatsapp')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <textarea class="form-control" placeholder="Hotel Names Makka and Madina with Address" name="hotel_name" id="hotel_name"
                            value="" wire:model="hotel_name"></textarea>
                        @error('hotel_name')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <textarea class="form-control" placeholder="Comments or Comment" name="comments" id="comments" value=""
                            wire:model="comments"></textarea>
                        @error('comments')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6" style="display: flex">
                        <input type="text" wire:model.live="userInput" class="form-control"
                            placeholder="Enter CAPTCHA">
                        <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <i wire:click="generateCaptcha" class="fa fa-refresh fa-lg"  style="cursor: pointer" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-3">
                        @error('userInput')
                            <br>
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div style="display: flex; justify-content: center; margin-top: 20px;">
                    <button type="submit"
                            class="btn secondary-btn"
                            style="background-position: 300% 100% !important; margin-left: 10px;">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

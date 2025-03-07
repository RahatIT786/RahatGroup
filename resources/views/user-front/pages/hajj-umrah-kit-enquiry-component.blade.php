<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="breadcrumbs mb-4">
                    <span>
                        <span class="breadcrumb-text">
                            <a href="{{ route('customer.homepage') }}">Home</a>
                        </span>
                        <span class="breadcrumb-separator"></span>
                        @if ($kit)
                            <span class="breadcrumb-text">
                                <a href="{{ route('customer.hajjKit', ['slug' => $kit->slug]) }}">HajjKit</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">{{ $kitName }}</span>
                            {{-- @else
                            <span class="breadcrumb-text">
                                HajjKit Not Found
                            </span> --}}
                        @endif
                    </span>
                </nav>
            </div>
        </div>
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
                    {{-- <div class="col-md-6 mb-3">
                        <input type="date" class="form-control" placeholder="Delivery Date" name="delivery_date"
                            id="delivery_date" value="" wire:model="delivery_date" onfocus="(this.type='date')"
                            onblur="(this.type='text')">
                        @error('delivery_date')
                       <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div> --}}

                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="date" class="form-control" placeholder="Delivery Date" name="delivery_date"
                            id="delivery_date" value="" wire:model="delivery_date" onfocus="(this.type='date')"
                            onblur="(this.type='text')">
                        @error('delivery_date')
                       <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Full Name" name="name" id="name"
                            value="" wire:model="name">
                        @error('name')
                       <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email"
                            value="" wire:model="email">
                        @error('email')
                       <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Mobile No" name="mobile_num"
                            id="mobile_num" value="" wire:model="mobile_num" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
                        @error('mobile_num')
                       <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <textarea class="form-control" placeholder="Address" name="address" id="address" value="" wire:model="address"></textarea>
                        @error('address')
                       <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <textarea class="form-control" placeholder="Description" name="description" id="description" value=""
                            wire:model="description"></textarea>
                        @error('description')
                       <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-8" style="display: flex">
                        <input type="text" wire:model.live="userInput" class="form-control"
                            placeholder="Enter CAPTCHA">
                        <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <i wire:click="generateCaptcha" class="fa fa-refresh fa-lg"  style="cursor: pointer" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-12">
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

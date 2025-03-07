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
                        <span class="breadcrumb-text">Laundry</span>
                    </span>
                </nav>
            </div>
        </div>
        <ul class="list-group shadow-sm">
            <li class="list-group-item bg-gradient text-white font-weight-bold"><span class="icon mr-2"><i
                        class="icon-users"></i></span>Laundry Enquiry Form</li>
        </ul>
        <div class="bg-white shadow-sm rounded p-3 mt-3 mb-4">
            <form wire:submit.prevent="save">
                @if (session('laundry_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="color: #1d6119;border: 1px solid #1d6119;">
                        {!! session('laundry_success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="color: #1d6119;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h5>All fields are mandatory</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="date" class="form-control" wire:model.live="booking_date">
                        @error('booking_date')
                            <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="number" class="form-control" wire:model.live="no_of_guest"
                            placeholder="No of guests">
                        @error('no_of_guest')
                            <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" wire:model.live="name" placeholder="Full Name">
                        @error('name')
                            <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" wire:model.live="email" placeholder="Email">
                        @error('email')
                            <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" wire:model.live="mobile"
                            placeholder="Mobile Without Country Code"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
                        @error('mobile')
                            <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" wire:model.live="whatsapp"
                            placeholder="Whatsapp Without Country Code"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
                        @error('whatsapp')
                            <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <textarea class="form-control" rows="2" wire:model.live="hotel_name"
                            placeholder="Hotel Names Makka and Madina with Address"></textarea>
                        @error('hotel_name')
                            <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <textarea class="form-control" rows="2" wire:model.live="comments" placeholder="Comments or Remarks"></textarea>
                        @error('comments')
                            <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-8" style="display: flex;">
                        <input type="text" wire:model.live="userInput" class="form-control"
                            placeholder="Enter CAPTCHA">
                        <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <i wire:click="generateCaptcha" class="fa fa-refresh fa-lg" style="cursor: pointer"
                            aria-hidden="true"></i>
                    </div>
                    <div class="col-md-12 mb-2">
                        @error('userInput')
                            <span class="text-red"
                                style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div style="display: flex; justify-content: center; margin-top: 20px;">
                    <button type="submit" class="btn secondary-btn"
                        style="background-position: 300% 100% !important; margin-left: 10px;">Send Enquiry</button>
                </div>
            </form>
        </div>
    </div>
</section>

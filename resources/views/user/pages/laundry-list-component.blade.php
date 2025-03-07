<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Laundry Form</h1>
        </div>
    </section>
    <div class="feedback_wrapper FeedBackFormHtml" id="feedback_wrapperMain">
        <div class="container">
            <div class="row top-space">
                <div class="col-md-8 mx-auto form-container">
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
                                <input type="date" class="form-control" wire:model="booking_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" class="form-control" wire:model="no_of_guest"
                                    placeholder="No of guests" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" wire:model="name" placeholder="Full Name"
                                    required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" wire:model="email" placeholder="Email"
                                    required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="tel" class="form-control" wire:model="mobile"
                                    placeholder="Mobile Without Country Code" required>
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="tel" class="form-control" wire:model="whatsapp"
                                    placeholder="Whatsapp Without Country Code" required>
                                @error('whatsapp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control" rows="2" wire:model="hotel_name"
                                    placeholder="Hotel Names Makka and Madina with Address" required></textarea>
                                @error('hotel_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control" rows="2" wire:model="comments" placeholder="Comments or Remarks" required></textarea>
                                @error('comments')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="display: flex;">
                                <input type="text" wire:model="userInput" class="form-control"
                                    placeholder="Enter CAPTCHA" required>
                                <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
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

<section class="section newsletter-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="{{ asset('assets/user-front/images/newsletter.png') }}" alt="newsletter" />
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="section-title">
                    <h2 class="title mb-4">Sign Up For a Newsletter</h2>
                    <p>Fill in your Details to Get Latest Offers, Special Discounts, News and Event Information from
                        Rahat.com.</p>
                </div>
                <div class="newsletter-form">
                    <form wire:submit.prevent="subscribe">
                        <div class="form-row">
                            <div class="col-sm-6 col-lg-6 form-group">
                                <input type="text" class="form-control" wire:model="name" placeholder="Enter Name" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-lg-6 form-group">
                                <input type="email" class="form-control" wire:model="email"
                                    placeholder="Enter Email" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-lg-6 form-group">
                                <input type="text" class="form-control" wire:model="city" placeholder="Enter City" />
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-lg-6 form-group">
                                <input type="phone" class="form-control" wire:model="mobile"
                                    placeholder="Your Mobile" />
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn default-btn mb-2">Subscribe</button>
                        </div>
                        @if ($successMessage)
                            <div class="alert alert-success">{{ $successMessage }}</div>
                        @endif
                        @if ($errorMessage)
                            <div class="alert alert-danger">{{ $errorMessage }}</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

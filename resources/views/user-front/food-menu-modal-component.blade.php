<div class="modal fade" id="foodenquiryModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Food Enquiry Form</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if (session('foodenquiry_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                     style="color: #1d6119; border: 1px solid #1d6119;">
                    {!! session('foodenquiry_success') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="color: #1d6119;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="modal-body">
                <form wire:submit.prevent="save">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name"
                                               class="form-control @error('name') validation-border @enderror"
                                               placeholder="Enter Name" wire:model="name" required>
                                               @error('name')
                                               <span class="text-red"
                                                   style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email"
                                               class="form-control @error('email') validation-border @enderror"
                                               placeholder="Enter Email" wire:model="email" required>
                                               @error('email')
                                               <span class="text-red"
                                                   style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="mobile" id="mobile"
                                               class="form-control @error('mobile') validation-border @enderror"
                                               placeholder="Enter Mobile Number" maxlength="10"
                                               wire:model="mobile" required>
                                               @error('mobile')
                                               <span class="text-red"
                                                   style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="date" name="travel_date" id="travel_date"
                                               class="form-control @error('travel_date') validation-border @enderror"
                                               wire:model="travel_date" required>
                                               @error('travel_date')
                                               <span class="text-red"
                                                   style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="makkah_hotel" id="makkah_hotel"
                                               class="form-control @error('makkah_hotel') validation-border @enderror"
                                               placeholder="Enter Makkah Hotel" wire:model="makkah_hotel" required>
                                               @error('makkah_hotel')
                                               <span class="text-red"
                                                   style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="madinah_hotel" id="madinah_hotel"
                                               class="form-control @error('madinah_hotel') validation-border @enderror"
                                               placeholder="Enter Madinah Hotel" wire:model="madinah_hotel" required>
                                               @error('madinah_hotel')
                                               <span class="text-red"
                                                   style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="adults" id="adults"
                                               class="form-control @error('adults') validation-border @enderror"
                                               placeholder="Enter Adults" wire:model="adults" min="0" required>
                                               @error('adults')
                                               <span class="text-red"
                                                   style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="children" id="children"
                                               class="form-control @error('children') validation-border @enderror"
                                               placeholder="Enter Children" wire:model="children" min="0" required>
                                               @error('children')
                                               <span class="text-red"
                                                   style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="infants" id="infants"
                                               class="form-control @error('infants') validation-border @enderror"
                                               placeholder="Enter Infants" wire:model="infants" min="0" required>
                                               @error('infants')
                                               <span class="text-red"
                                                   style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control @error('address') validation-border @enderror"
                                                  name="address" id="address"
                                                  placeholder="Message" wire:model="address"
                                                  style="height: 100px" required></textarea>
                                                  @error('address')
                                                  <span class="text-red"
                                                      style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                              @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8" style="display: flex">
                                    <input class="form-control" type="text" wire:model.live="userInput"
                                        placeholder="Enter CAPTCHA" required>
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
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit"  class="btn secondary-btn"
                        style="background-position: 300% 100% !important; margin-left: 10px;">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



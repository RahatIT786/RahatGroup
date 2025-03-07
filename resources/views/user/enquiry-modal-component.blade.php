<div class="modal fade" id="enquiryModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-8">
                    <div class="modal-header" style="background:#B49164;color:#ffffff;">
                        <h3 class="modal-title h5 mb-0 text-white">Quick Enquiry</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body package-enquiry-form">
                        <form id="form" wire:submit.prevent="save">
                            @if (session('enquiry_success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert"
                                    style="color: #1d6119;border: 1px solid #1d6119;">
                                    {!! session('enquiry_success') !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                        style="color: #1d6119;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Category Selection -->
                            <div class="form-group">
                                <label>I am interested in</label>
                                <div style="display:flex;gap: 8px;flex-wrap:wrap;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" name="cat_id" class="custom-control-input" id="Hajj"
                                            value="1" autocomplete="off" wire:model='cat_id'>
                                        <label class="custom-control-label" for="Hajj">Hajj</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" name="cat_id" class="custom-control-input" id="Umrah"
                                            value="2" autocomplete="off" wire:model='cat_id'>
                                        <label class="custom-control-label" for="Umrah">Umrah</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" name="cat_id" class="custom-control-input" id="Ramzaan"
                                            value="3" autocomplete="off" wire:model='cat_id'>
                                        <label class="custom-control-label" for="Ramzaan">Ramzaan</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" name="cat_id" class="custom-control-input" id="Ziarat"
                                            value="4" autocomplete="off" wire:model='cat_id'>
                                        <label class="custom-control-label" for="Ziarat">Ziarat</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" name="cat_id" class="custom-control-input" id="Other"
                                            value="5" autocomplete="off" wire:model='cat_id'>
                                        <label class="custom-control-label" for="Other">Other</label>
                                    </div>
                                </div>
                                @error('cat_id')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Name Input -->
                            <div class="form-group">
                                <input type="text" name="name" id="quick_name" class="form-control"
                                    placeholder="Name" wire:model='name' maxlength="50">
                                @error('name')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="quick_emailid"
                                    placeholder="Email" wire:model='email' maxlength="50">
                                @error('email')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Mobile Number Input -->
                            <div class="form-group">
                                <input type="text" class="form-control" name="mobile_num" id="quick_mobile"
                                    placeholder="Mobile" wire:model='mobile_num' maxlength="10">
                                @error('mobile_num')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Whatsapp Number Input -->
                            <div class="form-group">
                                <input type="text" class="form-control" name="whatsapp_num" id="quick_whatsappno"
                                    placeholder="Whatsapp No" wire:model='whatsapp_num' maxlength="10">
                                @error('whatsapp_num')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- City Input -->
                            <div class="form-group">
                                <input type="text" class="form-control" name="city_name" id="city_name"
                                    placeholder="City" wire:model='city_name' maxlength="50">
                                @error('city_name')
                                    <span class="validation-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- CAPTCHA Input -->
                            <div class="form-group col-md-12 px-0" style="display: flex">
                                <input type="text" wire:model.lazy="userInput" class="form-control" placeholder="Enter CAPTCHA">
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                    <div>
                                        <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @error('userInput')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" class="submit-btn">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 enquiry_list_box">
                            <div class="package_price_details">
                                <h3 class="box-title rounded-top">Quick Enquiry List</h3>
                                <div class="tailor_made_ticket_box">
                                    <div class="">
                                        @foreach ($QsEnquirys as $RsEnquiry)
                                            <div class="tailor_made_ticket_box">
                                                <ul class="">
                                                    <li>
                                                        <h5 class="h6"><strong
                                                                style='color:#B49164;font-weight:bold;text-transform: uppercase;'>
                                                                {{ $RsEnquiry->name }} </strong></h6>
                                                    </li>
                                                    <li>
                                                        <p><span class="project-text-color"> City :
                                                            </span>{{ $RsEnquiry->city_name }}</p>
                                                    </li>

                                                    <li>
                                                        <p><span class="project-text-color"> Enquiry Date :
                                                            </span>{{ $RsEnquiry->created_at->format('d M Y') }}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

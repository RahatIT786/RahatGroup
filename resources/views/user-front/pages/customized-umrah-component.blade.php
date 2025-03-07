<div>
    <section class="bg-light py-5">
        <div class="container">
            <div class="customize-box">
                @if (session('umrah_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="color: #1d6119;border: 1px solid #1d6119;">
                        {!! session('umrah_success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="color: #1d6119;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <nav class="breadcrumbs mb-4">
                            <span>
                                <span class="breadcrumb-text">
                                    <a href="#">Home</a>
                                </span>
                                <span class="breadcrumb-separator"></span>
                                <span class="breadcrumb-text">Customize Umrah</span>
                            </span>
                        </nav>
                    </div>
                </div>
                <div class="modal-header bg-gradient">
                    <h3 class="modal-title h5 mb-0 text-white">Customize Your Umrah Package</h3>
                </div>
                <div class="bg-white shadow-sm rounded p-3 mt-3 mb-4">
                    <form id="form" wire:submit.prevent="save">
                        @csrf
                        <div class="row">


                            <div class="col-md-6 form-group nights_makkah">
                                <label for="nights_makkah">Nights in Makkah</label><span class="text-red"></span>
                                <select wire:model.live="nights_makkah" class="custom-select form-control"
                                    id="nights_makkah">
                                    <option value="" selected>Select Nights in Makkah</option>
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('nights_makkah')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group nights_medina">
                                <label for="nights_medina">Nights in Medina</label><span class="text-red"></span>
                                <select wire:model.live="nights_medina" class="custom-select form-control"
                                    id="nights_medina">
                                    <option value="" selected>Select Nights in Medina</option>
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('nights_medina')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-6 form-group hotel_type">
                                <label>Hotel Type</label><span class="text-red">*</span>
                                <select class="custom-select form-control" name="hotel_type" id="hotel_type"
                                    wire:model.live="hotel_type">
                                    <option value="" selected="">Select Hotel Type</option>
                                    <option value="Standard Hotels">Standard Hotels</option>
                                    <option value="3 Star">One Star</option>
                                    <option value="4 Star">Two Star</option>
                                    <option value="5 Star">Three Star</option>
                                    <option value="5 Star">Four Star</option>
                                    <option value="5 Star">Five Star</option>

                                </select>
                                @error('hotel_type')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-6 form-group sharing_type">
                                <label for="sharing_type">Sharing Type</label><span class="text-red">*</span>
                                <select id="sharing_type" wire:model.live="sharing_type" class="form-control">
                                    <option value="" selected>Select Sharing Type</option>
                                    <option value="Single">Single</option>
                                    <option value="Double">Double</option>
                                    <option value="Triple">Triple</option>
                                    <option value="Quad">Quad</option>
                                    <option value="Quint">Quint</option>
                                </select>
                                @error('sharing_type')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-6 form-group travel_date">
                                <label>Date of travel</label><span class="text-red">*</span>
                                <input type="date" class="form-control" name="travel_date" id="travel_date"
                                    wire:model.live="travel_date">
                                @error('travel_date')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="country">Departure Country</label><span class="text-red">*</span>
                                <select class="form-control" id="country" wire:model.live="country_id"
                                    wire:change="changeCountry">
                                    <option value="" selected>Select Country</option>
                                    @foreach ($countries as $id => $countryname)
                                        <option value="{{ $id }}">{{ $countryname }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="city">Departure City</label><span class="text-red">*</span>
                                <select class="form-control" id="city" wire:model.live="city_id">
                                    <option value="" selected>Select City</option>
                                    @foreach ($cities as $id => $city_name)
                                        <option value="{{ $id }}">{{ $city_name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 form-group adults">
                                <label>Adults</label><span class="text-red">*</span>
                                <select wire:model.live="adults" class="custom-select form-control" name="adults"
                                    id="adults">
                                    <option value="" selected>Select Adults</option>
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('adults')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group children">
                                <label>Children</label><span class="text-red">*</span>
                                <select wire:model.live="children" class="custom-select form-control" name="children"
                                    id="children">
                                    <option value="" selected>Select Children</option>
                                    @for ($i = 0; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('children')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group infants">
                                <label>Infants</label><span class="text-red">*</span>
                                <select wire:model.live="infants" class="custom-select form-control" name="infants"
                                    id="infants">
                                    <option value="" selected>Select Infants</option>
                                    @for ($i = 0; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('infants')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 name">
                                <label>Name</label><span class="text-red">*</span>
                                <input wire:model.live="name" type="text" class="form-control"
                                    placeholder="Name">
                                @error('name')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 email">
                                <label>Email</label><span class="text-red">*</span>
                                <input wire:model.live="email" type="email" class="form-control"
                                    placeholder="Email">
                                @error('email')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mobile">
                                <label>Mobile</label><span class="text-red">*</span>
                                <input wire:model.live="mobile" type="text" class="form-control" maxlength="10"
                                    placeholder="Mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                @error('mobile')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 nationality">
                                <label>Nationality</label><span class="text-red">*</span>
                                <input wire:model.live="nationality" type="text" class="form-control"
                                    placeholder="Nationality">
                                @error('nationality')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 comments">
                                <label>Comments</label><span class="text-red">*</span>
                                <textarea class="form-control" rows="10" name="comments" id="comments" placeholder="Your Comments"
                                    wire:model.live="comments" style="width: 100%; height: 70px;"></textarea>
                                @error('comments')
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-8" style="display: flex">
                                <input type="text" wire:model.live="userInput" class="form-control"
                                    placeholder="Enter CAPTCHA">
                                <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                <i wire:click="generateCaptcha" class="fa fa-refresh fa-lg" style="cursor: pointer"
                                    aria-hidden="true"></i>
                            </div>
                            <div class="col-md-3">
                                @error('userInput')
                                    <br>
                                    <span class="text-red"
                                        style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="text-center" style="text-align: center;">
                                <button type="submit" class="btn secondary-btn"
                                    style="background-position: 300% 100% !important; margin-left: 10px;">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
    </section>
</div>

<div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                @include('agent.layouts.sidebar')
                <div class="col-xl-10 col-lg-9 col-md-12">
                    <div class="settings-widget">
                        <div class="settings-inner-blk p-0">
                            <div class="comman-space">
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
                                <h4 class="h5" style="text-align: center;">CUSTOMIZE YOUR UMRAH PACKAGE</h4>
                                <hr style="border-bottom: 1px solid #e4e4e4;border-top: 0px;margin: 20px 0px;" />
                                <form id="form" wire:submit.prevent="save">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 form-group nights_makkah mb-3">
                                            <label for="nights_makkah">Nights in Makkah</label><span
                                                class="text-danger">*</span>
                                            <select wire:model="nights_makkah"
                                                class="custom-select form-control form-select" id="nights_makkah">
                                                <option value="" selected>Select Nights in Makkah</option>
                                                @for ($i = 1; $i <= 50; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('nights_makkah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group nights_medina mb-3">
                                            <label for="nights_medina">Nights in Medina</label><span
                                                class="text-danger">*</span>
                                            <select wire:model="nights_medina"
                                                class="custom-select form-control form-select" id="nights_medina">
                                                <option value="" selected>Select Nights in Medina</option>
                                                @for ($i = 1; $i <= 50; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('nights_medina')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group hotel_type mb-3">
                                            <label>Hotel Type</label><span class="text-danger">*</span>
                                            <select class="custom-select form-control form-select" name="hotel_type"
                                                id="hotel_type" wire:model="hotel_type">
                                                <option value="" selected="">Select Hotel Type</option>
                                                <option value="Standard Hotels">Standard Hotels</option>
                                                <option value="1 Star">One Star</option>
                                                <option value="2 Star">Two Star</option>
                                                <option value="3 Star">Three Star</option>
                                                <option value="4 Star">Four Star</option>
                                                <option value="5 Star">Five Star</option>

                                            </select>
                                            @error('hotel_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group sharing_type mb-3">
                                            <label for="sharing_type">Sharing Type</label><span
                                                class="text-danger">*</span>
                                            <select id="sharing_type" wire:model="sharing_type"
                                                class="form-control form-select">
                                                <option value="" selected>Select Sharing Type</option>
                                                <option value="Single">Single</option>
                                                <option value="Double">Double</option>
                                                <option value="Triple">Triple</option>
                                                <option value="Quad">Quad</option>
                                                <option value="Quint">Quint</option>
                                            </select>
                                            @error('sharing_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group travel_date mb-3">
                                            <label>Date of travel</label><span class="text-danger">*</span>
                                            <input type="date" class="form-control" name="travel_date"
                                                id="travel_date" wire:model="travel_date">
                                            @error('travel_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label for="country">Departure Country</label><span
                                                class="text-danger">*</span>
                                            <select class="form-control form-select" id="country"
                                                wire:model="country_id" wire:change="changeCountry">
                                                <option value="" selected>Select Country</option>
                                                @foreach ($countries as $id => $countryname)
                                                    <option value="{{ $id }}">{{ $countryname }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label for="city">Departure City</label><span
                                                class="text-danger">*</span>
                                            <select class="form-control form-select" id="city"
                                                wire:model="city_id">
                                                <option value="" selected>Select City</option>
                                                @foreach ($cities as $id => $city_name)
                                                    <option value="{{ $id }}">{{ $city_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2 form-group adults mb-3">
                                            <label>Adults</label><span class="text-danger">*</span>
                                            <select wire:model="adults" class="custom-select form-control form-select"
                                                name="adults" id="adults">
                                                <option value="" selected>Select Adults</option>
                                                @for ($i = 1; $i <= 50; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('adults')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 form-group children mb-3">
                                            <label>Children</label><span class="text-danger">*</span>
                                            <select wire:model="children"
                                                class="custom-select form-control form-select" name="children"
                                                id="children">
                                                <option value="" selected>Select Children</option>
                                                @for ($i = 0; $i <= 50; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('children')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 form-group infants mb-3">
                                            <label>Infants</label><span class="text-danger">*</span>
                                            <select wire:model="infants"
                                                class="custom-select form-control form-select" name="infants"
                                                id="infants">
                                                <option value="" selected>Select Infants</option>
                                                @for ($i = 0; $i <= 50; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('infants')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 name mb-3">
                                            <label>Name</label><span class="text-danger">*</span>
                                            <input wire:model.defer="name" type="text" class="form-control"
                                                placeholder="Name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 email mb-3">
                                            <label>Email</label><span class="text-danger">*</span>
                                            <input wire:model.defer="email" type="email" class="form-control"
                                                placeholder="Email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 mobile mb-3">
                                            <label>Mobile</label><span class="text-danger">*</span>
                                            <input wire:model.defer="mobile" type="text" class="form-control"
                                                maxlength="10" placeholder="Mobile"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            @error('mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 nationality mb-3">
                                            <label>Nationality</label><span class="text-danger">*</span>
                                            <input wire:model.defer="nationality" type="text" class="form-control"
                                                placeholder="Nationality">
                                            @error('nationality')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12 comments mb-3">
                                            <label>Comments</label><span class="text-danger">*</span>
                                            <textarea class="form-control" rows="10" name="comments" id="comments" placeholder="Your Comments"
                                                wire:model="comments" style="width: 100%; height: 70px;"></textarea>
                                            @error('comments')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div style="margin-top:20px; display: flex; justify-content: center;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

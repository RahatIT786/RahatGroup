<main class="cAJbgc" style="margin-top: 0px;">
        <section id="inner_banner"
            style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
            <div class="container">
                <h1>CUSTOMIZE YOUR UMRAH PACKAGE</h1>
            </div>
        </section>
        <section class="customize-umrah">
            <div class="container">
                <div class="customize-box">
                    <h4 class="h5">CUSTOMIZE YOUR UMRAH PACKAGE</h4>
                    <hr style="border-bottom: 1px solid #e4e4e4;border-top: 0px;margin: 20px 0px;" />
                    <form id="form" wire:submit.prevent="save">
                        @csrf
                        <div class="row">
                        <div class="col-md-6 form-group nights_makkah">
        <label for="nights_makkah">Nights in Makkah</label><span class="text-red">*</span>
        <select wire:model="nights_makkah" class="custom-select form-control" id="nights_makkah">
            <option value="" selected>Select Nights in Makkah</option>
            @for ($i = 1; $i <= 50; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        @error('nights_makkah') <span class="text-red">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-6 form-group nights_medina">
        <label for="nights_medina">Nights in Medina</label><span class="text-red">*</span>
        <select wire:model="nights_medina" class="custom-select form-control" id="nights_medina">
            <option value="" selected>Select Nights in Medina</option>
            @for ($i = 1; $i <= 50; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        @error('nights_medina') <span class="text-red">{{ $message }}</span> @enderror
    </div>
                            <div class="col-md-6 form-group hotel_type">
                                <label>Hotel Type</label><span class="text-red">*</span>
                                <select class="custom-select form-control" name="hotel_type" id="hotel_type"  wire:model="hotel_type" >
                                    <option value="" selected="">Select Hotel Type</option>
                                    <option value="Standard Hotels">Standard Hotels</option>
                                    <option value="3 Star">3 Star</option>
                                    <option value="4 Star">4 Star</option>
                                    <option value="5 Star">5 Star</option>
                                </select>
                                @error('hotel_type') <span class="text-red">{{ $message }}</span> @enderror
                            </div>


                            <div class="col-md-2 form-group adults">
        <label>Adults</label><span class="text-red">*</span>
        <select wire:model="adults" class="custom-select form-control" name="adults" id="adults">
            <option value="" selected>Select Adults</option>
            @for ($i = 1; $i <= 50; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        @error('adults') <span class="text-red">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-2 form-group children">
        <label>Children</label>
        <select wire:model="children" class="custom-select form-control" name="children" id="children">
            <option value="" selected>Select Children</option>
            @for ($i = 0; $i <= 50; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        @error('children') <span class="text-red">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-2 form-group infants">
        <label>Infants</label>
        <select wire:model="infants" class="custom-select form-control" name="infants" id="infants">
            <option value="" selected>Select Infants</option>
            @for ($i = 0; $i <= 50; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        @error('infants') <span class="text-red">{{ $message }}</span> @enderror
    </div>

                            
                           
                           
                                <div class="col-md-6 form-group sharing_type">
        <label>Sharing Type</label><span class="text-red">*</span>
        <div style="display:flex;gap: 8px;flex-wrap:wrap;">
            <div class="custom-control custom-checkbox">
                <input type="radio" wire:model="sharing_type" class="custom-control-input"
                       id="double" value="Double">
                <label class="custom-control-label" for="double">Double</label>
               
            </div>
            <div class="custom-control custom-checkbox">
                <input type="radio" wire:model="sharing_type" class="custom-control-input"
                       id="triple" value="Triple">
                <label class="custom-control-label" for="triple">Triple</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="radio" wire:model="sharing_type" class="custom-control-input"
                       id="quad" value="Quad">
                <label class="custom-control-label" for="quad">Quad</label>
            </div>
        </div>
        @error('sharing_type') <span class="text-red">{{ $message }}</span> @enderror
    </div>
                            <div class="col-md-6 form-group travel_date">
                                <label>Date of travel</label><span class="text-red">*</span>
                                <input type="date" class="form-control" name="travel_date" id="travel_date"  wire:model="travel_date">
                                @error('travel_date') <span class="text-red">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 form-group departure_city">
    <label>Departure City</label><span class="text-red">*</span>
    <div style="display:flex; gap: 8px; flex-wrap:wrap;">
        <div class="custom-control custom-radio">
            <input type="radio" wire:model="departure_city" class="custom-control-input" id="sharjah" value="sharjah">
            <label class="custom-control-label" for="sharjah">Sharjah</label>
           
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" wire:model="departure_city" class="custom-control-input" id="abudhabi" value="abudhabi">
            <label class="custom-control-label" for="abudhabi">Abu Dhabi</label>

        </div>
        <div class="custom-control custom-radio">
            <input type="radio" wire:model="departure_city" class="custom-control-input" id="dubai" value="dubai">
            <label class="custom-control-label" for="dubai">Dubai</label>
        </div>
    </div>
    @error('departure_city') <span class="text-red">{{ $message }}</span> @enderror
</div>
<div class="form-group col-md-6 with_food">
    <label>Food</label><span class="text-red">*</span>
    <div style="display:flex; gap: 8px; flex-wrap: wrap;">
        <div class="custom-control custom-radio">
            <input type="radio" wire:model="with_food" class="custom-control-input" id="withfood" value="1">
            <label class="custom-control-label" for="withfood">With Food</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" wire:model="with_food" class="custom-control-input" id="withoutfood" value="0">
            <label class="custom-control-label" for="withoutfood">Without Food</label>
        </div>
       
    </div>
    @error('with_food') <span class="text-red">{{ $message }}</span> @enderror
</div>

<div class="form-group col-md-6 with_visa">
        <label>Visa</label><span class="text-red">*</span>
        <div style="display:flex; gap: 8px; flex-wrap: wrap;">
            <div class="custom-control custom-checkbox">
                <input type="radio" wire:model="with_visa" class="custom-control-input" id="withvisa" value="1">
                <label class="custom-control-label" for="withvisa">With Visa</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="radio" wire:model="with_visa" class="custom-control-input" id="withoutvisa" value="0">
                <label class="custom-control-label" for="withoutvisa">Without Visa</label>
            </div>
        </div>
        @error('with_visa') <span class="text-red">{{ $message }}</span> @enderror
    </div>
    <div class="form-group col-md-6 with_ticket">
        <label>Airline Ticket</label><span class="text-red">*</span>
        <div style="display:flex; gap: 8px; flex-wrap: wrap;">
            <div class="custom-control custom-checkbox">
                <input type="radio" wire:model="with_ticket" class="custom-control-input" id="withairlineticket" value="1">
                <label class="custom-control-label" for="withairlineticket">With Airline Ticket</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="radio" wire:model="with_ticket" class="custom-control-input" id="withoutairlineticket" value="0">
                <label class="custom-control-label" for="withoutairlineticket">Without Airline Ticket</label>
            </div>
        </div>
        @error('with_ticket') <span class="text-red">{{ $message }}</span> @enderror
    </div>
    <div class="form-group col-md-6 name">
        <label>Name</label><span class="text-red">*</span>
        <input wire:model.defer="name" type="text" class="form-control" placeholder="Name">
        @error('name') <span class="text-red">{{ $message }}</span> @enderror
</div>
    <div class="form-group col-md-6 email">
        <label>Email</label><span class="text-red">*</span>
        <input wire:model.defer="email" type="email" class="form-control" placeholder="Email">
        @error('email') <span class="text-red">{{ $message }}</span> @enderror
    </div>
    <div class="form-group col-md-6 mobile">
        <label>Mobile</label><span class="text-red">*</span>
        <input wire:model.defer="mobile" type="text" class="form-control" maxlength="10" placeholder="Mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        @error('mobile') <span class="text-red">{{ $message }}</span> @enderror
    </div>
    <div class="form-group col-md-6 nationality">
        <label>Nationality</label><span class="text-red">*</span>
        <input wire:model.defer="nationality" type="text" class="form-control" placeholder="Nationality">
        @error('nationality') <span class="text-red">{{ $message }}</span> @enderror
    </div>

    <div class="form-group col-md-12 comments">
            <label>Comments</label><span class="text-red">*</span>
            <textarea class="form-control" rows="8" name="comments" id="comments" placeholder="Comments" wire:model="comments"></textarea>
            @error('comments') <span class="text-red">{{ $message }}</span> @enderror
        </div>



  
    <div class="form-group col-md-6" style="display: flex">
                                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image">
                                    <input type="text" wire:model="userInput" placeholder="Enter CAPTCHA">
                                    
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <button wire:click="generateCaptcha" type="button">Refresh Captcha</button>
                                </div>
                                <div class="col-md-12">
                                @error('userInput')
                                        <br>
                                        <span class="mt-2 block text-red"
                                            style="color: red;font-weight: 500;">{{ $message }}</span>
                                    @enderror

                                </div>
                        <div style="margin-top:20px;">
                            <button type="submit" class="submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    
    
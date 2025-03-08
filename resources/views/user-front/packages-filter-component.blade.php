<div>
    <section class="section hero-section"
        style="background: url('/assets/user-front/images/hero-image.jpg') center no-repeat; background-size: cover;">
        <div class="container">
            <div class="banner-content" >
                <div class="d-flex justify-content-center" >
                   <div style="background-color: rgba(0, 0, 0, 0.2); width: fit-content; box-shadow:2px 2px 4px rgba(0, 0, 0, 0.2); border-radius: 5px;">
                    <h2 class="text-h2" style="
                    text-shadow: 5px 3px 5px black;
        color: white; 
        font-weight: bold;
                        
                        ">Find Your Perfect Umrah Package</h2>
                   </div>
                </div>
                <div class="home-banner-form">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-hajj-tab" data-toggle="pill" href="#pills-hajj"
                                role="tab" aria-controls="pills-hajj" aria-selected="true">Hajj</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-umrah-tab" data-toggle="pill" href="#pills-umrah"
                                role="tab" aria-controls="pills-umrah" aria-selected="false">Umrah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-ramzaan-tab" data-toggle="pill" href="#pills-ramzaan"
                                role="tab" aria-controls="pills-ramzaan" aria-selected="false">Ramzaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-ziyarat-tab" data-toggle="pill" href="#pills-ziyarat"
                                role="tab" aria-controls="pills-ziyarat" aria-selected="false">Ziyarat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-hotels-tab" data-toggle="pill" href="#pills-hotels"
                                role="tab" aria-controls="pills-hotels" aria-selected="false">Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-visa-tab" data-toggle="pill" href="#pills-visa" role="tab"
                                aria-controls="pills-visa" aria-selected="false">Visa</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-hajj" role="tabpanel"
                            aria-labelledby="pills-hajj-tab">
                            <div class="formbox">
                                <div class="form-row align-items-center">
                                    <div class="col-md-5">
                                        <select class="custom-select" wire:model="hajjPackage"
                                            aria-label="Select Package">
                                            <option value="" selected="">Select Package</option>
                                            @foreach ($packages as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="custom-select" wire:model="selectedhajjPackageType"
                                            aria-label="Select Subcategory">
                                            <option value="" selected="">Select Subcategory</option>
                                            @foreach ($packageTypes as $id => $type_ids)
                                                <option value="{{ $id }}">{{ $type_ids }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn default-btn btn-block" wire:click="search">Search
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="pills-umrah" role="tabpanel"
                            aria-labelledby="pills-umrah-tab">
                            <div class="formbox">
                                <div class="form-row align-items-center">
                                    <div class="col-md-5">
                                        <select class="custom-select" wire:model="umrahcity">
                                            <option value="">{{ __('tablevars.city') }}</option>
                                            @foreach ($departureCities as $RsCity)
                                                @if ($RsCity->city)
                                                    <option value="{{ $RsCity->dept_city_id }}">
                                                        {{ $RsCity->city->city_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <select class="form-control" wire:model="umrahmonth">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.month') }}</option>
                                            @foreach ($months as $key => $monthYear)
                                                <option value="{{ $key }}">{{ $monthYear['month'] }}
                                                    {{ $monthYear['year'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <button class="btn default-btn btn-block" wire:click="pendingSeatData">Search
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-ramzaan" role="tabpanel"
                            aria-labelledby="pills-ramzaan-tab">
                            <div class="formbox">
                                <div class="form-row align-items-center">
                                    <div class="col-md-5">
                                        <select class="custom-select" wire:model="ramzaanPackage"
                                            aria-label="Select Package">
                                            <option value="" selected="">Select Package</option>
                                            @foreach ($package as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="custom-select" wire:model="ramzaanPackageType"
                                            aria-label="Select Subcategory">
                                            <option value="" selected="">Select Subcategory</option>
                                            @foreach ($packageType as $id => $type_ids)
                                                <option value="{{ $id }}">{{ $type_ids }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn default-btn btn-block" wire:click="searchramzaan">Search
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-ziyarat" role="tabpanel"
                            aria-labelledby="pills-ziyarat-tab">
                            <div class="formbox">
                                <div class="form-row align-items-center">
                                    <div class="col-md-5">
                                        <select class="custom-select" wire:model="selectedziyaratpackage"
                                            aria-label="Select Package">
                                            <option value="" selected="">Select Package</option>
                                            @foreach ($packageziyarat as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="custom-select" wire:model="selectedziyaratpackageType"
                                            aria-label="Select Subcategory">
                                            <option value="" selected="">Select Subcategory</option>
                                            @foreach ($packageTypeziyarat as $id => $type_ids)
                                                <option value="{{ $id }}">{{ $type_ids }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn default-btn btn-block" wire:click="searchziyarat">Search
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-hotels" role="tabpanel"
                            aria-labelledby="pills-hotels-tab">
                            <div class="formbox">
                                <div class="form-row align-items-center">
                                    <div class="col-md-4">
                                        <select class="custom-select" wire:model="selectcity">
                                            <option value="">{{ __('tablevars.city') }}</option>
                                            @foreach ($cityData as $id => $city_name)
                                                <option value="{{ $id }}">{{ $city_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="custom-select" wire:model="selectstarrating">
                                            <option value="">{{ __('tablevars.select_rating') }}</option>
                                            @foreach ($star_ratings as $id => $star_rating)
                                                <option value="{{ $id }}">{{ $star_rating }} Stars
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="hotel_name" class="custom-select" wire:model="selecthotelname">
                                            <option value="">{{ __('tablevars.hotel_name') }}</option>
                                            @foreach ($hotels as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn default-btn" wire:click="searchhotel">Search
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-visa" role="tabpanel" aria-labelledby="pills-visa-tab">
                            <div class="formbox">
                                <div class="form-row align-items-center">
                                    <div class="col-md-5">
                                        <select class="custom-select" name="country_id" wire:model='selectedcountry'>
                                            <option value="">Select Country</option>
                                            @foreach ($country as $CountryId => $CountryName)
                                                <option value="{{ $CountryId }}">{{ $CountryName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="custom-select" name="visa_type" wire:model='selectedvisa'>
                                            <option value="" selected>Select Visa Type</option>
                                            <option value="Tourist Visa">Tourist Visa</option>
                                            <option value="Personal Visit">Personal Visit</option>
                                            <option value="Visit Visa">Visit Visa</option>
                                            <option value="Umrah Visa">Umrah Visa</option>
                                            <option value="Family Visa">Family Visa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn default-btn btn-block" wire:click="searchvisa">Search
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('extra_css')
    <style>
        .is-invalid {
            border-color: red;
            /* or your desired color */
        }

        .invalid-feedback {
            display: block;
            /* Make the feedback visible */
            color: red;
            /* Or any other color for the error message */
        }
    </style>
@endpush

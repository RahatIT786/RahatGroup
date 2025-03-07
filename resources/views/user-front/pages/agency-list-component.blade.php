<div>
    <section class="py-5 bg-light">
        <div class="container">
            <nav class="breadcrumbs mb-4">
                <span>
                    <span class="breadcrumb-text">
                        <a href="#">Home</a>
                    </span>
                    <span class="breadcrumb-separator"></span>
                    <span class="breadcrumb-text">Agency</span>
                </span>
            </nav>
            <div class="row">
                <div class="col-md-12">
                    <div class="package-search-box">
                        <h4>Search <small>(Agency)</small></h4>
                        <form name="frm_hotel_search" action="#" method="post" style="font-size:14px;">
                            <div class="form-row">

                                <div class="col-md-3">
                                    <div class="form-group pt-2 mt-2">
                                        <select class="custom-select form-control" wire:model.live="search_country"
                                            wire:keyup="changeInput">
                                            <option value="" selected>Select Country</option>
                                            @foreach ($countries as $id => $countryname)
                                                <option value="{{ $id }}">{{ $countryname }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group pt-2 mt-2">
                                        <select class="custom-select form-control" wire:model.live="search_state"
                                            wire:keyup="changeInput">
                                            <option value="" selected>Select State</option>
                                            @foreach ($states as $id => $state_name)
                                                <option value="{{ $id }}">{{ $state_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group pt-2 mt-2">
                                        <input class="form-control w-100" wire:model.live="search_city"
                                            wire:keyup="changeInput" placeholder="City" type="text">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group pt-2 mt-2">
                                        <input class="form-control w-100" wire:model.live="search_agency_name"
                                            wire:keyup="changeInput" placeholder="Agency Name" type="text">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group pt-2 mt-2">
                                        <input class="form-control w-100" wire:model.live="search_owner_name"
                                            wire:keyup="changeInput" placeholder="Owner Name" type="text">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <h5 class="mb-0 my-3 pb-3 border-bottom">Agency Found</h5>
            <div class="d-flex flex-wrap border-bottom">
                <div class="d-flex align-items-center mr-2 mb-3">
                    <img src="{{ asset('/assets/user-front/images/verified.png') }}" style="width:35px;height: 35px;min-width:35px;">

                    <h6 class="mb-0 p-2"> ::&nbsp; Approved Agent </h6>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('/assets/user-front/images/thumbverify.png') }}" style="width:35px;height: 35px;min-width:35px;">
                    <h6 class="mb-0 p-2"> ::&nbsp; Trusted &amp; Verified Partners </h6>
                </div>
            </div>

            <div class="row">
                @forelse($agencies as $index => $agency)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="agency_box my-3 text-center colorbox">
                            <ul class="text-center mt-4">
                                <li>
                                    <h5 class="h5 text-center"><strong>{{ $agency->agency_name }}</strong></h5>
                                </li>
                                <li>
                                    <div class="reviews_box">
                                        <a href="#">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fa fa-star-o"></i>
                                            @endfor
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <h6 class="h6 text-center">{{ $agency->owner_name }}</h6>
                                </li>
                                <li>
                                    <h6 class="h6 text-center">Agency Code : {{ $agency->id }}</h6>
                                </li>
                            </ul>

                            <div class="bottom-content">
                                <a href="#"><img src="{{ asset('/assets/user-front/images/verified.png') }}" class="icon-img"></a>
                                <a href="#" class="btn btn-agency-btm">View Details</a>
                                <a href="#"><img src="{{ asset('/assets/user-front/images/thumbverify.png') }}"
                                        class="icon-img"></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p>No agencies found.</p>
                    </div>
                @endforelse
            </div>
        </div>
</div>
</section>
</div>

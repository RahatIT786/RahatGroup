<div>
    <section class="section package-section bg-light">
        <div class="container">
            <nav class="breadcrumbs mb-2">
                <span>
                    <span class="breadcrumb-text">
                        <a href="#">Home</a>
                    </span>
                    <span class="breadcrumb-separator"></span>
                    <span class="breadcrumb-text">Hotels</span>
                </span>
            </nav>
            <div class="section-title text-center pb-0">
                <h2 class="title">Popular Hotels</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="package-search-box">
                        <h4>Search <small>(Hotels)</small></h4>
                        <form name="frm_hotel_search" action="#" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <select class="form-control" wire:model="city_id" wire:change="filterHotel">
                                        <option value="">{{ __('tablevars.city') }}</option>
                                        @foreach ($cityData as $id => $city_name)
                                            <option value="{{ $id }}">{{ $city_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" wire:model="star_rating" wire:change="filterHotel">
                                        <option value="">{{ __('tablevars.select_rating') }}</option>
                                        @foreach ($star_ratings as $id => $star_rating)
                                            <option value="{{ $id }}">{{ $star_rating }} Stars</option>
                                        @endforeach
                                    </select>
                                    @error('star_rating')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <input class="form-control w-100 datetimepicker-input" id="hotel_name"
                                        name="hotel_name" type="text" placeholder="Hotel Name" value=""
                                        wire:model="hotel_name" wire:keyup="filterHotel">
                                    @error('hotel_name')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($hotels as $hotel)
                    <div class="col-md-6 col-lg-4">
                        <div class="package-box">
                            @if ($hotel->hotelimage)
                                <div class="package-img image">
                                    <a class="img-thumb"
                                        href="{{ route('customer.hotel-detail', ['id' => $hotel->id]) }}">
                                        @php
                                            $randomImage = $hotel->hotelimage->first();
                                        @endphp
                                        <img src="{{ asset('storage/hotel_photo/' . $randomImage->hotel_img) }}"
                                            alt="hotel image">
                                        <div class="package-price">&#xFDFC;
                                            {{ number_format($hotel->low_season_price, 2) }} / night</div>
                                    </a>
                                </div>
                                <div class="package-text">
                                    <h4 class="package-name"><a
                                            href="{{ route('customer.hotel-detail', ['id' => $hotel->id]) }}">{{ $hotel->hotel_name }}</a>
                                    </h4>
                                    <div class="package-extra">
                                        @if (is_numeric($hotel->star_rating) && $hotel->star_rating >= 1 && $hotel->star_rating <= 5)
                                            <div class="package-rating">
                                                <span class="stars">
                                                    @for ($i = 0; $i < $hotel->star_rating; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </span>
                                            </div>
                                        @else
                                            @switch($hotel->star_rating)
                                                @case('Standard Hotel')
                                                    Standard Hotel
                                                @break

                                                @case('Building Accommodation')
                                                    Building Accommodation
                                                @break

                                                @default
                                                    Unknown Star Rating
                                            @endswitch
                                        @endif
                                        <span class="border-right ml-3 mr-3">&nbsp;</span>
                                        <div class="package-map">
                                            <i class="fa fa-map-marker"></i>
                                            {{ $hotel->city->city_name ?? 'Unknown City' }}
                                        </div>
                                    </div>
                                    <p class="package-desc">{{ $hotel->address }}</p>

                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('customer.hotel-detail', ['id' => $hotel->id]) }}"
                                            class="more-link">View More <i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @empty
                        <div class="col-md-12 text-center text-danger">
                            {{ __('tablevars.no_record') }}
                        </div>
                    @endforelse
                </div>
                @if ($hotels->count() < $totalHotels)
                    <div class="text-center my-4">
                        <button class="btn default-btn" wire:click="loadMore">Load More</button>
                    </div>
                @endif
        </section>
    </div>

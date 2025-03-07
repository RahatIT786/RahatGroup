<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Hotels</h1>
        </div>
    </section>
    <section class="cVoRcU">

        <div class="container">
            <div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                {{-- <h3>Filter</h3> --}}
            </div>
            <div class="instruct-search-blk mb-0">
                <div class="show-filter all-select-blk">
                    <div class="row gx-2">
                        <div class="col-md-3 col-lg-3 col-item">
                            {{-- <label>{{ __('tablevars.select') }} {{ __('tablevars.city') }} </label> --}}
                            <select class="form-control" wire:model="city_id" wire:change="changeInput">
                                <option value="">{{ __('tablevars.city') }}</option>
                                @foreach ($cityData as $id => $city_name)
                                    <option value="{{ $id }}">{{ $city_name }}</option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <span class="v-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-lg-3 col-item">
                            <select class="form-control" wire:model="star_rating" wire:change="changeInput">
                                <option value="">{{ __('tablevars.select_rating') }}</option>
                                @foreach ($star_ratings as $id => $star_rating)
                                    <option value="{{ $id }}">{{ $star_rating }} Stars</option>
                                @endforeach
                            </select>
                            @error('star_rating')
                                <span class="v-msg">{{ $message }}</span>
                            @enderror
                        </div>
						<div class="col-md-3 col-lg-3 col-item">
                            <input class="form-control w-100 datetimepicker-input" id="hotel_name" name="hotel_name"
                                type="text" placeholder="Hotel Name" value="" wire:model="hotel_name"
                                wire:keyup="changeInput">
                            @error('hotel_name')
                                <span class="v-msg">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($hotels as $hotel)
                    <div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
                        <a href="{{ route('hotelDetail', ['id' => $hotel->id]) }}">
                            @if ($hotel->hotelimage)
                                <article class="gzRGXF"
                                    style="background-image: url('{{ count($hotel->hotelimage) != 0 ? asset('storage/hotel_photo/' . $hotel->hotelimage[0]->hotel_img) : asset('storage/hotel_photo/NoImageFound.png') }}'); background-position:center;">
                                    <div>
                                        <span font-weight="800" font-style="normal" font-size="2rem" class="eklPbQ">
                                            <span>{{ $hotel->hotel_name }}</span>
                                        </span>
                                        <div>
                                            <ul>
                                                {{-- <li>
                                                <span font-weight="500" font-style="normal" font-size="1rem"
                                                    class="eklPbQ">
                                                    <span>{{ $hotel->hotel_name }}</span>
                                                </span>
                                            </li> --}}

                                                {{-- <li>
                                                    <p class="">{{ $hotel->address }}</p>
                                                </li> --}}

                                                <li>
                                                    <p class="hotel-address">
                                                        {{ Str::limit($hotel->address, 100) }}
                                                        @if (strlen($hotel->address) > 100)
                                                            <span class="more-text" style="display: none;">{{ substr($hotel->address, 10) }}</span>
                                                            <a href="javascript:void(0);" class="read-more" onclick="toggleReadMore('{{ $hotel->id }}')">Read More</a>
                                                        @endif
                                                    </p>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </article>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
            @if (count($hotels) < $totalHotels)
                    <div class="text-center my-4">
                        <button class="button" wire:click="loadMore">Load More</button>
                    </div>
                @endif
        </div>
    </section>
    
<style>
    .button{
    font-size: 1rem;
    color: rgb(255, 255, 255);
    background-color: rgb(0, 0, 0);
    padding: 0.6rem 1.4rem;
    border-radius: 2rem;
}
</style>
</main>

<script>
    function toggleReadMore(id) {
        var address = document.getElementById('address-' + id);
        var moreText = address.querySelector('.more-text');
        var readMoreLink = address.querySelector('.read-more');

        if (moreText.style.display === "none") {
            moreText.style.display = "inline";
            readMoreLink.textContent = "Read Less";
        } else {
            moreText.style.display = "none";
            readMoreLink.textContent = "Read More";
        }
    }
</script>



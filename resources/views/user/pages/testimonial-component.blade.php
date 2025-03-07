<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Testimonial</h1>
        </div>
    </section>
    <section class="listing-box">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-sec shadow filter-box-package">
                        <div class="filter-title">
                            <span class="fl-txt">Filter By</span>
                        </div>
                        <div class="fl-checkbox fl-checkbox_list2 filter_heightauto">
                            <div class="fl-title">Tour Type</div>
                            <div class="filter-height">
                                @foreach (Helper::service() as $key => $value)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input filterradio filter-nn tour-type"
                                            id="tour_type_{{ $key }}" name="tour_type[]"
                                            value="{{ $key }}" wire:change="getTourType('{{ $key }}')"
                                            wire:model="tour_type" autocomplete="off">
                                        <label class="custom-control-label"
                                            for="tour_type_{{ $key }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="fl-checkbox fl-checkbox_list2 filter_heightauto">
                            <div class="fl-title">City</div>
                            <div class="filter-height">
                                @foreach ($cityType as $cityTypeId => $cityTypeName)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input filterradio filter-nn pkg-type"
                                            id="city_type_{{ $cityTypeId }}" name="city_id[]"
                                            value="{{ $cityTypeId }}" wire:change="getCityType('{{ $cityTypeId }}')"
                                            wire:model="citytype" autocomplete="off">
                                        <label class="custom-control-label"
                                            for="city_type_{{ $cityTypeId }}">{{ $cityTypeName }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                    @foreach ($testimonials as $testimonial)
                        <div class="testimonialsarea">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="testimonialsvideobg">
                                        @if ($testimonial->video_url)
                                            @php
                                                // Extract the YouTube video ID from the URL
                                                $videoId = '';
                                                if (
                                                    preg_match(
                                                        '/(youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
                                                        $testimonial->video_url,
                                                        $matches,
                                                    )
                                                ) {
                                                    $videoId = $matches[2];
                                                }
                                            @endphp
                                            @if ($videoId)
                                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen width="100%" height="250" frameborder="0"
                                                    title=""></iframe>
                                            @else
                                                <p>Invalid video URL</p>
                                            @endif
                                        @else
                                            <a href="{{ asset('/storage/testimonial_image/' . $testimonial->image) }}"
                                                class="fancybox" data-fancybox-group="gallery"
                                                title="Image {{ $testimonial->id }}">
                                                <img src="{{ asset('/storage/testimonial_image/' . $testimonial->image) }}"
                                                    alt="Image {{ $testimonial->id }}" width="100%" height="250">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-7 rowmargin30">

                                    <div>
                                        <h4 style="color: black; font-weight: bold;">{{ $testimonial->title ?? '' }}
                                        </h4>
                                    </div>

                                    <div class="mb-2">
                                        <strong>City :</strong> {{ $testimonial->city->city_name ?? '' }}
                                    </div>

                                    <div class="mb-2">
                                        <strong>Tour : </strong>
                                        @if (isset(Helper::service()[$testimonial->tour_type]))
                                            {{ Helper::service()[$testimonial->tour_type] }}
                                        @else
                                            <div>No Tour Type Found</div>
                                        @endif
                                    </div>

                                    <div>
                                        {{ $testimonial->description ?? '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                            <select name="per_page" id="per_page" class="form-control" wire:model='perPage'
                                wire:change='filterTestimonial'>
                                @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{ $testimonials->links() }}
                    </div> --}}
                </div>

            </div>
        </div>
    </section>
</main>

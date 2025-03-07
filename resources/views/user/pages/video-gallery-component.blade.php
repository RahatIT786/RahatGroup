<main class="cAJbgc" style="margin-top: 0px;">

    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Video Gallery</h1>
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
                                            id="tour_type_{{ $key }}" name="service_id[]"
                                            value="{{ $key }}" wire:change="getTourType('{{ $key }}')"
                                            wire:model="tourtype" autocomplete="off">
                                        <label class="custom-control-label"
                                            for="tour_type_{{ $key }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="fl-checkbox fl-checkbox_list2 filter_heightauto">
                            <div class="fl-title">Package Type</div>
                            <div class="filter-height">
                                @foreach ($packageType as $packageTypeId => $packageTypeName)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input filterradio filter-nn pkg-type"
                                            id="package_type_{{ $packageTypeId }}" name="package_id[]"
                                            value="{{ $packageTypeId }}"
                                            wire:change="getPackageType('{{ $packageTypeId }}')"
                                            wire:model="packagetype" autocomplete="off">
                                        <label class="custom-control-label"
                                            for="package_type_{{ $packageTypeId }}">{{ $packageTypeName }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="fl-checkbox fl-checkbox_list2 filter_heightauto">
                            <div class="fl-title">Type</div>
                            <div class="filter-height">
                                @foreach (Helper::type() as $key => $value)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input filterradio filter-nn tour-type"
                                            id="type_{{ $key }}" name="type[]" value="{{ $key }}"
                                            wire:change="getType('{{ $key }}')" wire:model="type"
                                            autocomplete="off">
                                        <label class="custom-control-label"
                                            for="type_{{ $key }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="row" id="divImageList">
                        @foreach ($videos as $gallery)
                            @if ($gallery->galleryvideo)
                                @foreach ($gallery->galleryvideo as $video)
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="gallerybox">
                                            <div class="galleryboximg">
                                                @php
                                                    // Extract the YouTube video ID from the URL
                                                    $videoId = '';
                                                    if (
                                                        preg_match(
                                                            '/(youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
                                                            $video->video,
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
                                                        title="YouTube video"></iframe>
                                                @else
                                                    <p>Invalid video URL</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@push('extra_css')
    <style>
        .gallerybox {
            margin-bottom: 30px;
            background: #fff;
            border-radius: 10px;
            padding: 10px;
            -webkit-box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
        }

        .galleryboximg {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            border-radius: 10px;
        }

        .galleryboximg iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
            border-radius: 10px;
            /* Ensure the iframe also has rounded corners */
        }
    </style>
@endpush

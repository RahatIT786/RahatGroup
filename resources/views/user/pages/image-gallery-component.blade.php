<main class="cAJbgc" style="margin-top: 0px;">

    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Image Gallery</h1>
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
                        @foreach ($images as $gallery)
                            @if ($gallery->galleryimage)
                                @foreach ($gallery->galleryimage as $image)
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="gallerybox">
                                            <div class="galleryboximg">

                                                @if ($gallery->facebook_link)
                                                    <a href="{{ $gallery->facebook_link }}" target="_blank"
                                                        class="share-icon">
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg"
                                                            alt="Facebook" width="50px" height="50px">
                                                    </a>
                                                @endif
                                                <a href="{{ asset('storage/image_gallery/' . $image->image) }}"
                                                    class="fancybox" data-fancybox-group="gallery"
                                                    title="Image {{ $image->id }}">
                                                    <img src="{{ asset('storage/image_gallery/' . $image->image) }}"
                                                        alt="Image {{ $image->id }}">
                                                </a>
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
        .galleryboximg {
            position: relative;
        }

        .share-icon {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .share-icon img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.8);
            transition: all ease-in-out 0.5s;
        }

        .share-icon:hover img {
            opacity: 0.8;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.8);
        }
    </style>
@endpush

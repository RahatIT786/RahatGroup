<main class="cAJbgc shortinnerheader" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url('https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp');">
        <div class="container">
        </div>
    </section>
    <section class="listing-box">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-sec shadow filter-box-package">
                        <div class="filter-title">
                            <div class="fl-title filter-result">
                                <span id="filter_count">{{ count($packages) }}</span> out of
                                <span>{{ count($packages) }}</span> packages
                            </div>
                            <span class="fl-txt">Filter</span>
                            {{-- <button wire:click="resetFilters" class="fl-btn"><i class="fa fa-undo"></i> Reset</button> --}}
                        </div>
                        <div class="form-packagesearch">
                            <div class="filter_type">
                                <input type="text" class="form-control" name="search_package" id="search_package"
                                    class="form-control" wire:model='search_package' wire:keyup="filterHajj"
                                    placeholder="Search by Package Name" autocomplete="off">
                            </div>
                        </div>
                        <hr />

                        <div style="margin-bottom: 15px;">
                            <div class="wrapper">
                                <h6 class="filter-title mb-2">Price Range</h6>

                                <!-- Input fields for min and max price -->
                                <div class="price-input">
                                    <div class="field">
                                        <span>Min</span>
                                        <input type="number" class="input-min" min="5000" max="500000"
                                            wire:model.lazy="minPrice">
                                    </div>
                                    <div class="separator">-</div>
                                    <div class="field">
                                        <span>Max</span>
                                        <input type="number" class="input-max" min="5000" max="500000"
                                            wire:model.lazy="maxPrice">
                                    </div>
                                </div>

                                <!-- Slider for min and max price -->
                                <div class="slider">
                                    <div class="progress"
                                        style="left: {{ (($minPrice - 5000) / 495000) * 100 }}%; right: {{ 100 - (($maxPrice - 5000) / 495000) * 100 }}%;">
                                    </div>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="range-min" min="5000" max="500000" step="5000"
                                        value="{{ $minPrice }}" oninput="@this.set('minPrice', this.value)">
                                    <input type="range" class="range-max" min="5000" max="500000" step="5000"
                                        value="{{ $maxPrice }}" oninput="@this.set('maxPrice', this.value)">
                                </div>
                            </div>
                        </div>
                        <h6 wire:ignore class="mt-2" style="cursor:pointer;" data-toggle="collapse"
                            data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">Package Type</h6>
                        <div wire:ignore class="fl-checkbox fl-checkbox_list2 filter_heightauto collapse show"
                            id="collapse1" aria-labelledby="heading1">
                            @foreach ($packageType as $packageTypeId => $packageTypeName)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input filterradio filter-nn pkg-type"
                                        id="package_type_{{ $packageTypeId }}" value="{{ $packageTypeId }}"
                                        wire:model="selectedPackageTypes" wire:change="changeInput" autocomplete="off">
                                    <label class="custom-control-label"
                                        for="package_type_{{ $packageTypeId }}">{{ $packageTypeName }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                    <div id="packages-list-ajax">
                        {{-- {{ dd($packages) }} --}}
                        {{-- @if ($packages->isNotEmpty()) --}}
                        @if (!empty($packages))
                            @foreach ($packages as $key => $package)
                                <div class="fl-list-show">
                                    <div class="fl-list-item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="fl-img liting-img">
                                                    @if (count($package->pkgImages) > 0)
                                                        <img src="{{ asset('storage/package_image/' . $package->pkgImages[0]->pkg_img) }}"
                                                            alt="Image" title="" border="0">
                                                    @else
                                                        <img src="{{ asset('storage/NoImageFound.png') }}"
                                                            alt="Image" title="" border="0">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-box">
                                                    <span class="listbox-title">
                                                        <a href="#">{{ $package->name }}</a>
                                                    </span>
                                                    <div class="list-detail">
                                                        <span class="list-detail-width">
                                                            <strong>Destinations -</strong>
                                                            <span class="italic ng-binding">Makkah, Madinah</span>
                                                        </span>
                                                        <div role="tabpanel" class="tab-pane" id="details_tab4">
                                                            <div class="inclusionicons" id="divIncludes">
                                                                <ul id="ulIncludes">
                                                                    @php
                                                                        $pkgIncludes = explode(
                                                                            ',',
                                                                            $flavour[$key][0]['includes'],
                                                                        );
                                                                    @endphp
                                                                    @foreach ($pkgIncludes as $item)
                                                                        @if (isset($allIncludes[$item]))
                                                                            <li>
                                                                                <div class="text-center">
                                                                                    {!! $allIncludes[$item] !!}<br>{{ $item }}
                                                                                </div>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="detail-right">
                                                        <div class="dropdown selectroom_cls-box">
                                                            <label class="labeltxt labeltxtright_align"
                                                                for="rooms">Category :</label>
                                                            <select
                                                                wire:change="selectedflavour($event.target.value, {{ $key }})"
                                                                class="sltcat form-control select_box_wth pkg_cat_selector">
                                                                @foreach ($flavour[$key] as $details)
                                                                    <option value="{{ $details['pkg_type_id'] }}">
                                                                        {{ $details['pkg_type_name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="dt-1 mobilestartfrm">Starting from</div>
                                                        <div class="dt-2 mobile_price">
                                                            <strong>
                                                                <span>₹</span>
                                                                <span wire:loading
                                                                    wire:target="selectedflavour">Loading...</span>
                                                                <span wire:loading.remove
                                                                    class="pkg-price">{{ number_format($selectedFlavour[$key]['price'], 2) }}</span>
                                                            </strong>
                                                        </div>
                                                        <div class="dt-txt mobileperson">Per Person General Sharing
                                                        </div>
                                                        <div class="sharelist">
                                                            <div class="mt-2">
                                                                <div class="bbb">
                                                                    {{-- <a class="mdr svmdr detail_link detailbtn-mobile"
                                                                        href="{{ route('hajjPackagesView', ['id' => $package->id, 'type' => $selectedFlavour[$key]['pkg_type_id']]) }}"
                                                                        data-id="{{ $package->id }}">View
                                                                        Details</a> --}}

                                                                    <a class="mdr svmdr detail_link detailbtn-mobile"
                                                                        href="{{ route('hajjPackagesView', ['id' => $package->id, 'type' => $selectedFlavour[$key]['pkg_type_id']]) }}">View
                                                                        Details</a>


                                                                    <a id="estinamtebtnid" data-toggle="modal"
                                                                        data-title="Deluxe Long Shifting Hajj 40 Days"
                                                                        data-id="28" data-target="#bookingModal"
                                                                        class="estimate-btn sendRateEnuiryPackagetour"
                                                                        href="javascript:void(0);">Book Now</a>
                                                                    {{-- <a class="mdr svmdr detail_link detailbtn-mobile"
                                                                        href="{{ route('hajjPackagesView', ['id' => $package->id]) }}">View
                                                                        Details</a> --}}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No packages available.</p>
                        @endif
                    </div>
                    @if (count($packages) < $totalPackages)
                        <div class="text-center my-4">
                            <button class="button" type="button" wire:click="loadMore">Load More</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- @if (count($packages) < $totalPackages)
        <div class="text-center my-4">
            <button class="button" wire:click="loadMore">Load More</button>
        </div>
    @endif --}}
    </section>
</main>

<script>
    function updateDetailsLink(selectElement) {
        var selectedCategoryId = $(selectElement).val();
        var selectedPkgId = $(selectElement).find(':selected').data('pkg-id');
        var detailsLink = "https://umrahrahat.com/package-detail/:packageId";
        detailsLink = detailsLink.replace(':packageId', selectedPkgId);
        var separator = detailsLink.includes('?') ? '&' : '?';
        detailsLink = detailsLink + separator + "pkg_cat=" + selectedCategoryId;
        var linkSelector = $(selectElement).closest('.detail-right').find('.detail_link_274');
        $(linkSelector).attr('href', detailsLink);
    }

    $('.pkg_cat_selector').change(function() {
        updateDetailsLink(this);
    });

    $('.pkg_cat_selector').each(function() {
        updateDetailsLink(this);
    });

    $('.detailbtn-mobile').click(function() {
        var selectedValue = $(this).closest(".detail-right").find(".sltcat").val();
        var pkgId = $(this).data("id");
        @this.call('putInCache', selectedValue, pkgId);
    })
</script>
@push('extra_js')
    <script>
        // slider js

        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    </script>
@endpush

@push('extra_css')
    <style>
        .inclusionicons {
            margin: 0px;
        }

        .inclusionicons ul {
            margin: 0px 0px;
            padding: 0px 0px;
        }

        .inclusionicons ul li {
            list-style-type: none;
            margin: 10px 5px 0px 10px;
            padding: 0px 0px 0px 0px;
            display: inline-block;
            font-size: 11px;
            color: #7a7b7d;
            line-height: 13px;
            text-align: center;
            position: relative;
        }

        .inclusionicons ul li:first-child {
            margin: 0px 10px 0px 0px;
        }

        .inclusionicons ul li::after {
            content: "\002B";
            font-size: 18px;
            color: #717171;
            position: absolute;
            display: block;
            right: -17px;
            top: 5px;
        }

        .inclusionicons ul li:last-child::after {
            content: none;
        }

        .inclusionicons ul li svg {
            height: 20px;
            fill: #ffa500;
        }

        .inclusionicons ul li svg polygon,
        .inclusionicons ul li svg line,
        .inclusionicons ul li svg circle {
            stroke: #ffa500;
            fill: #ffa500;
        }

        .inclusionicons ul li svg path {
            stroke: #ffa500;
        }


        .departure-text {
            white-space: nowrap;
        }

        /* slider style */

        .price-input {
            width: 100%;
            display: flex;
            margin: 15px 0 15px;
        }

        .price-input .field {
            display: flex;
            width: 100%;
            height: 25px;
            align-items: center;
        }

        .field input {
            width: 100%;
            height: 100%;
            outline: none;
            font-size: 12px;
            margin-left: 8px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #999;
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .price-input .separator {
            width: 78px;
            display: flex;
            font-size: 12px;
            align-items: center;
            justify-content: center;
        }

        .slider {
            height: 5px;
            position: relative;
            background: #ddd;
            border-radius: 5px;
        }

        .slider .progress {
            height: 100%;
            left: 0%;
            right: 0%;
            position: absolute;
            border-radius: 5px;
            background: #17b860;
        }

        .range-input {
            position: relative;
        }

        .range-input input {
            position: absolute;
            width: 100%;
            height: 5px;
            top: -5px;
            background: none;
            pointer-events: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            height: 17px;
            width: 17px;
            border-radius: 50%;
            background: #17b860;
            pointer-events: auto;
            -webkit-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        input[type="range"]::-moz-range-thumb {
            height: 17px;
            width: 17px;
            border: none;
            border-radius: 50%;
            background: #17b860;
            pointer-events: auto;
            -moz-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        /* Support */
        .support-box {
            top: 2rem;
            position: relative;
            bottom: 0;
            text-align: center;
            display: block;
        }
    </style>
@endpush

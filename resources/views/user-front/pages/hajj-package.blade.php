<div class="container mb-4">
    <nav class="breadcrumbs mb-4">
        <span>
            <span class="breadcrumb-text">
                <a href="{{ route('customer.homepage') }}">Home</a>
            </span>
            <span class="breadcrumb-separator"></span>
            <span class="breadcrumb-text">Package</span>
        </span>
    </nav>
    <div class="row">
        <div class="col-md-3">
            <div class="package_search_box sticky-top" style="top: 115px;">
                <h4 class="box-title"> <span id="filter_count">{{ count($packages) }}</span> out of
                    <span>{{ count($packages) }}</span> packages <small>(Packages)</small>
                </h4>
                {{-- <span class="fl-txt">Filter</span> --}}

                <div class="search_content">
                    <form action="http://localhost/hajjumrahonline/Packages" method="post">
                        <div class="form-group">
                            <h6 class="filter-title mb-2">Package Name</h6>
                            <input type="text" class="form-control" name="search_package" id="search_package"
                                class="form-control" wire:model='search_package' wire:keyup="filterHajj"
                                placeholder="Search by Package Name" autocomplete="off">
                        </div>
                        <div class="form-group pt-2 mt-2">
                            {{-- <h6 class="filter-title mb-2">Sort Packages</h6> --}}
                            <div class="row">

                            </div>
                        </div>
                    </form>
                    {{-- slider --}}
                    <div class="form-group">
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

                    <div class="form-group border-solid-top pt-2 mt-2">
                        <h6 class="filter-title mb-2">Package Type</h6>
                        <div class="col-md-12 p-0">
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

                    {{-- <div class="form-group border-solid-top pt-2 mt-2">
                        <h6 class="filter-title mb-2">Hotel Distance Madina</h6>
                        <select class="custom-select" id="madina_distance" name="madina_distance">
                            <option value="" selected="">Select Hotel Distance Madina</option>
                            <option value="50"> Less than 50 Mtrs.</option>
                            <option value="250"> Less than 250 Mtrs.</option>
                            <option value="500"> Less than 500 Mtrs.</option>
                            <option value="750"> Less than 750 Mtrs.</option>
                            <option value="1500"> Less than 1500 Mtrs.</option>
                        </select>
                    </div> --}}

                </div>
            </div>
        </div>
        <div class="col-md-9">

            <div class="package_list_section" id="package_list">
                <div class="package_list_section">
                    @if ($packages->isNotEmpty())
                        @foreach ($packages as $key => $package)
                            <div class="package_list_box">
                                <h5 class="h5 package_title mb-0"></h5>
                                <div class="package_list_content">
                                    <div class="row">
                                        <div class="col-md-12 package_details">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                                                    <div class="package_text">
                                                        <div class="">
                                                            @if ($package->pkgImages->isNotEmpty())
                                                                <a
                                                                    href="{{ route('customer.hajjPackageView', ['id' => $package->id, 'type' => $selectedFlavour[$key]['pkg_type_id']]) }}"><img
                                                                        class="pkgImage_0 packageimg"
                                                                        src="{{ asset('storage/package_image/' . $package->pkgImages->first()->pkg_img) }}"
                                                                        alt="Image" />
                                                                </a>
                                                            @else
                                                                <img src="{{ asset('storage/NoImageFound.png') }}"
                                                                    alt="No Image Found" class="pkgImage_0 packageimg"
                                                                    title="" border="0">
                                                            @endif
                                                        </div>
                                                        <div class="details">
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <div class="mb-2" align="#">
                                                                        <h5 class="">{{ $package->name }}</h5>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-2 departure-text">
                                                                        <b>Departure :</b> Makkah, Madinah
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-6">
                                                                    {{-- <div class="mb-2" align="left">
                                                                        <b>Dept Sec:</b>
                                                                    </div> --}}
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    {{-- <div class="mb-2" align="left">
                                                                        <b>Return Sec:</b>
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="mb-2" align="left">
                                                                        {{-- <strong style="color: #008e00;">Available Seats
                                                                            :</strong> Lefts --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
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
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 border-left">
                                                    <div class="compare text-right">
                                                        <div class="dropdown">
                                                            {{-- <label class="labeltxt labeltxtright_align"
                                                                for="rooms">Category :</label> --}}
                                                            <select
                                                                wire:change="selectedflavour($event.target.value, {{ $key }})"
                                                                class="sltcat form-control h-auto px-2 pkg_cat_selector mb-2">
                                                                @foreach ($flavour[$key] as $details)
                                                                    <option value="{{ $details['pkg_type_id'] }}">
                                                                        {{ $details['pkg_type_name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <p class="mb-0">
                                                            <small>Tot Price:</small>
                                                            <span class="package_price">
                                                                <span wire:loading
                                                                    wire:target="selectedflavour">Loading...</span>
                                                                <span
                                                                    wire:loading.remove>{{ number_format($selectedFlavour[$key]['price'], 2) }}</span>
                                                            </span><br>
                                                            <small>Per Person</small>
                                                        </p>

                                                        <div class="mt-2">
                                                            <a class="mdr svmdr detail_link detailbtn-mobile secondary-btn btn btn-block py-2 px-2"
                                                                href="{{ route('customer.hajjPackageView', ['id' => $package->id, 'type' => $selectedFlavour[$key]['pkg_type_id']]) }}">View
                                                                Details</a>
                                                        </div>

                                                        <div class="mt-2">
                                                            <a id="estinamtebtnid" data-toggle="modal"
                                                                class="default-btn btn btn-block py-2 px-2"
                                                                data-title="Deluxe Long Shifting Hajj 40 Days"
                                                                data-id="28" data-target="#BookingModal"
                                                                class="estimate-btn sendRateEnuiryPackagetour"
                                                                href="javascript:void(0);">Book Now</a>
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
                        <p class="text-red text-center">No packages available.</p>
                    @endif
                </div>
                @if (count($packages) < $totalPackages)
                    <div class="text-center my-4">
                        <button class="btn default-btn" wire:click="loadMore">Load More</button>
                    </div>
                @endif
            </div>

        </div>

    </div>

</div>




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

        /* .inclusionicons ul li svg {
                                                                height: 20px;
                                                                fill: #b49164;
                                                                display: inline-block;
                                                            } */

        .inclusionicons ul li svg polygon,
        .inclusionicons ul li svg line,
        .inclusionicons ul li svg circle {
            stroke: #b49164;
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
            background: #17a2b8;
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
            background: #17a2b8;
            pointer-events: auto;
            -webkit-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        input[type="range"]::-moz-range-thumb {
            height: 17px;
            width: 17px;
            border: none;
            border-radius: 50%;
            background: #17a2b8;
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

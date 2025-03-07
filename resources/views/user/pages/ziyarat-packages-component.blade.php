<main class="cAJbgc shortinnerheader" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url('https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp');">
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
                        @if ($packages->isNotEmpty())
                            @foreach ($packages as $key => $package)
                                <div class="fl-list-show">
                                    <div class="fl-list-item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="fl-img liting-img">
                                                    <a href="javascript:void(0);">
                                                        @if (count($package->pkgImages) > 0)
                                                            <img src="{{ asset('storage/package_image/' . $package->pkgImages[0]->pkg_img) }}"
                                                                alt="Image" title="" border="0">
                                                        @else
                                                            <img src="{{ asset('storage/NoImageFound.png') }}"
                                                                alt="Image" title="" border="0">
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-box">
                                                    <span class="listbox-title">
                                                        <a href="#">{{ $package->name }}</a>
                                                    </span>
                                                    {{-- <div class="list-detail-inner">
                                                        <span>{{ $package->qt_share_price }} <span>Nights</span></span>
                                                    </div> --}}
                                                    <div class="list-detail">
                                                        <span class="list-detail-width">
                                                            <strong>Destinations -</strong>
                                                            <span class="italic ng-binding">Makkah, Madinah</span>
                                                        </span>
                                                        <div role="tabpanel" class="tab-pane" id="details_tab4">
                                                            <div class="inclusionicons" id="divIncludes">
                                                                <ul id="ulIncludes">
                                                                    @php
                                                                     $pkgIncludes = explode(",", $flavour[$key][0]['includes']);
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
                                                                    <a class="mdr svmdr detail_link detailbtn-mobile"
                                                                    href="{{ route('ziyaratPackagesView', ['id' => $package->id, 'type' => $selectedFlavour[$key]['pkg_type_id']]) }}">View Details</a>
                                                                    <a id="estinamtebtnid" data-toggle="modal"
                                                                        data-title="Deluxe Long Shifting Hajj 40 Days"
                                                                        data-id="28" data-target="#bookingModal"
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
                                </div>
                            @endforeach
                        @else
                            <p class="text-red">No packages available.</p>
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
            fill: #b49164;
            display: inline-block;
        }

        .inclusionicons ul li svg polygon,
        .inclusionicons ul li svg line,
        .inclusionicons ul li svg circle {
            stroke: #b49164;
            fill: #b49164;
        }

        .inclusionicons ul li svg path {
            stroke: #b49164;
        }

        .button {
            width: auto; /* Adjust to the content size */
            font-size: 1rem;
            color: #ffffff; /* White text color */
            background-color: #000000; /* Black background */
            padding: 0.6rem 1.4rem; /* Add spacing inside the button */
            border-radius: 2rem; /* Rounded corners */
            border: none; /* Remove default border */
            display: inline-block; /* Prevent the button from stretching */
            cursor: pointer; /* Change the cursor to a pointer on hover */
            text-align: center; /* Center-align text inside the button */
            margin: 0 auto; /* Center the button horizontally */
        }
    </style>
@endpush

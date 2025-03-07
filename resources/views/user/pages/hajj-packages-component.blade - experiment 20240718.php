<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Hajj Packages from Dubai</h1>
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
                            <button wire:click="resetFilters" class="fl-btn"><i class="fa fa-undo"></i> Reset</button>
                        </div>
                        <div class="form-packagesearch">
                            <div class="filter_type">
                                <input type="search" class="form-control" wire:model="searchTerm"
                                    placeholder="Search by Package Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="fl-checkbox fl-checkbox_list2 filter_heightauto">
                            @foreach ($packageType as $packageTypeId => $packageTypeName)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input filterradio filter-nn pkg-type"
                                        id="package_type_{{ $packageTypeId }}" name="package_id[]"
                                        value="{{ $packageTypeId }}"
                                        wire:change="getPackageType('{{ $packageTypeId }}')" wire:model="packagetype"
                                        autocomplete="off">
                                    <label class="custom-control-label"
                                        for="package_type_{{ $packageTypeId }}">{{ $packageTypeName }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="fl-checkbox fl-checkbox_list1 filter_heightauto">
                            <div class="fl-title">Number of Nights</div>
                            <div class="filter-height">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input filtercheckbox filter-nn"
                                        id="inlineChecknight39" value="39" autocomplete="off">
                                    <label class="custom-control-label" for="inlineChecknight39">39 Nights</label>
                                </div>
                            </div>
                        </div>
                        <div class="price-range-slider">
                            <p class="range-value">
                                <input type="text" id="amount" readonly="">
                            </p>
                            <div id="slider-range"
                                class="range-bar ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"
                                    style="left: 0%; width: 100%;"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                                    style="left: 0%;"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                                    style="left: 100%;"></span>
                            </div>
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
                                                    <a href="#">
                                                        <img src="{{ asset('storage/package_image/' . $package->image) }}"
                                                            alt="Image" title="" border="0">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-box">
                                                    <span class="listbox-title">
                                                        <a href="#">{{ $package->name }}</a>
                                                    </span>
                                                    <div class="list-detail-inner">
                                                        {{-- <span>{{ $package->qt_share_price }} <span>Nights</span></span> --}}
                                                    </div>
                                                    <div class="list-detail">
                                                        <span class="list-detail-width">
                                                            <strong>Destinations -</strong>
                                                            <span class="italic ng-binding">Makkah, Madinah</span>
                                                        </span>
                                                        @php
                                                            $package_includes = explode(',', $package->pkgDetails[0]->package_includes);
                                                        @endphp
                                                        <span class="list-detail-included">
                                                            @if (in_array('Meals', $package_includes))
                                                                <span class="inclusion-list-item">
                                                                    <span class="inclusion-icon">
                                                                        <img src="https://umrahrahat.com/assets/img/inclusion/all-meals.png">
                                                                    </span>
                                                                    <span class="ng-binding">All Meals</span>
                                                                </span>
                                                            @endif
                                                            @if (in_array('Ziyarat', $package_includes))
                                                                <span class="inclusion-list-item">
                                                                    <span class="inclusion-icon">
                                                                        <img src="https://umrahrahat.com/assets/img/inclusion/flight.png">
                                                                    </span>
                                                                    <span class="ng-binding">Ziyarat</span>
                                                                </span>
                                                            @endif
                                                            @if (in_array('Saudi Sim', $package_includes))
                                                                <span class="inclusion-list-item">
                                                                    <span class="inclusion-icon">
                                                                        <img src="https://umrahrahat.com/assets/img/inclusion/hotel.png">
                                                                    </span>
                                                                    <span class="ng-binding">Saudi Sim</span>
                                                                </span>
                                                            @endif
                                                            @if (in_array('Saudi Sim', $package_includes))
                                                                <span class="inclusion-list-item">
                                                                    <span class="inclusion-icon">
                                                                        <img src="https://umrahrahat.com/assets/img/inclusion/visa.png">
                                                                    </span>
                                                                    <span class="ng-binding">Welcome Kit</span>
                                                                </span>
                                                            @endif
                                                            @if (in_array('Transfers', $package_includes))
                                                                <span class="inclusion-list-item">
                                                                    <span class="inclusion-icon">
                                                                        <img src="https://umrahrahat.com/assets/img/inclusion/airport-transfers.png">
                                                                    </span>
                                                                    <span class="ng-binding">Transfers</span>
                                                                </span>
                                                            @endif
                                                            @if (in_array('Zamzam', $package_includes))
                                                                <span class="inclusion-list-item">
                                                                    <span class="inclusion-icon">
                                                                        <img src="https://umrahrahat.com/assets/img/inclusion/all-transfers.png">
                                                                    </span>
                                                                    <span class="ng-binding">Zamzam</span>
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="detail-right">
                                                        <div class="dropdown selectroom_cls-box">
                                                            <label class="labeltxt labeltxtright_align"
                                                                for="rooms">Category :</label>
                                                            <select wire:change="selectedflavour($event.target.value, {{ $key }})"
                                                                class="sltcat form-control select_box_wth pkg_cat_selector">
                                                                @foreach ($flavour[$key] as $details)
                                                                    <option value="{{ $details['pkg_type_id']}}">
                                                                        {{ $details['pkg_type_name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="dt-1 mobilestartfrm">Starting from</div>
                                                        <div class="dt-2 mobile_price">
                                                            <strong>
                                                                <span class="price-package" id="price-package-{{ $key }}">{{ $selectedFlavour[$key]->amount ?? '' }}</span>
                                                            </strong>
                                                        </div>
                                                        <a href="#" class="viewdtl viewdtlright_align">VIEW
                                                            DETAILS</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No packages found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

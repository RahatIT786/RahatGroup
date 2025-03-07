<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                            <!-- This section can remain as is -->
                                        </div>
                                        <div id="content">
                                            <div class="container py-4">
                                                <section class="pricing-table">
                                                    <div class="block-heading">
                                                        <h4 style="color:#d81b60;"><strong>Select Package Type</strong>
                                                        </h4>
                                                        <input type="hidden" id="user_projectPath"
                                                            name="user_projectPath" value="">
                                                    </div>
                                                    <div class="row justify-content-md-center">
                                                        <div class="col-md-auto">
                                                            <div class="checkbox ml-3">
                                                                @foreach ($serviceType as $id => $type)
                                                                    <input class="form-check-input" type="radio"
                                                                        name="serviceType[]"
                                                                        id="serviceType{{ $id }}"
                                                                        value="{{ $id }}"
                                                                        wire:model="selectedServiceType"
                                                                        wire:change="loadPackages"
                                                                        @if ($id == $selectedServiceType) checked @endif>
                                                                    <label class="form-check-label"
                                                                        for="serviceType_{{ $id }}">
                                                                        {{ $type }}
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="package_show">
                                                        {{-- <div class="row justify-content-md-center mt-4">
                                                            @foreach ($packages as $package)
                                                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                                                                    <div class="item">
                                                                        <div class="heading">
                                                                            <h6>{{ $package->name }}</h6>
                                                                        </div>
                                                                        <div class="item-content">
                                                                            <div class="text-center">
                                                                                @if ($package->image)
                                                                                    <img src="{{ asset('storage/package_image/' . $package->image) }}"
                                                                                        style="width: 250px; height: 150px; margin-bottom: 10px; border: 1px solid #cecaca;border-radius:20px;box-shadow: 0 0rem 8px rgba(0, 0, 0, 10%);" />
                                                                                @else
                                                                                    <img src="{{ asset('public/storage/image/no-image') }}"
                                                                                        style="width: 250px; height: 150px; margin-bottom: 10px; border: 1px solid #cecaca;border-radius:20px;box-shadow: 0 0rem 8px rgba(0, 0, 0, 10%);" />
                                                                                @endif
                                                                            </div>
                                                                            <div class="features">
                                                                                <h4><span class="feature"><i class="fa fa-hotel text-info me-2"></i> Makka Hotel Name</span> : <span class="value">{{ $package->pkgDetails->first()->makkahotel->hotel_name ?? '' }}</span></h4>
                                                                                <h4><span class="feature"><i class="fa fa-road text-info me-2"></i> Makka Distance</span> : <span class="value">{{ $package->pkgDetails->first()->makkahotel->distance ?? '' }} Mtr</span></h4>
                                                                                <h4><span class="feature"><i class="fa fa-hotel text-info me-2"></i> Madina Hotel Name</span> : <span class="value">{{ $package->pkgDetails->first()->madinahotel->hotel_name ?? '' }}</span></h4>
                                                                                <h4><span class="feature"><i class="fa fa-road text-info me-2"></i> Madina Distance</span> : <span class="value">{{ $package->pkgDetails->first()->madinahotel->distance ?? '' }} Mtr</span></h4>
                                                                            </div>
                                                                            <div class="text-center">
                                                                                @if ($selectedPackageType)
                                                                                    <a class="btn project-btn" href="{{ route('agent.packageDescription', ['id' => $package->id, 'pkgid' => $selectedPackageType]) }}">
                                                                                        Select Package
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div> --}}
                                                    </div>
                                                    <div id="package_show">
                                                        <div class="row justify-content-md-center mt-4">
                                                            @foreach ($packages as $package)
                                                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                                                                    <div class="item">
                                                                        <div class="heading">
                                                                            <h6>{{ $package->name }}</h6>
                                                                        </div>
                                                                        <div class="item-content">
                                                                            <div class="text-center">
                                                                                @if (count($package->pkgImages) > 0)
                                                                                    <img src="{{ asset('storage/package_image/' . $package->pkgImages[0]->pkg_img) }}"
                                                                                        style="width: 250px; height: 150px; margin-bottom: 10px; border: 1px solid #cecaca;border-radius:20px;box-shadow: 0 0rem 8px rgba(0, 0, 0, 10%);" />
                                                                                @else
                                                                                    <img src="{{ asset('storage/NoImageFound.png') }}"
                                                                                        style="width: 250px; height: 150px; margin-bottom: 10px; border: 1px solid #cecaca;border-radius:20px;box-shadow: 0 0rem 8px rgba(0, 0, 0, 10%);" />
                                                                                @endif
                                                                            </div>
                                                                            <div class="features">
                                                                                <h4><span class="feature"><i
                                                                                            class="fa fa-hotel text-info me-2"></i>
                                                                                        Makka Hotel Name</span> : <span
                                                                                        class="value">{{ $package->pkgDetails->first()->makkahotel->hotel_name ?? '' }}</span>
                                                                                </h4>
                                                                                <h4><span class="feature"><i
                                                                                            class="fa fa-road text-info me-2"></i>
                                                                                        Makka Distance</span> : <span
                                                                                        class="value">{{ $package->pkgDetails->first()->makkahotel->distance ?? '' }}
                                                                                        Mtr</span></h4>
                                                                                <h4><span class="feature"><i
                                                                                            class="fa fa-hotel text-info me-2"></i>
                                                                                        Madina Hotel Name</span> : <span
                                                                                        class="value">{{ $package->pkgDetails->first()->madinahotel->hotel_name ?? '' }}</span>
                                                                                </h4>
                                                                                <h4><span class="feature"><i
                                                                                            class="fa fa-road text-info me-2"></i>
                                                                                        Madina Distance</span> : <span
                                                                                        class="value">{{ $package->pkgDetails->first()->madinahotel->distance ?? '' }}
                                                                                        Mtr</span></h4>
                                                                            </div>
                                                                            <div class="text-center">
                                                                                {{-- @if ($selectedPackageType) --}}
                                                                                    <a class="btn project-btn"
                                                                                        href="{{ route('agent.packageDescription', ['pkgid' => $package->id]) }}">
                                                                                        Select Package
                                                                                    </a>
                                                                                {{-- @endif --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="settings-widget ">
            <div class="settings-inner-blk p-0 pb-4">
                <div class="comman-space pb-0 ">
                    <div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                        <h3>Package Price Listing</h3>
                    </div>
                    <div class="instruct-search-blk mb-0">
                        <div class="show-filter all-select-blk">
                            <div class="row gx-2">
                                <div class="col-md-3 col-lg-3 col-item">
                                    <label class="form-control-label">{{ __('tablevars.service_type') }}
                                    </label>
                                    <input type="text" class="form-control" placeholder="Service Type"
                                        wire:model='search_service_type' wire:keyup="filterBookings">
                                </div>
                                {{-- <div class="col-md-3 col-lg-3 col-item">
                                    <label class="form-control-label">{{ __('tablevars.service_type') }}
                                    </label>
                                    <input type="text" class="form-control" placeholder="Service Type"
                                        wire:model='search_service_type' wire:keyup="filterBookings1">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xl-12 col-lg-12 col-md-12 ">
                    <div class="tak-instruct-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead class="table-primary">
                                            <tr>
                                                <th style="width: 25%;">{{ __('tablevars.package') }}</th>
                                                <th>Sharing price({{ Aihut::get('currency') }})</th>
                                                <th>Quint price({{ Aihut::get('currency') }})</th>
                                                <th>Quad Price({{ Aihut::get('currency') }})</th>
                                                <th>Single Price({{ Aihut::get('currency') }})</th>
                                                <th>Double Price({{ Aihut::get('currency') }})</th>
                                                <th>Triple Price({{ Aihut::get('currency') }})</th>
                                                <th>Child+Bed Price({{ Aihut::get('currency') }})</th>
                                                <th>Child Price({{ Aihut::get('currency') }})</th>
                                                <th>Infant Price({{ Aihut::get('currency') }})</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($packagePrices as $packagePrice)
                                                @php
                                                    $serviceTypeName = $packagePrice->package->serviceType->name ?? '-';
                                                    $colorClass = '';

                                                    if ($serviceTypeName == 'Umrah') {
                                                        $colorClass = 'red';
                                                    } elseif ($serviceTypeName == 'Hajj') {
                                                        $colorClass = 'blue';
                                                    } elseif ($serviceTypeName == 'Ramzan') {
                                                        $colorClass = 'green';
                                                    } else {
                                                        $colorClass = 'yellow';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <span
                                                            class="{{ $colorClass }}">{{ $serviceTypeName }}</span><br>
                                                        <span><b>{{ $packagePrice->package->name ?? '-' }}</b></span><br>
                                                        <span>{{ $packagePrice->packageType->package_type ?? '-' }}</span>
                                                    </td>
                                                    <td>{{ number_format($packagePrice->g_share, 2) }}</td>
                                                    <td>{{ number_format($packagePrice->qt_share, 2) }}</td>
                                                    <td>{{ number_format($packagePrice->qd_share, 2) }}</td>
                                                    <td>{{ number_format($packagePrice->single, 2) }}</td>
                                                    <td>{{ number_format($packagePrice->d_share, 2) }}</td>
                                                    <td>{{ number_format($packagePrice->t_share, 2) }}</td>
                                                    <td>{{ number_format($packagePrice->child_with_bed, 2) }}</td>
                                                    <td>{{ number_format($packagePrice->chlid_no_bed, 2) }}</td>
                                                    <td>{{ number_format($packagePrice->infant, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" align="center" class="text-danger">
                                                        <span class="v-msg">No Records Found</span>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                        <select name="per_page" id="per_page" wire:model='perPage' class="form-control"
                                            wire:change='filterBookings'>
                                            @foreach (Helper::getPerPageOptions() as $item)
                                                <option value="{{ $item }}">{{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{ $packagePrices->links(data: ['scrollTo' => false]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .red {
            color: red;
        }

        .blue {
            color: blue;
        }

        .green {
            color: green;
        }

        .yellow {
            color: yellow;
        }
    </style>

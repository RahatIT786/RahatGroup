<div class="col-lg-4">
    <div class="card gradient-bottom" style="height: auto;">
        <div class="card-header">
            <h4>Top 5 Packages</h4>
            <div class="card-header-action dropdown">
                <a href="javascript:void(0)" data-toggle="dropdown"
                    class="btn btn-danger dropdown-toggle">{{ ucwords($period) }}</a>
                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <li class="dropdown-title">Select Period</li>
                    <li><a href="javascript:void(0)" class="dropdown-item {{ $period == 'today' ? 'active' : '' }}"
                            wire:click="getTopPackages('today')">Today</a>
                    </li>
                    <li><a href="javascript:void(0)" class="dropdown-item {{ $period == 'week' ? 'active' : '' }}"
                            wire:click="getTopPackages('week')">Week</a>
                    </li>
                    <li><a href="javascript:void(0)" class="dropdown-item {{ $period == 'month' ? 'active' : '' }}"
                            wire:click="getTopPackages('month')">Month</a></li>
                    <li><a href="javascript:void(0)" class="dropdown-item {{ $period == 'year' ? 'active' : '' }}"
                            wire:click="getTopPackages('year')">This
                            Year</a></li>
                    <li><a href="javascript:void(0)" class="dropdown-item {{ $period == 'all' ? 'active' : '' }}"
                            wire:click="getTopPackages('all')">All</a></li>

                </ul>
            </div>
        </div>
        <div class="card-body" id="top-5-scroll">
            <ul class="list-unstyled list-unstyled-border">
                @forelse ($topPackages as $top)
                    @php
                        $number = rand(1, 3);
                        $path = "assets/gift-$number.svg";
                    @endphp
                    <li class="media">
                        <img class="mr-3 rounded" width="55" src="{{ asset($path) }}" alt="product">
                        <div class="media-body">
                            <div class="float-right">
                                <div class="font-weight-600 text-muted text-small">{{ $top->count }} Bookings</div>
                            </div>
                            <div class="media-title">{{ $top->package_name }}</div>
                            {{-- <div class="mt-1">
                                <div class="budget-price">
                                    <div class="budget-price-square bg-primary" data-width="{{ $top->percentage }}%">
                                    </div>
                                    <div class="budget-price-label">{{ $top->count }}</div>
                                </div>
                            </div> --}}
                        </div>
                    </li>
                @empty
                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                        <img src="{{ asset('assets/think.svg') }}" alt="Icon" height="100">
                        <p style="margin-top: 11px;font-weight: 600;}">Seems like...there are no records
                            {{ $periodText }}</p>
                    </div>
                @endforelse
                {{-- <li class="media">
                    <img class="mr-3 rounded" width="55" src="{{ asset('img/products/product-4-50.png') }}"
                        alt="product">
                    <div class="media-body">
                        <div class="float-right">
                            <div class="font-weight-600 text-muted text-small">67 Bookings</div>
                        </div>
                        <div class="media-title">7 Days Umrah Package</div>
                        <div class="mt-1">
                            <div class="budget-price">
                                <div class="budget-price-square bg-primary" data-width="70%"></div>
                                <div class="budget-price-label">67</div>
                            </div>
                            <div class="budget-price">
                                <div class="budget-price-square bg-danger" data-width="60%"></div>
                                <div class="budget-price-label">52</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="media">
                    <img class="mr-3 rounded" width="55" src="{{ asset('img/products/product-1-50.png') }}"
                        alt="product">
                    <div class="media-body">
                        <div class="float-right">
                            <div class="font-weight-600 text-muted text-small">63 Bookings</div>
                        </div>
                        <div class="media-title">5 Days Ramzan Package</div>
                        <div class="mt-1">
                            <div class="budget-price">
                                <div class="budget-price-square bg-primary" data-width="34%"></div>
                                <div class="budget-price-label">63</div>
                            </div>
                            <div class="budget-price">
                                <div class="budget-price-square bg-danger" data-width="28%"></div>
                                <div class="budget-price-label">45</div>
                            </div>
                        </div>
                    </div>
                </li> --}}
            </ul>
        </div>
        <div class="card-footer pt-3 d-flex justify-content-center">
            {{-- <div class="budget-price justify-content-center">
                <div class="budget-price-square bg-primary" data-width="20"></div>
                <div class="budget-price-label">Inquiries</div>
            </div>
            <div class="budget-price justify-content-center">
                <div class="budget-price-square bg-danger" data-width="20"></div>
                <div class="budget-price-label">Bookings</div>
            </div> --}}
        </div>
    </div>
</div>

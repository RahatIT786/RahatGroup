<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.client_report') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.reports') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.clientReport.index') }}"
                        wire:navigate>{{ __('tablevars.client_report') }} {{ __('tablevars.list') }}</a></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Search</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <label class="label-header" for="search_booking_id">Booking Id</label>
                                    <input type="text" name="search_booking_id" id="search_booking_id"
                                    class="form-control" placeholder="Search Booking Id" autocomplete="off"
                                    wire:model='search_booking_id' wire:keyup="filterBookings">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.client_report') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.booking_id') }}</th>
                                            <th>{{ __('tablevars.service') }}</th>
                                            <th>{{ __('tablevars.packagetype') }}</th>
                                            <th>{{ __('tablevars.agency') }}</th>
                                            <th>{{ __('tablevars.travel_date') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th class="no-wrap">{{ __('tablevars.total_price') }} (₹)</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($ClientReport as $key => $report)
                                            <tr>
                                                <td>{{ $key + $ClientReport->firstItem() }}</td>
                                                <td>{{ $report->booking_id }}</td>
                                                <td>{{ $report->servicetype->name ?? '---' }}</td>
                                                <td>{{ $report->packagetype->package_type ?? '---' }}</td>
                                                <td>{{ $report->agency ? $report->agency->agency_name : '' }}</td>
                                                <td>
                                                    {{ $report->travel_date ? Helper::formatCarbonDate($report->travel_date) : '' }}
                                                </td>
                                                <td>{{ $report->mehram_name }}</td>
                                                <td>
                                                    {{ number_format($report->tot_cost, 2) }}
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a wire:click="downloadReport('{{ $report->booking_id }}')"
                                                                href="javascript:void(0)" class="dropdown-item"
                                                                data-toggle="tooltip" title="Print">Print</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" align="center" class="v-msg">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control"wire:model='perPage'
                                        wire:change='filterBookings'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $ClientReport->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
</div>

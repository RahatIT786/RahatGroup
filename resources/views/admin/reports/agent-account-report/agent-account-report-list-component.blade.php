<div class="main-content">
    <div wire:loading>
        <div
            style="display: flex; justify-content: center; align-items: center; background-color: black; position:fixed; top: 0px; left:0px; z-index:9999; width: 100%; height:100%; opacity:.75;">
            <div class="la-ball-fussion la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.agents_accounts') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.reports') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.agentAccountReport.index') }}"
                        wire:navigate>{{ __('tablevars.agents_accounts') }} {{ __('tablevars.list') }}</a></div>
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
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_bookingid">Software Id</label>
                                    <input type="text" name="search_bookingid" id="search_bookingid"
                                        class="form-control" placeholder="Search Software Id" autocomplete="off"
                                        wire:model='search_booking_id' wire:keyup="filterBookings">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_name">Name</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        placeholder="Search Name" autocomplete="off" wire:model='search_name'
                                        wire:keyup="filterBookings">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.agents_accounts') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="javascript:void(0)" class="btn btn-info" style="color: white;"
                                    wire:click="exportToExcel">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                                <a href="javascript:void(0);" style="color: white" class="btn btn-warning"
                                    wire:click="download"><i class="fas fa-print"></i>Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            {{-- <th>{{ __('tablevars.date') }}</th> --}}
                                            <th>{{ __('tablevars.booking_id') }}</th>
                                            <th>{{ __('tablevars.service') }}</th>
                                            <th>{{ __('tablevars.packagetype') }}</th>
                                            <th>{{ __('tablevars.dep_city') }}</th>
                                            <th>{{ __('tablevars.agency') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($AgentAccounts as $key => $agentac)
                                            <tr>
                                                <td>{{ $key + $AgentAccounts->firstItem() }}</td>
                                                {{-- <td>{{ $agentac->created_at ? Helper::formatCarbonDate($agentac->created_at) : '' }}
                                                </td> --}}
                                                <td>{{ $agentac->booking_id ?? '---' }}</td>
                                                <td>{{ $agentac->servicetype->name ?? '---' }}</td>
                                                <td>{{ $agentac->packagetype->package_type ?? '---' }}</td>
                                                <td>{{ $agentac->city->city_name ?? '---' }}</td>
                                                <td>{{ $agentac->agency ? $agentac->agency->agency_name : '---' }}</td>
                                                <td>{{ $agentac->mehram_name ?? '---' }}</td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#viewModal"
                                                                data-toggle="tooltip" title="View"
                                                                wire:click="getAgentReportContent({{ $agentac->id }})">View</a>
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
                                {{ $AgentAccounts->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Agent Account Report Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($agentreport_modal_data)
                        <table class="table table-striped">
                            <tr>
                                <th>Date</th>
                                <td>{{ $agentreport_modal_data->created_at ? Helper::formatCarbonDate($agentreport_modal_data->created_at) : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Softwer Id</th>
                                <td>{{ $agentreport_modal_data->booking_id }}</td>
                            </tr>
                            <tr>
                                <th>Service</th>
                                <td>{{ $agentreport_modal_data->servicetype->name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Dep City</th>
                                <td>{{ $agentreport_modal_data->city->city_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Agency</th>
                                <td>{{ $agentreport_modal_data->agency->agency_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Travel Date</th>
                                <td>{{ $agentreport_modal_data->travel_date ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Package Type</th>
                                <td>{{ $agentreport_modal_data->packagetype->package_type ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $agentreport_modal_data->mehram_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Airlines</th>
                                <td>{{ $agentreport_modal_data->pnr->flightdetails->flight_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ $agentreport_modal_data->contact ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Sharing</th>
                                <td>{{ $agentreport_modal_data->sharingtype->name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Days</th>
                                <td>{{ $agentreport_modal_data->days ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>Ticket</th>
                                <td>{{ $agentreport_modal_data->adult + $agentreport_modal_data->child + $agentreport_modal_data->child_bed ?? '---' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Visa</th>
                                <td>
                                    {{ $agentreport_modal_data->adult + $agentreport_modal_data->child + $agentreport_modal_data->child_bed ?? '---' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Beds</th>
                                <td>
                                    {{ $agentreport_modal_data->adult + $agentreport_modal_data->child ?? '---' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td>
                                    {{ number_format($agentreport_modal_data->tot_cost, 2) ?? '---' }}
                                </td>
                            </tr>
                        </table>
                    @else
                        loading........
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
</div>

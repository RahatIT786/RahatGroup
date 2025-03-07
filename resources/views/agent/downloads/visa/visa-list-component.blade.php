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
                                            <h3>{{ __('tablevars.visa') }} {{ __('tablevars.list') }}</h3>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.booking_id') }}</label>
                                                        <input type="number" class="form-control"
                                                            wire:model='booking_id' placeholder="Search booking Id"
                                                            wire:keyup.debounce.500ms="filterBookings" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.Mehram') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='mehram_name'
                                                            placeholder="Search Mehram Name"
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th width="4%">SL#</th>
                                                        <th>{{ __('tablevars.booking_id') }}</th>
                                                        <th>{{ __('tablevars.meheram_name') }}</th>
                                                        <th>{{ __('tablevars.total_pax') }}</th>
                                                        <th>{{ __('tablevars.travel_date') }}</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     @forelse ($visas as $key => $visa)

                                                     <tr>
                                                            <td>{{ $key + $visas->firstItem() }}</td>
                                                            <td>{{ $visa->booking_id }}</td>
                                                            <td>{{ $visa->mehram_name }}</td>
                                                            <td>{{ $visa->adult + $visa->child + $visa->child_bed + $visa->infant }}</td>
                                                            <!-- <td>{{ App\Helpers\Helper::getCanonicalDate($visa->travel_date) }}</td> -->
                                                            <td>{{Helper::appDateFormat($visa->travel_date) }}</td>
                                                            <td wire:click='download_visas({{ $visa->id }})' style="cursor: pointer;" role="button">
                                                                <i class="fas fa-download" style="font-size: 20px; color: #392c7d;"></i>
                                                            </td>
                                                            
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="9" align="center" class="text-danger">
                                                                {{ __('tablevars.no_record') }}
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
                                                <select name="per_page" id="per_page" wire:model='perPage'
                                                    class="form-control" wire:change='filterBookings'>
                                                    @foreach (Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $visas->links(data: ['scrollTo' => false]) }}
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

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.flight') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ 'Pnr' }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.flight.index') }}"
                        wire:navigate>{{ __('tablevars.flight') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.flight') }}</div>
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
                                    <label class="label-header" for="search_flight">{{ __('tablevars.flight') }}</label>
                                    <input type="text" name="search_flight" id="search_flight" class="form-control"
                                        wire:model='search_flight' placeholder="Search Flight Name" autocomplete="off"
                                        wire:keyup="filterFlight">
                                </div>
                                <div class="col-3">
                                    <label class="label-header"
                                        for="search_flight_code">{{ __('tablevars.flight_code') }}</label>
                                    <input type="text" name="search_flight_code" id="search_flight_code"
                                        class="form-control" wire:model='search_flight_code'
                                        placeholder="Search Flight Code" autocomplete="off" wire:keyup="filterFlight">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.flight') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ route('admin.flight.create') }}" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.flight_name') }}</th>
                                            <th>{{ __('tablevars.flight_code') }}</th>
                                            <th>{{ __('tablevars.carrier') }}</th>
                                            <th>{{ __('tablevars.flight_logo') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($flights as $key => $flight)
                                            <tr>
                                                <td>{{ $key + $flights->firstItem() }}</td>
                                                <td>{{ \App\Helpers\Helper::textLimit($flight->flight_name) }}</td>
                                                <td>{{ \App\Helpers\Helper::textLimit($flight->flight_code) }}</td>
                                                <td>{{ $flight->carrier }}</td>
                                                <td class="p-2">
                                                    <img src="{{ asset('/storage/flight_image/' . $flight->flight_logo) }}"
                                                        alt="Flight Image" style="height: 100px;border-radius: 10px;">
                                                </td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $flight->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $flight->id }})">
                                                        {{ $flight->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; right: 0px; will-change: transform;">

                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#viewModal"
                                                                data-toggle="tooltip" title="View Flight"
                                                                wire:click="getModalContent({{ $flight->id }})">View</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.flight.edit', $flight->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit Flight">Edit</a>

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Delete Flight"
                                                                wire:click='isDelete({{ $flight->id }})'>{{ __('tablevars.trash') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" align="center" class="v-msg">
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
                                    <select name="per_page" id="per_page" class="form-control" wire:model='perPage'
                                        wire:change='filterUsers'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $flights->links(data: ['scrollTo' => false]) }}
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
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view') }} {{ 'Flight' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.flight_name') }}</th>
                                <td>{{ $modalData->flight_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.flight_code') }}</th>
                                <td>{{ $modalData->flight_code }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.carrier') }}</th>
                                <td>{{ $modalData->carrier }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.flight_logo') }}</th>
                                <td> <img src="{{ asset('/storage/flight_image/' . $modalData->flight_logo) }}"
                                        alt="Flight Image" style="height: 100px;border-radius: 10px;"></td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.status') }}</th>
                                <td>
                                    <div class="badge badge-{{ $modalData->is_active == 1 ? 'primary' : 'danger' }}">
                                        {{ $modalData->is_active == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @else
                        {{ __('tablevars.loading') }}
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark"
                        data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table-responsive {
            min-height: 250px;
        }
    </style>
</div>

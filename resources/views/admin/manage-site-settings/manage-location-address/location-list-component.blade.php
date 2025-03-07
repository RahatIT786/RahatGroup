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
            <h1>{{ __('tablevars.ManageLocationAddress') }}</h1>
            <div class="section-header-button">
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageSiteSettings') }} </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.location.index') }}"
                        wire:navigate>{{ __('tablevars.All_LocationAddress') }}
                    </a>
                </div>
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
                                    <label class="form-control-label">{{ __('tablevars.email') }}</label>
                                    <input type="text" class="form-control" wire:model='search_email'
                                        placeholder="Search Email" wire:keyup.debounce.500ms="filterLocation">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.ManageLocationAddress') }} </h4>
                            <a class="btn btn-icon btn-sm m-1 btn-primary" href="{{ route('admin.location.create') }}"
                                data-toggle="tooltip" title="Add Location">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL#</th>
                                            <th>{{ __('tablevars.country') }}</th>
                                            <th>{{ __('tablevars.city') }}</th>
                                            {{-- <th>{{ __('tablevars.address') }}</th> --}}
                                            <th>{{ __('tablevars.phone_no') }}</th>
                                            <th>{{ __('tablevars.tollfree_no') }}</th>
                                            <th>{{ __('tablevars.email') }}</th>
                                            {{-- <th>{{ __('tablevars.map_address') }}</th> --}}
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($locations as $key => $location)
                                            <tr>
                                                <td>{{ $key + $locations->firstItem() }}</td>

                                                <td>{{ $location->country->countryname ?? '' }}</td>
                                                <td>{{ $location->city->city_name ?? '' }}</td>
                                                {{-- <td>{{ Helper::limitText($location->address, 50) }}</td> --}}
                                                <td>{{ $location->phone_no }}</td>
                                                <td>{{ $location->tollfree_no }}</td>
                                                <td>{{ $location->email }}</td>
                                                {{-- <td>{{ Helper::limitText($location->map_address, 50) }}</td> --}}

                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            <a class="dropdown-item"
                                                                href="javascript:void(0)"data-bs-toggle="modal"
                                                                data-bs-target="#agentModal" data-toggle="tooltip"
                                                                title="View"
                                                                wire:click="view({{ $location->id }})">View</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.location.edit', $location->id) }}"
                                                                wire:navigate data-bs-toggle="modal"
                                                                data-bs-target="#editModal" data-toggle="tooltip"
                                                                title="Edit">Edit</a>

                                                            <a class="dropdown-item text-danger"
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                class="text-danger" title=" Trash"
                                                                wire:click='isDelete({{ $location->id }})'>Trash</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12" align="center" class="v-msg">
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
                                        wire:change='filterLocation'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $locations->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->

    <div wire:ignore.self class="modal fade" id="agentModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.location') }}
                        {{ __('tablevars.details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($location_modal_data)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country Name</label>
                                                <div>{{ $location_modal_data->country->countryname }}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City Name</label>
                                                <div>{{ $location_modal_data->city->city_name }}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone No</label>
                                                <div>{{ $location_modal_data->phone_no }}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tollfree No</label>
                                                <div>{{ $location_modal_data->tollfree_no }}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <div>{{ $location_modal_data->address }}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Map Address</label>
                                                <div>{{ $location_modal_data->map_address }}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div>{{ $location_modal_data->email }}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.request_quote') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageSiteSettings') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.request.index') }}"
                        wire:navigate>{{ __('tablevars.request_quote') }}</a></div>
                <div class="breadcrumb-item"> {{ __('tablevars.requestquote_all') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <!-- <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <label class="label-header"
                                        for="search_agency">{{ __('tablevars.package_type') }}</label>
                                    <input type="text" name="search_pkg" id="search_pkg" class="form-control"
                                        placeholder="Search Package Type" autocomplete="off">
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.requestquote_all') }} </h4>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <!-- <th>{{ __('tablevars.category') }}</th> -->
                                            <th>{{ __('tablevars.packagetype') }} </th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.email') }}</th>
                                            <th>{{ __('tablevars.phone') }}</th>
                                            <th>{{ __('tablevars.traveldate') }}</th>
                                            <th>{{ __('tablevars.support_team') }}</th>
                                            <th>{{ __('tablevars.food') }}</th>
                                            <th>{{ __('tablevars.visa') }}</th>
                                            <th>{{ __('tablevars.airticket') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Requestquote as $key => $enquirie)
                                            <tr>
                                                <td>{{ $key + $Requestquote->firstItem() }}</td>
                                                <!-- dd() -->
                                                <td>{{ $enquirie->packagemaster->name ?? '' }}</td>
                                                <td>{{ $enquirie->cust_name ?? '' }}</td>
                                                <td>{{ $enquirie->cust_email ?? '' }}</td>
                                                <td>{{ $enquirie->cust_num ?? '' }}</td>
                                                <td>{{ $enquirie->travel_date ?? '' }}</td>
                                                <td>{{ $enquirie->support_team ?? ' - ' }}</td>
                                                <td>{{ $enquirie->food ?? ' - ' }}</td>
                                                <td>{{ $enquirie->visa ?? ' - ' }}</td>
                                                <td>{{ $enquirie->air_ticket ?? ' - ' }}</td>
                                                <td>
                                                    <div style="cursor:pointer;"
                                                        class="pointer badge badge-{{ $enquirie->status == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $enquirie->id }})">
                                                        {{ $enquirie->status == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="ticket-grp mb-2 has-submenu">
                                                        <button
                                                            class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="fas fa-cog" data-toggle="tooltip"
                                                                title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <!-- <a href="javascript:void(0)"
                                                                            data-bs-toggle="modal" class="dropdown-item"
                                                                            data-bs-target="#viewModal"
                                                                            data-toggle="tooltip"
                                                                            title="View">View</a> -->

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.request.edit', $enquirie->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>


                                                            <a class="dropdown-item text-danger"
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                class="text-danger" title="Trash"
                                                                wire:click='isDelete({{ $enquirie->id }})'>Trash</a>
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
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control">
                                        wire:model='perPage' wire:change='filterEnquirie'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Requestquote->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

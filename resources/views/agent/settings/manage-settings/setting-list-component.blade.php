<div class="page-content">
    <section class="section">
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
                                            <div class="filter-grp ticket-grp d-flex justify-content-between">
                                                <h3 class="m-0">Settings Page</h3>
                                                <div>
                                                    <a class="btn btn-icon btn-sm m-1 btn-primary"
                                                        href="{{ route('agent.setting.create') }}"data-toggle="tooltip"
                                                        title="Add New">Add
                                                        New</a>
                                                </div>
                                            </div>
                                            <div class="instruct-search-blk mb-0">
                                                <div class="show-filter all-select-blk">
                                                    <div class="row gx-2">
                                                        <div class="col-md-3 col-lg-3 col-item">
                                                            <label
                                                                class="form-control-label">{{ __('tablevars.parameter') }}
                                                                {{ __('tablevars.name') }}</label>
                                                            <input type="text" class="form-control"
                                                                wire:model='parameter_name'
                                                                placeholder="Search Parameter Name"
                                                                wire:keyup.debounce.500ms="filterManageSetting"maxlength="100">
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-item">
                                                            <label
                                                                class="form-control-label">{{ __('tablevars.settings_value') }}</label>
                                                            <input type="text" class="form-control"
                                                                wire:model='setting_value'
                                                                placeholder="Search Setting Value"
                                                                wire:keyup.debounce.500ms="filterManageSetting">
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
                                                            <th>{{ __('tablevars.#') }}</th>
                                                            <th>{{ __('tablevars.parameter') }}
                                                                {{ __('tablevars.name') }}</th>
                                                            <th>{{ __('tablevars.settings_value') }}</th>
                                                            <!-- <th>{{ __('tablevars.status') }} </th> -->
                                                            <th width="6%">{{ __('tablevars.action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($manageSettings as $key => $manageSetting)
                                                            <tr>
                                                                <td>{{ $key + $manageSettings->firstItem() }}</td>
                                                                <td>{{ $manageSetting->setting->parameter_name ?? '' }}
                                                                </td>
                                                                <td width="50%">{{ $manageSetting->settings_value }}
                                                                </td>



                                                                <td>
                                                                    <div class="ticket-grp mb-2 has-submenu">
                                                                        <button
                                                                            class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                                data-toggle="tooltip"
                                                                                title="Options"></i></button>
                                                                        <div class="dropdown-menu"
                                                                            x-placement="bottom-start"
                                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                            <!-- <a href="javascript:void(0)"
                                                                            data-bs-toggle="modal" class="dropdown-item"
                                                                            data-bs-target="#viewModal"
                                                                            data-toggle="tooltip"
                                                                            title="View">View</a> -->

                                                                            <a class="dropdown-item"
                                                                                href="{{ route('agent.setting.edit', $manageSetting->id) }}"
                                                                                data-bs-toggle="modaltwo"
                                                                                data-bs-target="#editModal"
                                                                                data-toggle="tooltip"
                                                                                title="Edit">{{ __('tablevars.edit') }}</a>


                                                                            <a class="dropdown-item text-danger"
                                                                                href="javascript:void(0)"
                                                                                data-toggle="tooltip"
                                                                                class="text-danger" title="Trash"
                                                                                wire:click='isDelete({{ $manageSetting->id }})'>Trash</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="10" align="center"
                                                                    class="v-msg text-danger">
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
                                                        class="form-control" wire:change='filterManageSetting'>
                                                        @foreach (Helper::getPerPageOptions() as $item)
                                                            <option value="{{ $item }}">{{ $item }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{ $manageSettings->links(data: ['scrollTo' => false]) }}
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

</section>

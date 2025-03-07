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
                                        <div class="filter-grp ticket-grp d-flex justify-content-between">
                                            <h4>User Contact List</h4>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.name') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_name' placeholder="Search Name"
                                                            wire:keyup.debounce.500ms="filterContact">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.email') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_email' placeholder="Search Email"
                                                            wire:keyup.debounce.500ms="filterContact">
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
                                                        <th width="10%">SL#</th>
                                                        <th width="20%">{{ __('tablevars.name') }}</th>
                                                        <th width="18%">{{ __('tablevars.phone') }}</th>
                                                        <th width="20%">{{ __('tablevars.email') }}</th>
                                                        <th width="20%">{{ __('tablevars.message') }}</th>
                                                        <th width="10%">{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($contactList as $key => $contactLists)
                                                        <tr>
                                                            <td>{{ $key + $contactList->firstItem() }}</td>
                                                            <td>{{ $contactLists->name }}</td>
                                                            <td>{{ $contactLists->phone }}</td>
                                                            <td>{{ $contactLists->email }}</td>
                                                            <!-- <td>{{ $contactLists->message }}</td> -->
                                                            <td><a href="javascript:void(0)"data-bs-toggle="modal"
                                                                    data-bs-target="#messageModal"
                                                                    wire:click="getContact({{ $contactLists->id }})">
                                                                    <i class="fas fa-eye"></i></a></td>

                                                            <td>
                                                                <div class="ticket-grp mb-2 has-submenu">
                                                                    <button
                                                                        class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"><i
                                                                            class="fas fa-cog" data-toggle="tooltip"
                                                                            title="Options"></i></button>
                                                                    <div class="dropdown-menu"
                                                                        x-placement="bottom-start"
                                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">




                                                                        <a class="dropdown-item text-danger"
                                                                            href="javascript:void(0)"
                                                                            data-toggle="tooltip" class="text-danger"
                                                                            title=" Trash"
                                                                            wire:click='isDelete({{ $contactLists->id }})'>Trash</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" align="center" class="v-msg text-danger">
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
                                                    class="form-control" wire:change='filterContact'>
                                                    @foreach (Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $contactList->links(data: ['scrollTo' => false]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal use for message -->
        <div wire:ignore.self class="modal fade" id="messageModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">
                            {{ __('tablevars.message') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        @if ($contact_modal_data)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div> {!! $contact_modal_data->message !!}</div>
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

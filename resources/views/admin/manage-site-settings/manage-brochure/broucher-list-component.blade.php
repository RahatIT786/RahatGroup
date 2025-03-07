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
            <h1>{{ __('tablevars.brochure') }} </h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageSiteSettings') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.brochure.index') }}"
                        wire:navigate>{{ __('tablevars.brochure') }}</a></div>

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
                                    <label class="label-header" for="name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        wire:model='name' placeholder="Search Brochure Name" autocomplete="off"
                                        wire:keyup="filterBrochure">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.brochure_all') }} </h4>
                            <div>
                                <a href="{{ route('admin.brochure.create') }}" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>

                            </div>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.image') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Broucher as $key => $broucher)
                                            <tr>
                                                <td>{{ $key + $Broucher->firstItem() }}</td>

                                                <td>{{ $broucher->name ?? ' - ' }}</td>
                                                <td class="p-2">
                                                    <img src="{{ asset('/storage/profile_image/' . $broucher->image) }}"
                                                        style="height: 100px; border-radius: 10px;width: 150px;">
                                                </td>
                                                <td>
                                                    <div style="cursor:pointer;"
                                                        class="pointer badge badge-{{ $broucher->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $broucher->id }})">
                                                        {{ $broucher->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                href="{{ route('admin.brochure.edit', $broucher->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>


                                                            <a class="dropdown-item text-danger"
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                class="text-danger" title="Trash"
                                                                wire:click='isDelete({{ $broucher->id }})'>Trash</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" align="center" class="v-msg text-danger">
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
                                        wire:model='perPage' wire:change='filterBrochure'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Broucher->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</div>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.admin') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}"
                        wire:navigate>{{ __('tablevars.admin') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.admin') }}
                    {{ __('tablevars.list') }}</div>
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
                                    <label class="label-header" for="search_admin_name">Admin Name</label>
                                    <input type="text" name="search_admin_name" id="search_admin_name"
                                        class="form-control" wire:model='search_admin_name' wire:keyup="filterAdmin"
                                        placeholder="Search Admin Name" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_email">Admin Email</label>
                                    <input type="text" name="search_email" id="search_email"
                                        class="form-control"wire:model='search_email' wire:keyup="filterAdmin"
                                        placeholder="Search Email" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.admin') }} {{ __('tablevars.list') }}</h4>
                            <a href="{{ route('admin.admin.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.admin') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.admin') }} {{ __('tablevars.id') }}</th>
                                            <th>{{ __('tablevars.email') }}</th>
                                            <th>{{ __('tablevars.admin') }} {{ __('tablevars.role') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($AdminList as $key => $admin)
                                            <tr>
                                                <td>{{ $key + $AdminList->firstItem() }}</td>
                                                <td>{{ $admin->name ?? '---' }}</td>
                                                <td>{{ $admin->admin_id ?? '---' }}</td>
                                                <td>{{ $admin->email ?? '---' }}</td>
                                                <td>{{ $admin->admintype->admin_type ?? '---' }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $admin->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $admin->id }})">
                                                        {{ $admin->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.admin.edit', $admin->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit City">Edit</a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger"
                                                                wire:click='isDelete({{ $admin->id }})'>{{ __('tablevars.trash') }}</a>
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
                                        wire:change='filterAdmin'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $AdminList->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
</div>

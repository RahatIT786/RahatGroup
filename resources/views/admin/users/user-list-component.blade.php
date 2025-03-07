<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.users') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.user') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"
                        wire:navigate>{{ __('tablevars.users') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.users') }}</div>
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
                                    <label class="label-header" for="search_name">Name</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        placeholder="Search Name" autocomplete="off" wire:model="search_name"
                                        wire:keyup="filterUsers">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_email">Email</label>
                                    <input type="text" name="search_email" id="search_email" class="form-control"
                                        placeholder="Search Email" autocomplete="off" wire:model='search_email'
                                        wire:keyup="filterUsers">
                                </div>
                                {{-- <div class="col-3">
                                    <label class="label-header" for="search_role">Role</label>
                                    <select class="form-control" name='search_role' id="search_role"
                                        wire:model='search_role' wire:state="search_role" wire:change="filterUsers">
                                        <option value="">{{ __('tablevars.all') }}</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-3">
                                    <label class="label-header" for="search_status">Status</label>
                                    <select class="form-control" name='search_status' id="search_status"
                                        wire:model='search_status' wire:state="search_status" wire:change="filterUsers">
                                        <option value="">{{ __('tablevars.all') }}</option>
                                        @foreach (\App\Helpers\Helper::status() as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.user') }} {{ __('tablevars.list') }}</h4>
                            {{-- <a href="{{ route('admin.user-create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.email') }}</th>
                                            {{-- <th>{{ __('tablevars.phone') }}</th> --}}
                                            {{-- <th>{{ __('tablevars.role') }}</th> --}}
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $key => $user)
                                            <tr>
                                                <td>{{ $key + $users->firstItem() }}</td>
                                                <td>{{ $user->name }}
                                                    {{-- @if ($user->id != 1)
                                                        <div class="table-links">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#viewModal"
                                                                wire:click="getModalContent({{ $user->id }})">{{ __('tablevars.view') }}</a>
                                                            <div class="bullet"></div>
                                                            <a href="{{ route('admin.user-edit', $user->id) }}"
                                                                wire:navigate>{{ __('tablevars.edit') }}</a>
                                                            @if ($user->id != auth()->user()->id)
                                                                <div class="bullet"></div>
                                                                <a href="javascript:void(0)" class="text-danger"
                                                                    wire:click='isDelete({{ $user->id }})'>{{ __('tablevars.trash') }}</a>
                                                            @endif
                                                        </div>
                                                    @endif --}}
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                {{-- <td>{{ $user->phone }}</td> --}}
                                                {{-- <td>
                                                    @if ($user->roles()->count() > 0)
                                                        {{ $user->roles->first()->label }}
                                                    @else
                                                        -
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $user->id }})">
                                                        {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($user->id != 1)
                                                        <div class="no-wrap">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="btn btn-icon btn-sm m-1 btn-primary"
                                                                data-bs-target="#viewModal"
                                                                wire:click="getModalContent({{ $user->id }})"
                                                                data-toggle="tooltip" title="View"><i
                                                                    class="far fa-eye"></i></a>
                                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                                                wire:navigate
                                                                class="btn btn-icon btn-sm m-1 btn-warning"><i
                                                                    class="far fa-edit" data-toggle="tooltip"
                                                                    title="Edit"></i></a>
                                                            @if ($user->id != auth()->user()->id)
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-icon btn-sm m-1 danger-btn btn-danger"
                                                                    wire:click='isDelete({{ $user->id }})'><i
                                                                        class="fas fa-times" data-toggle="tooltip"
                                                                        title="Delete"></i></a>
                                                            @endif
                                                        </div>
                                                    @endif
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
                                    <select name="per_page" id="per_page" wire:model='perPage' class="form-control"
                                        wire:change='filterUsers'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $users->links(data: ['scrollTo' => false]) }}
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
                    <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view') }}
                        {{ __('tablevars.user') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.name') }}</th>
                                <td>{{ $modalData->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.email') }}</th>
                                <td>{{ $modalData->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.phone') }}</th>
                                <td>{{ $modalData->phone }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.address') }}</th>
                                <td>{{ $modalData->address }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.profile_image') }}</th>
                                <td>
                                    @if ($modalData)
                                        <img src="{{ asset('storage/profile_image/' . $modalData->profile_image) }}"
                                            style="height: 100px;">
                                    @endif
                                </td>
                            </tr>
                            {{-- <tr>
                                <th>{{ __('tablevars.role') }}</th>
                                <td>{{ $modalData->roles()->first()->label }}</td>
                            </tr> --}}
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
</div>

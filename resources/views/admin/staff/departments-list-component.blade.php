<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.department') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.department') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.department.index') }}"
                        wire:navigate>{{ __('tablevars.department') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.department') }}</div>
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
                                    <label class="label-header" for="search_name">Start Date</label>
                                    <input type="date" name="search_name" id="search_name" class="form-control"
                                        placeholder="Search Booking Id" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_email">End Date</label>
                                    <input type="date" name="search_email" id="search_email" class="form-control"
                                        placeholder="Search Name" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_role">Status</label>
                                    <select class="form-control" name='search_role' id="search_role">
                                        {{-- wire:model='search_role' wire:state="search_role" wire:change="filterUsers"> --}}
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                        {{-- @endforeach --}}
                                    </select>
                                </div>
                                {{-- <div class="col-3">
                                    <label class="label-header" for="search_status">Status</label>
                                    <select class="form-control" name='search_status' id="search_status"
                                        wire:model='search_status' wire:state="search_status" wire:change="filterUsers">
                                        <option value="">{{ __('tablevars.all') }}</option>
                                        @foreach (\App\Helpers\Helper::status() as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.department') }} {{ __('tablevars.list') }}</h4>
                            <a href="{{route('admin.department.create')}}" class="btn btn-primary" wire:navigate>{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.department') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($departments as $key => $department)
                                            <tr>
                                                <td>{{ $key + $departments->firstItem() }}</td>
                                                <td>{{ $department->department_name }}</td>
                                                <td>
                                                    <div class="pointer badge badge-primary">Active</div>
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a class="dropdown-item" href="{{route('admin.department.edit', $department->id)}}" wire:navigate
                                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit City">Edit</a>
                                                            <a class="dropdown-item text-danger"
                                                                href="#">Trash</a>
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
                                    <select name="per_page" id="per_page" class="form-control">
                                        {{-- wire:model='perPage' wire:change='filterUsers'> --}}
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- {{ $users->links(data: ['scrollTo' => false]) }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
</div>

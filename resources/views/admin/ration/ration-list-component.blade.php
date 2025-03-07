<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.manage_ration') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manage-ration.index') }}"
                        wire:navigate>{{ __('tablevars.manage_ration') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.manage_ration') }}</div>
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
                                    <label class="label-header" for="search_email">Title</label>
                                    <input type="text" name="search_email" id="search_email" class="form-control"
                                        placeholder="Search title" autocomplete="off">
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
                            <h4>{{ __('tablevars.manage_ration') }} {{ __('tablevars.list') }}</h4>
                            <a href="{{ route('admin.manage-ration.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.date') }}</th>
                                            <th>{{ __('tablevars.ration_title') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>05-10-2024</td>
                                            <td>20 MAY BOM</td>
                                            <td>
                                                <div class="pointer badge badge-primary">Active</div>
                                                {{-- <div class="table-links d-flex">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                    <form id="#" action="#" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <div class="bullet"></div>
                                                    <i style="color: rgb(58, 23, 90)" class="fas fa-print"></i>
                                                    <div class="bullet"></div>
                                                    <i style="color: rgb(165, 126, 18)" class="fas fa-file-excel"></i>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                        <a class="dropdown-item" href="#">Download Invoice</a>
                                                        <a class="dropdown-item" href="#">Export To XLS</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>05-10-2024</td>
                                            <td>20 MAY BOM</td>
                                            <td>
                                                <div class="pointer badge badge-primary">Active</div>
                                                {{-- <div class="table-links d-flex">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                    <form id="#" action="#" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <div class="bullet"></div>
                                                    <i style="color: rgb(58, 23, 90)" class="fas fa-print"></i>
                                                    <div class="bullet"></div>
                                                    <i style="color: rgb(165, 126, 18)" class="fas fa-file-excel"></i>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item text-danger" href="#">Trash</a>
                                                        <a class="dropdown-item text-danger" href="#">Download Invoice</a>
                                                        <a class="dropdown-item" href="#">Export To XLS</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>05-10-2024</td>
                                            <td>20 MAY BOM</td>
                                            <td>
                                                <div class="pointer badge badge-primary">Active</div>
                                                {{-- <div class="table-links d-flex">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                    <form id="#" action="#" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <div class="bullet"></div>
                                                    <i style="color: rgb(58, 23, 90)" class="fas fa-print"></i>
                                                    <div class="bullet"></div>
                                                    <i style="color: rgb(165, 126, 18)" class="fas fa-file-excel"></i>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                        <a class="dropdown-item" href="#">Download Invoice</a>
                                                        <a class="dropdown-item" href="#">Export To XLS</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>05-10-2024</td>
                                            <td>20 MAY BOM</td>
                                            <td>
                                                <div class="pointer badge badge-primary">Active</div>
                                                {{-- <div class="table-links d-flex">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                    <form id="#" action="#" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <div class="bullet"></div>
                                                    <i style="color: rgb(58, 23, 90)" class="fas fa-print"></i>
                                                    <div class="bullet"></div>
                                                    <i style="color: rgb(165, 126, 18)" class="fas fa-file-excel"></i>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                        <a class="dropdown-item" href="#">Download Invoice</a>
                                                        <a class="dropdown-item" href="#">Export To XLS</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- @empty
                                            <tr>
                                                <td colspan="5" align="center" class="v-msg">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse --}}
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

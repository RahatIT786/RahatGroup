<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.category_page') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.category_page') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.categoryPage.index') }}"
                        wire:navigate>{{ __('tablevars.category_page') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.category_page') }}</div>
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
                                    <label class="label-header"
                                        for="search_category_name">{{ __('tablevars.category_name') }}</label>
                                    <input type="text" name="search_category_name" id="search_category_name"
                                        class="form-control" placeholder="Search Category Name" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_role">Status</label>
                                    <select class="form-control" name='search_role' id="search_role">
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.category_page') }} {{ __('tablevars.list') }}</h4>
                            {{-- <a href="{{ route('admin.categoryPage.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a> --}}

                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                class="btn btn-icon btn-sm m-1 btn-primary" data-bs-target="#addModal"
                                data-toggle="tooltip" title="Add Category Page">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.category_name') }}</th>
                                            <th>{{ __('tablevars.desc') }}</th>
                                            <th>{{ __('tablevars.created_date') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                News & Alerts
                                            </td>
                                            <td><a href="#"> <i class="fas fa-eye"></i></a></td>
                                            <td>29-03-2019</td>
                                            <td>
                                                {{-- <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                    wire:click="toggleStatus({{ $user->id }})">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </div> --}}
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
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Duplicate</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                Information
                                            </td>
                                            <td><a href="#"> <i class="fas fa-eye"></i></a></td>
                                            <td>29-03-2019</td>
                                            <td>
                                                {{-- <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                    wire:click="toggleStatus({{ $user->id }})">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </div> --}}
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
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Duplicate</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                Information-2
                                            </td>
                                            <td><a href="#"> <i class="fas fa-eye"></i></a></td>
                                            <td>29-03-2019</td>
                                            <td>
                                                {{-- <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                    wire:click="toggleStatus({{ $user->id }})">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </div> --}}
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
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Duplicate</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                Information -4
                                            </td>
                                            <td><a href="#"> <i class="fas fa-eye"></i></a></td>
                                            <td>29-03-2019</td>
                                            <td>
                                                {{-- <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                    wire:click="toggleStatus({{ $user->id }})">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </div> --}}
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
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Duplicate</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                Information - 5 
                                            </td>
                                            <td><a href="#"> <i class="fas fa-eye"></i></a></td>
                                            <td>29-03-2019</td>
                                            <td>
                                                {{-- <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                    wire:click="toggleStatus({{ $user->id }})">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </div> --}}
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
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Duplicate</a>
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
    <div wire:ignore.self class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Category Page</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                {{-- <form wire:submit="save">  --}}
                <form>
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <div class="mb-3">
                            <label for="category_name" class="form-label">{{ __('tablevars.category_name') }}</label>
                            {{-- <input type="text" class="form-control" name="category_name" id="category_name" wire:model="name"> --}}
                            <input type="text" class="form-control" name="category_name" id="category_name"
                                placeholder="Please enter category name">
                            @error('category_name')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label>{{ __('tablevars.desc') }}</label><span class="text-danger">*</span>
                                <textarea name="desc" class="form-control"></textarea>
                                @error('desc')
                                    <span class="v-msg-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

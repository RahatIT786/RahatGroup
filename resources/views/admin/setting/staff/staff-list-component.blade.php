<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.staff_listing') }}</h1>
            <div class="section-header-button">
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.clientReport.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.staff') }}
                        {{ __('tablevars.list') }}</a></div>
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
                                    <label class="label-header" for="search_name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        wire:model='search_name' wire:keyup="filterStaff" placeholder="Search Name"
                                        autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_email">{{ __('tablevars.email') }}</label>
                                    <input type="text" name="search_email" id="search_email" class="form-control"
                                        wire:model='search_email' wire:keyup="filterStaff" placeholder="Search Email"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.staff_listing') }}</h4>
                            <div>
                                <a href="{{ route('admin.staff.create') }}" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                                <a href="javascript:void(0)" wire:click="exportToExcel()" style="color: white"
                                    class="btn btn-info"><i class="fas fa-file-excel"></i> Export
                                    into excel</a>
                                <a wire:click="downloadStaffList()" href="javascript:void(0)" style="color: white"
                                    class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.email') }}</th>
                                            <th>{{ __('tablevars.mobile') }}</th>
                                            <th>{{ __('tablevars.role') }}</th>
                                            {{-- <th>{{ __('tablevars.department') }}</th> --}}
                                            {{-- <th>{{ __('tablevars.phone') }}</th>
                                            <th>{{ __('tablevars.country') }}</th>
                                            <th>{{ __('tablevars.city') }}</th>
                                            <th>{{ __('tablevars.postal_code') }}</th>
                                            <th>{{ __('tablevars.photo') }}</th>
                                            <th>{{ __('tablevars.details') }}</th>
                                            <th>{{ __('tablevars.address') }}</th> --}}
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($staffs as $key => $staff)
                                            <tr>
                                                <td>{{ $key + $staffs->firstItem() }}</td>
                                                <td>{{ $staff->first_name }} {{ $staff->last_name }}</td>
                                                <td>{{ $staff->email }}</td>
                                                <td>{{ $staff->mobile }}</td>
                                                <td>{{ $staff->staffrole->staff_role }}</td>
                                                {{-- <td>{{ $staff->staffdepartment->department_name }}</td> --}}
                                                {{-- <td>{{ $staff->office_no }}</td>
                                               <td>{{ $staff->country->countryname }}</td>
                                                <td>{{ $staff->city->city_name }}</td>
                                                <td>{{ $staff->postal_code }}</td>
                                                <td>
                                                    @if ($staff)
                                                        <img src="{{ asset('storage/staff_photo/' . $staff->photo) }}"
                                                            style="height: 100px;">
                                                    @endif
                                                </td>
                                                <td>{{ $staff->detail }}</td>
                                                <td>{{ $staff->address }}</td> --}}
                                                <td>
                                                    <div class="pointer badge badge-{{ $staff->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $staff->id }})">
                                                        {{ $staff->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; right: 0px; will-change: transform;">
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.staff.edit', $staff->id) }}"
                                                                wire:navigate data-bs-toggle="modal"
                                                                data-bs-target="#editModal" data-toggle="tooltip"
                                                                title="Edit">Edit</a>
                                                            <a class="dropdown-item"
                                                                href="javascript:void(0)"data-bs-toggle="modal"
                                                                data-bs-target="#staffModal" data-toggle="tooltip"
                                                                title="View"
                                                                wire:click="getStaffContent({{ $staff->id }})">View</a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                wire:click='isDelete({{ $staff->id }})'>{{ __('tablevars.trash') }}</a>
                                                            <a href="javascript:void(0)" class="dropdown-item"
                                                                wire:click.prevent="openChangePasswordModal({{ $staff->id }})"
                                                                data-bs-toggle="modal" data-bs-target="#crudModal"
                                                                data-toggle="tooltip" title="">Change Password</a>
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
                                        wire:change='filterStaff'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $staffs->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="staffModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.staff') }}
                        {{ __('tablevars.details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($staff_modal_data)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div>{{ $staff_modal_data->first_name ?? '' }}
                                                    {{ $staff_modal_data->last_name }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div>{{ $staff_modal_data->email }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <div>{{ $staff_modal_data->mobile }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <div>{{ $staff_modal_data->staffrole->staff_role }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <div>{{ $staff_modal_data->staffdepartment->department_name ?? '---' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <div>{{ $staff_modal_data->office_no }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <div>{{ $staff_modal_data->country->countryname }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <div>{{ $staff_modal_data->city->city_name }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <div>{{ $staff_modal_data->postal_code }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Photo</label>
                                                <div>
                                                    @if ($staff_modal_data)
                                                        <img src="{{ asset('storage/staff_photo/' . $staff_modal_data->photo) }}"
                                                            alt="Staff Image"
                                                            style="height: 100px;border-radius: 10px;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Details</label>
                                                <div>{{ $staff_modal_data->detail }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <div>{{ $staff_modal_data->address }}</div>
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
    <!-- Change Password Modal -->
    <div wire:ignore.self class="modal fade" id="crudModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="update">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="crudModalLabel">Change Password
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label for="password">Staff Change Password<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="password" id="password" class="form-control"
                                                wire:model="password" placeholder="Enter password">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="togglePassword"
                                                    style="cursor: pointer;">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <span class="v-msg-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                    {{ __('tablevars.close') }}
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>

    </div>
    <style>
        .table-responsive {
            min-height: 250px;
        }
    </style>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            // Toggle password visibility
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</div>

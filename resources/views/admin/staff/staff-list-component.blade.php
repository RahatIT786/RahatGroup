<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.staff_listing') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.staff_listing') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.clientReport.index') }}"
                        wire:navigate>{{ __('tablevars.staff_listing') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.staff_listing') }}</div>
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
                                        placeholder="Search Name" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_email">{{ __('tablevars.email') }}</label>
                                    <input type="text" name="search_email" id="search_email" class="form-control"
                                        placeholder="Search Email" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.staff') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ route('admin.staff.create') }}" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                                <a href="{{ asset('/storage/sample_pdf/Agents-Accounts-Detail.xls') }}"
                                    style="color: white" class="btn btn-info"><i class="fas fa-file-excel"></i> Export
                                    into excel</a>
                                <a href="{{ asset('/storage/sample_pdf/my-pdf-voucher.pdf') }}" style="color: white"
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
                                            <th>{{ __('tablevars.department') }}</th>
                                            <th>{{ __('tablevars.country') }}</th>
                                            <th>{{ __('tablevars.city') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>Robin jhaa</td>
                                            <td>robin@gmail.com</td>
                                            <td>9337367467</td>
                                            <td>Sales</td>
                                            <td>Farma</td>
                                            <td>India</td>
                                            <td>Mumbai</td>
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
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" data-toggle="tooltip"
                                                            title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
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
                                        <tr>
                                            <td>2</td>
                                            <td>jyoti</td>
                                            <td>jyoti@gmail.com</td>
                                            <td>9337367467</td>
                                            <td>Sales</td>
                                            <td>Nursing</td>
                                            <td>India</td>
                                            <td>Mumbai</td>
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
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" data-toggle="tooltip"
                                                            title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>biswa</td>
                                            <td>biswqa@gmail.com</td>
                                            <td>9337367467</td>
                                            <td>Sales</td>
                                            <td>Nursing</td>
                                            <td>India</td>
                                            <td>Delhi</td>
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
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" data-toggle="tooltip"
                                                            title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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

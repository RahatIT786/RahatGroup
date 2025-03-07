<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.forex') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.forex') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.forex.index') }}"
                        wire:navigate>{{ __('tablevars.forex') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.forex') }}</div>
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
                                        for="search_reference_no">{{ __('tablevars.reference_no') }}</label>
                                    <input type="text" name="search_reference_no" id="search_reference_no"
                                        class="form-control" placeholder="Search Reference No" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header"
                                        for="search_beneficiary">{{ __('tablevars.beneficiary') }}
                                        {{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_beneficiary" id="search_beneficiary"
                                        class="form-control" placeholder="Search Beneficiary Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.forex') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ route('admin.forex.create') }}" class="btn btn-primary"
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
                                            <th>{{ __('tablevars.date') }}</th>
                                            <th>{{ __('tablevars.reference_no') }}</th>
                                            <th>{{ __('tablevars.beneficiary') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.company') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.amount') }}</th>
                                            <th>{{ __('tablevars.type') }}</th>
                                            <th>{{ __('tablevars.bank') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.particulars') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>20-06-2022</td>
                                            <td>1771524</td>
                                            <td>HOTEL-DEAFAH</td>
                                            <td>UMRAH TOURS PVT LTD</td>
                                            <td>100,000.00</td>
                                            <td>CREDIT</td>
                                            <td>HDFC BANK</td>
                                            <td>XYZ</td>
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
                                            <td>9238829</td>
                                            <td>1771524</td>
                                            <td>HOTEL-Mira Ajyaad</td>
                                            <td>ALL INDIA HAJJ AND UMRAH TOURS PVT LTD</td>
                                            <td>40,000.00</td>
                                            <td>CREDIT</td>
                                            <td>HDFC BANK</td>
                                            <td>XYZ</td>
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
                                            <td>20-06-2022</td>
                                            <td>8352941</td>
                                            <td>HOTEL-Mira Ajyaad</td>
                                            <td>AMAZON INTERTNATIONAL</td>
                                            <td>100,000.00</td>
                                            <td>CREDIT</td>
                                            <td>HDFC BANK</td>
                                            <td>XYZ</td>
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
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
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

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.agent') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.payment.index') }}" wire:navigate>{{ __('tablevars.agent') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.agent') }}</div>
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
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_agency_code">Agency Code</label>
                                    <input type="text" name="search_agency_code" id="search_agency_code" class="form-control"
                                        placeholder="Search Agency Code" autocomplete="off">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_agency">Agency</label>
                                    <input type="text" name="search_agency" id="search_agency" class="form-control"
                                        placeholder="Search Agency" autocomplete="off">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_name">Agent Name</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        placeholder="Search Agent Name" autocomplete="off">
                                </div>
                                {{-- <div class="col-4 mb-2">
                                    <label class="label-header" for="search_mobile">Mobile</label>
                                    <input type="text" name="search_mobile" id="search_mobile" class="form-control"
                                        placeholder="Search Mobile" autocomplete="off">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_role">Status</label>
                                    <select class="form-control" name='search_role' id="search_role">
                                        wire:model='search_role' wire:state="search_role" wire:change="filterUsers">
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.agent') }} {{ __('tablevars.list') }}</h4>
                            
                            <div>
                                <a href="{{ route('admin.agentlist.create') }}" class="btn btn-primary"
                            wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                                <a href="{{ asset('/storage/Agents-Accounts-Detail.xls') }}" style="color: white" class="btn btn-info"><i class="fas fa-file-excel"></i> Export
                                    into excel</a>
                                <a style="color: white" class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                           <th>Agency Code</th>
                                           <th>Agency</th>
                                           <th>Name</th>
                                           {{-- <th>State</th>
                                           <th>City</th> --}}
                                           {{-- <th>Mobile</th>
                                           <th>Email</th> --}}
                                           <th>Is Paid</th>
                                           <th>Expired</th>
                                           <th>{{ __('tablevars.status') }}</th>
                                           <th>{{ 'Action' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>1704</td>
                                            <td>Kalimi Umrah tour</td>
                                            <td>Md Jahangir Alam</td>
                                            <td>Unpaid</td>
                                            <td>02-03-2025</td>
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
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#viewModal" data-toggle="tooltip" title="View">View</a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
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
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Agent Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Agency Code</th>
                            <td>15998</td>
                        </tr>
                        <tr>
                            <th>Agency</th>
                            <td>Jyoti</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>Cash</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>123456789</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>AL DEAFAH INTERNATIONAL PVT LTD</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>HDFC BANK</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>50200080189220</td>
                        </tr>
                        <tr>
                            <th>Is Paid</th>
                            <td>Narendra Nayak</td>
                        </tr>
                        <tr>
                            <th>Expired</th>
                            <td>test</td>
                        </tr>
                    </table>
                    
                    {{-- @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <td>{{ $modalData->name }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <div class="badge badge-{{ $modalData->is_active == 1 ? 'primary' : 'danger' }}">
                                        {{ $modalData->is_active == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @else
                        loading........
                    @endif --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
</div>

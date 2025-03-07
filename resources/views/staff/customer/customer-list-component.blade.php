<div class="content-wrapper">

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">

            <div class="card">

                <div class="card-header bg-primary text-white">Search</div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="search_status">{{ __('tablevars.name') }}</label>

                                <input type="text" name="search_name" id="search_name" wire:model='search_name'
                                    wire:keyup="filterCustomer" class="form-control" placeholder="Search Name"
                                    autocomplete="off">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">

            <div class="card">

                <div class="card-header">

                    <div class="row align-items-center">

                        <div class="col-md-6">

                            <h4 class="display-5">{{ __('tablevars.user') }} {{ __('tablevars.list') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('tablevars.#') }}</th>
                                    <th>{{ __('tablevars.name') }} </th>
                                    <th>{{ __('tablevars.email') }} </th>
                                    <th>{{ __('tablevars.phone') }}</th>
                                    <th>{{ __('tablevars.state') }}</th>
                                    <th>{{ __('tablevars.city') }}</th>
                                    <th>{{ __('tablevars.status') }}</th>
                                    <th>{{ __('tablevars.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($Customers as $key => $customer)
                                    <tr>
                                        <td>{{ $key + $Customers->firstItem() }}</td>
                                        <td>{{ $customer->name ?? '' }}</td>
                                        <td>{{ $customer->email ?? '' }}</td>
                                        <td>{{ $customer->mobile ?? '' }}</td>
                                        <td>{{ $customer->state->state_name ?? '' }}</td>
                                        <td>{{ $customer->city ?? '' }}</td>
                                        <td>
                                            <div class="pointer badge badge-{{ $customer->is_active == 1 ? 'primary' : 'danger' }}"
                                                wire:click="toggleStatus({{ $customer->id }})">
                                                {{ $customer->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </div>
                                        </td>
                                        <td>
                                            <li class="nav-item list-unstyled dropdown">

                                                <a class="nav-link dropdown-toggle" href="#"
                                                    data-toggle="dropdown" id="optionDropdown"><i
                                                        class="mdi mdi-settings"></i></a>

                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                                    aria-labelledby="optionDropdown">
                                                    <a class="dropdown-item py-2" href="javascript:void(0)"
                                                        data-toggle="modal"
                                                        wire:click="getModalContent({{ $customer->id }})"
                                                        data-target="#enquiryListModal"><i
                                                            class="mdi mdi-check text-primary"></i> View</a>
                                                    <a href="javascript:void(0)" class="dropdown-item py-2"
                                                        data-toggle="tooltip" title="User Login"
                                                        wire:click='askToLogin({{ $customer->id }})'>
                                                        <i class="mdi mdi-check text-primary"></i> User
                                                        Login</a>
                                                </div>
                                            </li>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="10" align="center" class="v-msg text-danger">

                                            No Records Found...

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                        <div class="d-flex flex-row justify-content-between align-items-center table-pagination mt-4">

                            <div class="d-flex align-items-center">

                                <span class="font-weight-bold mr-3 flex-shrink-0">Per Page</span>

                                <select name="per_page" id="per_page" wire:model='perPage' class="form-control"
                                    wire:change='filterCustomer'>

                                    @foreach (Helper::getPerPageOptions() as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach

                                </select>

                            </div>

                            {{ $Customers->links(data: ['scrollTo' => false]) }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- view modal --}}

    <div class="modal fade" id="enquiryListModal" tabindex="-1" role="dialog" aria-labelledby="enquiryListModalTitle"
        aria-hidden="true" wire:ignore.self>

        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="enquiryListModalTitle">Manage User Details</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="container">

                        <div class="row">

                            @if ($modalData)
                                <table class="table table-striped">

                                    <tr>
                                        <th>{{ __('tablevars.name') }}</th>
                                        <td>{{ $modalData->name ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.country') }}</th>
                                        <td>{{ $modalData->country->countryname ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.state') }}</th>
                                        <td>{{ $modalData->state->state_name ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.city') }}</th>
                                        <td>{{ $modalData->city ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.mobile') }}</th>
                                        <td>{{ $modalData->mobile ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.email') }}</th>
                                        <td>{{ $modalData->email ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.address') }}</th>
                                        <td>{{ $modalData->address ?? '---' }}</td>
                                    </tr>
                                    {{-- <tr>

                                        <th>{{ __('tablevars.profile_image') }}</th>

                                        <td><a href="{{ asset('storage/profile_image/' . $modalData->profile_img) }}"
                                                target="_blank" download>Download</a></td>

                                    </tr> --}}
                                </table>
                            @else
                                {{ __('tablevars.loading') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark"
                        data-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>

            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('user-logged-in', (event) => {

            var url = event.url;

            window.open(url, '_blank');

        });
    </script>
@endscript

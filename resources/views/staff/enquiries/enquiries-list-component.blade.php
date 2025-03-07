    <div>
    <div class="content-wrapper">
        <div class="row">
            @livewire('staff.enquiries.enquiries-component')
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between">Search
                        <div>
                            <span class="mr-2">Total Enquiry : {{ $total }}</span>  <span class="mr-2">Complete Enquiry : {{ $complete }}</span> <span class="mr-2">Pending Enquiry : {{ $pending }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">

                                <div cclass="form-group">
                                    <label class="label-header" for="search_name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        wire:model='search_name' placeholder="Search name" autocomplete="off"
                                        wire:keyup="filterBooking">
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label class="label-header"
                                        for="search_category">{{ __('tablevars.category') }}</label>
                                    <input type="text" name="search_category" id="search_category"
                                        class="form-control" wire:model='search_category' placeholder="Search Category"
                                        autocomplete="off" wire:keyup="filterBooking">
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
                                <h4 class="display-5">{{ __('tablevars.booking') }} {{ __('tablevars.enquiry') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('tablevars.#') }}</th>
                                        <th>{{ __('tablevars.category') }}</th>
                                        <th>{{ __('tablevars.package') }} </th>
                                        <th>{{ __('tablevars.packagetype') }} </th>
                                        <th>{{ __('tablevars.name') }}</th>
                                        <th>{{ __('tablevars.phone') }}</th>
                                        <th>{{ __('tablevars.status') }}</th>
                                        <th>{{ __('tablevars.action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($Bookingenquiry as $key => $bookingenquiry)
                                        <tr>
                                            <td>{{ $key + $Bookingenquiry->firstItem() }}</td>
                                            <td>{{ $bookingenquiry->servicetype->name ?? '-' }}</td>
                                            <td>{{ $bookingenquiry->packagemaster->name ?? '' }}</td>
                                            <td>{{ $bookingenquiry->packagetype->package_type ?? '' }}</td>
                                            <td>{{ $bookingenquiry->cust_name ?? '' }}</td>
                                            <td>
                                                {{ $bookingenquiry->cust_num ?? '' }}
                                            </td>
                                            <td> @php
                                                $statusLabels = [
                                                    1 => ['label' => 'Assigned', 'class' => 'badge-primary'],
                                                    2 => ['label' => 'Completed', 'class' => 'badge-success'],
                                                    3 => ['label' => 'Rejected', 'class' => 'badge-danger'],
                                                ];
                                            @endphp
                                                @if (array_key_exists($bookingenquiry->status, $statusLabels))
                                                    <div
                                                        class="badge {{ $statusLabels[$bookingenquiry->status]['class'] }}">
                                                        {{ $statusLabels[$bookingenquiry->status]['label'] }}
                                                    </div>
                                                @endif
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
                                                            wire:click="getModalContent({{ $bookingenquiry->id }})"
                                                            data-target="#enquiryListModal"><i
                                                                class="mdi mdi-check text-primary"></i> View</a>

                                                        <a class="dropdown-item py-2" href="javascript:void(0)"
                                                            data-toggle="modal"
                                                            wire:click="changestatus({{ $bookingenquiry->id }})"
                                                            data-target="#editModal"><i
                                                                class="mdi mdi-check text-primary"></i>Change Status</a>

                                                    </div>
                                                </li>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" align="center" class="v-msg text-danger">
                                                {{ __('tablevars.no_record') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control" wire:model='perPage'
                                        wire:change='filterBooking'>
                                        @foreach (Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Bookingenquiry->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- view modal --}}
        <div class="modal fade" id="enquiryListModal" tabindex="-1" role="dialog"
            aria-labelledby="enquiryListModalTitle" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="enquiryListModalTitle">Booking Enquiry Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- {{ $post }} --}}
                        <div class="container">
                            <div class="row">
                                @if ($modalData)
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('tablevars.category') }}</th>
                                            <td>{{ $modalData->servicetype->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.package') }}</th>
                                            <td>{{ $modalData->packagemaster->name ?? '' }}</td>

                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.packagetype') }}</th>
                                            <td>{{ $modalData->packagetype->package_type ?? '' }}</td>

                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <td>{{ $modalData->cust_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.email') }}</th>
                                            <td>{{ $modalData->cust_email }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.phone') }}</th>
                                            <td>{{ $modalData->cust_num }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.traveldate') }}</th>
                                            <td>{{ $modalData->travel_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.food') }}</th>
                                            <td>{{ $modalData->food == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.visa') }}</th>
                                            <td>{{ $modalData->visa == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.airticket') }}</th>
                                            <td>{{ $modalData->air_ticket == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.comment') }}</th>
                                            <td>{{ $modalData->comment }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.status') }}</th>
                                            {{-- <td>{{ $modalData->status }}</td> --}}
                                            <td>{{ $modalData->status == 2 ? 'Complete' : ($modalData->status == 3 ? 'Reject' : '') }}
                                            </td>
                                        </tr>

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
        {{--
//comments// --}}

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" tabindex="-1"
            aria-labelledby="editModalLabel" aria-hidden="true" wire:ignore.self>
            {{-- <div class="modal-dialog modal-xl modal-dialog-centered"> --}}
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Change Status</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <form wire:submit.prevent="save">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="status">
                                    <option value="">{{ __('tablevars.select') }}
                                        {{ __('tablevars.name') }}</option>
                                    <option value="2">Complete</option>
                                    <option value="3">Reject</option>
                                </select>
                                @error('status')
                                    <span class="v-msg-500">{{ $message }}</span>
                                @enderror
                            </div>



                            <!-- Add your form fields here -->
                            <div class="mb-12">
                                <label>Comment<span class="text-danger">*</span></label>
                                <textarea class="form-control" wire:model="comment" name="comment" placeholder="Enter your comment"
                                    style="height: 120px"></textarea>
                                @error('comment')
                                    <span class="v-msg-500">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-dark"
                                data-dismiss="modal">{{ __('tablevars.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.visa') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.visaMaster.index') }}"
                        wire:navigate>{{ __('tablevars.visa') }} {{ __('tablevars.master') }}</a></div>
                <div class="breadcrumb-item">All Visa</div>
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
                                        for="search_booking_id">{{ __('tablevars.country') }}</label>
                                    <input type="text" name="countryname" id="countryname" class="form-control"
                                        wire:model='countryname' wire:keyup="filterSetting"
                                        placeholder="Search country Name" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_meheram">{{ __('tablevars.visa') }}
                                        {{ __('tablevars.type') }}</label>
                                    <input type="text" name="visa_name" id="visa_name" class="form-control"
                                        wire:model='visa_name' wire:keyup="filterSetting" placeholder="Search Visa Type"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.visa') }} {{ __('tablevars.list') }}</h4>
                            <a href="{{ route('admin.visaMaster.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.Country Name') }} </th>
                                            <th>{{ __('tablevars.Visa Type') }} </th>
                                            {{-- <th>{{ __('tablevars.Visa Rate') }}</th> --}}
                                            <th>{{ __('tablevars.status') }} </th>
                                            <th>{{ __('tablevars.action') }} </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($VisaTypes as $key => $visatype)
                                            <tr>
                                                <td>{{ $key + $VisaTypes->firstItem() }}</td>
                                                <td>{{ $visatype->country->countryname ?? '' }}</td>
                                                <td>{{ $visatype->visa_name ?? '' }}</td>
                                                {{-- <td>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#viewDateModal"
                                                       wire:click="getDateModalContent({{ $visatype->id }})"
                                                       data-toggle="tooltip" title="View"><i class="fas fa-eye"></i></a>
                                                </td> --}}
                                                <td>
                                                    <div class="pointer badge badge-{{ $visatype->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $visatype->id }})">
                                                        {{ $visatype->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.visaMaster.edit', $visatype->id) }}"
                                                                data-toggle="tooltip" class="text-danger" title="Edit"
                                                                wire:click='({{ $visatype->id }})'>Edit</a>
                                                            


                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                class="text-danger" data-bs-toggle="modal"
                                                                {{-- class="btn btn-icon btn-sm m-1 btn-primary" --}} data-bs-target="#viewModal"
                                                                wire:click="getModalContent({{ $visatype->id }})"
                                                                data-bs-target="#viewModal" data-toggle="tooltip"
                                                                title="View"><i></i>View</a>

                                                            <a  href="javascript:void(0)"
                                                                data-toggle="tooltip" class="dropdown-item text-danger"
                                                                title="Delete"
                                                                wire:click='isDelete({{ $visatype->id }})'>Trash</a>

                                                            <a href="javascript:void(0)" wire:click='isDupicate({{ $visatype->id }})'  class="dropdown-item">{{ 'Duplicate' }}</a>

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
                                    <select name="per_page" id="per_page" class="form-control" wire:model='perPage'
                                        wire:change='filterSetting'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $VisaTypes->links(data: ['scrollTo' => false]) }}
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
                    <h5 class="modal-title" id="viewModalLabel">{{ 'View Visa Master' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                    {{-- {{dd($modalData->visadetail);}} --}}
                        <table class="table table-striped sliding-table ">
                            <tr>
                                <th>{{ __('tablevars.Country Name') }}</th>
                                <td>{{ $modalData->country->countryname ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.Visa Type') }}</th>
                                <td>{{ $modalData->visa_name ?? '' }}</td>
                            </tr>
                            @foreach ($modalData->visadetail as $visadetail)
                                <tr>
                                    <th>{{ 'Entry Type' }}</th>
                                    <td>{{ $visadetail->entry_type ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ 'Visa Validity' }}</th>
                                    <td>{{ $visadetail->visa_validity ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ 'Visa Period Of Stay In Days' }}</th>
                                    <td>{{ $visadetail->stay_period ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ 'Visa Price' }}</th>
                                    <td>{{ $visadetail->visa_price ?? '' }}</td>
                                </tr>
                                @break
                            @endforeach

                            
                        
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

    <div wire:ignore.self class="modal fade" id="viewDateModal" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="viewDateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDateModalLabel">Visa Price</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                @if ($modalDateData)
                    <table class="table table-striped sliding-table">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Price (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modalDateData as $RsmodalDateData)
                                <tr>
                                    <td>{{ App\Helpers\Helper::getCanonicalDate($RsmodalDateData->start_date) ?? '' }}</td>
                                    <td>{{ App\Helpers\Helper::getCanonicalDate($RsmodalDateData->end_date) ?? '' }}</td>
                                    <td>{{ number_format($RsmodalDateData->visa_price,2) ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    {{ __('tablevars.loading') }}
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
            </div>
        </div>
    </div>
</div>
</div>

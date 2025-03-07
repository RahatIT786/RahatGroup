<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.hotel_inquary') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage-enquiry') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.hotelInquary.index') }}"
                        wire:navigate>{{ __('tablevars.hotel_inquary') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.list') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    {{-- <div class="card">
                        <div class="card-header">
                            <h4>Search</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <label class="label-header" for="service_type">
                                        {{ __('tablevars.service_type') }}</label>
                                    <input type="text" name="service_type" id="service_type" class="form-control"
                                        wire:model='serviceType' wire:keyup="filterManageEnquiry"
                                        placeholder="Search Service Type" autocomplete="off">
                                </div>

                                <div class="col-3">
                                    <label class="label-header" for="name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        wire:model='name' wire:keyup="filterManageEnquiry" placeholder="Search Name"
                                        autocomplete="off">
                                </div>


                            </div>
                        </div>
                    </div> --}}
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.hotel_inquary') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.name') }} </th>
                                            <th>{{ __('tablevars.hotel') }} </th>
                                            <th>{{ __('tablevars.country') }} </th>
                                            <th>{{ __('tablevars.mobile_number') }} </th>
                                            <th>{{ __('tablevars.message') }} </th>
                                            <th>{{ __('tablevars.action') }} </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($hotelEnquirys as $key => $hotelEnquiry)
                                            <tr>
                                                <td>{{ $key + $hotelEnquirys->firstItem() }}</td>
                                                <td>{{ $hotelEnquiry->cust_name ?? '-' }}</td>
                                                <td>{{ $hotelEnquiry->hotel->hotel_name ?? '-' }}</td>
                                                <td>{{ $hotelEnquiry->country_name ?? '-' }}</td>
                                                <td>{{ $hotelEnquiry->mob_num ?? '-' }}</td>
                                                <td>{{ $hotelEnquiry->message ?? '-' }}</td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                wire:click='isDelete({{ $hotelEnquiry->id }})'>Trash</a> 
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" align="center" class="v-msg">
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
                                        wire:change='filterManageEnquiry'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $hotelEnquirys->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

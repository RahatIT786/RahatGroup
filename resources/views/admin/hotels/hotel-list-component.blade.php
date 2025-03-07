<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.hotel') }} {{ __('tablevars.list') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.hotel.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.hotel') }}
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
                                    <label class="label-header" for="search_hotel">{{ __('tablevars.hotel') }}</label>
                                    <input type="text" name="search_hotel" id="search_hotel" class="form-control"
                                        wire:model='search_hotel' placeholder="Search Hotel Name" autocomplete="off"
                                        wire:keyup="filterHotel">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_city">{{ __('tablevars.city') }}</label>
                                    <input type="text" name="search_city" id="search_city" class="form-control"
                                        wire:model='search_city' placeholder="Search City Name" autocomplete="off"
                                        wire:keyup="filterHotel">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.hotel') }} {{ __('tablevars.list') }}</h4>
                            <a href="{{ route('admin.hotel.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.hotel') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.star') }} {{ __('tablevars.rating') }}</th>
                                            <th>{{ __('tablevars.city') }}</th>
                                            <th>{{ __('tablevars.distance') }}</th>
                                            <th>{{ __('tablevars.contact') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Hotels as $key => $hotel)
                                            <tr>
                                                <td>{{ $key + $Hotels->firstItem() }}</td>
                                                <td>{{ $hotel->hotel_name ?? '---' }}</td>
                                                <td>{{ $hotel->star_rating ?? '---' }}</td>
                                                <td>{{ $hotel->city->city_name ?? '---' }}</td>
                                                <td>{{ $hotel->distance ?? '---' }}</td>
                                                <td>{{ $hotel->contact ?? '---' }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $hotel->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $hotel->id }})">
                                                        {{ $hotel->is_active == 1 ? 'Active' : 'Inactive' }}
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

                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#viewModal"
                                                                data-toggle="tooltip" title="View"
                                                                wire:click="getModalContent({{ $hotel->id }})">View</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.hotel.edit', $hotel->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit">Edit</a>

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                wire:click='isDelete({{ $hotel->id }})'>{{ __('tablevars.trash') }}</a>
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
                                        wire:change='filterHotel'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Hotels->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view') }} {{ __('tablevars.hotel') }}
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.hotel') }} {{ __('tablevars.name') }}</th>
                                <td>{{ $modalData->hotel_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.star') }} {{ __('tablevars.rating') }}</th>
                                <td>{{ $modalData->star_rating ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.city') }}</th>
                                <td>{{ $modalData->city->city_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.distance') }}</th>
                                <td>{{ $modalData->distance ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.contact') }}</th>
                                <td>{{ $modalData->contact ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.high_season_price') }}</th>
                                <td>{{ number_format($modalData->high_season_price ?? '---') }}.00</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.medium_season_price') }}</th>
                                <td>{{ number_format($modalData->medium_season_price ?? '---') }}.00</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.low_season_price') }}</th>
                                <td>{{ number_format($modalData->low_season_price ?? '---') }}.00</td>
                            </tr>
                            {{-- <tr>
                            <th>{{ __('tablevars.flight_logo') }}</th>
                            <td> <img src="{{ asset('/storage/flight_image/' . $modalData->flight_logo) }}" alt="Flight Image" style="height: 100px;border-radius: 10px;"></td>
                        </tr> --}}

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
</div>

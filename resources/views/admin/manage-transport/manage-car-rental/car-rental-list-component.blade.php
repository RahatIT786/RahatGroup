<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.car_rental') }}</h1>
            <div class="section-header-button">
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.car_rental') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manageCarRental.index') }}"
                        wire:navigate>{{ __('tablevars.car_rental') }}</a></div>
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
                                    <label class="label-header" for="car_type">{{ __('tablevars.cartype') }}</label>
                                    <input type="text" name="car_type" id="car_type" class="form-control"
                                        placeholder="Search Car Type" autocomplete="off" wire:model="car_type"
                                        wire:keyup="filterCars">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.car_rental') }} {{ __('tablevars.list') }}</h4>

                            <a href="{{ route('admin.manageCarRental.create') }}" class="btn btn-primary"
                                title="Add New cars">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.cartype') }}</th>
                                            <th>{{ __('tablevars.car_sector') }}</th>
                                            <th>{{ __('tablevars.no_of_seats') }}</th>
                                            <th>{{ __('tablevars.price') }} ( &#xFDFC; )</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Cars as $key => $car)
                                            <tr>
                                                <td>{{ $key + $Cars->firstItem() }}</td>
                                                <td>{{ $car->cartypemaster->car_type ?? '' }}</td>
                                                <td>{{ $car->carsectormaster->sector_name ?? '' }}</td>
                                                <td>{{ $car->no_of_seats ?? '' }}</td>
                                                <td>{{ number_format($car->price, 2) }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $car->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $car->id }})">
                                                        {{ $car->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                                wire:click='getModalContent({{ $car->id }})'
                                                                data-toggle="tooltip" title="View">View</a>

                                                            <a class="dropdown-item" data-toggle="tooltip"
                                                                href="{{ route('admin.manageCarRental.edit', $car->id) }}"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Delete"
                                                                wire:click='isDelete({{ $car->id }})'>{{ __('tablevars.trash') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" align="center" class="v-msg">
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
                                    <select name="per_page" id="per_page" wire:model='perPage' class="form-control"
                                        wire:change='filterCars'>
                                        @foreach (App\Helpers\Helper::getPerPageOptions() as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Cars->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--View Modal -->
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div style="max-width: 1000px;" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Cars</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.cartype') }}</th>
                                <td>{{ $modalData->cartypemaster->car_type ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.car_sector') }}</th>
                                <td>{{ $modalData->carsectormaster->sector_name ?? '' }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('tablevars.no_of_seats') }}</th>
                                <td>{{ $modalData->no_of_seats ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.price') }}</th>
                                <td>₹{{ number_format($modalData->price ?? '---') }}.00</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.air_conditioner') }}</th>
                                <td>
                                    @if ($modalData->air_conditioner == '1')
                                        Yes
                                    @elseif ($modalData->air_conditioner == '2')
                                        No
                                    @else
                                        {{ $modalData->air_conditioner }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.terms') }}</th>
                                <td>{!! $modalData->terms !!}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.description') }}</th>
                                <td>{!! $modalData->description !!}</td>
                            </tr>
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

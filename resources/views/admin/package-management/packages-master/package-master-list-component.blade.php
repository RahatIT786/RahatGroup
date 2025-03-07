<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ 'Package Master' }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ 'Package Management' }}</div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.packageMaster.index') }}"
                    wire:navigate>{{ __('tablevars.package') }} {{ 'Package Master' }}</a></div>
                <div class="breadcrumb-item active">{{ 'All Package Master' }}</div>
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
                                    <label class="label-header" for="search_meheram">{{ 'Dept Date' }}</label>
                                    <input type="date" name="dept_date" wire:model='dept_date' id="dept_date" class="form-control" placeholder="Search Package Name" autocomplete="off" wire:change="filterPackage">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_meheram">{{ 'Package Type' }}</label>
                                    <select class="form-control" name='package_type' id="package_type" wire:model="package_type" wire:change="filterPackage">
                                        <option value="">Select Package Type</option>
                                        @foreach ($package as $id => $package_type)
                                            <option value="{{$package_type}}">{!! $package_type !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_meheram">{{ 'City' }}</label>
                                    <select class="form-control" name='city_id' id="city_id" wire:model="city_id" wire:change="filterPackage">
                                        <option value="">Select City </option>
                                        @foreach ($city as $id => $city_name)
                                            <option value="{{$id}}">{!! $city_name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ 'Package Master' }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.package') }}</th>
                                            <th>{{ __('tablevars.group_name') }}</th>
                                            <th>{{ __('tablevars.dept_date') }}</th>
                                            <th>{{ __('tablevars.quint_price') }}  ( {{ Aihut::get('currency') }} )</th>
                                            <th>{{ __('tablevars.quad_price') }}  ( {{ Aihut::get('currency') }} )</th>
                                            <th>{{ 'Triple Price' }}  ( {{ Aihut::get('currency') }} )</th>
                                            <th>{{ 'Double Price' }}  ( {{ Aihut::get('currency') }} )</th>
                                            <th>{{ 'Child+Bed Price' }}  ( {{ Aihut::get('currency') }} )</th>
                                            <th>{{ 'Child Price' }}  ( {{ Aihut::get('currency') }} )</th>
                                            <th>{{ 'Infant Price' }}  ( {{ Aihut::get('currency') }} )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($packages as $package)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $package->package_name }} &nbsp; {{ $package->package_type }}</td>
                                                <td>{{ $package->group_name }}</td>
                                                <td>{{ App\Helpers\Helper::getCanonicalDate($package->dept_date) }}</td>
                                                <td>{{ number_format($package->quint_price, 2) }}</td>
                                                <td>{{ number_format($package->quad_price, 2) }}</td>
                                                <td>{{ number_format($package->triple_price, 2) }}</td>
                                                <td>{{ number_format($package->double_price, 2) }}</td>
                                                <td>{{ number_format($package->childbed_price, 2) }}</td>
                                                <td>{{ number_format($package->child_price, 2) }}</td>
                                                <td>{{ number_format($package->infant_price, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" align="center" class="v-msg">
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
                                    <select name="per_page" id="per_page" class="form-control" wire:model='perPage' wire:change='filterPackage'>
                                        @foreach (Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $packages->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- View Modal  -->
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ 'View Package Master' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.package_name') }}</th>
                                <td>{{ $modalData->package_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.pkg_type') }}</th>
                                <td>{{ $modalData->package_type }}</td>
                            </tr>
                            <tr>
                                <th>{{ 'Makka Hotel Category' }}</th>
                                @if($modalData->makka_rating == 1)
                                    <td>{{ 'One Star' }}</td>
                                @elseif($modalData->makka_rating == 2)
                                    <td>{{ 'Two Star' }}</td>
                                @elseif($modalData->makka_rating == 3)
                                    <td>{{ 'Three Star' }}</td>
                                @elseif($modalData->makka_rating == 4)
                                    <td>{{ 'Four Star' }}</td>
                                @elseif($modalData->makka_rating == 5)
                                    <td>{{ 'Five Star' }}</td>
                                @elseif($modalData->makka_rating == 'Standard Hotel')
                                    <td>{{ 'Standard Hotel' }}</td>
                                @elseif($modalData->makka_rating == 'Building Accommodation')
                                    <td>{{ 'Building Accommodation' }}</td>
                                @else
                                    <td>{{ '-' }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.makka_hotel') }}</th>
                                <td>{{ $modalData->makkahotel->hotel_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ 'Madina Hotel Category' }}</th>
                                @if($modalData->madina_rating == 1)
                                    <td>{{ 'One Star' }}</td>
                                @elseif($modalData->madina_rating == 2)
                                    <td>{{ 'Two Star' }}</td>
                                @elseif($modalData->madina_rating == 3)
                                    <td>{{ 'Three Star' }}</td>
                                @elseif($modalData->madina_rating == 4)
                                    <td>{{ 'Four Star' }}</td>
                                @elseif($modalData->madina_rating == 5)
                                    <td>{{ 'Five Star' }}</td>
                                @elseif($modalData->madina_rating == 'Standard Hotel')
                                    <td>{{ 'Standard Hotel' }}</td>
                                @elseif($modalData->madina_rating == 'Building Accommodation')
                                    <td>{{ 'Building Accommodation' }}</td>
                                @else
                                    <td>{{ '-' }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.madina_hotel') }}</th>
                                <td>{{ $modalData->madinahotel->hotel_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ 'Package Includes' }}</th>
                                <td>{{ $modalData->package_includes }}</td>
                            </tr>
                            <tr>
                                <th>{{ 'Laundry Type' }}</th>
                                <td>{{ $modalData->lundrytype->lundray_type ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>{{ 'Food Type' }}</th>
                                <td>{{ $modalData->foodType->food_type ?? '-' }}</td>
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

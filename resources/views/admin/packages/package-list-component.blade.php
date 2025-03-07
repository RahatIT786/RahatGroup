<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ 'Package Master' }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ 'Package Master' }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.package.index') }}">{{ __('tablevars.package') }}
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
                                    <label class="label-header" for="search_meheram">{{ 'Package Name' }}</label>
                                    <input type="text" name="package_name" wire:model='package_name'
                                        id="package_name" class="form-control" placeholder="Search Package Name"
                                        autocomplete="off" wire:keyup="filterPackage">
                                </div>
                                {{-- <div class="col-3">
                                    <label class="label-header" for="search_meheram">{{ 'Service Type' }}</label>
                                    <input type="text" name="package_type" id="package_type" class="form-control"
                                        placeholder="Search Service Type" autocomplete="off" wire:model='package_type'
                                        wire:keyup="filterPackage">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ 'Package Master' }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ route('admin.package.create') }}"
                                    class="btn btn-primary">{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                                {{-- <a style="color: white" class="btn btn-warning"><i class="fas fa-print"></i> Print</a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.package_name') }}</th>
                                            {{-- <th>{{ __('tablevars.pkg_type') }}</th> --}}
                                            <th>{{ __('tablevars.service') }}</th>
                                            <th>{{ __('tablevars.image') }}</th>
                                            {{-- <th>{{ __('tablevars.makka_hotel') }}</th>
                                            <th>{{ __('tablevars.madina_hotel') }}</th>
                                            <th>{{ __('tablevars.food_type') }}</th> --}}
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($packages as $key => $package)
                                            <tr>
                                                <td>{{ $key + $packages->firstItem() }}</td>
                                                <td>{{ $package->name }}</td>


                                                <td>{{ $package->serviceType->name }}</td>
                                                <td class="p-2">
                                                    {{-- <div class="gallery gallery-md">
                                                        <div class="gallery-item" data-image="{{ asset('/storage/package_image/' . $package->image) }}" data-title="{{ $package->image }}">
                                                        </div>
                                                    </div> --}}
                                                    @if (count($package->pkgImages) != 0)
                                                        <img src="{{ asset('/storage/package_image/' . $package->pkgImages[0]->pkg_img) }}"
                                                            style="height: 100px; border-radius: 10px;width: 150px;">
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $package->pkgDetails[0]->makkahotel->hotel_name ?? '' }}</td>
                                                <td>{{ $package->pkgDetails[0]->madinahotel->hotel_name ?? '' }}</td>
                                                <td>{{ $package->food_type_master->food_type ?? '' }}</td> --}}
                                                <td>
                                                    <div class="pointer badge badge-{{ $package->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $package->id }})">
                                                        {{ $package->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                wire:click="getPackageContent({{ $package->id }})"
                                                                data-bs-target="#PackageModal"
                                                                data-bs-toggle="modal">View</a>

                                                            {{-- <div class="dropdown-divider"></div> --}}

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.package.edit', $package->id) }}">Edit</a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger"
                                                                wire:click='isDelete({{ $package->id }})'>{{ __('tablevars.trash') }}</a>
                                                            {{-- <a href="javascript:void(0)"
                                                                wire:click='isDupicate({{ $package->id }})'
                                                                class="dropdown-item">{{ 'Duplicate' }}</a> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" align="center" class="v-msg">
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
                                        wire:change='filterPackage'>
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
                            @if ($modalData->service_id == 1)
                                <tr>
                                    <th>{{ 'Makka Hotel Category' }}</th>
                                    @if ($modalData->makka_rating == 1)
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
                            @endif
                            @if ($modalData->service_id == 2)
                                <tr>
                                    <th>MOULLIM Number</th>
                                    <td>{{ $modalData->moullim_no }}</td>
                                </tr>
                            @endif
                            @if ($modalData->service_id == 3)
                                <tr>
                                    <th>Stay</th>
                                    <td>
                                        @if ($modalData->stay_id == 1)
                                            Hotel Stay
                                        @endif
                                        @if ($modalData->stay_id == 2)
                                            Astana Stay
                                        @endif
                                    </td>
                                </tr>
                            @endif
                            @if ($modalData->service_id == 1)
                                <tr>
                                    <th>{{ __('tablevars.makka_hotel') }}</th>
                                    <td>{{ $modalData->makkahotel->hotel_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ 'Madina Hotel Category' }}</th>
                                    @if ($modalData->madina_rating == 1)
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
                                    <td>{{ $modalData->madinahotel->hotel_name ?? '' }}</td>
                                </tr>
                            @endif
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

    <div wire:ignore.self class="modal fade" id="PackageModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="PackageModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PackageModal">Package Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>


                <div class="modal-body">
                    <div class="card">
                        {{-- <div class="card-header">
                        <h4>Flush</h4>
                    </div> --}}
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($package_modal_data)

                                        @foreach ($package_modal_data as $package_data)
                                            <div id="accordion" class="col-12">
                                                <div class="accordion">
                                                    <div class="accordion-header collapsed" role="button"
                                                        data-toggle="collapse"
                                                        data-target="#panel-body-{{ $package_data->pkg_type_id }}"
                                                        aria-expanded="false">
                                                        <h4>{{ $package_data != '' ? $package_data->packageType->package_type : 'N/A' }}
                                                        </h4>

                                                    </div>
                                                    <div class="accordion-body collapse"
                                                        id="panel-body-{{ $package_data->pkg_type_id }}"
                                                        data-parent="#accordion" style="">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Makka Hotel</label>
                                                                    <div>
                                                                        {{ $package_data->makkahotel->hotel_name ?? '' }}
                                                                    </div>
                                                                    <div>Rating:
                                                                        {{ $package_data->makkahotel->star_rating ?? '' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Madina Hotel</label>
                                                                    <div>
                                                                        {{ $package_data->madinahotel->hotel_name ?? '' }}
                                                                    </div>
                                                                    <div>Rating:
                                                                        {{ $package_data->madinahotel->star_rating ?? '' }}
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Meal Type</label>
                                                                    <div>
                                                                        {{ $package_data->mealType->packagetype->package_type ?? '' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Laundry Type</label>
                                                                    <div>
                                                                        {{ $package_data->laundrytype->lundray_type ?? '' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Sharing Rate</label>
                                                                    <div> {{ $package_data->g_share ?? '' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Quint</label>
                                                                    <div> {{ $package_data->qt_share ?? '' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Quad</label>
                                                                    <div> {{ $package_data->qd_share ?? '' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Triple</label>
                                                                    <div> {{ $package_data->t_share ?? '' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Double</label>
                                                                    <div> {{ $package_data->d_share ?? '' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Single</label>
                                                                    <div> {{ $package_data->single ?? '' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Chlid With Bed</label>
                                                                    <div> {{ $package_data->child_with_bed ?? '' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Chlid Without Bed</label>
                                                                    <div> {{ $package_data->chlid_no_bed ?? '' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Infant</label>
                                                                    <div> {{ $package_data->infant ?? '' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <label>Infant</label>
                                                                    <div> {{ $package_data->package_includes ?? '' }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5>
                                                    Description
                                                </h5>
                                            </div>
                                            <div class="col-md-12">
                                                {{ $selected_pkg->description }}
                                            </div>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>

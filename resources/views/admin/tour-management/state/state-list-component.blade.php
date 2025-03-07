<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.tour_state') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.tour_package_management') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.state.index') }}"
                        wire:navigate>{{ __('tablevars.tour_state') }}</a></div>
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
                                        for="">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="name" id="search_foodtype"
                                        class="form-control" placeholder="Search name" autocomplete="off"
                                        wire:model="search_name" wire:keyup="filterTourPackage">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.tour_package') }} {{ __('tablevars.list') }}</h4>

                            <a href="{{ route('admin.destination.create') }}" class="btn btn-primary"
                                title="Add New Tour">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div> --}}

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.image') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tourstates as $key => $tourstate)
                                            <tr>
                                                <td>{{ $key + $tourstates->firstItem() }}</td>
                                                <td>{{ $tourstate->name ?? ''}}</td>

                                                <td class="p-2">
                                                    <img src="{{ asset('/storage/state_img/' . $tourstate->image) }}"
                                                        style="height: 100px; border-radius: 10px;width: 150px;">
                                                </td>

                                                <td>
                                                    <div style="cursor:pointer;"
                                                        class="pointer badge badge-{{ $tourstate->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $tourstate->id }})">
                                                        {{ $tourstate->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                                {{-- {{dd($tourstate->name)}} --}}
                                                {{-- <td>{{ number_format($foodtype->price , 2) }}</td> --}}
                                                {{-- <td>
                                                    <div class="pointer badge badge-{{ $tourpackage->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $tourpackage->id }})">
                                                        {{ $tourpackage->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">



                                                            <a class="dropdown-item" data-toggle="tooltip"
                                                                href="{{ route('admin.state.edit', $tourstate->id) }}"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>




                                                            {{-- <a href="javascript:void(0)" data-toggle="tooltip"
                                                                title="Duplicate"
                                                                wire:click='isDupicate({{ $tourpackage->id }})'
                                                                class="dropdown-item">{{ 'Duplicate' }}</a> --}}

                                                                <a href="javascript:void(0)"
                                                                data-toggle="tooltip" class="dropdown-item text-danger"
                                                                title="Delete"
                                                                wire:click='isDelete({{ $tourstate->id }})'>{{ __('tablevars.trash') }}</a>
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
                                    <select name="per_page" id="per_page" wire:model='perPage' class="form-control"
                                        wire:change='filterTourPackage'>
                                        @foreach (App\Helpers\Helper::getPerPageOptions() as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $tourstates->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!--View Modal -->


</div>

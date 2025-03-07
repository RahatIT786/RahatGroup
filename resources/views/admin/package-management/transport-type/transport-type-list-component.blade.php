<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.transport_type') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.transportType.index') }}"
                        wire:navigate>{{ __('tablevars.transport_type') }}</a></div>
                
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
                                        for="search_transport_type">{{ __('tablevars.transport_type') }}</label>
                                    <input type="text" name="search_transport_type" id="search_transport_type" class="form-control"
                                        placeholder="Search Transport Type" autocomplete="off" wire:model="search_transport_type" wire:keyup="filterTransportType">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.transport_type') }} {{ __('tablevars.list') }}</h4>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#crudModal" wire:click='resetForm'
                                class="btn btn-icon btn-sm m-1 btn-primary" data-toggle="tooltip"
                                title="Add New Transport Type ">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.transport_type') }}</th>
                                            <th>{{ __('tablevars.price') }} ( {{ Aihut::get('currency') }} )</th>                     
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transportTypes as $key => $transportType)
                                            <tr>
                                                <td>{{ $key + $transportTypes->firstItem() }}</td>
                                                <td>{{ App\Helpers\Helper::textCut($transportType->transport_type) }}</td>
                                                {{-- <td>{{ $transportType->transport_type }}</td> --}}
                                                <td>{{ number_format($transportType->price,2) }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $transportType->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $transportType->id }})">
                                                        {{ $transportType->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#crudModal" wire:click.prevent="edit({{ $transportType->id }})"data-toggle="tooltip"
                                                                title="Edit">Edit</a>

                                                                <a href="javascript:void(0)"
                                                                data-toggle="tooltip" class="dropdown-item text-danger"
                                                                title="Delete" 
                                                                wire:click='isDelete({{ $transportType->id }})'>{{ __('tablevars.trash') }}</a>
                                                                    
                                                                <a href="javascript:void(0)" wire:click='isDupicate({{ $transportType->id }})' title="Duplicate"  class="dropdown-item">{{ 'Duplicate' }}</a>

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
                                    <select name="per_page" id="per_page" class="form-control" wire:model='perPage'  wire:change='filterTransportType'>                                    
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $transportTypes->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CRUD Modal -->
    <div wire:ignore.self class="modal fade" id="crudModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <form wire:submit.prevent="{{ $is_edit ? 'update' : 'save' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crudModalLabel">{{ $is_edit ? __('tablevars.edit_transport_types') : __('tablevars.add_transport_types')  }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('tablevars.transport_type') }}</label><span
                                        class="text-danger">*</span>
                                    <input type="text" name="transport_type" class="form-control" wire:model="transport_type"
                                        placeholder="Enter {{ __('tablevars.transport_type') }}" maxlength="50">
                                    @error('transport_type')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>     

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('tablevars.price') }}</label><span
                                        class="text-danger">*</span>
                                    <input type="text" name="price" class="form-control" wire:model="price"
                                        placeholder="Enter {{ __('tablevars.price') }}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="7">
                                    @error('price')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ $is_edit ? __('tablevars.update') : __('tablevars.save')  }}</button>
                        <button type="button" class="btn btn-dark"
                            data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

     <!--View Modal -->
     <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view_transport_types') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.transport_type') }}</th>
                                <td>{{ $modalData->transport_type }}</td>
                            </tr>   
                            
                            <tr>
                                <th>{{ __('tablevars.price') }}</th> 
                                <td>{{ $modalData->price }}</td>
                            </tr> 
                            
                            <tr>
                                <th>{{ __('tablevars.status') }}</th>
                                <td>
                                    <div class="badge badge-{{ $modalData->is_active == 1 ? 'primary' : 'danger' }}">
                                        {{ $modalData->is_active == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @else
                        Loading...
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
@push('extra_scripts')
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.laundry') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.packageType.index') }}"
                        wire:navigate>{{ __('tablevars.laundry_type') }}</a></div> 
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
                                        for="search_laundrytype">{{ __('tablevars.laundry_type') }}</label>
                                    <input type="text" name="search_laundrytype" id="search_laundrytype" class="form-control"
                                        placeholder="Search Laundry Type" autocomplete="off" wire:model="search_laundrytype" wire:keyup="filterLaundryTypes">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.laundry_type') }} {{ __('tablevars.list') }}</h4>
                            <a href="" data-bs-toggle="modal" data-bs-target="#crudModal" wire:click='resetForm'
                                class="btn btn-icon btn-sm m-1 btn-primary" data-toggle="tooltip"
                                title="Add New laundary Type">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.laundry_type') }}</th>
                                            <th>{{ __('tablevars.price') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($laundrytypes as $key => $laundrytype)
                                            <tr>
                                                <td>{{ $key + $laundrytypes->firstItem() }}</td>
                                                <td>{{ App\Helpers\Helper::textCut($laundrytype->lundray_type) }}</td>
                                                <td>{{ $laundrytype->price }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $laundrytype->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $laundrytype->id }})">
                                                        {{ $laundrytype->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                data-bs-target="#crudModal" wire:click.prevent="edit({{ $laundrytype->id }})"data-toggle="tooltip"
                                                                title="Edit">Edit</a>

                                                                <a href="javascript:void(0)"
                                                                data-toggle="tooltip" class="dropdown-item text-danger"
                                                                title="Delete" 
                                                                wire:click='isDelete({{ $laundrytype->id }})'>{{ __('tablevars.trash') }}</a>

                                                                <a href="javascript:void(0)" wire:click='isDupicate({{ $laundrytype->id }})'  title="Duplicate"   class="dropdown-item">{{ 'Duplicate' }}</a>

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
                                    <select name="per_page" id="per_page" class="form-control" wire:model='perPage'  wire:change='filterLaundryTypes'>                                    
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $laundrytypes->links(data: ['scrollTo' => false]) }}
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
                        <h5 class="modal-title" id="crudModalLabel">{{ $is_edit ? __('tablevars.edit_laundry_type') : __('tablevars.add_laundry_type')  }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('tablevars.laundry_type') }}</label><span
                                        class="text-danger">*</span>
                                    <input type="text" name="lundray_type" class="form-control" wire:model="lundray_type"
                                        placeholder="Enter {{ __('tablevars.laundry_type') }}"  maxlength="30">
                                    @error('lundray_type')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>     
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('tablevars.price') }}</label><span
                                        class="text-danger">*</span>
                                    <input type="text" name="price" class="form-control" wire:model="price"
                                        placeholder="Enter {{ __('tablevars.price') }}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
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
                 <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view_laundry_type') }}</h5>
                 <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                         aria-hidden="true">×</span></button>
             </div>
             <div class="modal-body">
                 @if ($modalData)
                     <table class="table table-striped">
                         <tr>
                             <th>{{ __('tablevars.laundry_type') }}</th>
                             <td>{{ $modalData->lundray_type }}</td>
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

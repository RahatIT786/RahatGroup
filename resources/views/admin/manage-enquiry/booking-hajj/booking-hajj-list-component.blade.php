<div class="main-content">
<div wire:loading>
        <div  style="display: flex; justify-content: center; align-items: center; background-color: black; position:fixed; top: 0px; left:0px; z-index:9999; width: 100%; height:100%; opacity:.75;">
            <div class="la-ball-fussion la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.Bookingfor_hajj') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageEnquiry') }}
                    
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.bookinghajj.index') }}"
                        wire:navigate>{{ __('tablevars.Bookingfor_hajj') }}</a></div>
                
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
                                        for="search_name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_name" id="search_name"
                                        class="form-control" wire:model='search_name' placeholder="Search name" autocomplete="off" wire:keyup="filterBookinghajj">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.Bookingfor_hajj') }} </h4>
                           
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.category') }}</th>
                                            <th>{{ __('tablevars.packagetype') }} </th>
                                         <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.email') }}</th>
                                            <th>{{ __('tablevars.phone') }}</th>
                                            <th>{{ __('tablevars.traveldate') }}</th> 
                                            <th>{{ __('tablevars.food') }}</th> 
                                            <th>{{ __('tablevars.visa') }}</th> 
                                            <th>{{ __('tablevars.airticket') }}</th> 
                                            <th>{{ __('tablevars.support_team') }}</th> 
                                            <th>{{ __('tablevars.action') }}</th> 
                                            <th>{{ __('tablevars.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @forelse ($Bookinghajj as $key => $bookinghajj) 
                                        <tr>
                                        <td>{{ $key + $Bookinghajj->firstItem() }}</td>
                                        <td>{{ $bookinghajj->servicetype->name ?? '-' }}</td>
                                                    <td>{{ $bookinghajj->packagemaster->package_name ?? '' }}</td>
                                                    <td>{{ $bookinghajj->cust_name ?? '' }}</td>
                                                    <td>{{ $bookinghajj->cust_email ?? '' }}</td>
                                                    <td>{{ $bookinghajj->cust_num ?? '' }}</td>
                                                    <td>{{ $bookinghajj->travel_date ?? '' }}</td>
                                                    <td >{{ $bookinghajj->food ?? ' - ' }}</td>
                                                    <td >{{ $bookinghajj->visa ?? ' - ' }}</td>
                                                    <td >{{ $bookinghajj->air_ticket ?? ' - ' }}</td>
                                                    <td >{{ $bookinghajj->support_team ?? ' - ' }}</td>
                                                    
                                                    <td>
                                                    <div style="cursor:pointer;" class="pointer badge badge-{{ $bookinghajj->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $bookinghajj->id }})">
                                                        {{ $bookinghajj->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                            <td>
                                                                <div class="ticket-grp mb-2 has-submenu">
                                                                    <button
                                                                        class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"><i
                                                                            class="fas fa-cog" data-toggle="tooltip"
                                                                            title="Options"></i></button>
                                                                    <div class="dropdown-menu"
                                                                        x-placement="bottom-start"
                                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                        <!-- <a href="javascript:void(0)"
                                                                            data-bs-toggle="modal" class="dropdown-item"
                                                                            data-bs-target="#viewModal"
                                                                            data-toggle="tooltip"
                                                                            title="View">View</a> -->
                                                                            
                                                                            <a class="dropdown-item"
                                                                            href="{{ route('admin.bookinghajj.edit', $bookinghajj->id) }}" data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                                data-toggle="tooltip"
                                                                            title="Edit">{{ __('tablevars.edit') }}</a>

                                                                           
                                                                            <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                                            data-toggle="tooltip" class="text-danger"
                                                                                title="Trash" 
                                                            wire:click='isDelete({{ $bookinghajj->id }})'>Trash</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                        </tr>
                                    @empty
                                            <tr>
                                                <td colspan="10" align="center" class="v-msg text-danger">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse 
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control">
                                  wire:model='perPage' wire:change='filterBookinghajj'> 
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            {{ $Bookinghajj->links(data: ['scrollTo' => false]) }} 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    
    
</div>



<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.city') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.city') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.city.index') }}"
                        wire:navigate>{{ __('tablevars.city') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.city') }}
                    {{ __('tablevars.list') }}</div>
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
                                    <label class="label-header" for="search_city">{{ __('tablevars.city') }}</label>
                                    <input type="text" name="search_city" id="search_city" class="form-control"
                                        wire:model='search_city' wire:keyup="filterCity" placeholder="Search City"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.city') }} {{ __('tablevars.list') }}</h4>
                            {{-- <a href="javascript:void(0)" data-bs-toggle="modal"
                                class="btn btn-icon btn-sm m-1 btn-primary" data-bs-target="#addModal"
                                data-toggle="tooltip" title="Add Category Page">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a> --}}

                            <button data-bs-toggle="modal" data-bs-target="#crudModal" class="btn btn-primary"
                                wire:click='resetForm'>{{ __('tablevars.add_new') }}</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.country') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.city') }} {{ __('tablevars.name') }}</th>
                                            {{-- <th>{{ __('tablevars.status') }}</th> --}}
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Cities as $key => $city)
                                            <tr>
                                                <td>{{ $key + $Cities->firstItem() }}</td>
                                                <td>{{ $city->country->countryname ?? '---' }}</td>
                                                <td>{{ $city->city_name ?? '---' }}</td>
                                                {{-- <td>
                                                    <div
                                                        class="badge badge-{{ $city->is_active == 1 ? 'primary' : 'danger' }}">
                                                        {{ $city->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                wire:click.prevent="edit({{ $city->id }})"
                                                                data-bs-toggle="modal" data-bs-target="#crudModal"
                                                                data-toggle="tooltip" title="">Edit</a>

                                                                <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger"
                                                                wire:click='isDelete({{ $city->id }})'>{{ __('tablevars.trash') }}</a>
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
                                    <select name="per_page" id="per_page" class="form-control"wire:model='perPage'
                                        wire:change='filterCity'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Cities->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div wire:ignore.self class="modal fade" id="crudModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <form wire:submit.prevent="{{ $is_edit ? 'update' : 'save' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crudModalLabel">
                            {{ __('tablevars.city') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('tablevars.country') }}</label><span class="text-danger">*</span>
                                    <select class="form-control" name='country_id' id="country_id"
                                        wire:model='country_id'>
                                        <option value="">Country Name</option>
                                        @foreach ($country as $CountryId => $CountryName)
                                            <option value="{{ $CountryId }}">{{ $CountryName }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('tablevars.city') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="city_name"
                                        wire:model="city_name" id="city_name" placeholder="Please enter city name" maxlength="70">
                                    @error('city_name')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-dark"
                            data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

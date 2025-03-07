<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.site_bank_info') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.finance') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.siteBankInfo.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.site_bank_info') }}
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
                                    <label class="label-header"
                                        for="search_bank_name">{{ __('tablevars.bank_name') }}</label>
                                    <input type="text" name="search_bank_name" id="search_bank_name" class="form-control"
                                        wire:model='search_bank_name' wire:keyup="filterSiteBankInfo" placeholder="Search Bank Name"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.site_bank_info') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ route('admin.siteBankInfo.create') }}" data-toggle="tooltip" title="Add New" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.bank_name') }}</th>
                                            <th>{{ __('tablevars.account_number') }}</th>
                                            <th>{{ __('tablevars.bank_address') }}</th>
                                            <th>{{ __('tablevars.ifsc_code') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bankDetails as $key => $detail)
                                            <tr>
                                                <td>{{ $key + $bankDetails->firstItem() }}</td>
                                                <td>{{ $detail->bank_name ?? '---' }}</td>
                                                <td>{{ $detail->account_number ?? '---' }}</td>
                                                <td>{{ $detail->bank_address ?? '---' }}</td>
                                                <td>{{ $detail->ifsc_code ?? '---' }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $detail->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $detail->id }})">
                                                        {{ $detail->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                            {{-- <a class="dropdown-item"
                                                                href="{{ route('admin.bankDetails.edit', $detail->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit">Edit</a> --}}
                                                                <a class="dropdown-item"
                                                                href="{{ route('admin.siteBankInfo.edit', $detail->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit">Edit</a>

                                                                <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger" data-toggle="tooltip" title="Trash"
                                                                wire:click='isDelete({{ $detail->id }})'>{{ __('tablevars.trash') }}</a>
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
                                    <select name="per_page" id="per_page" class="form-control"wire:model='perPage'
                                        wire:change='filterSiteBankInfo'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $bankDetails->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


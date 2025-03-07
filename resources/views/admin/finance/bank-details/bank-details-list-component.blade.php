<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.bank_details') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.finance') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.bankDetails.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.bank_details') }}
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
                                        for="search_company">{{ __('tablevars.company') }}</label>
                                    <input type="text" name="search_company" id="search_company" class="form-control"
                                        wire:model='search_company' wire:keyup="filterBank" placeholder="Search Company"
                                        autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_bank">{{ __('tablevars.bank') }}</label>
                                    <input type="text" name="search_bank" id="search_bank" class="form-control"
                                        wire:model='search_bank' wire:keyup="filterBank" placeholder="Search Bank"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.bank_details') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ route('admin.bankDetails.create') }}" data-toggle="tooltip" title="Add New" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                                <a href="javascript:void(0);" style="color: white"
                                    class="btn btn-warning"><i class="fas fa-print"></i>Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.company') }}</th>
                                            <th>{{ __('tablevars.bank') }}</th>
                                            <th>{{ __('tablevars.account_holder') }}</th>
                                            <th>{{ __('tablevars.city') }}</th>
                                            <th>{{ __('tablevars.address') }}</th>
                                            <th>{{ __('tablevars.bank_details') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bankDetails as $key => $detail)
                                            <tr>
                                                <td>{{ $key + $bankDetails->firstItem() }}</td>
                                                <td>{{ $detail->company_name ?? '---' }}</td>
                                                <td>{{ $detail->bank_name ?? '---' }}</td>
                                                <td>{{ $detail->account_holder ?? '---' }}</td>
                                                <td>{{ $detail->getcity->city_name ?? '---' }}</td>
                                                <td>
                                                    <a href="javascript:void(0)"data-bs-toggle="modal"
                                                        data-bs-target="#contentModal"
                                                        wire:click="getContent({{ $detail->id }})"> <i
                                                            class="fas fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)"data-bs-toggle="modal"
                                                        data-bs-target="#contentModal2"
                                                        wire:click="getContent({{ $detail->id }})"> <i
                                                            class="fas fa-eye"></i></a>
                                                </td>
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
                                                                href="{{ route('admin.bankDetails.edit', $detail->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit">Edit</a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip" title="Duplicate"
                                                                wire:click='isDupicate({{ $detail->id }})'
                                                                class="dropdown-item">{{ __('tablevars.duplicate') }}</a>
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
                                        wire:change='filterBank'>
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

    <div wire:ignore.self class="modal fade" id="contentModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Address</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($content_modal_data)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div> {{ $content_modal_data->address }}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="contentModal2" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Bank Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($content_modal_data)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div> {{ $content_modal_data->bank_details }}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.forex') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.finance') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.forex.index') }}"
                        wire:navigate>{{ __('tablevars.forex') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.booking') }}</div>
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
                                        for="search_reference_no">{{ __('tablevars.reference_no') }}</label>
                                    <input type="text" wire:model='search_reference_no'
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        name="search_reference_no" id="search_reference_no" class="form-control"
                                        placeholder="Search Reference No" autocomplete="off" wire:keyup="filterForex">
                                </div>
                                <div class="col-3">
                                    <label class="label-header"
                                        for="search_beneficiary">{{ __('tablevars.beneficiary') }}
                                        {{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_beneficiary" wire:model='search_beneficiary'
                                        id="search_beneficiary" class="form-control"
                                        placeholder="Search Beneficiary Name" autocomplete="off"
                                        wire:keyup="filterForex">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.forex') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ route('admin.forex.create') }}" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>

                                <a href="javascript:void(0);" class="btn btn-info" style="color: white;"
                                    wire:click="exportToExcel">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>

                                <a href="javascript:void(0);" style="color: white" class="btn btn-warning"
                                    wire:click="downloadInvoice()"><i class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.date') }}</th>
                                            <th>{{ __('tablevars.reference_no') }}</th>
                                            <th>{{ __('tablevars.beneficiary') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.company') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.amount') }}(₹)</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($forexData as $key => $RtforexData)
                                            <tr>
                                                <td>{{ $key + $forexData->firstItem() }}</td>
                                                <td>{{ $RtforexData->txn_date ? Helper::formatCarbonDate($RtforexData->txn_date) : '---' }}
                                                </td>
                                                <td>{{ $RtforexData->reference_no }}</td>
                                                <td>{{ $RtforexData->beneficiary->beneficiary_name ?? '-' }}</td>
                                                <td>{{ $RtforexData->company->company_name ?? '-' }}</td>
                                                <td>{{ number_format($RtforexData->amount , 2) }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $RtforexData->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $RtforexData->id }})">
                                                        {{ $RtforexData->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                href="{{ route('admin.forex.edit', $RtforexData->id) }}"
                                                                title="Edit">Edit</a>

                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger"
                                                                wire:click='isDelete({{ $RtforexData->id }})'
                                                                title="Delete">{{ __('tablevars.trash') }}</a>
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
                                        wire:change='filterForex'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $forexData->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
</div>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.forex_transaction') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.resources') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.forexTransaction.index') }}"
                        wire:navigate>{{ __('tablevars.forex_transaction') }}</a></div>
                <div class="breadcrumb-item">All Statement Report</div>
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
                                <div class="col-6">
                                    <select class="form-control" wire:model='benificiaryId'>
                                        <option value="">{{ __('tablevars.select') }}
                                            {{ __('tablevars.beneficiary') }}</option>
                                        @foreach ($benificiary as $BenificiaryId => $BenificiaryName)
                                            <option value="{{ $BenificiaryId }}">{{ $BenificiaryName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 align-self-end">
                                    <a class="btn btn-primary" id="box" style="color: white"
                                        wire:click.prevent="benificiarySearch" data-bs-toggle="modal"
                                        href="javascript:void(0)" data-toggle="tooltip">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (empty($forexData))
                        <div class="card" id="myDIV">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('tablevars.#') }}</th>
                                                <th>{{ __('tablevars.date') }}</th>
                                                <th>{{ __('tablevars.particulars') }}</th>
                                                <th>{{ __('tablevars.total_amount_inr') }}</th>
                                                <th>{{ __('tablevars.debit') }}</th>
                                                <th>{{ __('tablevars.credit') }}</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="thead-light">
                                            <tr>
                                                <th scope="col" colspan="4" class="text-right"></th>
                                                <th scope="col">0.00</th>
                                                <th scope="col">0.00</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" colspan="4" class="text-right">Balance
                                                </th>
                                                <th scope="col" class="bg-danger" colspan="2">
                                                    00.00
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!empty($forexData))
                        <div class="card" id="myDIV">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Statement Report List</h4>
                                <div>
                                    <a href="javascript:void(0);" style="color: white"
                                    class="btn btn-warning" wire:click="downloadInvoice('{{ $benificiaryId }}')"><i class="fas fa-print"></i> Print</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('tablevars.#') }}</th>
                                                <th>{{ __('tablevars.date') }}</th>
                                                <th>{{ __('tablevars.particulars') }}</th>
                                                <th>{{ __('tablevars.total_amount_inr') }}</th>
                                                <th>{{ __('tablevars.debit') }}</th>
                                                <th>{{ __('tablevars.credit') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $tot_debit = 0;
                                                $tot_credit = 0;
                                            @endphp

                                            @forelse ($forexData as $key => $forex)
                                                @php
                                                    $SarRate = $forex->sar_rate;
                                                    if ($forex->types == 'DEBIT') {
                                                        $debit = $forex->tot_amount;
                                                        $Sardebit = $debit / $SarRate;
                                                        $credit = 0;
                                                        $tot_debit += $Sardebit;
                                                    } elseif ($forex->types == 'CREDIT') {
                                                        $debit = 0;
                                                        $credit = $forex->tot_amount;
                                                        $Sarcredit = $credit / $SarRate;
                                                        $tot_credit += $Sarcredit;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $forex->txn_date ? Helper::formatCarbonDate($forex->txn_date) : '' }}
                                                    </td>
                                                    <td>{{ $forex->particularts ?? '---' }}</td>
                                                    <td>{{ $forex->types == 'DEBIT' ? number_format($debit, 2) : number_format($credit, 2) }}
                                                    </td>
                                                    <td>{{ $forex->types == 'DEBIT' ? number_format($Sardebit, 2) : '0.00' }}
                                                    </td>
                                                    <td>{{ $forex->types == 'CREDIT' ? number_format($Sarcredit, 2) : '0.00' }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" align="center" class="v-msg">
                                                        {{ __('tablevars.no_record') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot class="thead-light">
                                            <tr>
                                                <th scope="col" colspan="4" class="text-right"></th>
                                                <th scope="col">{{ number_format($tot_debit, 2) }}</th>
                                                <th scope="col">{{ number_format($tot_credit, 2) }}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" colspan="4" class="text-right">Balance</th>
                                                <th scope="col"
                                                    class="{{ $tot_credit - $tot_debit > 0 ? 'bg-success' : 'bg-danger' }} text-white"
                                                    colspan="2">
                                                    {{ number_format($tot_credit - $tot_debit, 2) }}
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

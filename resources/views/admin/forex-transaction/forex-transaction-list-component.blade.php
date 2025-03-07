<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.forex_transaction') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.forex_transaction') }}
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
                                <div class="col-3">
                                    <label class="label-header" for="search_agency">{{ __('tablevars.beneficiary') }}
                                        {{ __('tablevars.name') }}</label>
                                    <select class="form-control">
                                        <option value="">{{ __('tablevars.select') }}
                                            {{ __('tablevars.beneficiary') }} {{ __('tablevars.name') }}</option>
                                        <option value="1">HOTEL-Mira Ajyaad</option>
                                        <option value="2">HOTEL- LULU MUBARAK</option>
                                        <option value="3">HOTEL - JULNAR TAIBAH</option>
                                        <option value="3">HOTEL - PULLMAN MAKKAH </option>
                                        <option value="3">HOTEL - PULLMAN MADINA</option>
                                        <option value="3">HOTEL - RAWDA AL SAFWA</option>
                                        <option value="3">HOTEL - JAWHARAT AL RASHEED</option>
                                        <option value="3">VISA - MAKARIM (OJOUR)</option>
                                    </select>
                                </div>
                                <div class="col-3 align-self-end">
                                    <a class="btn btn-primary" id="box" style="color: white"
                                        onclick="myFunction()">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="myDIV">
                        {{-- <div class="card" id="myDIV" style="display: none;"> --}}
                        <div class="card-header d-flex justify-content-between">
                            <h4>Statement Report List</h4>
                            <div>
                                <a href="{{ asset('/storage/sample_pdf/my-pdf-voucher.pdf') }}" style="color: white"
                                    class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
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
                                            <th></th>
                                            <th>{{ __('tablevars.debit') }}</th>
                                            <th>{{ __('tablevars.credit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>25-03-2024</td>
                                            <td>UM1008</td>
                                            <td>UGG008</td>
                                            <td></td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Balance : </td>
                                            <td style="background-color: red; color: white">0.00</td>
                                            <td style="background-color: red; color: white"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control">
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <script>
        function myFunction() {
            document.getElementById("myDIV").style.display = "block";
        }
    </script> --}}
</div>

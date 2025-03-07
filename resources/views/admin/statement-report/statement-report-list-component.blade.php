<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.statement_report') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.statement_report') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.statementReport.index') }}"
                        wire:navigate>{{ __('tablevars.statement_report') }}</a></div>
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
                                    <label class="label-header" for="search_agency">{{ __('tablevars.agency') }}</label>
                                    <select class="form-control" name='search_agency' id="search_agency">
                                        {{-- wire:model='search_agency' wire:state="search_agency" wire:change="filterUsers"> --}}
                                        <option value="1">Agency Name</option>
                                        <option value="2">Ammar Tours And Travels</option>
                                        <option value="2">Global Visa Consultancy</option>
                                        <option value="2">IHRAM UMRAH TOURS & TRAVELS</option>
                                        <option value="2">MEHTAB TOURS AND TRAVELS</option>
                                        {{-- @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_name">Start Date</label>
                                    <input type="date" name="search_name" id="search_name" class="form-control"
                                        placeholder="Search Booking Id" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_email">End Date</label>
                                    <input type="date" name="search_email" id="search_email" class="form-control"
                                        placeholder="Search Name" autocomplete="off">
                                </div>
                                <div class="col-3 align-self-end">
                                    <a class="btn btn-primary" id="box" style="color: white"
                                        onclick="myFunction()">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="myDIV" style="display: none;">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Statement Report List</h4>
                            <div>
                                <a href="{{ asset('/storage/sample_pdf/Agents-Accounts-Detail.xls') }}"
                                    style="color: white" class="btn btn-info"><i class="fas fa-file-excel"></i> Export
                                    into excel</a>
                            </div>
                        </div>
                        <div class="text-center">
                            <h4>Statement Report for Ammar Tours And Travels</h4><br>
                            ( 03 Apr 2024 - 03 Apr 2024 )
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.date') }}</th>
                                            <th>{{ __('tablevars.booking_id') }}</th>
                                            <th>{{ __('tablevars.payment_id') }}</th>
                                            <th>{{ __('tablevars.particulars') }}</th>
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
                                            <td>Total : </td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total Balance : </td>
                                            <td style="background-color: red; color: white">0.00</td>
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
    <script>
        function myFunction() {
            document.getElementById("myDIV").style.display = "block";
        }
    </script>
</div>

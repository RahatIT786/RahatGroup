<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-primary text-white">Search</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search_name">Customer Name</label>
                                <input type="text" class="form-control" id="search_name" placeholder="Search Name"
                                    autocomplete="off">

                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="search_email">Email</label>
                                <input type="email" class="form-control" id="search_email" placeholder="Search Email"
                                    autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search_phone">Phone</label>
                                <input type="text" class="form-control" id="search_phone" maxlength="10"
                                    placeholder="Search Phone" autocomplete="off">

                            </div>
                        </div> --}}
                        {{-- wire:model='search_name' wire:keyup="filterLeads" --}}
                        {{-- wire:model='search_email' wire:keyup="filterLeads" --}}
                        {{-- wire:model='search_phone' wire:keyup="filterLeads" --}}
                        {{-- <div class="col-md-2">
                            <div class="form-group">
                                <label for="search_completed">Is Completed ?</label>
                                <select class="form-control" id="search_completed" wire:model='search_completed'
                                    wire:change="filterLeads">
                                    <option>All</option>
                                    <option value="1">Completed</option>
                                    <option value="0">In Progress</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search_status">Status</label>
                                wire:model='search_status' wire:change="filterLeads"
                                <select class="form-control" id="search_status">
                                    <option>All</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Converted</option>
                                    <option value="2">Rejected</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="display-5">Earning List</h4>
                        </div>
                        <div class="col-md-6 ">
                            {{-- <div class="float-right"> --}}
                            <span class="text-dark display-5">Total Earning : 20,000 </span>
                            {{-- </div> --}}
                            <div class="float-right">
                                <a href="#" class="btn btn-success btn-sm"><i class="mdi mdi-file-excel"></i>Expot
                                    to Excel
                                </a>
                            </div>
                            <div class="float-right mx-2">
                                <a href="#" class="btn btn-warning btn-sm"><i class="mdi mdi-file-pdf"></i>PDF</a>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="float-right">
                                <a href="{{ route('staff.leads-create') }}" class="btn btn-primary btn-sm"
                                    wire:navigate>New
                                    Lead</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Customer Name</th>
                                    <th>Package</th>
                                    <th>Package Cost</th>
                                    <th>Converted Date</th>
                                    <th>Commision Earned</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="10" align="center" class="v-msg text-danger">
                                        {{ __('tablevars.no_record') }}
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                        <div class="d-flex flex-row justify-content-between align-items-center table-pagination mt-4">
                            <div class="d-flex align-items-center">
                                <span class="font-weight-bold mr-3 flex-shrink-0">Per Page</span>
                                <select name="per_page" id="per_page" wire:model='perPage' class="form-control"
                                    wire:change='filterLeads'>
                                    @foreach (Helper::getPerPageOptions() as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- {{ $leads->links(data: ['scrollTo' => false]) }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Enquiry Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $post }}
                </div>

            </div>
        </div>
    </div> --}}
</div>

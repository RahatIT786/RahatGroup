<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search_name">Name</label>
                                <input type="text" class="form-control" id="search_name" wire:model='search_name'
                                    wire:keyup="filterLeads" placeholder="Search Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search_email">Email</label>
                                <input type="email" class="form-control" id="search_email" wire:model='search_email'
                                    wire:keyup="filterLeads" placeholder="Search Email" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="search_phone">Phone</label>
                                <input type="text" class="form-control" id="search_phone" wire:model='search_phone'
                                    wire:keyup="filterLeads" maxlength="10" placeholder="Search Phone"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="search_status">Status</label>
                                <select class="form-control" id="search_status" wire:model='search_status'
                                    wire:change="filterLeads">
                                    <option>All</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="display-5">Leads List</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <a href="{{ route('staff.leads-create') }}" class="btn btn-primary btn-sm"
                                    wire:navigate>New
                                    Lead</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Completed ?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leads as $key => $lead)
                                    <tr>
                                        <td>{{ $key + $leads->firstItem() }}</td>
                                        <td>{{ $lead->name }}</td>
                                        <td>{{ $lead->email }}</td>
                                        <td>{{ $lead->phone }}</td>
                                        <td>
                                            <div class="pointer rounded-lg badge badge-{{ $lead->is_active == 1 ? 'primary' : 'danger' }}"
                                                wire:click="toggleStatus({{ $lead->id }})">
                                                {{ $lead->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </div>
                                        </td>
                                        <td>
                                            <label
                                                class="badge badge-{{ $lead->completed == 1 ? 'success' : 'warning' }} rounded-pill">{{ $lead->completed == 1 ? 'Completed' : 'In Progress' }}</label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" align="center" class="v-msg">
                                            No Records Found...
                                        </td>
                                    </tr>
                                @endforelse
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
                            {{ $leads->links(data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

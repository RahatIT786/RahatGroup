<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.ticket_booking') }}</h1>
            <div class="section-header-button">
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.download') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.ticket.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.ticket_booking') }}
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
                                    <label class="label-header" for="search_booking_id">Booking Id</label>
                                    <input type="text" name="search_booking_id" id="search_booking_id"
                                        class="form-control" wire:model='search_booking_id' wire:keyup="filterBookings"
                                        placeholder="Search Booking Id"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header"
                                        for="search_name">{{ __('tablevars.meheram_name') }}</label>
                                    <input type="text" name="search_name" id="search_name"
                                        class="form-control"wire:model='search_name' wire:keyup="filterBookings"
                                        placeholder="Search Meheram Name" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header"
                                        for="search_travel_date">{{ __('tablevars.travel_date') }}</label>
                                    <input type="date" name="search_travel_date" id="search_travel_date"
                                        class="form-control" autocomplete="off" wire:model='search_travel_date'
                                        wire:change="filterBookings">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.ticket_booking') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.booking_id') }}</th>
                                            <th>{{ __('tablevars.meheram_name') }}</th>
                                            <th>{{ __('tablevars.total_pax') }}</th>
                                            <th>{{ __('tablevars.travel_date') }}</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($TicketsBookings as $key => $ticket)
                                            <tr>
                                                <td>{{ $key + $TicketsBookings->firstItem() }}</td>
                                                <td>{{ $ticket->booking_id ?? '---' }}</td>
                                                <td>{{ $ticket->mehram_name ?? '---' }}</td>
                                                <td>
                                                    {{ $ticket->adult + $ticket->child + $ticket->child_bed + $ticket->infant ?? '---' }}
                                                </td>
                                                <td>
                                                    {{ $ticket->travel_date ? Helper::formatCarbonDate($ticket->travel_date) : ' --- ' }}
                                                    {{-- @if (in_array($ticket->service_type, [2, 6, 8, 10, 11]))
                                                        {{ $ticket->pnr->dept_date ? Helper::formatCarbonDate($ticket->pnr->dept_date) : ' --- ' }}
                                                    @elseif(in_array($ticket->service_type, [1, 7, 9, 4, 5, 3, 14, 15, 16, 17, 18, 19]))
                                                        {{ $ticket->travel_date ? Helper::formatCarbonDate($ticket->travel_date) : ' --- ' }}
                                                    @elseif(in_array($ticket->service_type, [13]))
                                                        {{ $ticket->checkin_date ? Helper::formatCarbonDate($ticket->checkin_date) : ' --- ' }}
                                                    @elseif(in_array($ticket->service_type, [12]))
                                                        {{ $ticket->visa_date ? Helper::formatCarbonDate($ticket->visa_date) : ' --- ' }}
                                                    @else
                                                        ---
                                                    @endif --}}
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; right: 0px; will-change: transform;">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#viewModal"
                                                                data-toggle="tooltip" title="View"
                                                                wire:click="viewTicket({{ $ticket->id }})">Upload</a>
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
                                        wire:change='filterBookings'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $TicketsBookings->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->

    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Guest List</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Ticket</label>
                                    </div>
                                </div>
                                @forelse($guests as $guest)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div>{{ $guest->guest_first_name }} {{ $guest->guest_last_name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="file" class="form-control mb-2"
                                                wire:model="files.{{ $guest->id }}"
                                                accept=".jpeg,.jpg,.png,.webp,.pdf">
                                                @if($guest->tkt_file != null)
                                                    <a href="{{ asset('/storage/ticket-documents/' . $guest->tkt_file) }}" download>
                                                        <i class="fas fa-download" style="font-size: 24px; color: #007bff;"></i>
                                                    </a>
                                                    <p>
                                                        Already Uploaded File
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Guest Found</p>
                                @endforelse
                                <button class="btn btn-primary btn-sm" wire:click.prevent="uploadFile">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

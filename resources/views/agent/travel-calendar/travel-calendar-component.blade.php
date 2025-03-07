<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4>Travel Calendar</h4>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">

                                                {{-- <a href="{{ route('agent.bookings.index') }}"
                                                    target="_blank"></a> --}}
                                                {{-- <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.package') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_title' placeholder="Search Package"
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.group_name') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_location' placeholder="Search Group Name"
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <div id='calendar'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('extra_js')
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script>
        document.addEventListener('livewire:initialized', function() {
            let component = @this;
            console.log(component.title);
        })
        // document.addEventListener('livewire:initialized', function() {
        //     var calendarEl = document.getElementById('calendar');

        //     // Get the first date of the current month
        //     var today = new Date();
        //     var firstDateOfCurrentMonth = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split(
        //         'T')[0];


        //     var calendar = new FullCalendar.Calendar(calendarEl, {
        //         headerToolbar: {
        //             left: 'prevYear,prev,next,nextYear today',
        //             center: 'title',
        //             // right: 'dayGridMonth,dayGridWeek,dayGridDay'
        //         },
        //         // initialDate: firstDateOfCurrentMonth,
        //         initialDate: '2023-01-12',
        //         navLinks: true, // can click day/week names to navigate views
        //         editable: false,
        //         dayMaxEvents: true, // allow "more" link when too many events
        //         events: [{
        //                 title: 'All Day Event',
        //                 start: '2023-01-01'
        //             },
        //             {
        //                 title: 'Long Event',
        //                 start: '2023-01-07',
        //                 end: '2023-01-10'
        //             },
        //             {
        //                 groupId: 999,
        //                 title: 'Repeating Event',
        //                 start: '2023-01-09T16:00:00'
        //             },
        //             {
        //                 groupId: 999,
        //                 title: 'Repeating Event',
        //                 start: '2023-01-16T16:00:00'
        //             },
        //             {
        //                 title: 'Conference',
        //                 start: '2023-01-11',
        //                 end: '2023-01-13'
        //             },
        //             {
        //                 title: 'Meeting',
        //                 start: '2023-01-12T10:30:00',
        //                 end: '2023-01-12T12:30:00'
        //             },
        //             {
        //                 title: 'Lunch',
        //                 start: '2023-01-12T12:00:00'
        //             },
        //             {
        //                 title: 'Meeting',
        //                 start: '2023-01-12T14:30:00'
        //             },
        //             {
        //                 title: 'Happy Hour',
        //                 start: '2023-01-12T17:30:00'
        //             },
        //             {
        //                 title: 'Dinner',
        //                 start: '2023-01-12T20:00:00'
        //             },
        //             {
        //                 title: 'Birthday Party',
        //                 start: '2023-01-13T07:00:00'
        //             },
        //             {
        //                 title: 'Click for Google',
        //                 url: 'http://google.com/',
        //                 start: '2023-01-28'
        //             }
        //         ]
        //     });

        //     calendar.render();
        // });

        document.addEventListener('livewire:initialized', function() {

            function getCurrentDateFormatted() {
                var today = new Date();
                var year = today.getFullYear();
                var month = (today.getMonth() + 1).toString().padStart(2, '0');
                var day = today.getDate().toString().padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            var currentDate = getCurrentDateFormatted();
            console.log(currentDate); // Outputs the current date in Y-m-d format

            var calendarEl = document.getElementById('calendar');

            // Pass the events from PHP to JavaScript
            var events = @json($events);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    // right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                initialDate: currentDate,
                // initialDate: '2023-01-12',
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                dayMaxEvents: true, // allow "more" link when too many events
                events: events
            });

            calendar.render();
        });
    </script>
@endpush

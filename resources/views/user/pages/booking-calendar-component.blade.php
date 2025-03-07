<main class="cAJbgc" style="margin-top: 0px;">

    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Umrah Calendar</h1>
        </div>
    </section>
    <section class="calendar-sec">
        <div class="container">
            {{-- <h3 style="font-size:1.2rem;">Sharjah | Dubai | Abu Dhabi</h3> --}}
            <div id="calendar"></div>
        </div>
    </section>
</main>

@push('extra_js')
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script>
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
                },
                initialDate: currentDate,
                navLinks: true,
                editable: false,
                dayMaxEvents: true,
                events: events,
                eventContent: function(arg) {
                    // Create custom HTML content for the event
                    let eventTitle = document.createElement('div');
                    eventTitle.innerHTML = arg.event.title;

                    // Check if 'city' data exists and create a new div to show city
                    let eventCity = document.createElement('div');
                    if (arg.event.extendedProps.city) {
                        eventCity.innerHTML = arg.event.extendedProps.city;
                        // eventCity.style.fontSize = 'smaller'; // Optional styling
                        // eventCity.style.color = '#555'; // Optional styling
                    }

                    return {
                        domNodes: [eventTitle, eventCity]
                    };
                }
            });

            calendar.render();

        });
    </script>
@endpush

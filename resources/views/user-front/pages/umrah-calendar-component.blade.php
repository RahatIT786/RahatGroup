<div>
    <section class="calendar-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="breadcrumbs mb-4">
                        <span>
                            <span class="breadcrumb-text">
                                <a href="#">Home</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">Events</span>
                        </span>
                    </nav>
                </div>
            </div>
            <form class="form_input_group" method="post">
                <div class="d-flex w-75">
                    <select id="city_id" name="city_id" class="custom-select mb-3 mr-2">
                        <option value="" selected="">Select City</option>
                        <option value="2">Delhi</option>
                        <option value="4">Mumbai</option>
                        <option value="6">Lucknow</option>
                        <option value="7">Hyderabad</option>
                        <option value="8">Ahmedabad</option>
                        <option value="9">Jaipur</option>
                        <option value="10">Bangalore</option>
                        <option value="11">Nagpur</option>
                        <option value="12">Kolkatta</option>
                        <option value="13">Srinagar</option>
                        <option value="14">Mangalore</option>
                        <option value="15"> Chennai</option>
                        <option value="16">Udaipur</option>
                        <option value="17">GOA</option>
                        <option value="18">Guwahti</option>
                        <option value="19">BHUBANESHWAR</option>
                    </select>
                    <input class="btn default-btn mb-3" type="submit" name="clndr_serch" value="Submit">
                </div>
            </form>
            <div id="calendar" class="bg-white border p-2" style="border-radius:10px;"></div>
        </div>
    </section>
</div>

@push('extra_js')
    <script type="text/javascript">
        $(function () {

/* initialize the external events
 -----------------------------------------------------------------*/
function ini_events(ele) {
  ele.each(function () {

    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
    // it doesn't need to have a start or end
    var eventObject = {
      title: $.trim($(this).text()) // use the element's text as the event title
    };

    // store the Event Object in the DOM element so we can get to it later
    $(this).data('eventObject', eventObject);

    // make the event draggable using jQuery UI
    $(this).draggable({
      zIndex: 1070,
      revert: true, // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
    });

  });
}

ini_events($('#external-events div.external-event'));

/* initialize the calendar
 -----------------------------------------------------------------*/
//Date for the calendar events (dummy data)
var date = new Date();
var d = date.getDate(),
    m = date.getMonth(),
    y = date.getFullYear();
$('#calendar').fullCalendar({
  header: {
    left: 'prev,next today',
    center: 'title',
    right: false
  },
  buttonText: {
    today: 'today',
    month: 'month',
    week: 'week',
    day: 'day'
  },
  //Random default events
 events: generateEvents(),
 eventRender: function(event, element) {
    // Add the icon to the event title
    element.find('.fc-title').html(event.title);
    $(element).find(".fc-time").remove();
 },
  editable: false,
});			
});

function generateEvents() {
var events = [];
var currentDate = moment().startOf('year'); // Start from the beginning of the current month

while (currentDate.year() === moment().year()) {
    if (currentDate.day() === 1) { // If it's a Monday
        events.push({
            title: 'Umrah By Flight <i class="fa fa-plane"></i>',
            backgroundColor: "#FFA500",
            textColor: "white", 
            borderColor: "#FFA500", 
            start: currentDate.format('YYYY-MM-DD'), // Date only, without time
            end: currentDate.format('YYYY-MM-DD'),   // Date only, without time
            allDay: true // All-day event, without specific time
        });
    }
    if (currentDate.day() === 3) { // If it's a Monday
        events.push({
            title: 'Umrah By BUS <i class="fa fa-bus"></i>',
            backgroundColor: "#FFA500",
            textColor: "white", 
            borderColor: "#FFA500", 
            start: currentDate.format('YYYY-MM-DD'), // Date only, without time
            end: currentDate.format('YYYY-MM-DD'),   // Date only, without time
            allDay: true // All-day event, without specific time
        });
    }
    if (currentDate.day() === 5) { // If it's a Monday
        events.push({
            title: 'Return to UAE from Madina <i class="fa fa-bus"></i>',
            backgroundColor: "#FFA500",
            textColor: "white", 
            borderColor: "#FFA500", 
            start: currentDate.format('YYYY-MM-DD'), // Date only, without time
            end: currentDate.format('YYYY-MM-DD'),   // Date only, without time
            allDay: true // All-day event, without specific time
        });
    }
    if (currentDate.day() === 6) { // If it's a Monday
        events.push({
            title: 'Reach UAE <i class="fa fa-map-marker"></i>',
            backgroundColor: "#FFA500",
            textColor: "white", 
            borderColor: "#FFA500", 
            start: currentDate.format('YYYY-MM-DD'), // Date only, without time
            end: currentDate.format('YYYY-MM-DD'),   // Date only, without time
            allDay: true // All-day event, without specific time
        });
    }
    currentDate.add(1, 'day');
}

return events;
}
</script>
@endpush

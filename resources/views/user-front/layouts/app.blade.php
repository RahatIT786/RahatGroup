@include('user-front.includes.header')

{{-- @yield('content') --}}
{{ $slot }}
@livewire('user.booking-modal-component')
@livewire('user-front.publication-enquiry-modal-component')
@livewire('user-front.call-us-back-component')
@livewire('user.enquiry-modal-component')
@livewire('user-front.book-now-component')
@livewire('user-front.forex-component')
@livewire('user-front.call-us-back-component')
@livewire('user-front.enquiry-modals-component')
@livewire('user-front.feed-back-component')
@livewire('user-front.shopping-modal-component')
@livewire('user-front.food-menu-modal-component')
@include('user-front.includes.footer')

@stack('extra_js')
<script>
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            $('header').addClass("header-sticky");
        } else {
            $('header').removeClass("header-sticky");
        }
    });
    $('.toggleNav').on('click', function() {
        $('nav[data-nav]').toggleClass('show');
        $('body').css('overflow-y', 'hidden');
    });
    $('.closeNav').on('click', function() {
        $('nav[data-nav]').removeClass('show');
        $('body').css('overflow-y', 'unset');
    });
</script>
<script>
    var revapi;
    jQuery(document).ready(function() {
        revapi = jQuery('.tp-banner').revolution({
            delay: 9000,
            startwidth: 1600,
            startheight: 769,
            hideThumbs: 10,
            navigationArrows: "thumb",
            navigationStyle: "round",
            navigationHAlign: "center",
            navigationVAlign: "bottom",
            navigationHOffset: 0,
            navigationVOffset: 20,
            fullWidth: "on",
            forceFullWidth: "on"
        });
    }); //ready
    const swiper = new Swiper('.swiper-journey', {
        // Optional parameters
        slidesPerView: 1.5,
        speed: 400,
        spaceBetween: 20,

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        breakpoints: {
            767: {
                slidesPerView: 2.5,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2.5,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 2.5,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 2.8,
                spaceBetween: 20,
            },
        },
    });
    $(window).scroll(function() {
        var element = $('.kQJOna svg > g > g');
        var scrollTop = $(window).scrollTop();
        var offset = element.offset().top;
        var windowHeight = $(window).height();

        // Check if the element is in view
        if (offset < scrollTop + windowHeight && offset + element.height() > scrollTop) {
            // Calculate parallax effect
            var parallaxOffset = (offset + scrollTop) * 0.2;
            // Update styles
            element.css({
                'transform': 'matrix(1,0,0,-1,' + (-parallaxOffset) + ',2100)',
            });
        }
    });
    jQuery(document).ready(function() {
        $('.slide-out-div').tabSlideOut({
            tabHandle: '.handle',
            pathToTabImage: "{{ asset('assets/user/images/contact_tab.gif') }}",
            imageHeight: '199px',
            imageWidth: '40px',
            tabLocation: 'right',
            speed: 300,
            action: 'click',
            topPos: '150px',
            fixedPosition: true
        });
    });
</script>
<script type="text/javascript">
    $(function() {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function() {

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
                    revertDuration: 0 //  original position after the drag
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
                    backgroundColor: "#B49164",
                    textColor: "white",
                    borderColor: "#B49164",
                    start: currentDate.format('YYYY-MM-DD'), // Date only, without time
                    end: currentDate.format('YYYY-MM-DD'), // Date only, without time
                    allDay: true // All-day event, without specific time
                });
            }
            if (currentDate.day() === 3) { // If it's a Monday
                events.push({
                    title: 'Umrah By BUS <i class="fa fa-bus"></i>',
                    backgroundColor: "#B49164",
                    textColor: "white",
                    borderColor: "#B49164",
                    start: currentDate.format('YYYY-MM-DD'), // Date only, without time
                    end: currentDate.format('YYYY-MM-DD'), // Date only, without time
                    allDay: true // All-day event, without specific time
                });
            }
            if (currentDate.day() === 5) { // If it's a Monday
                events.push({
                    title: 'Return to UAE from Madina <i class="fa fa-bus"></i>',
                    backgroundColor: "#B49164",
                    textColor: "white",
                    borderColor: "#B49164",
                    start: currentDate.format('YYYY-MM-DD'), // Date only, without time
                    end: currentDate.format('YYYY-MM-DD'), // Date only, without time
                    allDay: true // All-day event, without specific time
                });
            }
            if (currentDate.day() === 6) { // If it's a Monday
                events.push({
                    title: 'Reach UAE <i class="fa fa-map-marker"></i>',
                    backgroundColor: "#B49164",
                    textColor: "white",
                    borderColor: "#B49164",
                    start: currentDate.format('YYYY-MM-DD'), // Date only, without time
                    end: currentDate.format('YYYY-MM-DD'), // Date only, without time
                    allDay: true // All-day event, without specific time
                });
            }
            currentDate.add(1, 'day');
        }

        return events;
    }
</script>
{{-- <script>
        $(document).ready(function() {
            $('#enquiryMsg').modal('show');
        });
    </script> --}}
{{-- @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach --}}
<script>
    @if (Session::has('success_msg'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('success_msg') }}");
    @endif

    @if (Session::has('errors'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        };

        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>

<script>
    const swiper1 = new Swiper('.swiper-gallery', {
        // Optional parameters
        slidesPerView: 1,
        speed: 400,
        spaceBetween: 20,

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need pagination
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
        },
    });

    jQuery(document).ready(function() {

        $('#itinerary').on("click", function() {

            $('html, body').animate({
                scrollTop: $("#itenary").offset().top - 220
            }, 200);

        });

        $('#termscondition').on("click", function() {
            $('html, body').animate({
                scrollTop: $("#terms_condition").offset().top - 220
            }, 200);

        });
    });

    function pakagetabFunc(button, tabId) {

        // Get all divs with the class 'hidden'
        var allDivs = document.querySelectorAll('.hidden');

        // Loop through all divs and hide them
        allDivs.forEach(function(div) {
            div.style.display = 'none';
        });

        // Show the selected div
        var selectedDiv = document.getElementById(tabId);
        if (selectedDiv) {
            selectedDiv.style.display = 'block';
        }
    }
</script>
<script>
    function AddReadMore() {
        var carLmt = 280;
        var readMoreTxt = " Read More";
        var readLessTxt = " Read Less";
        $(".addReadMore").each(function() {
            if ($(this).find(".firstSec").length)
                return;
            var allstr = $(this).text();
            if (allstr.length > carLmt) {
                var firstSet = allstr.substring(0, carLmt);
                var secdHalf = allstr.substring(carLmt, allstr.length);
                var strtoadd = "<p>" + firstSet + "<span class='more-dots'>...</span><span class='SecSec'>" +
                    secdHalf +
                    "</span></p><div class='text-right'><span class='readMore readmore_text1'  title='Click to Show More'>" +
                    readMoreTxt + "</span><span class='readLess readmore_text1' title='Click to Show Less'>" +
                    readLessTxt + "</span></div>";
                $(this).html(strtoadd);
            }
        });
        $(document).on("click", ".readMore,.readLess", function() {
            $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
        });
    }
    AddReadMore();
</script>

{{-- Jyoti start --}}
<script>
    $(document).ready(function() {
        $("#frm_quick_enquiry input, #frm_quick_enquiry select, #frm_quick_enquiry textarea").not(":submit").on(
            "input",
            function() {
                validateInput($(this));
            });

        $("#frm_quick_enquiry").submit(function(event) {
            var isValid = true;
            $("input, select, textarea", this).not(":submit, :hidden").each(function() {
                if ($(this).attr('name')) {
                    if ($(this).attr('type') === 'email' && !isValidEmail($(this).val())) {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else if ($(this).val().trim() === "") {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else {
                        $(this).css("border", "1px solid green");
                    }
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    function validateInput(element) {
        if (element.val().trim() === "" && (element.attr("type") !== "radio" || !$("input[name='" + element.attr(
                "name") + "']:checked").val())) {
            element.css("border", "1px solid red");
        } else if (element.attr('type') === 'email' && !isValidEmail(element.val())) {
            element.css("border", "1px solid red");
        } else {
            element.css("border", "1px solid green");
        }
    }

    function isValidEmail(email) {
        // Regular expression for a basic email validation
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailRegex.test(email);
    }
</script>
<script>
    $(document).ready(function() {
        $("#frm_feedback input, #frm_feedback select, #frm_feedback textarea").not(":submit").on(
            "input",
            function() {
                validateInput($(this));
            });

        $("#frm_feedback").submit(function(event) {
            var isValid = true;
            $("input, select, textarea", this).not(":submit, :hidden").each(function() {
                if ($(this).attr('name')) {
                    if ($(this).attr('type') === 'email' && !isValidEmail($(this).val())) {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else if ($(this).val().trim() === "") {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else {
                        $(this).css("border", "1px solid green");
                    }
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    function validateInput(element) {
        if (element.val().trim() === "" && (element.attr("type") !== "radio" || !$("input[name='" + element.attr(
                "name") + "']:checked").val())) {
            element.css("border", "1px solid red");
        } else if (element.attr('type') === 'email' && !isValidEmail(element.val())) {
            element.css("border", "1px solid red");
        } else {
            element.css("border", "1px solid green");
        }
    }

    function isValidEmail(email) {
        // Regular expression for a basic email validation
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailRegex.test(email);
    }
</script>
{{-- Jyoti End --}}
{{-- Jyoti start-2024-02-05 --}}
<script>
    $(document).ready(function() {
        $("#frm_booking_enquiry input, #frm_booking_enquiry select, #frm_booking_enquiry textarea").not(
            ":submit").on(
            "input",
            function() {
                validateInput($(this));
            });

        $("#frm_booking_enquiry").submit(function(event) {
            var isValid = true;
            $("input, select, textarea", this).not(":submit, :hidden").each(function() {
                if ($(this).attr('name')) {
                    if ($(this).attr('type') === 'email' && !isValidEmail($(this).val())) {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else if ($(this).val().trim() === "") {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else {
                        $(this).css("border", "1px solid green");
                    }
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    function validateInput(element) {
        if (element.val().trim() === "" && (element.attr("type") !== "radio" || !$("input[name='" + element.attr(
                "name") + "']:checked").val())) {
            element.css("border", "1px solid red");
        } else if (element.attr('type') === 'email' && !isValidEmail(element.val())) {
            element.css("border", "1px solid red");
        } else {
            element.css("border", "1px solid green");
        }
    }

    function isValidEmail(email) {
        // Regular expression for a basic email validation
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailRegex.test(email);
    }
</script>
{{-- Jyoti End-2024-02-05 --}}
{{-- Jyoti start-2024-02-06 --}}
<script>
    $(document).ready(function() {
        $("#frm_booking_enquiry_details input, #frm_booking_enquiry_details select, #frm_booking_enquiry_details textarea")
            .not(":submit").on(
                "input",
                function() {
                    validateInput($(this));
                });

        $("#frm_booking_enquiry_details").submit(function(event) {
            var isValid = true;
            $("input, select, textarea", this).not(":submit, :hidden").each(function() {
                if ($(this).attr('name')) {
                    if ($(this).attr('type') === 'email' && !isValidEmail($(this).val())) {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else if ($(this).val().trim() === "") {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else {
                        $(this).css("border", "1px solid green");
                    }
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    function validateInput(element) {
        if (element.val().trim() === "" && (element.attr("type") !== "radio" || !$("input[name='" + element.attr(
                "name") + "']:checked").val())) {
            element.css("border", "1px solid red");
        } else if (element.attr('type') === 'email' && !isValidEmail(element.val())) {
            element.css("border", "1px solid red");
        } else {
            element.css("border", "1px solid green");
        }
    }

    function isValidEmail(email) {
        // Regular expression for a basic email validation
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailRegex.test(email);
    }
</script>
{{-- Jyoti End-2024-02-06 --}}

{{-- Jyoti start-2024-02-13 --}}
<script>
    $(document).ready(function() {
        $("#frm_booking_enquiry_list input, #frm_booking_enquiry_list select, #frm_booking_enquiry_list textarea")
            .not(":submit").on(
                "input",
                function() {
                    validateInput($(this));
                });

        $("#frm_booking_enquiry_list").submit(function(event) {
            var isValid = true;
            $("input, select, textarea", this).not(":submit, :hidden").each(function() {
                if ($(this).attr('name')) {
                    if ($(this).attr('type') === 'email' && !isValidEmail($(this).val())) {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else if ($(this).val().trim() === "") {
                        isValid = false;
                        $(this).css("border", "1px solid red");
                    } else {
                        $(this).css("border", "1px solid green");
                    }
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    function validateInput(element) {
        if (element.val().trim() === "" && (element.attr("type") !== "radio" || !$("input[name='" + element.attr(
                "name") + "']:checked").val())) {
            element.css("border", "1px solid red");
        } else if (element.attr('type') === 'email' && !isValidEmail(element.val())) {
            element.css("border", "1px solid red");
        } else {
            element.css("border", "1px solid green");
        }
    }

    function isValidEmail(email) {
        // Regular expression for a basic email validation
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailRegex.test(email);
    }
</script>

<script>
    $(document).ready(function() {
        $('#bookingModal_list').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var modal = $(this);
            modal.find('.modal-title').text(title);
        });
        $.getJSON('https://restcountries.com/v3.1/all', function(data) {
            data.forEach(function(country) {
                $('#countrySelect').append('<option value="' + country.cca2 +
                    '" data-icon="flag-icon flag-icon-' + country.cca2.toLowerCase() +
                    '">' + country.name.common + '</option>');
            });
        });
        $('#applyVisaModal').on('shown.bs.modal', function() {
            $('#countrySelect').select2({
                dropdownParent: $('#countrydropdown'),
                templateResult: formatCountry,
                templateSelection: formatSelectedCountry
            });
        });

        // Check on page load
        if ($('#countrySelect').val() !== '') {
            var selectedValue = $('#countrySelect').val();
            // Disable the "Select a country" option
            $(this).find('option[value=""]').prop('disabled', true);

            $('.klLqjz').removeClass('hide');
            $('.idwEoO *:nth-child(3)').addClass('active');
            $('.idwEoO *:nth-child(6)').addClass('hide');
            $('.idwEoO *:nth-child(7)').addClass('hide');
            $('input[name="visaholder"]').prop('checked', false);
        }

        // Show/hide divs based on select option
        $('#countrySelect').on('change', function() {
            var selectedValue = $(this).val();
            // Disable the "Select a country" option
            $(this).find('option[value=""]').prop('disabled', true);

            if ($(this).val() !== '') {
                $('.klLqjz').removeClass('hide');
                $('.idwEoO *:nth-child(3)').addClass('active');
                $('.idwEoO *:nth-child(4)').addClass('activeline');
            } else {
                $('.klLqjz').addClass('hide');
                $('.dvDqDM').addClass('hide');
                $('input[name="visaholder"]').prop('checked', false);
                $('#nodiv').addClass('hide');
                $('#yesdiv').addClass('hide');
            }
        });

        // Show/hide divs based on radio button selection
        $('input[name="visaholder"]').on('change', function() {
            if ($(this).val() === 'No') {
                $('.dvDqDM').removeClass('hide');
                $('#yesdiv').addClass('hide');

                $('input[name="resident"]').prop('checked', false);

                $('.idwEoO *:nth-child(4)').addClass('activeline');
                $('.idwEoO *:nth-child(5)').addClass('active');
                $('.idwEoO *:nth-child(6)').removeClass('hide activeline');
                $('.idwEoO *:nth-child(7)').removeClass('hide active');
            } else {
                $('.dvDqDM').addClass('hide');
                $('#nodiv').addClass('hide');
                $('#yesdiv').removeClass('hide');

                $('.idwEoO *:nth-child(4)').addClass('active');
                $('.idwEoO *:nth-child(5)').addClass('active');
                $('.idwEoO *:nth-child(6)').addClass('hide');
                $('.idwEoO *:nth-child(7)').addClass('hide');
            }
        });
        // Show/hide divs based on radio button selection
        $('input[name="resident"]').on('change', function() {
            if ($(this).val() === 'No') {
                $('#nodiv').removeClass('hide');
                $('#yesdiv').addClass('hide');

                $('.idwEoO *:nth-child(6)').addClass('activeline');
                $('.idwEoO *:nth-child(7)').addClass('active');
            } else {
                $('#nodiv').addClass('hide');
                $('#yesdiv').removeClass('hide');
                $('.idwEoO *:nth-child(6)').addClass('activeline');
                $('.idwEoO *:nth-child(7)').addClass('active');
            }
        });
    });
    // Custom template function to display country name and flag icon in the dropdown
    function formatCountry(country) {
        if (!country.id) {
            return country.text; // Return the original text for the placeholder
        }

        var countryCode = $(country.element).data('icon'); // Get country icon class
        var $country = $(
            '<span><span class="' + countryCode + '"></span> ' + country.text + '</span>'
        );
        return $country;
    }

    // Custom template function to display selected country with flag icon
    function formatSelectedCountry(country) {
        if (!country.id) {
            return country.text; // Return the original text for the placeholder
        }

        var countryCode = $(country.element).data('icon'); // Get country icon class
        var $country = $(
            '<span><span class="' + countryCode + '"></span> ' + country.text + '</span>'
        );
        return $country;
    }
</script>
{{-- Jyoti End-2024-02-13 --}}

<script>
    var $videoSrc;
    $('.video-btn').click(function() {
        $videoSrc = $(this).data("src");
    });
    console.log($videoSrc);
    $('#videoModal').on('shown.bs.modal', function(e) {
        $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"); //
    })
    $('#videoModal').on('hide.bs.modal', function(e) {
        $("#video").attr('src', '');
    });
</script>
<script>
    const swiper2 = new Swiper('.swiper-slider1', {
        // Optional parameters
        slidesPerView: 1,
        speed: 400,
        spaceBetween: 20,

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            1024: {
                slidesPerView: 1.2,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 1.2,
                spaceBetween: 20,
            },
        },
    });

    const swiper3 = new Swiper('.swiper-boxslider', {
        // Optional parameters
        slidesPerView: 1,
        speed: 400,
        spaceBetween: 20,


        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            767: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 3.4,
                spaceBetween: 20,
            },
        },
    });
    $(document).ready(function() {
        $('#success-message').show();
        setTimeout(function() {
            $('#success-message').fadeOut(
                'slow');
        }, 5000);
    });
</script>

@extends('layouts.app')

@section('content')

    {{--<!-- Google Calendar Appointment Scheduling begin -->
    <link href="https://calendar.google.com/calendar/scheduling-button-script.css" rel="stylesheet">
    <script src="https://calendar.google.com/calendar/scheduling-button-script.js" async></script>
    <script>
        (function() {
            var target = document.currentScript;
            window.addEventListener('load', function() {
                calendar.schedulingButton.load({
                    url: 'https://calendar.google.com/calendar/appointments/schedules/AcZssZ2GxUWxI3JQEgRvhbFG-yU4GeiSUlsd0mHxUuT_XjXn48_8NJEp7BsfP3Bl1VSj_XPJaH6JOfOe?gv=true',
                    color: '#D50000',
                    label: 'Book an appointment',
                    target,
                });
            });
        })();
    </script>
    <!-- end Google Calendar Appointment Scheduling -->
--}}
    <!-- Google Calendar Appointment Scheduling begin -->
    <iframe
        src="https://calendar.google.com/calendar/appointments/schedules/AcZssZ2GxUWxI3JQEgRvhbFG-yU4GeiSUlsd0mHxUuT_XjXn48_8NJEp7BsfP3Bl1VSj_XPJaH6JOfOe?gv=true"
        style="border: 0" width="100%" height="800" frameborder="0"></iframe>
    <!-- end Google Calendar Appointment Scheduling -->
@endsection

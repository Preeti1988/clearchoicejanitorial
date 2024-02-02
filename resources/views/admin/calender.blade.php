@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Dashboard')
@push('css')
    <style>
        input[type="date"] {
            border: none;
            outline: none;
        }
    </style>
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-css/home.css') }}">



    <script src="{{ custom_asset('public/assets/admin-js/index.global.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var events = @json($services);
            console.log(events);
            // var events = [{
            //         title: 'Event 1',
            //         start: '2024-02-01'
            //     },
            //     {
            //         title: 'Event 2',
            //         start: '2024-02-05',
            //         end: '2024-02-07'
            //     }
            //     // Add more events as needed
            // ];
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: events,
                eventClick: function(info) {
                    // Redirect to the specified URL when an event is clicked
                    window.location.href = info.event.url;
                }
            });
            calendar.render();
        });
    </script>
@endpush
@section('content')
    <div class="body-main-content">
        <div class="overview-section">
            <div class="row">
                <div class="col-md-10 bg-gray">
                    <h2>Calender</h2>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
@endsection

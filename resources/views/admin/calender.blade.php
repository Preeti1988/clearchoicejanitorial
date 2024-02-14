@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Dashboard')
@push('css')
    <style>
        input[type="date"] {
            border: none;
            outline: none;
        }

        .fc .fc-scrollgrid-liquid {
            border-radius: 10px;
            background: white;
            border: 0;
            box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;
        }

        .fc-today-button {
            background-color: var(--green, #7BC043) !important;
            color: var(--white, #FFF) !important;
            border: 0 !important;
        }

        .fc-theme-standard td,
        .fc-theme-standard th {
            border: 1px solid #c1e4a3;
        }

        .fc .fc-daygrid-day-number {
            font-size: 18px;
        }

        .fc .fc-daygrid-day.fc-day-today {
            background-color: rgb(79 255 40 / 15%);
        }

        .fc-h-event .fc-event-main-frame {
            background-color: var(--blue);
            padding-left: 5px;
            border: 0;
            color: var(--white, #FFF) !important;
        }

        .fc-daygrid-event-dot {
            border: calc(var(--fc-daygrid-event-dot-width)/2) solid var(--green, #7BC043);
        }

        .fc-scrollgrid-sync-inner {
            padding: 6px;
        }

        .fc-button {
            background-color: transparent;
            border: 1px solid var(--green, #7BC043);
        }

        .fc .fc-button-primary {
            background-color: transparent;
            border: 1px solid var(--green, #7BC043);
        }

        .fc .fc-button-primary:hover,
        .fc-button:hover {
            background-color: var(--green, #7BC043);
            border: 1px solid var(--green, #7BC043);
        }

        .fc .fc-button-primary:hover .fc-icon,
        .fc-button:hover .fc-icon {
            color: white;
        }

        .fc .fc-button-primary:focus,
        .fc-button:focus {
            box-shadow: none;
        }

        .fc .fc-button .fc-icon {
            color: var(--green, #7BC043);
        }

        .bg-gray h2 {
            font-size: 18px;
            margin: 0;
            padding: 0;
            line-height: normal;
            color: var(--blue);
            font-weight: 700;
        }

        .master-card-head h2 {
            color: var(--blue, #23356F);
            font-size: 16px;
            font-style: normal;
            font-weight: 700;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin: 0;
            padding: 0;
        }

        .fc-toolbar-title {
            color: var(--gray, #4F5168) !important;
        }

        .fc .fc-toolbar-title {
            font-size: 20px;
            font-weight: 500;
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
                initialView: 'dayGridWeek',
                events: events,
                eventClick: function(info) {
                    // Redirect to the specified URL when an event is clicked
                    window.location.href = info.event.url;
                },


            });
            calendar.render();
        });
    </script>
@endpush
@section('content')
    <div class="body-main-content">
        <div class="overview-section">
            <div class="row">
                <div class="col-md-12 bg-gray">
                    <h2 class= "mb-2">Calender</h2>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
@endsection

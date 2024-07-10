@extends('layouts.app')

@section('content')
{{--  <link href='{{ ENV('BASE_URL') }}/public/calendar/lib/main.css' rel='stylesheet' />  --}}
{{--  <script src='{{ ENV('BASE_URL') }}/public/calendar/lib/main.js'></script>  --}}
@push('head')
    <link href="{{ asset('assets/assets/calendar/calendar/lib/main.css') }}" rel='stylesheet' />
    <script src="{{ asset('assets/assets/calendar/calendar/lib/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var initialLocaleCode = 'id';
            var calendarEl = document.getElementById('calendar');
            var calendarWeek = document.getElementById('calendarWeek');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                {{--  initialView: 'timeGridWeek',  --}}
                locale: initialLocaleCode,
                navLinks: true,
                dayMaxEvents: true,
                events: {
                    url: '/front-office/get-stay-view',
                    failure: function() {
                        {{--  document.getElementById('script-warning').style.display = 'block';  --}}
                    },
                    loading: function(bool) {
                        document.getElementById('loading').style.display =
                        bool ? 'block' : 'none';
                    },
                    success: function(info) {
                        console.log('Events successfully loaded:', info);
                    },
                }
            });

            calendar.render();

            //Minggu ini
            {{--  var calendar3 = new FullCalendar.Calendar(calendarWeek, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                  // left: 'prev,next today',
                  // center: 'title',
                  // right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                // initialDate: '2020-09-12',
                locale: initialLocaleCode,

                // editable: true,
                navLinks: true, // can click day/week names to navigate views
                dayMaxEvents: true, // allow "more" link when too many events
                events: {
                  url: '/front-office/get-stay-view',
                  failure: function() {
                    document.getElementById('script-warning').style.display = 'block'
                  }
                },
                loading: function(bool) {
                  document.getElementById('loading').style.display =
                    bool ? 'block' : 'none';
                }
              });

            calendar3.render();  --}}
        });
    </script>
@endpush

<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6>Front Desk <i class="bi bi-chevron-right"></i> {{ $title }}</h6>
                            <a href="{{ route('room.create') }}" class="btn btn-primary btn-sm ms-auto">Create</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="p-5">
                            <div id='calendar'></div>
                        </div>

                        <div class="p-5">
                            <div id='calendarWeek'></div>
                        </div>
                </div>
        </div>
    </div>
</main>
@endsection

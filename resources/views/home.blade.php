@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('fullcalendar/main.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card calendarEvent">
                <div class="card-header">
                    <strong class="control-label">{{ __('home.calendar') }}</strong>
                    {{-- <button class="btn btn-block btn-outline-info float-right  col-md-2" onclick="hideCalendar()">{{
                        __('home.future_events') }}</button> --}}

                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
            {{-- <div class="card futureEvent" style="display:none">
                <div class="card-header">
                    <strong class="control-label">{{ __('home.upcoming_events') }}</strong>
                    <button class="btn btn-block btn-outline-info float-right  col-md-2" onclick="hideFuture()">{{
                        __('home.calendar') }}</button>

                </div>
                <div class="card-body">
                    <div id="future">
                        <table>

                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('fullcalendar/main.min.js') }}"></script>
<script>
    var localeCode = "{{App::currentLocale()}}";
    if(localeCode == 'jp'){
        localeCode = 'ja';
    }
    $(document).ready(function(){
        var calendarEl = document.getElementById('calendar');
        var config = {
            navLinks: true,
            selectable: true,
            nowIndicator: true,
            businessHours: true,
            dayMaxEvents: true,
            locale: localeCode,
            headerToolbar:{
                left:'prev,next today',
                center:'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
            initialView: 'dayGridMonth',
            events:'/get-events',
        };
        let calendar= new FullCalendar.Calendar(calendarEl, config);
        calendar.render();
    });
</script>
{{--
<script>
function hideCalendar() {
 $('.calendarEvent').hide();
 $('.futureEvent').show();
};
function hideFuture(){
$('.calendarEvent').show();
 $('.futureEvent').hide();
}
</script> --}}
@endsection

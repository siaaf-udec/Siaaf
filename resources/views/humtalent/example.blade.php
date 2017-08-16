@extends('material.layouts.dashboard')

@section('page-title', 'Documentos Requeridos:')
@push('styles')
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print' type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/css/plugins-md.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/css/components-md.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/global/css/components.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Calendario'])
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <!-- Selección de eventos-->
                <div id="external-events">
                    <form class="inline-form">
                        {!! Field::text(
                            'event_title',null,
                            ['label'=>'Crear un evento:','class'=> 'form-control','required','placeholder'=>'Nombre del evento...', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                            ['help' => 'Digite el nombre del evento', 'icon' => 'fa fa-calendar']) !!}

                        {!! Field::date(
                            'Fecha de recordatorio',
                            ['required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                            ['help' => 'Digite la fecha de recordatorio.', 'icon' => 'fa fa-calendar']) !!}
                        <a href="javascript:;" id="event_add" class="btn green"> Añadir </a>
                    </form>
                    <hr>
                        <div id="event_box" class="margin-bottom-10"></div>

                    <br><br><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline" for="drop-remove"> Eliminar evento del listado luego de arrastrarlo
                        <input type="checkbox" class="group-checkable" id="drop-remove" />
                        <span></span>
                    </label>

                    <hr class="visible-xs" /> </div>
                <!-- Fin selección de eventos-->
            </div>
                <div class="col-md-9 col-sm-12">
                    <div id="calendar" class="has-toolbar"> </div>
                </div>
        </div>
    @endcomponent
@endsection
@push('plugins')

<script src="{{ asset('assets/global/plugins/fullcalendar/lib/moment.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fullcalendar/lang-all.js') }}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>

<script src="{{asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

@endpush
@push('functions')
<script>
    var AppCalendar = function() {

        return {
            //main function to initiate the module
            init: function() {
                this.initCalendar();
            },

            initCalendar: function() {

                if (!jQuery().fullCalendar) {
                    return;
                }

                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                var h = {};

                if (App.isRTL()) {
                    if ($('#calendar').parents(".portlet").width() <= 720) {
                        $('#calendar').addClass("mobile");
                        h = {
                            right: 'title, prev, next',
                            center: '',
                            left: 'agendaDay, agendaWeek, month, today'
                        };
                    } else {
                        $('#calendar').removeClass("mobile");
                        h = {
                            right: 'title',
                            center: '',
                            left: 'agendaDay, agendaWeek, month, today, prev,next'
                        };
                    }
                } else {
                    if ($('#calendar').parents(".portlet").width() <= 720) {
                        $('#calendar').addClass("mobile");
                        h = {
                            left: 'title, prev, next',
                            center: '',
                            right: 'today,month,agendaWeek,agendaDay'
                        };
                    } else {
                        $('#calendar').removeClass("mobile");
                        h = {
                            left: 'title',
                            center: '',
                            right: 'prev,next,today,month,agendaWeek,agendaDay'
                        };
                    }
                }

                var initDrag = function(el) {
                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim(el.text()) // use the element's text as the event title
                    };
                    // store the Event Object in the DOM element so we can get to it later
                    el.data('eventObject', eventObject);
                    // make the event draggable using jQuery UI
                    el.draggable({
                        zIndex: 999,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0 //  original position after the drag
                    });
                };

                var addEvent = function(title) {
                    title = title.length === 0 ? "Untitled Event" : title;
                    var html = $('<div class="external-event label label-default">' + title + '</div>');
                    jQuery('#event_box').append(html);
                    initDrag(html);
                };

                $('#external-events div.external-event').each(function() {
                    initDrag($(this));
                });

                $('#event_add').unbind('click').click(function() {
                    var title = $('#event_title').val();
                    addEvent(title);
                });

                //predefined events
                $('#event_box').html("");
                addEvent("My Event 1");
                addEvent("My Event 2");
                addEvent("My Event 3");
                addEvent("My Event 4");
                addEvent("My Event 5");
                addEvent("My Event 6");

                $('#calendar').fullCalendar('destroy'); // destroy the calendar
                $('#calendar').fullCalendar({ //re-initialize the calendar
                    header: h,
                    defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/
                    slotMinutes: 15,
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    drop: function(date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');
                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;
                        copiedEventObject.className = $(this).attr("data-class");

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }
                    },
                    events: [{
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        backgroundColor: App.getBrandColor('yellow')
                    }, {
                        title: 'Long Event',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        backgroundColor: App.getBrandColor('green')
                    }, {
                        title: 'Repeating Event',
                        start: new Date(y, m, d - 3, 16, 0),
                        allDay: false,
                        backgroundColor: App.getBrandColor('red')
                    }, {
                        title: 'Repeating Event',
                        start: new Date(y, m, d + 4, 16, 0),
                        allDay: false,
                        backgroundColor: App.getBrandColor('green')
                    }, {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                    }, {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        backgroundColor: App.getBrandColor('grey'),
                        allDay: false,
                    }, {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        backgroundColor: App.getBrandColor('purple'),
                        allDay: false,
                    }, {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        backgroundColor: App.getBrandColor('yellow'),
                        url: 'http://google.com/',
                    }]
                });

            }

        };

    }();
    jQuery(document).ready(function() {
        AppCalendar.init();
    });


</script>
@endpush

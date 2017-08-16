@extends('material.layouts.dashboard')

@section('page-title', 'Documentos Requeridos:')
@push('styles')
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print' type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
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
                    <hr/>
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
<script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fullcalendar/lang-all.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

@endpush
@push('functions')
<script>
    $(document).ready(function() {

        var initDrag = function(el) {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim(el.text()),
                stick:true,// use the element's text as the event title
                backgroundColor: App.getBrandColor('green')

            };
            // store the Event Object in the DOM element so we can get to it later
            el.data('event', eventObject);
            // make the event draggable using jQuery UI
            el.draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });
        };

        var addEvent = function(title) {
            title = title.length === 0 ? "Evento sin titulo" : title;
            var html = $('<div class="external-event label label-default ui-draggable ui-draggable-handle" >' + title + '</div>');
            jQuery('#event_box').append(html);
            initDrag(html);
        };

        $('#external-events div.external-event').each(function() {
            initDrag($(this));
            $(this).data('event',
                {
                    title: $.trim($(this).text()),
                    stick: true
                });

            $(this).draggable(
                {
                    zIndex: 999,
                    revert: true,
                    revertDuration: 0
                });
        });

        $('#event_add').unbind('click').click(function() {
            var title = $('#event_title').val();
            addEvent(title);
        });


        $('#calendar').fullCalendar({
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,basicWeek,basicDay'
            },
            lang:'es',
            editable: true,
            droppable: true,
            eventLimit:true,

            eventClick: function(calEvent, jsEvent, view) {

                alert('Event: ' + calEvent.title);

            },
            drop: function()
            {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked'))
                {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            }
        })


    });


</script>
@endpush

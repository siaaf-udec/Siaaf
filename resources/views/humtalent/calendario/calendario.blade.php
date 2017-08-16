@extends('material.layouts.dashboard')

@section('page-title', 'Documentos Requeridos:')
@push('styles')
<link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print' type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Calendario'])
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <!-- Selección de eventos-->
                <div id="external-events">
                    {!! Form::open (['id'=>'form_calendar']) !!}
                        {!! Field::text(
                            'NOTIF_Descripcion',null,
                            ['label'=>'Crear un evento:','class'=> 'form-control','required','placeholder'=>'Nombre del evento...', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                            ['help' => 'Digite el nombre del evento', 'icon' => 'fa fa-calendar']) !!}

                    <a href="javascript:;" id="event_add" class="btn green"> Añadir </a>
                    {!! Form::close() !!}
                    <hr/>
                    <div id="event_box" class="margin-bottom-10"></div>
                    <p>
                        <h1 style="color: red" class="fa fa-remove" id="trash"><i class="icon-trash"></i></h1>
                    </p>
                    <hr class="visible-xs" /> </div>
                <!-- Fin selección de eventos-->
            </div>
            <div class="col-md-9 col-sm-12">
                <div id="calendar" class="has-toolbar"> </div>
            </div>
            <div class="col-md-12">
                <!-- Modal -->
                <div class="modal fade" id="modal-update-notify" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            {!! Form::open(['id' => 'from_calendar_notify','method'=>'POST', 'route'=> ['talento.humano.calendario.storeDateNotification']]) !!}
                            <div class="modal-header modal-header-success">
                                <h1><i class="glyphicon glyphicon-thumbs-up"></i> Fecha de Notificación</h1>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Field::date(
                                                'NOTIF_Fecha_Notificacion',
                                                ['label' => 'Fecha de notificación :','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                ['help' => 'Digite la fecha de recordatorio.', 'icon' => 'fa fa-calendar']) !!}
                                        {!! Field::hidden ('PK_NOTIF_Id_Notificacion')!!}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- Modal -->
                <div class="modal fade" id="modal-update-Event" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            {!! Form::open(['id' => 'from_calendar_notify','method'=>'POST', 'route'=> ['talento.humano.calendario.storeDateEvent']]) !!}
                            <div class="modal-header modal-header-success">
                                <h1><i class="glyphicon glyphicon-thumbs-up"></i> Fecha de Notificación</h1>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Field::date(
                                                'EVNT_Fecha_Notificacion',
                                                ['label' => 'Fecha de notificación :','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                ['help' => 'Digite la fecha de recordatorio.', 'icon' => 'fa fa-calendar']) !!}
                                        {!! Field::hidden ('PK_EVNT_IdEvento')!!}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- Modal -->
                <div class="modal fade" id="modal-update-titleNotify" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            {!! Form::open(['id' => 'from_calendar_Updatenotify','method'=>'POST', 'route'=> ['talento.humano.calendario.updateNotification']]) !!}
                            <div class="modal-header modal-header-success">
                                <h1><i class="glyphicon glyphicon-thumbs-up"></i> Modificar recordatorio</h1>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Field::text(
                                            'NOTIF_Descripcion',null,
                                            ['label'=>'Crear un evento:','class'=> 'form-control','required','placeholder'=>'Nombre del evento...', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                            ['help' => 'Digite el nombre del evento', 'icon' => 'fa fa-calendar']) !!}
                                        {!! Field::date(
                                                'NOTIF_Fecha_Notificacion',
                                                ['label' => 'Fecha de notificación :','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                ['help' => 'Digite la fecha de recordatorio.', 'icon' => 'fa fa-calendar']) !!}
                                        {!! Field::hidden ('PK_NOTIF_Id_Notificacion')!!}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- Modal -->
                <div class="modal fade" id="modal-update-titleEvent" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            {!! Form::open(['id' => 'from_calendar_Updatenotify','method'=>'POST', 'route'=> ['talento.humano.calendario.updateEvent']]) !!}
                            <div class="modal-header modal-header-success">
                                <h1><i class="glyphicon glyphicon-thumbs-up"></i> Modificar Evento</h1>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Field::text(
                                            'EVNT_Descripcion',null,
                                            ['label'=>'Crear un evento:','class'=> 'form-control','required','placeholder'=>'Nombre del evento...', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                            ['help' => 'Digite el nombre del evento', 'icon' => 'fa fa-calendar']) !!}
                                        {!! Field::text(
                                                'EVNT_Hora',
                                                ['label'=>'Hora:','class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "hh/mm-", 'data-date-start-date' => "+0d", 'required', 'auto' => 'off'],
                                                ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}
                                        {!! Field::date(
                                                'EVNT_Fecha_Notificacion',
                                                ['label' => 'Fecha de notificación :','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                ['help' => 'Digite la fecha de notificación del evento .', 'icon' => 'fa fa-calendar']) !!}
                                        {!! Field::hidden ('PK_NOTIF_Id_Notificacion')!!}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
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
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script>

    $(document).ready(function() {
        @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'success':
                toastr.options.closeButton = true;
                toastr.success("{{Session::get('message')}}",'Calendario:');
                break;
        }
         @endif



        var initDrag = function(el) {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim(el.text()),
                stick:true,// use the element's text as the event title
                backgroundColor:'#25C279'
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

        });

        $('#event_add').unbind('click').click(function() {
            var title = $('#NOTIF_Descripcion').val();
            addEvent(title);
        });

        $('#calendar').fullCalendar({

            events: function(start, end, timezone, callback) {
                var route = "{{ route('talento.humano.calendario.getEvent')}}";
                $.ajax({
                    url: route,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                    },
                    success: function(eventos) {
                        var events= JSON.parse(eventos);

                        callback(events);

                    }
                });
            },

            eventReceive: function(event){
                var title = event.title;
                var start = event.start.format("YYYY-MM-DD");
                var end   = event.start.format("YYYY-MM-DD");
                var route = "{{ route('talento.humano.calendario.storeNotification')}}";
                $.ajax({
                    url: route,
                    data: 'type=new&title='+title+'&startdate='+start+'&endDate='+end,
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function(response){
                       $('input[name="PK_NOTIF_Id_Notificacion"]').val(response);
                        $('#modal-update-notify').modal('toggle');
                    },
                    error: function(e){
                        console.log(e.responseText);
                    }
                });
                $('#calendar').fullCalendar('updateEvent',event);
            },
            eventResize: function(event){
                var end   = event.end.format("YYYY-MM-DD");
                var id    = event.id;
                var eventType= event.type;
                var route = "{{ route('talento.humano.calendario.updateDateNotification')}}";
                $.ajax({
                    url: route,
                    data: 'type=endDateUpdate&endDate='+end+'&eventId='+id+'&eventType='+eventType,
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function(response){

                    },
                    error: function(e){
                        console.log(e.responseText);
                    }
                });
                $('#calendar').fullCalendar('updateEvent',event);
            },
            eventDrop: function(event, delta, revertFunc) {
                var title = event.title;
                var start = event.start.format();
                var end = (event.end == null) ? start : event.end.format();
                var id    = event.id;
                var eventType  =  event.type;
                var route = "{{ route('talento.humano.calendario.updateDateNotification')}}";
                $.ajax({
                    url: route,
                    data: 'type=resetDate&startdate='+start+'&endDate='+end+'&eventId='+id+'&eventType='+eventType,
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function(response){
                        if(response.eventType == "Evento"){
                            $('input[name="PK_EVNT_IdEvento"]').val(response.id);
                            $('#modal-update-Event').modal('toggle');
                        }
                        if(response.eventType == "Recordatorio"){
                            $('input[name="PK_NOTIF_Id_Notificacion"]').val(response.id);
                            $('#modal-update-notify').modal('toggle');
                        }

                    },
                    error: function(e){
                        console.log(e.responseText);
                    }
                });
            },
           eventClick: function(calEvent, jsEvent, view) {
                if(calEvent.type == "Recordatorio") {
                    $('input[name="PK_NOTIF_Id_Notificacion"]').val(calEvent.id);
                    $('input[name="NOTIF_Descripcion"]').val(calEvent.title);
                    $('input[name="NOTIF_Fecha_Notificacion"]').val(calEvent.notif);
                    $('#modal-update-titleNotify').modal('toggle');
                }
                if(calEvent.type == "Evento"){
                    $('input[name="PK_NOTIF_Id_Notificacion"]').val(calEvent.id);
                    $('input[name="EVNT_Descripcion"]').val(calEvent.title);
                    $('input[name="EVNT_Hora"]').val(calEvent.hora);
                    $('input[name="EVNT_Fecha_Notificacion"]').val(calEvent.notif);
                    $('#modal-update-titleEvent').modal('toggle');
                }
            },
            eventRender: function(event,element, jsEvent, ui, view) {
                 var el = element.html();
                 element.html(el+'<div style="text-align:right;" class="closeE"><i style="color: #f9fffd;" class="icon-trash"></i></div>');
                 element.find('.closeE').click(function (e){
                     e.preventDefault();
                //if (isElemOverDiv()){
                    var id = event.id;
                    var eventType = event.type;
                    var route = "{{ route('talento.humano.calendario.deleteNotification')}}";
                    $.ajax({
                        url: route,
                        data: 'eventId=' + id + '&eventType=' + eventType,
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                UIToastr.init(xhr, response.title, response.message);
                            }

                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
               // }
                });
            },
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,basicWeek,basicDay'
            },
            lang:'es',
            editable: true,
            droppable: true,
            eventLimit:true,
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

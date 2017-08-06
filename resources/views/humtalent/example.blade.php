@extends('material.layouts.dashboard')

@section('page-title', 'Documentos Requeridos:')
@push('styles')
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print' type="text/css" />

@endpush
@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Calendario'])
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <!-- Selección de eventos-->
                <h3 class="event-form-title margin-bottom-20">Crear un evento: </h3>
                <div id="external-events">
                    <form class="inline-form">
                        <input autocomplete="off" value="" class="form-control" placeholder="Nombre del evento..." id="event_title" />
                        <br/>
                        <a href="javascript:;" id="event_add" class="btn green"> Añadir </a>
                    </form>
                    <hr/>

                        <div class="external-event label label-default ui-draggable ui-draggable-handle " style="position: relative;">Prueba 1</div>
                        <div class="external-event label label-default ui-draggable ui-draggable-handle" style="position: relative;">Prueba 2</div>
                        <div class="external-event label label-default ui-draggable ui-draggable-handle" style="position: relative;">Prueba 3</div>
                        <div class="external-event label label-default ui-draggable ui-draggable-handle" style="position: relative;">Prueba 4</div>
                        <div class="external-event label label-default ui-draggable ui-draggable-handle" style="position: relative;">Prueba 5</div>
                        <div class="external-event label label-default ui-draggable ui-draggable-handle" style="position: relative;">Prueba 6</div>


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




@endpush
@push('functions')
<script>
    $(document).ready(function() {


        $('#external-events .external-event').each(function()
        {
            // store data so the calendar knows to render an event upon drop
            $(this).data('event',
                {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });
            // make the event draggable using jQuery UI
            $(this).draggable(
                {
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });
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

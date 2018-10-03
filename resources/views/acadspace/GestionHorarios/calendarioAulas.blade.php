<!--/**
 * Created by PhpStorm.
 * User: AlexPovedaG
 * Date: 4/09/17
 * Time: 12:51 PM
 */-->
@permission('ACAD_EVENTOS')
@extends('material.layouts.dashboard')
@push('styles')
    {{--Fullcalendar--}}
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print'
          type="text/css"/>
    {{--Select2--}}
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
    {{--Toast--}}
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Styles SWEETALERT  -->
    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    {{--Estilo agregado para drag and drop zone--}}
    <link href="{{asset('assets/main/acadspace/css/componentsacadspace.css')}}" rel="stylesheet"
          type="text/css"/>
    {{--JQuery datatable and row details--}}
    <link href="{{ asset('assets/main/acadspace/css/rowdetails.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-calendar', 'title' => 'Gestión espacios académicos'])
        <div class="panel panel-default">
            <!-- Content Header (Page header) -->
            <div class="panel-body">
                <!-- Main content -->
                <section class="content">
                    <div class="col-md-12">
                        <div class="note">
                            @permission('ACAD_CONSULTAR_AULA')
                            {!! Field::select('Espacio académico:',$espacios,
                                    ['id' => 'SOL_laboratorios', 'name' => 'SOL_laboratorios'])
                                    !!}

                            {!! Field::select(
                                                            'aula', null,
                                                            ['name' => 'aula']) !!}
                            <br>
                            <br>
                            <br>
                            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                                @slot('columns', [
                                '#' => ['style' => 'width:20px;'],
                                '',
                                'Nucleo',
                                'Estudiantes',
                                'Practica',
                                'Acciones'
                                ])
                            @endcomponent
                            @endpermission
                        </div>
                    </div>
                    {{--Calendar--}}
                    <div class="col-md-12">
                        <div class="note">
                            <br>
                            <br>
                            <br>
                            <div class="row">
                                <div class="portlet light portlet-fit  calendar">
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">Eventos</h4>
                                                </div>

                                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                                    <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                                                    <ul class="fc-color-picker" id="color-chooser">
                                                        <li><a class="text-aqua" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-blue" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-light-blue" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-teal" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-yellow" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-orange" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-green" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-lime" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-red" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-purple" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-fuchsia" href="#"><i
                                                                        class="fa fa-square"></i></a></li>
                                                        <li><a class="text-muted" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                        <li><a class="text-navy" href="#"><i
                                                                        class="fa fa-square"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <form class="inline-form">
                                                    <div class="input-group">
                                                        <input id="new-event" type="text" class="form-control"
                                                               placeholder="Titulo del evento">

                                                        <div class="input-group-btn">
                                                            @permission('ACAD_REGISTRAR_EVENTO')
                                                            <button id="add-new-event" type="button"
                                                                    class="btn btn-primary btn-flat">
                                                                Agregar
                                                            </button>
                                                            @endpermission
                                                        </div>
                                                        <!-- /btn-group -->
                                                    </div>


                                                    <hr/>
                                                    <div class="box-body">
                                                        <div id="external-events">
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <!-- the events -->

                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"
                                                               for="drop-remove">
                                                            Remover al asignar
                                                            <input type="checkbox" class="group-checkable"
                                                                   id="drop-remove"/>
                                                            <span></span>
                                                        </label>

                                                    </div>
                                                </form>
                                                <!-- /.box-body -->
                                                <div id="event_box" class="margin-bottom-10"></div>
                                                <hr class="visible-xs"/>
                                                @permission('ACAD_IMPRIMIR_PDF')
                                                <span id="AE_btn_pdf" class="btn blue"><input type="hidden"
                                                                                              id="zz_pdf"
                                                                                              value=""/>Generar PDF</span>
                                                @endpermission
                                            </div>
                                            <!-- END DRAGGABLE EVENTS PORTLET-->
                                            <div class="col-md-9 col-sm-12">
                                                <div id="calendar" class="has-toolbar"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>    <!-- /.content -->
            </div><!-- /.panel-body -->
        </div><!-- /.panel -->
    @endcomponent
@endsection

@push('plugins')
    {{--Fullcalendar--}}
    <script src="{{ asset('assets/global/plugins/fullcalendar/lib/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/fullcalendar/lang-all.js') }}" type="text/javascript"></script>
    {{--Jquery--}}
    <script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    {{--DatePicker--}}
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"
            type="text/javascript"></script>
    {{--Validations--}}
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>
    {{--Datatable--}}
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <!-- Mensaje TOAST -->
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
    </script>
    {{--Selects--}}
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
    {{--Handlebars--}}
    <script src="{{ asset('assets/main/acadspace/js/handlebars.js') }}"></script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    {{--Row Details--}}
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tr>
                <td>Docente solicitante:</td>
                <td>@{{user.name}} @{{user.lastname}}</td>
            </tr>
            <tr>
                <td>Solicito para:</td>
                <td>@{{SOL_Dias}} @{{SOL_fecha_inicial}}</td>
            </tr>
            <tr>
                <td>Hora inicio: @{{SOL_Hora_Inicio}}</td>
                <td>Hora fin: @{{SOL_Hora_Fin}}</td>
            </tr>
            <tr>
                <td>Guía de práctica:</td>
                <td>@{{SOL_Guia_Practica}}</td>
            </tr>
            <tr>
                <td>Software:</td>
                <td>@{{software.SOF_Nombre_Soft}}</td>
            </tr>
        </table>
    </script>
    <script>
        /*PINTAR TABLA*/
        $(document).ready(function () {
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                allowClear: true,
                placeholder: "Seleccione",
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });


            var template = Handlebars.compile($("#details-template").html());
            var table, url, columns;
            table = $('#art-table-ajax');

            url = "{{ route('espacios.academicos.acadcalendar.data' ) }}" + '/' + 0;
            columns = [
                {data: 'DT_Row_Index', "visible": false},
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {data: 'SOL_Nucleo_Tematico', name: 'Nucleo'},
                {data: 'SOL_Cant_Estudiantes', name: 'Estudiantes'},
                {data: 'tipo_prac', name: 'Practica'},
                {
                    defaultContent: '@permission('ACAD_VER_MAS_EVENTO') <a href="javascript:;" class="btn btn-simple btn-primary btn-icon edit"><i class="glyphicon glyphicon-ok"></i></a> @endpermission',
                    data: 'action',
                    name: 'action',
                    title: 'Acciones',
                    orderable: false,
                    searchable: false,
                    exportable: false,
                    printable: false,
                    className: 'text-right',
                    render: null,
                    responsivePriority: 2
                }
            ];

            dataTableServer.init(table, url, columns);
            /*ENVIANDO EL VALOR DEL SELECT AULA PARA TRAER LOS DATOS*/
            $("#SOL_laboratorios").change(function (event) {
                /*Limpiar los eventos drag and drop creados dinamicamente*/
                $("#external-events").empty();
                /*Cargar select de aulas*/
                $('#aula').empty();
                $.get("cargarSalasCalendario/" + event.target.value + "", function (response) {
                    $(response.data).each(function (key, value) {
                        $("#aula").append(new Option(value.SAL_Nombre_Sala, value.PK_SAL_Id_Sala));
                    });
                    $("#aula").val([]);
                });
                //RECARGAR DATATABLE CON BASE AL EVENTO DEL SELECT
                $("#aula").change(function (event) {
                    $("#external-events").empty();
                    App.unblockUI('.portlet-form');
                    table = $('#art-table-ajax');
                    var select = $('#aula option:selected').val();
                    table.dataTable().fnDestroy();
                    url = "{{ route('espacios.academicos.acadcalendar.data' ) }}" + '/' + select;
                    dataTableServer.init(table, url, columns);
                    table = table.DataTable();
                    //FIN RECARGAR DATATABLE
                    /*Inicio recargar calendario con base al select*/
                    var events = {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'cargaEventos',
                        type: 'POST',
                        data: {
                            sala: $('#aula option:selected').val()
                        }
                    };
                    $('#calendar').fullCalendar('removeEventSource', events);
                    $('#calendar').fullCalendar('addEventSource', events);
                    $('#calendar').fullCalendar('refetchEvents');
                });
                /*Fin recargar calendario*/

            });

            /*Inicio detalles desplegables grupal*/
            $('#art-table-ajax tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('details');
                }
                else {
                    // Open this row
                    row.child(template(row.data())).show();
                    tr.addClass('details');
                }
            });
            /*Fin detalles de solicitud*/
            /*Terminar proceso datatable-*/
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();

                var route = '{{ route('espacios.academicos.evalsol.finalizarProceso') }}';
                var type = 'POST';
                var async = async || false;
                var formData = new FormData();
                formData.append('id_solicitud', dataTable.PK_SOL_id_solicitud);
                $.ajax({
                    url: route,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    cache: false,
                    type: type,
                    contentType: false,
                    data: formData,
                    processData: false,
                    async: async,
                    beforeSend: function () {

                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            table.ajax.reload();
                            UIToastr.init(xhr, response.title, response.message);
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'error') {
                            UIToastr.init(xhr, response.title, response.message);
                        }
                    }
                });

            });
            /*fin terminar proceso datatable*/

            $(function () {
                /* initialize the external events
                 -----------------------------------------------------------------*/
                function ini_events(ele) {
                    ele.each(function () {
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
                            revertDuration: 0  //  original position after the drag
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

                //while(reload==false){
                $('#calendar').fullCalendar({
                    lang: 'es',
                    axisFormat: "HH:mm",
                    allDaySlot: false,
                    loading: function (bool) {
                        if (bool)
                            $('#loading').show();
                        else
                            $('#loading').hide();
                    },
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {
                        today: 'hoy',
                        month: 'mes',
                        week: 'semana',
                        day: 'dia'
                    },

                    events: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'cargaEventos',
                        type: 'POST',
                        data: {
                            sala: $('select[name="aula"]').val()
                        }
                    },

                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar !!!

                    drop: function (date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');
                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);
                        allDay = true;
                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;
                        copiedEventObject.backgroundColor = $(this).css("background-color");
                        copiedEventObject.borderColor = $(this).css("border-color");

                        // render the event on the calendar
                        //$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }
                        //Guardamos el evento creado en base de datos
                        var title = copiedEventObject.title;
                        var start = copiedEventObject.start.format("YYYY-MM-DD HH:mm");
                        var back = copiedEventObject.backgroundColor;
                        var sala = document.getElementById("aula").value;
                        var espacio = $('select[name="SOL_laboratorios"]').val();

                        if ($('select[name="aula"]').val() == null) {
                            UIToastr.init('error', '¡Error!', 'Antes de registrar eventos seleccione el espacio academico y aula que gestionara');
                        } else {
                            crsfToken = document.getElementsByName("_token")[0].value;
                            $.ajax({
                                url: 'guardaEventos',
                                data: 'title=' + title + '&start=' + start + '&allday=' + allDay + '&background=' + back + '&salaSeleccionada=' + sala + '&espacio=' + espacio,
                                type: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": crsfToken
                                },
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        $('#calendar').fullCalendar('refetchEvents');
                                        App.unblockUI('.portlet-form');
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        }
                    },
                    eventResize: function (event) {
                        var start = event.start.format("YYYY-MM-DD HH:mm");
                        var back = event.backgroundColor;
                        var allDay = event.allDay;
                        if (event.end) {
                            var end = event.end.format("YYYY-MM-DD HH:mm");
                        } else {
                            var end = null;
                        }
                        crsfToken = document.getElementsByName("_token")[0].value;
                        $.ajax({
                            url: 'actualizaEventos',
                            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id + '&background=' + back + '&allday=' + allDay,
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": crsfToken
                            },
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    $('#calendar').fullCalendar('refetchEvents');
                                    App.unblockUI('.portlet-form');
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    },
                    eventDrop: function (event, delta) {
                        var start = event.start.format("YYYY-MM-DD HH:mm");
                        if (event.end) {
                            var end = event.end.format("YYYY-MM-DD HH:mm");
                        } else {
                            var end = "NULL";
                        }
                        var back = event.backgroundColor;
                        var allDay = event.allDay;
                        crsfToken = document.getElementsByName("_token")[0].value;

                        $.ajax({
                            url: 'actualizaEventos',
                            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id + '&background=' + back + '&allday=' + allDay,
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": crsfToken
                            },
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    $('#calendar').fullCalendar('refetchEvents');
                                    App.unblockUI('.portlet-form');
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    },
                    eventClick: function (event, jsEvent, view) {
                        crsfToken = document.getElementsByName("_token")[0].value;
                        // var con = confirm("Esta seguro que desea eliminar el evento");
                        // if (con) {
                        swal({
                            title: "¿Esta seguro?",
                            text: "¿Esta seguro que desea eliminar el evento?",
                            type: "warning",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            confirmButtonText: "Si, eliminar",
                            confirmButtonColor: "#ec6c62",
                            confirmButtonClass: "btn blue",
                            cancelButtonText: "Cancelar",
                            cancelButtonClass: "btn red",
                        }, function () {
                            $.ajax({
                                url: 'eliminaEvento',
                                data: 'id=' + event.id,
                                headers: {
                                    "X-CSRF-TOKEN": crsfToken
                                },
                                type: "POST",
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        $('#calendar').fullCalendar('removeEvents', event._id);
                                        App.unblockUI('.portlet-form');
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            })
                                .done(function (data) {
                                    swal("Eliminado", "El evento se ha eliminado correctamente", "success");
                                })
                                .error(function (data) {
                                    swal("Oops", "Ha ocurrido un error", "error");
                                });
                        });

                    },

                    eventMouseover: function (event, jsEvent, view) {
                        var start = (event.start.format("HH:mm"));
                        var back = event.backgroundColor;
                        if (event.end) {
                            var end = event.end.format("HH:mm");
                        } else {
                            var end = "No definido";
                        }
                        if (event.allDay) {
                            var allDay = "Si";
                        } else {
                            var allDay = "No";
                        }
                        var tooltip = '<div class="tooltipevent" style="border:1px solid black;margin: 0.5em;padding: 0.5em;width:200px;height:100px;color:white;background:' + back + ';position:absolute;z-index:10001;">' + '<center>' + event.title + '</center>' + '<br>' + 'Inicio: ' + start + '<br>' + 'Fin: ' + end + '</div>';
                        $("body").append(tooltip);
                        $(this).mouseover(function (e) {
                            $(this).css('z-index', 10000);
                            $('.tooltipevent').fadeIn('500');
                            $('.tooltipevent').fadeTo('10', 1.9);
                        }).mousemove(function (e) {
                            $('.tooltipevent').css('top', e.pageY + 10);
                            $('.tooltipevent').css('left', e.pageX + 20);
                        });
                    },

                    eventMouseout: function (calEvent, jsEvent) {
                        $(this).css('z-index', 8);
                        $('.tooltipevent').remove();
                    },

                    dayClick: function (date, jsEvent, view) {
                        if (view.name === "month") {
                            $('#calendar').fullCalendar('gotoDate', date);
                            $('#calendar').fullCalendar('changeView', 'agendaDay');
                        }
                    }
                });

                /* AGREGANDO EVENTOS AL PANEL */
                var exist = [];
                var currColor = "#3c8dbc"; //Red by default
                //Color chooser button
                var colorChooser = $("#color-chooser-btn");
                $("#color-chooser > li > a").click(function (e) {
                    e.preventDefault();
                    //Save color
                    currColor = $(this).css("color");
                    //Add color effect to button
                    $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
                });
                $("#add-new-event").click(function (e) {
                    e.preventDefault();
                    //Get value and make sure it is not null
                    var val = $("#new-event").val();
                    if (val.length == 0) {
                        UIToastr.init('error', 'Escribir un nombre', 'por favor agregar escribir algo en el campo');
                        return;
                    }
                    console.log(exist.length);
                    exist.push(val.toLowerCase());
                    console.log(exist);
                    //Create events
                var flag = 0;
                for (let i = 0; i < exist.length ; i++) {
                    if(exist[i].localeCompare(val.toLowerCase()) == 0)
                        flag += 1;
                }
                if(flag < 2 ){
                    var event = $("<div />");
                        event.css({
                        "background-color": currColor,
                        "border-color": currColor,
                        "color": "#fff"
                        }).addClass("external-event");
                        event.html(val);
                        $('#external-events').prepend(event);
                        flag = 0;
                        //Add draggable funtionality
                        ini_events(event);
                }else{
                    UIToastr.init('error', 'No repetir los nombres de los eventos', 'por favor cambiar el nombre');
                    return;
                }
                    //Remove event from text input
                    $("#new-event").val("");
                });
            });


        });
    </script>

    <script>
        /*Exportar a pdf*/
        $("#AE_btn_pdf").click(function () {
            window.print();
        });
    </script>
@endpush
@endpermission
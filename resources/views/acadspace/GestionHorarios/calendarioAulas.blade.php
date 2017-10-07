<!--/**
 * Created by PhpStorm.
 * User: AlexPovedaG
 * Date: 4/09/17
 * Time: 12:51 PM
 */-->
@permission('auxapoyo')
@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print'
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/main/acadspace/css/componentsacadspace.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Styles SWEETALERT  -->
    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>

@endpush
@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gestion espacios academicos'])

        <div class="panel panel-default">
            <!-- Content Header (Page header) -->
            <div class="panel-body">
                <!-- Main content -->
                <section class="content">
                    <div class="col-md-12">
                        {!! Field::select('SOL_laboratorios',
                                                                    ['Aulas de computo' => 'Aulas de computo',
                                                                    'Ciencias agropecuarias y ambientales' => 'Ciencias agropecuarias y ambientales'],
                                                                    null,
                                                                    [ 'label' => 'Seleccione el espacio academico que requiere:']) !!}
                        <div id="mostrar_sala">
                            {!! Form::label('label', 'Seleccione el aula:')  !!}

                            {!! Form::select('aulas',['placeholder'=>'Seleccione'],null,
                            array('class' => 'select2-hidden-accessible form-control pmd-select2', 'id'=>'aula')) !!}
                        </div>

                        <br>
                        <br>
                        <br>


                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                            @slot('columns', [
                            '#' => ['style' => 'width:20px;'],
                            'Nucleo',
                            'Estudiantes',
                            'Practica'
                            ])
                        @endcomponent
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h4 class="box-title">Eventos</h4>
                                </div>
                                <div class="box-body">
                                    <!-- the events -->
                                    <div id="external-events">
                                        <div class="checkbox">
                                            <label for="drop-remove">
                                                <input type="checkbox" id="drop-remove">
                                                Eliminar al asignar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /. box -->
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Crear evento</h3>
                                </div>
                                <div class="box-body">
                                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                        <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                                        <ul class="fc-color-picker" id="color-chooser">
                                            <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a>
                                            </li>
                                            <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                                            <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                    <div class="input-group">
                                        <input id="new-event" type="text" class="form-control"
                                               placeholder="Titulo de evento">

                                        <div class="input-group-btn">
                                            <button id="add-new-event" type="button" class="btn btn-primary btn-flat">
                                                Agregar
                                            </button>
                                        </div>
                                        <!-- /btn-group -->
                                    </div>
                                    <br/><br/>
                                    <!-- /input-group -->
                                    {!! Form::open(['route' => ['guardaEventos'], 'method' => 'POST', 'id' =>'form-calendario']) !!}
                                    {!! Form::close() !!}
                                </div>
                                <span id="AE_btn_pdf" class="btn blue"><input type="hidden" id="zz_pdf" value=""/>Generar PDF</span>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="box box-primary">
                                <div class="box-body no-padding">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /. box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div><!-- /.panel-body -->
        </div><!-- /.panel -->
        @endcomponent
        </div>
        </div>
@endsection
@push('plugins')
    <script src="{{ asset('assets/main/acadspace/js/addimage.js') }}" type="text/javascript"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="{{ asset('assets/global/plugins/fullcalendar/lib/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/fullcalendar/lang-all.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/main/acadspace/js/html2canvas.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    <!-- SCRIPT DATATABLE -->
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
@endpush
@push('functions')
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script>
        /*PINTAR TABLA*/
        $(document).ready(function () {
            var table, url, columns;
            table = $('#art-table-ajax');

            url = "{{ route('espacios.academicos.acadcalendar.data' ) }}" + '/' + 0;
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'SOL_nucleo_tematico', name: 'Nucleo'},
                {data: 'SOL_cant_estudiantes', name: 'Estudiantes'},
                {data: 'tipo_prac', name: 'Practica'}
            ];

            dataTableServer.init(table, url, columns);


            /*ENVIANDO EL VALOR DEL SELECT AULA PARA TRAER LOS DATOS*/
            $("#SOL_laboratorios").change(function (event) {
                /*Limpiar los eventos drag and drop creados dinamicamente*/
                $("#external-events").empty();
                /*Cargar select de aulas*/
                $.get("cargarSalasCalendario/" + event.target.value + "", function (response) {
                    $("#aula").empty();
                    $("#aula").append("<option value='seleccione'>Seleccione</option>")
                    for (i = 0; i < response.length; i++) {
                        $("#aula").append("<option value='" + response[i].SAL_nombre_sala + "'>" + response[i].SAL_nombre_sala + "</option>")
                    }
                });
                //RECARGAR DATATABLE CON BASE AL EVENTO DEL SELECT
                $("#aula").change(function (event) {
                    /*Limpiar los eventos drag and drop creados dinamicamente*/
                    $("#external-events").empty();
                    //Recargar datatable
                    var select = $('#aula option:selected').val();
                    $("#art-table-ajax").dataTable().fnDestroy();
                    url = "{{ route('espacios.academicos.acadcalendar.data' ) }}" + '/' + select;
                    dataTableServer.init(table, url, columns);
                    //FIN RECARGAR DATATABLE
                    /*Inicio recargar calendario con base al select*/
                    var events = {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'cargaEventos',
                        type: 'POST',
                        data: {
                            sala: $('#aula option:selected').val()
                        }
                    }


                    console.log("RESPUESTA");
                    $('#calendar').fullCalendar('removeEventSource', events);
                    $('#calendar').fullCalendar('addEventSource', events);
                    $('#calendar').fullCalendar('refetchEvents');
                });
                /*Fin recargar calendario*/

            });
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
                            sala: $('#aula option:selected').val()
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

                        crsfToken = document.getElementsByName("_token")[0].value;
                        $.ajax({
                            url: 'guardaEventos',
                            data: 'title=' + title + '&start=' + start + '&allday=' + allDay + '&background=' + back + '&salaSeleccionada=' + sala,
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": crsfToken
                            },
                            success: function (events) {
                                UIToastr.init('success', '¡Bien hecho!', 'Evento creado correctamente');
                                $('#calendar').fullCalendar('refetchEvents');
                            },
                            error: function (json) {
                                console.log("Error al crear evento");
                            }
                        });
                    },
                    eventResize: function (event) {
                        var start = event.start.format("YYYY-MM-DD HH:mm");
                        var back = event.backgroundColor;
                        var allDay = event.allDay;
                        if (event.end) {
                            var end = event.end.format("YYYY-MM-DD HH:mm");
                        } else {
                            var end = "NULL";
                        }
                        crsfToken = document.getElementsByName("_token")[0].value;
                        $.ajax({
                            url: 'actualizaEventos',
                            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id + '&background=' + back + '&allday=' + allDay,
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": crsfToken
                            },
                            success: function (json) {
                                UIToastr.init('success', '¡Bien hecho!', 'Evento modificado correctamente');
                                console.log("Updated Successfully");
                            },
                            error: function (json) {
                                console.log("Error al actualizar evento");
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
                            success: function (json) {
                                UIToastr.init('success', '¡Bien hecho!', 'Evento modificado correctamente');
                                console.log("Updated Successfully eventdrop");
                            },
                            error: function (json) {
                                console.log("Error al actualizar eventdrop");
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
                                success: function () {
                                    $('#calendar').fullCalendar('removeEvents', event._id);
                                    console.log("Evento eliminado");
                                }
                            })
                                .done(function (data) {
                                    swal("Eliminado", "El evento se ha eliminado correctamente", "success");
                                })
                                .error(function (data) {
                                    swal("Oops", "Ha ocurrido un error", "error");
                                });
                        });
                        /*else {
                                           console.log("Cancelado");
                                       }*/
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
                        var tooltip = '<div class="tooltipevent" style="width:200px;height:100px;color:white;background:' + back + ';position:absolute;z-index:10001;">' + '<center>' + event.title + '</center>' + '<br>' + 'Inicio: ' + start + '<br>' + 'Fin: ' + end + '</div>';
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
                        return;
                    }

                    //Create events
                    var event = $("<div />");
                    event.css({
                        "background-color": currColor,
                        "border-color": currColor,
                        "color": "#fff"
                    }).addClass("external-event");
                    event.html(val);
                    $('#external-events').prepend(event);

                    //Add draggable funtionality
                    ini_events(event);

                    //Remove event from text input
                    $("#new-event").val("");
                });
            });
        });


    </script>

    <script>
        /*Exportar a pdf*/
        $("#AE_btn_pdf").button({
            icons: {
                primary: "ui-icon-image"
            },
            text: false
        });
        $("#AE_btn_pdf").click(function () {
            //#AEFC is my div for FullCalendar
            html2canvas($('#calendar'), {
                logging: true,
                //  useCORS: true,
                onrendered: function (canvas) {
                    var imgData = canvas.toDataURL("image/jpeg");
                    var doc = new jsPDF();
                    doc.addImage(imgData, 'JPEG', 15, 40, 180, 160);
                    download(doc.output(), "AEFC.pdf", "text/pdf");

                }
            });
        })

        function download(strData, strFileName, strMimeType) {
            var D = document,
                A = arguments,
                a = D.createElement("a"),
                d = A[0],
                n = A[1],
                t = A[2] || "text/plain";

            //build download link:
            a.href = "data:" + strMimeType + "," + escape(strData);

            if (window.MSBlobBuilder) {
                var bb = new MSBlobBuilder();
                bb.append(strData);
                return navigator.msSaveBlob(bb, strFileName);
            }
            /* end if(window.MSBlobBuilder) */

            if ('download' in a) {
                a.setAttribute("download", n);
                a.innerHTML = "downloading...";
                D.body.appendChild(a);
                setTimeout(function () {
                    var e = D.createEvent("MouseEvents");
                    e.initMouseEvent("click", true, false, window, 0, 0, 0, 0, 0, false, false,
                        false, false, 0, null);
                    a.dispatchEvent(e);
                    D.body.removeChild(a);
                }, 66);
                return true;
            }
            /* end if('download' in a) */

            //do iframe dataURL download:
            var f = D.createElement("iframe");
            D.body.appendChild(f);
            f.src = "data:" + (A[2] ? A[2] : "application/octet-stream") + (window.btoa ? ";base64"
                : "") + "," + (window.btoa ? window.btoa : escape)(strData);
            setTimeout(function () {
                D.body.removeChild(f);
            }, 333);
            return true;
        }

        /* end download() */
    </script>
@endpush
@endpermission
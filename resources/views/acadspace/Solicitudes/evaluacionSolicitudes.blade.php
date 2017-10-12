@extends('material.layouts.dashboard')

@push('styles')
    <!-- MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Solicitudes'])
            <div class="clearfix">
                <br>
                {!! Field::select('laboratorioSeleccionado',
                                                        ['Aulas de computo' => 'Aulas de computo',
                                                        'Ciencias agropecuarias y ambientales' => 'Ciencias agropecuarias y ambientales',
                                                        'Laboratorio psicologia' => 'Laboratorio psicologia'],
                                                        null,
                                                        [ 'label' => 'Espacio academico a gestionar:']) !!}
                {{--DIVISION NAV--}}
                <div class="portlet-body" id="vista-tabla">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#tab_2_1" data-toggle="tab"> Solicitudes grupales </a>
                        </li>
                        <li>
                            <a href="#tab_2_2" data-toggle="tab"> Solicitudes libres </a>
                        </li>
                    </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="tab_2_1">
                                <p>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                                        @slot('columns', [
                                        '#' => ['style' => 'width:20px;'],
                                        'Nucleo tematico',
                                        'Estudiantes',
                                        'Practica',
                                        ' ' => ['style' => 'width:20px;'],
                                        'Acciones'
                                        ])
                                    @endcomponent
                                </p>
                            </div>
                            <div class="tab-pane fade" id="tab_2_2">
                                <p>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax-libre'])
                                        @slot('columns', [
                                        '#' => ['style' => 'width:20px;'],
                                        'Nucleo tematico',
                                        'Estudiantes',
                                        'Practica',
                                        ' ' => ['style' => 'width:20px;'],
                                        'Acciones'
                                        ])
                                    @endcomponent
                                </p>
                            </div>
                        </div>
                </div>
            </div>
            {{-- FIN DIVISION NAV--}}
    </div>

    <br>
    <br>
    <br>

    <div class="col-md-12">

    </div>
    <div class="clearfix">
    </div>
    {{--MODAL PARA ACEPTAR SOLICITUD Y ASIGNAR SALA--}}
    <div class="row">
        <div class="col-md-12">
        {{-- BEGIN HTML MODAL UPDATE --}}
        <!-- responsive -->
            <div class="modal fade" data-width="760" id="modal-aprobar-sol" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h2 class="modal-title">
                        <i class="glyphicon glyphicon-user">
                        </i>
                        Aprobar solicitud de espacio academico
                    </h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'form-aceptar-sol', 'class' => '', 'url' => '/forms']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                {{--{!! Field::select('Seleccione la sala donde asignara la solicitud:',$sala,
                                    ['name' => 'sala_seleccionada'])
                                    !!}--}}
                                {!! Form::label('label', 'Seleccione el aula donde asignara la solicitud:')  !!}

                                {!! Form::select('aulas',['placeholder'=>'Seleccione'],null, array('class' => 'form-control', 'id'=>'aula')) !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
            {{-- END HTML MODAL CREATE--}}
        </div>
    </div>
    {{--MODAL PARA REPROBAR SOLICITUD Y ASIGNAR SALA--}}
    <div class="row">
        <div class="col-md-12">
        {{-- BEGIN HTML MODAL UPDATE --}}
        <!-- responsive -->
            <div class="modal fade" data-width="760" id="modal-reprobar-sol" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h2 class="modal-title">
                        <i class="glyphicon glyphicon-user">
                        </i>
                        Reprobar solicitud de espacio academico
                    </h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'form-reprobar-sol', 'class' => '', 'url' => '/forms']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::label('Agregar observacion:') }}
                            {!! Form::textarea('anotacion',null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
            {{-- END HTML MODAL CREATE--}}
        </div>
    </div>

    @endcomponent

    {{-- END HTML SAMPLE --}}
@endsection



@push('plugins')

    <!-- SCRIPT DATATABLE -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <!-- SCRIPT MODAL -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}"
            type="text/javascript"></script>
    <!-- SCRIPT Validacion Maxlength -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Personalizadas -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>
    <!-- SCRIPT MENSAJES TOAST-->
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
    <!--HANDLEBAR-->
    <script src="{{ asset('assets/main/acadspace/js/handlebars.js') }}"></script>

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>

    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    <!-- Informacion que muestra al desplegar -->
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tr>
                <td>Fecha de creacion:</td>
                <td>@{{created_at}}</td>
            </tr>
            <tr>
                <td>Programa:</td>
                <td>@{{SOL_carrera}}</td>
            </tr>
            <tr>
                <td>Docente solicitante:</td>
                <td>@{{user.name}} @{{user.lastname}}</td>
            </tr>
            <tr>
                <td>Dias seleccionados:</td>
                <td>@{{SOL_dias}}</td>
            </tr>
            <tr>
                <td>Hora inicio: @{{SOL_hora_inicio}}</td>
                <td>Hora fin: @{{SOL_hora_fin}}</td>
            </tr>
            <tr>
                <td>Guia de practica:</td>
                <td>@{{SOL_guia_practica}}</td>
            </tr>
            <tr>
                <td>Software:</td>
                <td>@{{SOL_software}}</td>
            </tr>
            <tr>
                <td>Fechas:</td>
                <td>@{{SOL_rango_fechas}}</td>
            </tr>
        </table>
    </script>

    /*TEMPLATE PARA SOLICITUD LIBRE*/
    <script id="details-template-libre" type="text/x-handlebars-template">
        <table class="table">
            <tr>
                <td>Fecha de creacion:</td>
                <td>@{{created_at}}</td>
            </tr>
            <tr>
                <td>Programa:</td>
                <td>@{{SOL_carrera}}</td>
            </tr>
            <tr>
                <td>Docente solicitante:</td>
                <td>@{{user.name}} @{{user.lastname}}</td>
            </tr>
            <tr>
                <td>Fecha seleccionada:</td>
                <td>@{{SOL_rango_fechas}}</td>
            </tr>
            <tr>
                <td>Hora inicio: @{{SOL_hora_inicio}}</td>
                <td>Hora fin: @{{SOL_hora_fin}}</td>
            </tr>
            <tr>
                <td>Guia de practica:</td>
                <td>@{{SOL_guia_practica}}</td>
            </tr>
            <tr>
                <td>Software:</td>
                <td>@{{SOL_software}}</td>
            </tr>
        </table>
    </script>

    <script>
        $("#laboratorioSeleccionado").append("<option  style='display:none' value='' selected>Seleccione..</option>");
       $("#vista-tabla").css("display", "none");

        /*PINTAR TABLA SOLICITUDES GRUPALES*/
        $(document).ready(function () {
            //capturar el template para desplegar la informacion
            var template = Handlebars.compile($("#details-template").html());

            var table, url, columns;
            var select = "vacio";
            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.evalsol.data') }}" + '/' + select;
            columns = [

                {data: 'DT_Row_Index'},
                {data: 'SOL_nucleo_tematico', name: 'Nucleo tematico'},
                {data: 'SOL_cant_estudiantes', name: 'Estudiantes'},
                {data: 'tipo_prac', name: 'Practica'},
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": '<a href="javascript:;" class="btn btn-simple btn-info" data-toggle="confirmation"><i class="glyphicon glyphicon-zoom-in"></i></a>'
                },
                {
                    defaultContent: '<a href="javascript:;" class="btn btn-simple btn-primary btn-icon edit"><i class="glyphicon glyphicon-ok"></i></a><a href="javascript:;" class="btn btn-simple btn-warning btn-icon remove" data-toggle="confirmation"><i class="icon-pencil"></i></a>',
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
            /*datatable informacion solicitudes libres*/
            var templateLibre = Handlebars.compile($("#details-template-libre").html());

            var tableLibre, urlLibre, columnsLibre;
            tableLibre = $('#art-table-ajax-libre');
            urlLibre = "{{ route('espacios.academicos.evalsol.cargarDataLibre') }}" + '/' + select;
            columnsLibre = [

                {data: 'DT_Row_Index'},
                {data: 'SOL_nucleo_tematico', name: 'Nucleo tematico'},
                {data: 'SOL_cant_estudiantes', name: 'Estudiantes'},
                {data: 'tipo_prac', name: 'Practica'},
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": '<a href="javascript:;" class="btn btn-simple btn-info" data-toggle="confirmation"><i class="glyphicon glyphicon-zoom-in"></i></a>'
                },
                {
                    defaultContent: '<a href="javascript:;" class="btn btn-simple btn-primary btn-icon edit"><i class="glyphicon glyphicon-ok"></i></a><a href="javascript:;" class="btn btn-simple btn-warning btn-icon remove" data-toggle="confirmation"><i class="icon-pencil"></i></a>',
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
            dataTableServer.init(tableLibre, urlLibre, columnsLibre);

            //RECARGAR DATATABLE CON BASE AL EVENTO DEL SELECT
            $("#laboratorioSeleccionado").change(function (event) {
                $("#vista-tabla").css("display", "block");

                var select = $('#laboratorioSeleccionado option:selected').val();
                //tabla sol grupal
                table = $('#art-table-ajax');
                table.dataTable().fnDestroy();
                url = "{{ route('espacios.academicos.evalsol.data' ) }}" + '/' + select;
                dataTableServer.init(table, url, columns);
                table = table.DataTable();

                //Tabla sol libre
                tableLibre = $('#art-table-ajax-libre');
                tableLibre.dataTable().fnDestroy();
                urlLibre = "{{ route('espacios.academicos.evalsol.cargarDataLibre' ) }}" + '/' + select;
                dataTableServer.init(tableLibre, urlLibre, columnsLibre);
                tableLibre = tableLibre.DataTable();

                /*Cargar select de aulas*/
                $.get("cargarSalas/" + event.target.value + "", function (response) {
                    $("#aula").empty();
                    for (i = 0; i < response.length; i++) {
                        $("#aula").append("<option value='" + response[i].SAL_nombre_sala + "'>" + response[i].SAL_nombre_sala + "</option>")
                    }
                })

            });

            /*Inicio detalles desplegables grupal*/
            $('#art-table-ajax tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child(template(row.data())).show();
                    tr.addClass('shown');
                }
            });
            /*Fin detalles de solicitud*/

            /*Inicio detalles desplegables libre*/
            $('#art-table-ajax-libre tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = tableLibre.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child(templateLibre(row.data())).show();
                    tr.addClass('shown');
                }
            });
            /*Fin detalles de solicitud*/


            /*Aprobar Solicitud GRUPAL*/
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();

                $('#modal-aprobar-sol').modal('toggle');
                /*Asignacion de sala validado*/
                var createPermissions = function () {

                    return {
                        init: function () {
                            var route = '{{ route('espacios.academicos.evalsol.aprobarSol') }}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id_solicitud', dataTable.PK_SOL_id_solicitud);
                            formData.append('FK_SOL_id_sala', $('select[name="aulas"]').val());
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
                                        $('#modal-aprobar-sol').modal('hide');
                                        $('#form-aceptar-sol')[0].reset(); //Limpia formulario
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        }
                    }
                };


                var form_edit = $('#form-aceptar-sol');
                var rules_edit = {
                    sala_seleccionada: {required: true}
                };
                FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
            });
            /*Fin aprobar solicitud*/

            /*Aprobar Solicitud LIBRE*/
            tableLibre.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = tableLibre.row($tr).data();

                $('#modal-aprobar-sol').modal('toggle');
                /*Asignacion de sala validado*/
                var createPermissions = function () {

                    return {
                        init: function () {
                            var route = '{{ route('espacios.academicos.evalsol.aprobarSol') }}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id_solicitud', dataTable.PK_SOL_id_solicitud);
                            formData.append('FK_SOL_id_sala', $('select[name="aulas"]').val());
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
                                        tableLibre.ajax.reload();
                                        $('#modal-aprobar-sol').modal('hide');
                                        $('#form-aceptar-sol')[0].reset(); //Limpia formulario
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        }
                    }
                };


                var form_edit = $('#form-aceptar-sol');
                var rules_edit = {
                    sala_seleccionada: {required: true}
                };
                FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
            });
            /*Fin aprobar solicitud LIBRE*/


            /*Rechazar solicitud GRUPAL*/
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();

                $('#modal-reprobar-sol').modal('toggle');
                var createPermissions = function () {

                    return {
                        init: function () {
                            var route = '{{ route('espacios.academicos.evalsol.reprobarSol') }}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id_solicitud', dataTable.PK_SOL_id_solicitud);
                            formData.append('anotacion', $("textarea").val());
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
                                        $('#modal-reprobar-sol').modal('hide');
                                        $('#form-reprobar-sol')[0].reset(); //Limpia formulario
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        }
                    }
                };
                var form_edit = $('#form-reprobar-sol');
                var rules_edit = {
                    anotacion: {
                        minlength: 5,
                        maxlength: 200,
                        required: true
                    }
                };
                FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
            });
            /*FIN RECHAZAR SOLICITUD GRUPAL*/

            /*Rechazar solicitud LIBRE*/
            tableLibre.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = tableLibre.row($tr).data();

                $('#modal-reprobar-sol').modal('toggle');
                var createPermissionsLibre = function () {

                    return {
                        init: function () {
                            var route = '{{ route('espacios.academicos.evalsol.reprobarSol') }}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id_solicitud', dataTable.PK_SOL_id_solicitud);
                            formData.append('anotacion', $("textarea").val());
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
                                        tableLibre.ajax.reload();
                                        $('#modal-reprobar-sol').modal('hide');
                                        $('#form-reprobar-sol')[0].reset(); //Limpia formulario
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        }
                    }
                };
                var form_edit = $('#form-reprobar-sol');
                var rules_edit = {
                    anotacion: {
                        minlength: 5,
                        maxlength: 200,
                        required: true
                    }
                };
                FormValidationMd.init(form_edit, rules_edit, false, createPermissionsLibre());
            });
            /*FIN RECHAZAR SOLICITUD LIBRE*/


        });


    </script>
@endpush
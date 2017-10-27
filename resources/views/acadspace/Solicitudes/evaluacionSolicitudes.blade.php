@permission('gestionSolicitudes')
@extends('material.layouts.dashboard')

@push('styles')
    {{--Select2--}}
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    {{--TOAST--}}
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    {{--JQuery datatable and row details--}}
    <link href="{{ asset('assets/main/acadspace/css/rowdetails.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'glyphicon glyphicon-edit', 'title' => 'Gestión Solicitudes'])
        <div class="col-md-12">
            <div class="clearfix">
                <br>
                {!! Field::select('Espacio académico:',$espacios,
                                    ['id' => 'SOL_laboratorio', 'name' => 'SOL_laboratorio'])
                                    !!}
                {{--DIVISION NAV--}}
                <div class="portlet-body" id="vista-tabla">
                    <ul class="nav nav-pills">
                        @permission('gestionSolicitudes')
                        <li class="active">
                            <a href="#tab_2_1" data-toggle="tab"> Solicitudes grupales </a>
                        </li>
                        <li>
                            <a href="#tab_2_2" data-toggle="tab"> Solicitudes libres </a>
                        </li>
                        @endpermission
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">
                            <p>
                                <br>
                                <br>
                                <br>
                                <br>
                                @permission('consultarSolicitudes')
                                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                                    @slot('columns', [
                                    '#' => ['style' => 'width:20px;'],
                                    ' ' => ['style' => 'width:20px;'],
                                    'Núcleo temático',
                                    'Estudiantes',
                                    'Práctica',
                                    'Acciones'
                                    ])
                                @endcomponent
                                @endpermission
                            </p>
                        </div>
                        <div class="tab-pane fade" id="tab_2_2">
                            <p>
                                <br>
                                <br>
                                <br>
                                <br>
                                @permission('consultarSolicitudes')
                                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax-libre'])
                                    @slot('columns', [
                                    '#' => ['style' => 'width:20px;'],
                                    ' ' => ['style' => 'width:20px;'],
                                    'Núcleo temático',
                                    'Estudiantes',
                                    'Práctica',
                                    'Acciones'
                                    ])
                                @endcomponent
                                @endpermission
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
                            <i class="glyphicon glyphicon-check">
                            </i>
                            Aprobar solicitud de espacio académico
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'form-aceptar-sol', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    {!! Field::select('aula', null,
                                                                  ['name' => 'aula']) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                        @permission('aprobarSolicitudes')
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        @endpermission
                    </div>
                    {!! Form::close() !!}
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>
        </div>
        {{--MODAL PARA REPROBAR SOLICITUD --}}
        <div class="row">
            <div class="col-md-12">
            {{-- BEGIN HTML MODAL UPDATE --}}
            <!-- responsive -->
                <div class="modal fade" data-width="760" id="modal-reprobar-sol" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-remove-sign">
                            </i>
                            Reprobar solicitud de espacio académico
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'form-reprobar-sol', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::label('Agregar observación:') }}
                                {!! Form::textarea('anotacion',null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @permission('rechazarSolicitudes')
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                        @endpermission
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>
        </div>

        {{--MODAL PARA ACEPTAR SOLICITUD Y ASIGNAR SALA LIBRE--}}
        <div class="row">
            <div class="col-md-12">
            {{-- BEGIN HTML MODAL UPDATE --}}
            <!-- responsive -->
                <div class="modal fade" data-width="760" id="modal-aprobar-sol-libre" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-check">
                            </i>
                            Aprobar solicitud de espacio académico
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'form-aceptar-sol-libre', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    {!! Field::select('aulas', null,
                                                                  ['name' => 'aulas']) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @permission('aprobarSolicitudes')
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                        @endpermission
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>
        </div>
        {{--MODAL PARA REPROBAR SOLICITUD LIBRE --}}
        <div class="row">
            <div class="col-md-12">
            {{-- BEGIN HTML MODAL UPDATE --}}
            <!-- responsive -->
                <div class="modal fade" data-width="760" id="modal-reprobar-sol-libre" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-remove-sign">
                            </i>
                            Reprobar solicitud de espacio académico
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'form-reprobar-sol-libre', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::label('Agregar observación:') }}
                                {!! Form::textarea('anotacion_libre',null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @permission('rechazarSolicitudes')
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                        @endpermission
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>
        </div>
    @endcomponent
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
    {{--Selects--}}
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
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
                <td>@{{SOL_Carrera}}</td>
            </tr>
            <tr>
                <td>Docente solicitante:</td>
                <td>@{{user.name}} @{{user.lastname}}</td>
            </tr>
            <tr>
                <td>Dias seleccionados:</td>
                <td>@{{SOL_Dias}}</td>
            </tr>
            <tr>
                <td>Hora inicio: @{{SOL_Hora_Inicio}}</td>
                <td>Hora fin: @{{SOL_Hora_Fin}}</td>
            </tr>
            <tr>
                <td>Guia de práctica:</td>
                <td>@{{SOL_Guia_Practica}}</td>
            </tr>
            <tr>
                <td>Software:</td>
                <td>@{{software.SOF_Nombre_Soft}}</td>
            </tr>
            <tr>
                <td>Fechas:</td>
                <td>@{{SOL_Rango_Fechas}}</td>
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
                <td>@{{SOL_Carrera}}</td>
            </tr>
            <tr>
                <td>Docente solicitante:</td>
                <td>@{{user.name}} @{{user.lastname}}</td>
            </tr>
            <tr>
                <td>Fecha seleccionada:</td>
                <td>@{{SOL_Fecha_Inicial}}</td>
            </tr>
            <tr>
                <td>Hora inicio: @{{SOL_Hora_Inicio}}</td>
                <td>Hora fin: @{{SOL_Hora_Fin}}</td>
            </tr>
            <tr>
                <td>Guia de práctica:</td>
                <td>@{{SOL_Guia_Practica}}</td>
            </tr>
            <tr>
                <td>Software:</td>
                <td>@{{software.SOF_Nombre_Soft}}</td>
            </tr>
        </table>
    </script>

    <script>

        $("#vista-tabla").css("display", "none");

        /*PINTAR TABLA SOLICITUDES GRUPALES*/
        $(document).ready(function () {
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });
            //capturar el template para desplegar la informacion
            var template = Handlebars.compile($("#details-template").html());

            var table, url, columns;
            var select = "vacio";
            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.evalsol.data') }}" + '/' + select;
            columns = [

                {data: 'DT_Row_Index', "visible": false},
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {data: 'SOL_Nucleo_Tematico', name: 'Núcleo temático'},
                {data: 'SOL_Cant_Estudiantes', name: 'Estudiantes'},
                {data: 'tipo_prac', name: 'Práctica'},
                {
                    defaultContent: ' @permission('aprobarSolicitudes') <a href="javascript:;" class="btn btn-simple btn-primary btn-icon edit"><i class="glyphicon glyphicon-ok"></i></a> @endpermission ' +
                    '@permission('rechazarSolicitudes') <a href="javascript:;" class="btn btn-simple btn-warning btn-icon remove" data-toggle="confirmation"><i class="icon-pencil"></i></a> @endpermission',
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

                {data: 'DT_Row_Index', "visible": false},
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {data: 'SOL_Nucleo_Tematico', name: 'Nucleo tematico'},
                {data: 'SOL_Cant_Estudiantes', name: 'Estudiantes'},
                {data: 'tipo_prac', name: 'Practica'},
                {
                    defaultContent: '@permission('aprobarSolicitudes') <a href="javascript:;" class="btn btn-simple btn-primary btn-icon edit"><i class="glyphicon glyphicon-ok"></i></a> @endpermission ' +
                    '@permission('rechazarSolicitudes') <a href="javascript:;" class="btn btn-simple btn-warning btn-icon remove" data-toggle="confirmation"><i class="icon-pencil"></i></a> @endpermission',
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
            $("#SOL_laboratorio").change(function (event) {
                $("#vista-tabla").css("display", "block");
                var select = $('#SOL_laboratorio option:selected').val();
                /*Cargar select de aulas*/
                $('#aula').empty();
                $.get("cargarSalas/" + select + "", function (response) {
                    $(response.data).each(function (key, value) {
                        $("#aula").append(new Option(value.SAL_Nombre_Sala, value.PK_SAL_Id_Sala));
                    });
                    $("#aula").val([]);
                    $('#aulas').empty();
                    $(response.data).each(function (key, value) {
                        $("#aulas").append(new Option(value.SAL_Nombre_Sala, value.PK_SAL_Id_Sala));
                    });
                    $("#aulas").val([]);
                });
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

            /*Inicio detalles desplegables libre*/
            $('#art-table-ajax-libre tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = tableLibre.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('details');
                }
                else {
                    // Open this row
                    row.child(templateLibre(row.data())).show();
                    tr.addClass('details');
                }
            });
            /*Fin detalles de solicitud*/


            /*Aprobar Solicitud GRUPAL*/
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                $('#modal-aprobar-sol').modal('toggle');
                /*Asignacion de sala validado*/
                var createPermissions = function () {

                    return {
                        init: function () {
                            var dataTable = table.row($tr).data();
                            var route = '{{ route('espacios.academicos.evalsol.aprobarSol') }}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id_solicitud', dataTable.PK_SOL_id_solicitud);
                            formData.append('FK_SOL_Id_Sala', $('select[name="aula"]').val());
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
                                        $("#aula").val('').trigger('change');
                                        $('#form-aceptar-sol')[0].reset(); //Limpia formulario
                                        UIToastr.init(xhr, response.title, response.message);
                                        formData = null;
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        }
                    }
                };


                var form_edit = $('#form-aceptar-sol');
                var rules_edit = {
                    aula: {required: true}
                };
                FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
            });
            /*Fin aprobar solicitud*/

            /*Aprobar Solicitud LIBRE*/
            tableLibre.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                $('#modal-aprobar-sol-libre').modal('toggle');
                /*Asignacion de sala validado*/
                var createPermissionsLib = function () {

                    return {
                        init: function () {
                            var dataTable = tableLibre.row($tr).data();
                            var route = '{{ route('espacios.academicos.evalsol.aprobarSol') }}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id_solicitud', dataTable.PK_SOL_id_solicitud);
                            formData.append('FK_SOL_Id_Sala', $('select[name="aulas"]').val());
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
                                        $("#aulas").val('').trigger('change');
                                        $('#modal-aprobar-sol-libre').modal('hide');
                                        $('#form-aceptar-sol-libre')[0].reset(); //Limpia formulario
                                        UIToastr.init(xhr, response.title, response.message);
                                        formData = null;
                                        route = '';
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        }
                    }
                };


                var form_edit = $('#form-aceptar-sol-libre');
                var rules_edit = {
                    aula: {required: true}
                };
                FormValidationMd.init(form_edit, rules_edit, false, createPermissionsLib());
            });
            /*Fin aprobar solicitud LIBRE*/


            /*Rechazar solicitud GRUPAL*/
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');


                $('#modal-reprobar-sol').modal('toggle');
                var createPermissions = function () {

                    return {
                        init: function () {
                            var dataTable = table.row($tr).data();
                            var route = '{{ route('espacios.academicos.evalsol.reprobarSol') }}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id_solicitud', dataTable.PK_SOL_id_solicitud);
                            formData.append('anotacion', $('textarea[name="anotacion"]').val());
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
                                        formData = null;
                                        route = '';
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
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

                $('#modal-reprobar-sol-libre').modal('toggle');
                var createPermissionsLibre = function () {

                    return {
                        init: function () {
                            var route = '{{ route('espacios.academicos.evalsol.reprobarSol') }}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id_solicitud', dataTable.PK_SOL_id_solicitud);
                            formData.append('anotacion', $('textarea[name="anotacion_libre"]').val());
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
                                        $('#modal-reprobar-sol-libre').modal('hide');
                                        $('#form-reprobar-sol-libre')[0].reset(); //Limpia formulario
                                        UIToastr.init(xhr, response.title, response.message);
                                        formData = null;
                                        route = '';
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);

                                    }
                                }
                            });
                        }
                    }
                };
                var form_edit = $('#form-reprobar-sol-libre');
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
@endpermission
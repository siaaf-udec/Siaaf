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
            </div>
            <br>
            <br>
            {!! Field::select('laboratorioSeleccionado',
                                    ['Aulas de computo' => 'Aulas de computo',
                                    'Ciencias agropecuarias y ambientales' => 'Ciencias agropecuarias y ambientales'],
                                    null,
                                    [ 'label' => 'Seleccionar espacio academico:']) !!}
            <br>
            <br>
            <br>

            <div class="col-md-12">
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
            </br>
            </br>
            </br>
            </br>

    </div>
    {{-- END HTML SAMPLE --}}
@endsection

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts necesarios para usar plugins
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}

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

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts para inicializar componentes Javascript como
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}
@push('functions')
    <!--HANDLEBAR-->
    <script src="{{ asset('assets/main/acadspace/js/handlebars.js') }}"></script>

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
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
                <td>Docente solicitante:</td>
                <td>@{{name}} @{{lastname}}</td>
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
                <td>Software:</td>
                <td>@{{SOL_software}}</td>
            </tr>
        </table>
    </script>
    <script>

        /*PINTAR TABLA*/
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

            //RECARGAR DATATABLE CON BASE AL EVENTO DEL SELECT
            $("#laboratorioSeleccionado").change(function (event) {

                table = $('#art-table-ajax');
                var select = $('#laboratorioSeleccionado option:selected').val();
                table.dataTable().fnDestroy();
                url = "{{ route('espacios.academicos.evalsol.data' ) }}" + '/' + select;
                dataTableServer.init(table, url, columns);
                table = table.DataTable();

                /*Cargar select de aulas*/
                $.get("cargarSalas/"+event.target.value+"", function(response){
                    $("#aula").empty();
                    for(i=0;i<response.length; i++){
                        $("#aula").append("<option value='"+response[i].SAL_nombre_sala+"'>"+response[i].SAL_nombre_sala+"</option>")
                    }
                })

            });

            /*Inicio detalles desplegables*/
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


            /*Aprobar Solicitud*/
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


            /*Rechazar solicitud Solicitud*/
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


        });


    </script>
@endpush
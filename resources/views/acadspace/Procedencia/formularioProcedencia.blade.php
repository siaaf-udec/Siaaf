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
    <link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    {{--toast--}}
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    {{--JQuery datatable and row details--}}
    <link href="{{ asset('assets/main/acadspace/css/rowdetails.css') }}" rel="stylesheet" type="text/css"/>
@endpush


@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-info', 'title' => 'Gestión Procedencias'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <a class="btn btn-simple btn-success btn-icon create" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Registrar Procedencia
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax', 'class' => 'table table-striped 
                table-bordered table-hover dt-responsive no-footer dtr-column collapsed'])
                    @slot('columns', [
                    'id_procedencia',
                    '#',
                    'Nombre procedencia',
                    'Acciones' => ['style' => 'width:70px;']
                    ])
                @endcomponent
            </div>
            <div class="clearfix">
            </div>
            <div class="row">
                <div class="col-md-12">
                {{-- BEGIN HTML MODAL CREATE --}}
                <!-- responsive -->
                    <div class="modal fade" data-width="760" id="modal-create-proc" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-tv">
                                </i>
                                Registrar Procedencia
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'form_proc', 'class' => '', 'url'=>'/forms']) !!}
                            <div class="row">
                                <div class="col-md-12">

                                    {!! Field:: text('tipo_procedencia',null,
                                    ['label'=>'Nombre procedencia:','class'=> 'form-control', 'autofocus', 'maxlength'=>'15','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre de la procedencia perteneciente a un elemento','icon'=>'fa fa-user'] ) !!}

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
                {{-- END HTML MODAL CREATE--}}
            </div>
        @endcomponent
    </div>
    {{-- END HTML SAMPLE --}}
@endsection


@push('plugins')
    {{--Selects--}}
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT DATATABLE -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/table-datatables-responsive.min.js') }}"
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
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    {{--ROW DETAILS DESPLEGABLE--}}
    <script id="details-template" type="text/x-handlebars-template"></script>
    <script>
        $(document).ready(function () {
            //inicializar select
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });
            var template = Handlebars.compile($("#details-template").html());
            var table, url, columns;
            //Define que tabla cargara los datos
            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.procedencia.data') }}"; //url para cargar datos
            columns = [
                {data: 'PK_PRO_Id_Procedencia', name: 'id_procedencia', "visible": false},
                {data: 'DT_Row_Index'},
                {data: 'PRO_Nombre', name: 'Nombre procedencia'},
                {
                    defaultContent: '@permission('ACAD_ELIMINAR_INCIDENTE') <div class="btn-group pull-right"><button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Opciones<i class="fa fa-angle-down"></i></button><ul class="dropdown-menu pull-right"><li><a href="javascript:;" class="edit"><i class="fa fa-edit"></i> Editar </a></li><li><a href="javascript:;" class="remove"><i class="fa fa-trash"></i> Eliminar</a></li></ul></div> @endpermission',
                    data: 'action',
                    name: 'action',
                    title: 'Acciones',
                    orderable: false,
                    searchable: false,
                    exportable: false,
                    printable: false,
                    render: null,
                    responsivePriority: 2
                }
            ];
            dataTableServer.init(table, url, columns);
            table = table.DataTable();

            /*EDITAR LA PROCEDENCIA*/
                table.on('click', '.edit', function(e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data(),
                route_edit = '{{ route('espacios.academicos.procedencia.editarProcedencia') }}'+'/'+dataTable.PK_PRO_Id_Procedencia;
                $(".content-ajax").load(route_edit);
             });

            /*ELIMINAR REGISTROS*/
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var route = '{{ route('espacios.academicos.procedencia.destroy') }}' + '/' + dataTable.PK_PRO_Id_Procedencia;
                var type = 'DELETE';
                var async = async || false;

                $.ajax({
                    url: route,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    cache: false,
                    type: type,
                    contentType: false,
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

            /*ABRIR MODAL*/
            $(".create").on('click', function (e) {
                e.preventDefault();
                $('#modal-create-proc').modal('toggle');
            });
            /*CREAR PROCEDENCIA CON VALIDACIONES*/
            var createPermissions = function () {
                return {
                    init: function () {
                        var route = '{{ route('espacios.academicos.procedencia.regisProcedencia') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('PRO_Nombre', $('input:text[name="tipo_procedencia"]').val());

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
                                    $('#modal-create-proc').modal('hide');//Esconder el formulario
                                    $('#form_proc')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
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

            var form_edit = $('#form_proc');
            /*CONCATENAR EL CAMPO Y LAS OPCIONES DE VALIDACIÓN*/
            var rules_edit = {
                tipo_procedencia: {required: true, minlength:1, maxlength: 20}
            };
            /*ENVIAR A FORMULARIO JS PARA VALIDAR*/
            FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
        });

    </script>
@endpush
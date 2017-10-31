@permission('registrarFormatos')
@extends('material.layouts.dashboard')

@push('styles')
    <!-- DROPZONE -->
    <link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css"/>
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
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formatos Académicos'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission('registrarFormatos')
                        <a class="btn btn-outline dark create" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Registrar
                        </a>
                        @endpermission
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <br>
            <div class="col-md-12">
                @permission('consultarFormatos')
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                    @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id_documento',
                    'Formato Académico',
                    'Fecha',
                    'Estado',
                    'Acciones' => ['style' => 'width:45px;']
                    ])
                @endcomponent
                @endpermission
            </div>
            <div class="clearfix">
            </div>
            <div class="col-md-12">
                {{-- BEGIN HTML MODAL CREATE --}}
                <div class="modal fade" data-width="760" id="modal-create-form" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="fa fa-file-pdf-o">
                            </i>
                            Registrar formato académico
                        </h2>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="portlet light " id="form_wizard_1">
                                <div class="portlet-body form">
                                    {!! Form::open(['id' => 'form_create_format', 'class' => '', 'url' => '/forms']) !!}
                                    <div class="form-wizard">
                                        <div class="form-body">
                                            {!! Field::text('titulo', ['required', 'label' => 'Nombre Documento:','maxlength'=>'50', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-file-pdf-o', 'help' => 'Ingrese el nombre.']) !!}

                                            {!! Field::textarea(
                                            'descripcion',
                                            ['required', 'label' => 'Descripción', 'max' => '100', 'min' => '2', 'auto' => 'off', 'rows' => '2'],
                                            ['help' => 'Ingrese la Descripción']) !!}

                                            {!! Field::email('email', ['required', 'max' => 80, 'label' => 'E-mail', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-envelope-o', 'help' => 'Ingrese el correo electrónico.']) !!}

                                            <h3 class="block">Formato académico</h3>
                                            <div class="form-group">
                                                <div class="dropzone dropzone-file-area data-dz-size"
                                                     id="my_dropzone">
                                                    <h3 class="sbold">Arrastra o da click aquí para cargar
                                                        archivos</h3>
                                                    <p> Por favor sube el formato académico en un formato
                                                        pdf. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="modal-footer">
                                            @permission('registrarFormatos')
                                            {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                                            @endpermission
                                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
    </div>
    @endcomponent
    {{-- END HTML SAMPLE --}}
@endsection


@push('plugins')
    {{--Datatable--}}
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}"
            type="text/javascript"></script>
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
    <!-- DROPZONE-->
    <script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}"
            type="text/javascript"></script>
    <!-- SCRIPT MENSAJES TOAST-->
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}"
            type="text/javascript"></script>
    {{-- wizard Scripts --}}
    <script src="{{ asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"
            type="text/javascript"></script>
    {{-- bootstrap-maxlength Scripts --}}
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript"></script>
@endpush

@push('functions')
    {{-- wizard Scripts --}}
    <script src="{{ asset('assets/main/acadspace/js/form-wizard.js') }}" type="text/javascript"></script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    {{--Dropzone--}}
    <script src="{{ asset('assets/main/acadspace/js/AcadspaceDropzone.js') }}"
            type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            /*cargar tabla*/
            var table, url, columns;
            //Define que tabla cargara los datos
            table = $('#art-table-ajax');
            /*Validaciones*/
            var $form = $('#form_create_format'),
                $wizard = $('#form_wizard_1');
            var rules = {
                titulo: {minlength: 3, required: true},
                descripcion: {required: true, minlength: 5},
                email: {email: true, required: true}
            };
            var messages = {};
            $wizard.bootstrapWizard(FormWizard.init($wizard, $form, rules, messages, false));

            /*Prueba*/
            var method = function () {
                return {
                    init: function () {
                        return valores = {
                            'titulo': $('input[name="titulo"]').val(),
                            'descripcion': $('textarea[name="descripcion"]').val(),
                            'email': $('input[name="email"]').val()
                        }
                    }
                };
            };
            var type_crud = 'CREATE',
                route_store = route('espacios.academicos.formacad.store'),
                formatfile = '.pdf',
                numfile = 1;
            FormDropzone.init(route_store, formatfile, numfile, method(), type_crud);


            url = "{{ route('espacios.academicos.formacad.data') }}"; //url para cargar datos
            columns = [
                //Carga los datos que ha traido el control
                {data: 'DT_Row_Index'},
                {data: 'PK_FAC_Id_Formato', name: 'id_documento', "visible": false},
                {data: 'FAC_Titulo_Doc', name: 'Formato Académico'},
                {data: 'created_at', name: 'Fecha'},
                {data: 'estado', name: 'Estado'},
                {
                    //Boton para descargar el archivo
                    defaultContent: ' @permission('descargFormato') <a href="javascript:;" class="btn btn-simple btn-icon download"><i class="icon-cloud-download"></i></a> @endpermission',
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
            //table = table.DataTable();
            table = table.DataTable();
            //Funcion para descargar el archivo
            table.on('click', '.download', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                $.ajax({}).done(function () {
                    window.location.href = '{{ route('espacios.academicos.descargarArchivo') }}' + '/' + dataTable.PK_FAC_Id_Formato;
                });
            });

            /*ABRIR MODAL*/
            $(".create").on('click', function (e) {
                e.preventDefault();
                $('#modal-create-form').modal('toggle');
            });

        });

    </script>
@endpush
@endpermission
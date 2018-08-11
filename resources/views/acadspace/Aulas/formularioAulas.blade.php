@permission('ACAD_AULAS')
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
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Styles SWEETALERT  -->
    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-layers', 'title' => 'Gestión Aulas'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission('ACAD_REGISTRAR_AULA')
                        <a class="btn btn-success btn-icon create" data-toggle="modal">
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
                @permission('ACAD_CONSULTAR_AULA')
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                    @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id_documento',
                    'Nombre Sala',
                    'Espacios',
                    'Acciones' => ['style' => 'width:45px;']

                    ])
                @endcomponent
                @endpermission
            </div>
            <div class="clearfix">
            </div>
            <div class="row">
                <div class="col-md-12">
                {{-- BEGIN HTML MODAL CREATE --}}
                <!-- responsive -->
                    <div class="modal fade" data-width="760" id="modal-create-soft" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-tv">
                                </i>
                                Registrar Aula
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'form_soft', 'class' => '', 'url'=>'/forms']) !!}
                            <div class="row">
                                <div class="col-md-12">

                                    {!! Field:: text('nomb_sala',null,
                                    ['label'=>'Nombre Sala:','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre','icon'=>'fa fa-desktop'] ) !!}

                                    {!! Field::select('Espacio académico:',$espacios,
                                    ['name' => 'espacios', 'id' => 'espacios'])
                                    !!}

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            @permission('ACAD_REGISTRAR_AULA')
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            @endpermission
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    {{-- END HTML MODAL CREATE--}}
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>
    </div>
    @endcomponent
@endsection


@push('plugins')
    {{--Selects--}}
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
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
    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
    </script>
@endpush

@push('functions')
    {{--Validacion--}}
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>

    <script>
        /*PINTAR TABLA*/
        $(document).ready(function () {
            //Aplicando style a select
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });
            var table, url, columns;
            //Define que tabla cargara los datos
            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.aulas.data') }}"; //url para cargar datos
            columns = [
                //Carga los datos que ha traido el control
                {data: 'DT_Row_Index'},
                {data: 'PK_SAL_Id_Sala', name: 'id_documento', "visible": false},
                {data: 'SAL_Nombre_Sala', name: 'Nombre Sala'},
                {data: 'espacio.N_espacio', name: 'Nombre Espacio'}, {
                    defaultContent: ' @permission('ACAD_ELIMINAR_AULA') <a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a> @endpermission',
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
            table = table.DataTable();
            /*ELIMINAR REGISTROS*/
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var route = '{{ route('espacios.academicos.aulas.destroy') }}' + '/' + dataTable.PK_SAL_Id_Sala;
                var type = 'DELETE';
                var async = async || false;
                swal({
                    title: "¿Esta seguro?",
                    text: "Eliminara calendario y solicitudes asociadas al aula.",
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
                    })
                        .done(function (data) {
                            swal("Eliminado", "El aula se ha eliminado correctamente", "success");
                        })
                        .error(function (data) {
                            swal("Oops", "Ha ocurrido un error", "error");
                        });
                });


            });

            /*ABRIR MODAL*/
            $(".create").on('click', function (e) {
                e.preventDefault();
                $('#modal-create-soft').modal('toggle');
            });
            /*CREAR AULA CON VALIDACIONES*/
            var createPermissions = function () {
                return {
                    init: function () {
                        var route = '{{ route('espacios.academicos.aulas.regisAula') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('SAL_Nombre_Sala', $('input:text[name="nomb_sala"]').val());
                        formData.append('FK_SAL_Id_Espacio', $('select[name="espacios"]').val());

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
                                    $('#espacios').val('').trigger('change');
                                    table.ajax.reload();
                                    $('#modal-create-soft').modal('hide');
                                    $('#form_soft')[0].reset(); //Limpia formulario
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

            var form_edit = $('#form_soft');
            var rules_edit = {
                nomb_sala: {
                    minlength: 3, required: true, remote: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{ route('espacios.academicos.aulas.verificarAula') }}',
                        type: "POST"
                    }
                },
                espacios: {required: true}
            };
            var messages = {
                nomb_sala: {
                    remote: "Aula ya registrada en el sistema."
                }
            };
            FormValidationMd.init(form_edit, rules_edit, messages, createPermissions());

        });

    </script>
@endpush
@endpermission

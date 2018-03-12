@extends('material.layouts.dashboard')

@push('styles')
    <!-- STYLES MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- Styles DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Styles SWEETALERT  -->
    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush


@section('title', '| Registrar Kit')

@section('page-title', 'Registrar Kit')

@section('page-description', 'Crear modificar y eliminar Kit')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Administradores'])
            <div class="clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <a class="btn btn-outline dark create" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Nuevo Kit
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'admin-table-ajax'])
                    @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'Kit',
                        'Estado',
                        'Acciones' => ['style' => 'width:90px;']
                    ])
                @endcomponent
            </div>
            <div class="clearfix">
            </div>
            <div class="row">
                <div class="col-md-12">
                   <div class="modal fade" data-width="400" id="modal-create-Kit" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-thumbs-up">
                                </i>
                                Registrar Kit
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'from_kit_create', 'class' => '', 'url' => '/forms']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        {!! Field::text('KIT_Nombre',
                                        ['label' => 'Nombre Kit:', 'max' => '15', 'min' => '5', 'required', 'auto' => 'off','tabindex'=>'1'],
                                        ['help' => 'Ingrese nombre Kit', 'icon' => 'fa fa-user'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::select('Seleccione un Estado',
                                       null,
                                       ['name' => 'FK_ART_Estado_id'])
                                       !!}

                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::text('ADMIN_Nombres',
                                        ['label' => 'Nombres:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'2'],
                                        ['help' => 'Ingrese Nombres', 'icon' => 'fa fa-user'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::text('ADMIN_Direccion',
                                        ['label' => 'Dirección:', 'max' => '50', 'min' => '5', 'required', 'auto' => 'off','tabindex'=>'4'],
                                        ['help' => 'Ingrese Direccion', 'icon' => 'fa fa-map-marker'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::tel('ADMIN_Telefono',
                                        ['label' => 'Telefono:','required', 'auto' => 'off', 'max' => '10','tabindex'=>'6'],
                                        ['help' => 'Digita un número de teléfono.', 'icon' => 'fa fa-phone'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::text('FK_ADMIN_Rol','Administrador',
                                        ['label' => 'Rol:','disabled'],
                                        ['help' => 'Ingrese Rol "Administrador","Docente"', 'icon' => 'fa fa-ban'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::password('ADMIN_RClave',
                                        ['label' => 'Confimar Contraseña:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'8'],
                                        ['help' => 'Confirmar Contraseña', 'icon' => 'fa fa-key'])
                                        !!}
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
                <div class="col-md-12">
                {{-- BEGIN HTML MODAL UPDATE --}}
                <!-- responsive -->
                    <div class="modal fade" data-width="760" id="modal-update-admin" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-user">
                                </i>
                                Editar Administrador
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'from_admin_update', 'class' => '', 'url' => '/forms']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::hidden('id_edit') !!}
                                        {!! Field::text('PK_ADMIN_Cedula_editar',
                                        ['label' => 'Cedula:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off', 'tabindex'=>'1' ],
                                        ['help' => 'Ingrese Cedula', 'icon' => 'fa fa-user','tabindex'=>'1'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::text('ADMIN_Apellidos_editar',
                                        ['label' => 'Apellidos:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'3'],
                                        ['help' => 'Ingrese Apellidos', 'icon' => 'fa fa-user'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::email('ADMIN_Correo_editar',
                                        ['label' => 'Correo Electronico:', 'max' => '40', 'min' => '10', 'required', 'auto' => 'off','tabindex'=>'5'],
                                        ['help' => 'Ingrese Email', 'icon' => ' fa fa-envelope-open'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::text('FK_ADMIN_Estado_editar','Activo',
                                        ['label' => 'Estado:','disabled'],
                                        ['help' => 'Ingrese Estado "Activo","Inactivo"', 'icon' => 'fa fa-ban'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::password('ADMIN_Clave_editar',
                                        ['label' => 'Contraseña:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'7'],
                                        ['help' => 'Ingrese Contraseña', 'icon' => 'fa fa-key'])
                                        !!}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::text('ADMIN_Nombres_editar',
                                        ['label' => 'Nombres:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'2'],
                                        ['help' => 'Ingrese Nombres', 'icon' => 'fa fa-user'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::text('ADMIN_Direccion_editar',
                                        ['label' => 'Dirección:', 'max' => '50', 'min' => '5', 'required', 'auto' => 'off','tabindex'=>'4'],
                                        ['help' => 'Ingrese Direccion', 'icon' => 'fa fa-map-marker'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::tel('ADMIN_Telefono_editar',
                                        ['label' => 'Telefono:','required', 'auto' => 'off', 'max' => '10','tabindex'=>'6'],
                                        ['help' => 'Digita un número de teléfono.', 'icon' => 'fa fa-phone'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::text('FK_ADMIN_Rol_editar','Administrador',
                                        ['label' => 'Rol:','disabled'],
                                        ['help' => 'Ingrese Rol "Administrador","Docente"', 'icon' => 'fa fa-ban'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::password('ADMIN_RClave_editar',
                                        ['label' => 'Confimar Contraseña:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'8'],
                                        ['help' => 'Confirmar Contraseña', 'icon' => 'fa fa-key'])
                                        !!}
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
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT DATEPICKER -->
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
            type="text/javascript"></script>
    <!-- SCRIPT MODAL -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT PWSTRENGTH -->
    <script src="{{ asset('assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Maxlength -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Personalizadas -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT MENSAJES TOAST-->
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript">
    </script>
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
    <!-- Estandar Validacion -->
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">
    </script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">
    </script>
    <script>
        var ComponentsBootstrapMaxlength = function () {
            var handleBootstrapMaxlength = function () {
                $("input[maxlength], textarea[maxlength]").maxlength({
                    alwaysShow: true,
                    appendToParent: true
                });

            }
            return {
                //main function to initiate the module
                init: function () {
                    handleBootstrapMaxlength();
                }
            };
        }();


        jQuery(document).ready(function () {

            ComponentsBootstrapMaxlength.init();

            //DATATABLE
            var table, url, columns;
            table = $('#admin-table-ajax');
            url = "{{ route('administrador.data') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'PK_ADMIN_Cedula', "visible": false},
                {data: 'ADMIN_Nombres', name: 'Nombres'},
                {data: 'ADMIN_Correo', name: 'Correo'},
                {data: 'ADMIN_Telefono', name: 'Telefono'},
                {
                    defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a>',
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
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var adminId = dataTable.PK_ADMIN_Cedula;
                deleteAdmin(adminId);


            });

            function deleteAdmin(adminId) {

                var route = '{{ route('administrador.destroy') }}' + '/' + adminId;
                var type = 'DELETE';
                var async = async || false;
                swal({
                    title: "¿Esta seguro?",
                    text: "¿Seguro que quiere eliminar este Administrador?",
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
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    })
                        .done(function (data) {
                            swal("Eliminado", "El administradir se ha eliminado correctamente", "success");
                        })
                        .error(function (data) {
                            swal("Oops", "No pudimos conectar con el servidor", "error");
                        });
                });
            }

            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                route_edit = '{{ route('administrador.edit') }}' + '/' + dataTable.PK_ADMIN_Cedula;

                $.get(route_edit, function (info) {
                    console.log(info);
                    $('input[name="id_edit"]').val(info.data.PK_ADMIN_Cedula);
                    $('input:text[name="PK_ADMIN_Cedula_editar"]').val(info.data.PK_ADMIN_Cedula);
                    $('input:text[name="ADMIN_Nombres_editar"]').val(info.data.ADMIN_Nombres);
                    $('input:text[name="ADMIN_Apellidos_editar"]').val(info.data.ADMIN_Apellidos);
                    $('input:text[name="ADMIN_Estado_editar"]').val(info.data.ADMIN_Estado);
                    $('input:text[name="ADMIN_Direccion_editar"]').val(info.data.ADMIN_Direccion);
                    $('#ADMIN_Correo_editar').val(info.data.ADMIN_Correo);
                    $('#ADMIN_Clave_editar').val(info.data.ADMIN_Clave);
                    $('#ADMIN_RClave_editar').val(info.data.ADMIN_Clave);
                    $('#ADMIN_Telefono_editar').val(info.data.ADMIN_Telefono);
                    $('#modal-update-admin').modal('toggle');


                });
            });

            $(".create").on('click', function (e) {
                e.preventDefault();
                $('#modal-create-admin').modal('toggle');

            });

            $(':password').pwstrength({
                ui: {showVerdictsInsideProgressBar: true}
            });

            /*Registrar Administrador*/
            var createAdmins = function () {
                return {
                    init: function () {
                        var route = '{{ route('administrador.store') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('PK_ADMIN_Cedula', $('input:text[name="PK_ADMIN_Cedula"]').val());
                        formData.append('ADMIN_Apellidos', $('input:text[name="ADMIN_Apellidos"]').val());
                        formData.append('FK_ADMIN_Estado', $('input:text[name="FK_ADMIN_Estado"]').val());
                        formData.append('ADMIN_Nombres', $('input:text[name="ADMIN_Nombres"]').val());
                        formData.append('ADMIN_Direccion', $('input:text[name="ADMIN_Direccion"]').val());
                        formData.append('FK_ADMIN_Rol', $('input:text[name="FK_ADMIN_Rol"]').val());
                        formData.append('ADMIN_Correo', $('#ADMIN_Correo').val());
                        formData.append('ADMIN_Clave', $('#ADMIN_Clave').val());
                        formData.append('ADMIN_Telefono', $('#ADMIN_Telefono').val());

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
                                    $('#modal-create-admin').modal('hide');
                                    $('#from_admin_create')[0].reset(); //Limpia formulario
                                    $(":password").pwstrength("forceUpdate");
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
            /*Editar Administrador*/
            var updateAdmins = function () {
                return {
                    init: function () {
                        var id_edit = $('input[name="id_edit"]').val();
                        var route = '{{ route('administrador.update') }}' + '/' + id_edit;
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('PK_ADMIN_Cedula', $('input:text[name="PK_ADMIN_Cedula_editar"]').val());
                        formData.append('ADMIN_Apellidos', $('input:text[name="ADMIN_Apellidos_editar"]').val());
                        formData.append('FK_ADMIN_Estado', $('input:text[name="FK_ADMIN_Estado_editar"]').val());
                        formData.append('ADMIN_Nombres', $('input:text[name="ADMIN_Nombres_editar"]').val());
                        formData.append('ADMIN_Direccion', $('input:text[name="ADMIN_Direccion_editar"]').val());
                        formData.append('FK_ADMIN_Rol', $('input:text[name="FK_ADMIN_Rol_editar"]').val());
                        formData.append('ADMIN_Correo', $('#ADMIN_Correo_editar').val());
                        formData.append('ADMIN_Clave', $('#ADMIN_Clave_editar').val());
                        formData.append('ADMIN_Telefono', $('#ADMIN_Telefono_editar').val());

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
                                    $('#modal-update-admin').modal('hide');
                                    $('#from_admin_update')[0].reset(); //Limpia formulario
                                    $(":password").pwstrength("forceUpdate");
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
            var form_create = $('#from_admin_create');
            var rules_create = {
                PK_ADMIN_Cedula: {minlength: 5, required: true, digits: true},
                ADMIN_Apellidos: {minlength: 5, required: true},
                FK_ADMIN_Estado: {required: true},
                ADMIN_Nombres: {minlength: 5, required: true},
                ADMIN_Direccion: {minlength: 5, required: true},
                FK_ADMIN_Rol: {required: true},
                ADMIN_Correo: {email: true, required: true},
                ADMIN_Clave: {minlength: 5, required: true},
                ADMIN_Telefono: {minlength: 5, required: true, digits: true},
                ADMIN_RClave: {minlength: 5, required: true, equalTo: "#ADMIN_Clave"},

            };
            FormValidationMd.init(form_create, rules_create, false, createAdmins());

            var form_update = $('#from_admin_update');
            var rules_update = {
                PK_ADMIN_Cedula_editar: {minlength: 5, required: true, digits: true},
                ADMIN_Apellidos_editar: {minlength: 5, required: true},
                FK_ADMIN_Estado_editar: {required: true},
                ADMIN_Nombres_editar: {minlength: 5, required: true},
                ADMIN_Direccion_editar: {minlength: 5, required: true},
                FK_ADMIN_Rol_editar: {required: true},
                ADMIN_Correo_editar: {email: true, required: true},
                ADMIN_Clave_editar: {minlength: 5, required: true},
                ADMIN_Telefono_editar: {minlength: 5, required: true, digits: true},
                ADMIN_RClave_editar: {minlength: 5, required: true, equalTo: "#ADMIN_Clave_editar"},

            };
            FormValidationMd.init(form_update, rules_update, false, updateAdmins());


        });
    </script>
@endpush

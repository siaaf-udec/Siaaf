{{--
|--------------------------------------------------------------------------
| Extends
|--------------------------------------------------------------------------
|
| Hereda los estilos y srcipts de la de la plantilla original.
| Es la base para todas las páginas que se deseen crear.
|
--}}
@extends('material.layouts.dashboard')

{{--
|--------------------------------------------------------------------------
| Styles
|--------------------------------------------------------------------------
|
| Inyecta CSS requerido ya sea por un JS o para un elemento específico
|
| @push('styles')
|
| @endpush
--}}
@push('styles')
{{-- STYLE SELECT --}}
<link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css"/>
<!-- STYLES MODAL -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
<!-- Styles DATATABLE  -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush


{{--
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Inyecta el título de la página a la etiqueta
<title>
</title>
de la plantilla
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('title', $miVariable)
| @section('title', 'Título')
--}}
@section('title', '| Gestion Funcionarios')

{{--
|--------------------------------------------------------------------------
| Page Title
|--------------------------------------------------------------------------
|
| Inyecta el título a la sección del contenido de página.
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-title', $miVariable)
| @section('page-title', 'Título')
|
|
--}}
@section('page-title', 'Gestion Funcionarios')
{{--
|--------------------------------------------------------------------------
| Page Description
|--------------------------------------------------------------------------
|
| Inyecta una breve descripción a la sección del contenido de página.
| Recibe texto o variables de los controladores o se puede dejar sin datos
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-description', $miVariable)
| @section('page-description', 'Título')
--}}

@section('page-description', 'crear modificar y eliminar Funcionarios')

{{--
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
|
| Inyecta el contenido HTML que se usará en la página
|
| @section('content')
|
| @endsection
--}}
@section('content')
    {{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Funcionarios'])
    <div class="clearfix">
    </div>
    <br>
        <br>
            <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="actions">
                            <a class="btn btn-outline dark create" data-toggle="modal">
                                <i class="fa fa-plus">
                                </i>
                                Nuevo Funcionario
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                </div>
                <br>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'funcionario-table-ajax'])
                            @slot('columns', [
                                '#' => ['style' => 'width:20px;'],
                                'Cedula',
                                'Nombres',
                                'Correo',
                                'Telefono',
                                'Acciones' => ['style' => 'widt1h:90px;']
                            ])
                        @endcomponent
                    </div>
                    <div class="clearfix">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{-- BEGIN HTML MODAL CREATE --}}
                            <!-- responsive -->
                            <div class="modal fade" data-width="760" id="modal-create-funcionario" tabindex="-1">
                                <div class="modal-header modal-header-success">
                                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    </button>
                                    <h2 class="modal-title">
                                        <i class="glyphicon glyphicon-user">
                                        </i>
                                        Registrar Funcionario
                                    </h2>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['id' => 'from_funcionario_create', 'class' => '', 'url' => '/forms']) !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                {!! Field::text('PK_FUNCIONARIO_Cedula',
                                                ['label' => 'Cedula:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Cedula', 'icon' => 'fa fa-user'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text('FUNCIONARIO_Apellidos',
                                                ['label' => 'Apellidos:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Apellidos', 'icon' => 'fa fa-user'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::email('FUNCIONARIO_Correo',
                                                ['label' => 'Correo Electronico:', 'max' => '40', 'min' => '10', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Email', 'icon' => ' fa fa-envelope-open'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text('FK_FUNCIONARIO_Estado','Activo',
                                                ['label' => 'Estado:','disabled'],
                                                ['help' => 'Ingrese Estado "Activo","Inactivo"', 'icon' => 'fa fa-ban'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::password('FUNCIONARIO_Clave', 
                                                ['label' => 'Contraseña:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Contraseña', 'icon' => 'fa fa-key'])
                                                !!}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                {!! Field::text('FUNCIONARIO_Nombres',
                                                ['label' => 'Nombres:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Nombres', 'icon' => 'fa fa-user'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text('FUNCIONARIO_Direccion',
                                                ['label' => 'Dirección:', 'max' => '50', 'min' => '5', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Direccion', 'icon' => 'fa fa-map-marker'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::tel('FUNCIONARIO_Telefono',
                                                ['label' => 'Telefono:','required', 'auto' => 'off', 'max' => '10'],
                                                ['help' => 'Digita un número de teléfono.', 'icon' => 'fa fa-phone'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text('FK_FUNCIONARIO_Rol','Administrador',
                                                ['label' => 'Rol:','disabled'],
                                                ['help' => 'Ingrese Rol "Administrador","Docente"', 'icon' => 'fa fa-ban'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::password('FUNCIONARIO_RClave', 
                                                ['label' => 'Confimar Contraseña:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Contraseña', 'icon' => 'fa fa-key'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::select('Seleccione Programa',$carreras,    
                                                        ['name' => 'FK_FUNCIONARIO_Programa']
                                                    )
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
                            <div class="modal fade" data-width="760" id="modal-update-funcionario" tabindex="-1">
                                <div class="modal-header modal-header-success">
                                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    </button>
                                    <h2 class="modal-title">
                                        <i class="glyphicon glyphicon-user">
                                        </i>
                                        Editar Fucionario
                                    </h2>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['id' => 'from_funcionario_update', 'class' => '', 'url' => '/forms']) !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                {!! Field::hidden('id_edit') !!}
                                                {!! Field::text('PK_FUNCIONARIO_Cedula_editar',
                                                ['label' => 'Cedula:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Cedula', 'icon' => 'fa fa-user'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text('FUNCIONARIO_Apellidos_editar',
                                                ['label' => 'Apellidos:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Apellidos', 'icon' => 'fa fa-user'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::email('FUNCIONARIO_Correo_editar',
                                                ['label' => 'Correo Electronico:', 'max' => '40', 'min' => '10', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Email', 'icon' => ' fa fa-envelope-open'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text('FK_FUNCIONARIO_Estado_editar','Activo',
                                                ['label' => 'Estado:','disabled'],
                                                ['help' => 'Ingrese Estado "Activo","Inactivo"', 'icon' => 'fa fa-ban'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::password('FUNCIONARIO_Clave_editar', 
                                                ['label' => 'Contraseña:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Contraseña', 'icon' => 'fa fa-key'])
                                                !!}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                {!! Field::text('FUNCIONARIO_Nombres_editar',
                                                ['label' => 'Nombres:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Nombres', 'icon' => 'fa fa-user'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text('FUNCIONARIO_Direccion_editar',
                                                ['label' => 'Dirección:', 'max' => '50', 'min' => '5', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Direccion', 'icon' => 'fa fa-map-marker'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::tel('FUNCIONARIO_Telefono_editar',
                                                ['label' => 'Telefono:','required', 'auto' => 'off', 'max' => '10'],
                                                ['help' => 'Digita un número de teléfono.', 'icon' => 'fa fa-phone'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text('FK_FUNCIONARIO_Rol_editar','Administrador',
                                                ['label' => 'Rol:','disabled'],
                                                ['help' => 'Ingrese Rol "Administrador","Docente"', 'icon' => 'fa fa-ban'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::password('FUNCIONARIO_RClave_editar', 
                                                ['label' => 'Confimar Contraseña:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese Contraseña', 'icon' => 'fa fa-key'])
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
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript">
</script>
<!-- SCRIPT MODAL -->
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
</script>
<!-- SCRIPT PWSTRENGTH -->
<script src="{{ asset('assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Maxlength -->
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Personalizadas -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript">
</script>
<!-- SCRIPT MENSAJES TOAST-->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript">
</script>
{{-- SCRIPT SELECT --}}
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
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
<script type="text/javascript">
    jQuery(document).ready(function() {
         
        ComponentsBootstrapMaxlength.init();
        ComponentsSelect2.init();
        //DATATABLE
        var table, url, columns;
        table = $('#funcionario-table-ajax');
        url = "{{ route('funcionario.data') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PK_FUNCIONARIO_Cedula', "visible": false },
            {data: 'FUNCIONARIO_Nombres', name: 'Nombres'},
            {data: 'FUNCIONARIO_Correo', name: 'Correo'},
            {data: 'FUNCIONARIO_Telefono', name: 'Telefono'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
                data:'action',
                name:'action',
                title:'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-right',
                render: null,
                responsivePriority:2
            }
        ];
        dataTableServer.init(table, url, columns);

        table = table.DataTable();
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();

            var route = '{{ route('funcionario.destroy') }}'+'/'+dataTable.PK_ADMIN_Cedula;
            var type = 'DELETE';
            var async = async || false;

            $.ajax({
                url: route,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
                        UIToastr.init(xhr , response.title , response.message  );
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'success') {
                        UIToastr.init(xhr, response.title, response.message);
                    }
                }
            });


        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input[name="id_edit"]').val(dataTable.PK_ADMIN_Cedula);            
            $('#modal-update-funcionario').modal('toggle');
       
            // $.get( "../../audiovisuales/administrador/all/"+ dataTable.PK_FNS_Cedula, function( data ) {
            //     console.log(data);
            //     //table.ajax.reload();
            //     $("#FNS_Nombres").val(data.FNS_Nombres);
            //     $("#FNS_Apellidos").val(data.FNS_Apellidos);
            //     $("#id_edit").val(data.PK_FNS_Cedula);
            //     $("#PK_FNS_Cedula").val(data.PK_FNS_Cedula);
            //     $("#FNS_Correo").val(data.FNS_Correo);
            //     $("#FNS_Telefono").val(data.FNS_Telefono);
            //     $("#FNS_Direccion").val(data.FNS_Direccion);
            //     $("#FK_FNS_Estado").val(data.FK_FNS_Estado);
            //     $("#FK_FNS_Programa").val(data.FK_FNS_Programa);
            //     $("#FNS_Clave").val(data.FNS_Clave);

            //     // PARA SELECCIONAR LA OPCION DE RADIO
            //     if (data.FK_FNS_Rol=='Estudiante'){
            //             $("input[name=FK_FNS_Rol][value='Estudiante']").prop("checked",true);
            //     }else {
            //                 $("input[name=FK_FNS_Rol][value='Docente']").prop("checked",true);
            //     }
            // });
        });

        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            $('#modal-create-funcionario').modal('toggle');

        });

        $(':password').pwstrength({
        ui: { showVerdictsInsideProgressBar: true }
        });

        /*Registrar Administrador*/
        var createAdmins = function () {
            return{
                init: function () {
                    var route = '{{ route('funcionario.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('PK_FUNCIONARIO_Cedula', $('input:text[name="PK_FUNCIONARIO_Cedula"]').val());
                    formData.append('FUNCIONARIO_Apellidos', $('input:text[name="FUNCIONARIO_Apellidos"]').val());
                    formData.append('FK_FUNCIONARIO_Estado', $('input:text[name="FK_FUNCIONARIO_Estado"]').val());
                    formData.append('FUNCIONARIO_Nombres', $('input:text[name="FUNCIONARIO_Nombres"]').val());
                    formData.append('FUNCIONARIO_Direccion', $('input:text[name="FUNCIONARIO_Direccion"]').val());
                    formData.append('FK_FUNCIONARIO_Rol', $('input:text[name="FK_FUNCIONARIO_Rol"]').val());
                    formData.append('FUNCIONARIO_Correo', $('#FUNCIONARIO_Correo').val());
                    formData.append('FUNCIONARIO_Clave', $('#FUNCIONARIO_Clave').val());
                    formData.append('FUNCIONARIO_Telefono', $('#FUNCIONARIO_Telefono').val());
                    formData.append('FK_FUNCIONARIO_Programa', $('select[name="FK_FUNCIONARIO_Programa"]').val());
                    
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
                                $('#modal-create-funcionario').modal('hide');
                                $('#from_funcionario_create')[0].reset(); //Limpia formulario
                                $(":password").pwstrength("forceUpdate");
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };


        // var form_edit = $('#from_roles_update');
        // var rules_edit = {
        //     name_edit: {minlength: 5, required: true},
        //     display_name_edit: {minlength: 5, required: true},
        //     description_edit: {minlength: 5},
        // };
        // FormValidationMd.init(form_edit,rules_edit,false,updatePermissions());

        var form_create = $('#from_funcionario_create');
        var rules_create = {
            PK_FUNCIONARIO_Cedula:{minlength: 5, required: true, digits: true},
            FUNCIONARIO_Apellidos:{minlength: 5, required: true},
            FK_FUNCIONARIO_Estado:{required: true},
            FUNCIONARIO_Nombres:{minlength: 5, required: true},
            FUNCIONARIO_Direccion:{minlength: 5, required: true},
            FK_FUNCIONARIO_Rol:{required: true},
            FUNCIONARIO_Correo:{email: true, required: true},
            FUNCIONARIO_Clave:{minlength: 5, required: true},
            FUNCIONARIO_Telefono:{minlength: 5, required: true, digits: true},
            FUNCIONARIO_RClave:{minlength: 5, required: true, equalTo:"#FUNCIONARIO_Clave"},
            FK_FUNCIONARIO_Programa:{required: true}
        };
        FormValidationMd.init(form_create,rules_create,false,createAdmins());

        
    });
    var ComponentsBootstrapMaxlength = function () {
            var handleBootstrapMaxlength = function() {
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
    var ComponentsSelect2 = function() {
            var handleSelect = function() {
                $.fn.select2.defaults.set("theme", "bootstrap");
                var placeholder = "<i class='fa fa-search'></i>  " + "Seleccionar";
                $(".pmd-select2").select2({
                    width: null,
                    placeholder: placeholder,
                    escapeMarkup: function(m) { 
                       return m; 
                    }
                });
            }
            return {
                init: function() {
                    handleSelect();
                }
            };
        }();
</script>
@endpush

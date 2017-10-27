<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Permisos registrado:'])
            @slot('actions', [
                       'link_cancel' => [
                       'link' => '',
                       'icon' => 'fa fa-arrow-left',
                      ],
               ])

        <div class="form-group">
            <div class="col-md-offset-1 col-md-10">
                <br><br>
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                    <thead>
                    <th>Número de Cedula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    </thead>
                    <tbody>
                    <td>{{$empleado->PK_PRSN_Cedula}}</td>
                    <td>{{$empleado->PRSN_Nombres}}</td>
                    <td>{{$empleado->PRSN_Apellidos}}</td>
                    <td>{{$empleado->PRSN_Telefono}}</td>
                    <td>{{$empleado->PRSN_Correo}}</td>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
            <br>
            @permission('CREATE_PERM_RRHH')
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i>Nuevo</a>                    </div>
                </div>
            </div>
            @endpermission
            <br>
            @permission('READ_PERM_RRHH')
                <div class="row">
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-permisos'])
                            @slot('columns', [
                                '#',
                                'Descripción',
                                'Fecha',
                                'Acciones'
                            ])
                        @endcomponent
                    </div>
                </div>
            @endpermission
        <!-- Modal -->
            <div class="modal fade" id="modal-create-permission" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_permission_create', 'url'=> ['/forms']]) !!}
                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-thumbs-up"></i> Regitro de permisos o incapacidades</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula,['id'=>'FK_TBL_Persona_Cedula']) !!}

                                    {!! Field::textarea(
                                        'PERM_Descripcion',null,
                                        ['label' => 'Descripción del permiso o incapacidad', 'maxlength' => '300','auto' => 'off'],
                                        ['help' => 'Ingrese la Descripción del permiso a registrar']) !!}
                                    {!! Field::date('PERM_Fecha',
                                                   ['label'=>'Fecha del permiso o incapacidad','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd"],
                                                   ['help' => 'Seleccione la fecha del permiso o incapacidad.', 'icon' => 'fa fa-calendar']) !!}
                            </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal-update-permission" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_permission_update', 'url'=> ['/forms']]) !!}
                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-thumbs-up"></i> Edición de permisos o incapacidades</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula,['id'=>'FK_TBL_Persona_Cedula']) !!}
                                    {!! Field::hidden('PK_PERM_IdPermiso') !!}
                                    {!! Field::textarea(
                                        'PERM_Descripcion',
                                        ['id'=>'descUpdate','label' => 'Descripción del permiso o incapacidad', 'maxlength' => '300','required', 'auto' => 'off'],
                                        ['help' => 'Ingrese la Descripción del permiso a registrar']) !!}
                                    {!! Field::date('PERM_Fecha',
                                                   ['id'=>'fechaUpdate','label'=>'Fecha del permiso o incapacidad','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd"],
                                                   ['help' => 'Seleccione la fecha del permiso o incapacidad.', 'icon' => 'fa fa-calendar']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endcomponent
    </div>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                todayHighlight: true,
                autoclose: true,
                language: "es",
            });
            $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        var cedula=$('input[id="FK_TBL_Persona_Cedula"]').val();
        var table, url,columns;
        table = $('#lista-permisos');
        url = '{{ route('talento.humano.permisos.consultaPermisos')}}'+'/'+cedula;
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PERM_Descripcion', name: 'Descripción'},
            {data: 'PERM_Fecha', name: 'Fecha'},
            {
                defaultContent: '@permission("UPDATE_PERM_RRHH")<a href="javascript:;" class="btn btn-primary edit" ><i class="icon-pencil"></i></a>@endpermission @permission("DELETE_PERM_RRHH")<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission',
                data:'action',
                name:'action',
                title:'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority:2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('talento.humano.permisos.destroy') }}'+'/'+dataTable.PK_PERM_IdPermiso;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Esta seguro?",
                    text: "¿Esta seguro de eliminar el permiso seleccionado?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            url: route,
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            cache: false,
                            type: type,
                            contentType: false,
                            processData: false,
                            async: async,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    table.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 &&  xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun permiso", "error");
                    }
                });
        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();

            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input[name="PK_PERM_IdPermiso"]').val(dataTable.PK_PERM_IdPermiso);
            $('#descUpdate').val(dataTable.PERM_Descripcion);
            $('#fechaUpdate').val(dataTable.PERM_Fecha);
            $('#modal-update-permission').modal('toggle');
        });

        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            $('#modal-create-permission').modal('toggle');
        });

        var createPermision = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.permisos.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('FK_TBL_Persona_Cedula', $('[name="FK_TBL_Persona_Cedula"]').val());
                    formData.append('PERM_Fecha', $('[name="PERM_Fecha"]').val());
                    formData.append('PERM_Descripcion', $('[name="PERM_Descripcion"]').val());
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
                                $('#modal-create-permission').modal('hide');
                                $('#form_permission_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var updatePermision = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.permisos.update') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('FK_TBL_Persona_Cedula', $('[name="FK_TBL_Persona_Cedula"]').val());
                    formData.append('PERM_Fecha', $('#fechaUpdate').val());
                    formData.append('PERM_Descripcion', $('#descUpdate').val());
                    formData.append('PK_PERM_IdPermiso', $('[name="PK_PERM_IdPermiso"]').val());
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
                                $('#modal-update-permission').modal('hide');
                                $('#form_permission_update')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#!();áéíóúñüàè]+$/i.test(value);
        });
        var form_create = $('#form_permission_create');
        var formMessage = {
            PERM_Descripcion: {letters: 'Existen caracteres que no están permitidos'},
        };
        var rules_create = {
            PERM_Descripcion: { maxlength: 300, required: true, letters:true },
            PERM_Fecha: { required: true },
        };
        FormValidationMd.init(form_create,rules_create,formMessage,createPermision());

        var form_update = $('#form_permission_update');
        var rules_update = {
            PERM_Descripcion: { maxlength: 300, required: true, letters:true },
            PERM_Fecha: { required: true },
        };

        FormValidationMd.init(form_update,rules_update,formMessage,updatePermision());

        $( "#link_cancel" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.permisos.listaEmpleados.ajax') }}';
            $(".content-ajax").load(route);
        });
    });
</script>
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Usuarios Registrados:'])
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    @permission('ADMIN_CARPARK')<a href="javascript:;"
                                                   class="btn btn-simple btn-success btn-icon create"
                                                   title="Registar nuevo usuario">
                        <i class="fa fa-plus">
                        </i>Nuevo
                    </a>@endpermission
                    @permission('ADMIN_CARPARK')<a href="javascript:;"
                                                   class="btn btn-simple btn-success btn-icon reports"
                                                   title="Reporte"><i class="glyphicon glyphicon-list-alt"></i>Reporte
                        de Usuarios</a>@endpermission
                    <br>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaUsuarios'])
                    @slot('columns', [
                        '#',
                        'Código',
                        'Nombre',
                        'Apellido',
                        'Correo',
                        'Perfil',
                        'Vehículo',
                        'Acciones'
                    ])
                @endcomponent
            </div>
        </div>
    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        var table, url, columns;
        table = $('#listaUsuarios');
        url = "{{ route('parqueadero.usuariosCarpark.tablaUsuarios')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PK_CU_Codigo', name: 'Código'},
            {data: 'CU_Nombre1', name: 'Nombre'},
            {data: 'CU_Apellido1', name: 'Apellido'},
            {data: 'CU_Correo', name: 'Correo'},
            {
                defaultContent: '@permission('ADMIN_CARPARK')<a href="javascript:;" class="btn btn-success verPerfil"  title="Perfil" ><i class="fa fa-address-card"></i></a>@endpermission',
                data: 'action',
                name: 'Perfil',
                title: 'Perfil',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            },
            {
                defaultContent: '@permission('ADMIN_CARPARK')<a href="javascript:;" class="btn btn-success RegistrarMoto"  title="Vehículo" ><i class="fa fa-motorcycle"></i></a>@endpermission',
                data: 'action',
                name: 'Vehículo',
                title: 'Vehículo',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            },
            {
                defaultContent: '@permission('ADMIN_CARPARK')<a href="javascript:;" class="btn btn-success reporte"  title="Reporte" ><i class="fa fa-table"></i></a>@endpermission @permission('ADMIN_CARPARK') <a href="javascript:;" title="Editar" class="btn btn-primary edit" ><i class="icon-pencil"></i></a> @endpermission @permission('ADMIN_CARPARK')<a href="javascript:;" title="Eliminar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission',
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('parqueadero.usuariosCarpark.destroy') }}' + '/' + dataTable.PK_CU_Codigo;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar el usuario seleccionado?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                                if (request.status === 422 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun usuario", "error");
                    }
                });

        });

        table.on('click', '.verPerfil', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('parqueadero.usuariosCarpark.verPerfil') }}' + '/' + dataTable.PK_CU_Codigo;
            $(".content-ajax").load(route_edit);
        });

        table.on('click', '.RegistrarMoto', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('parqueadero.motosCarpark.RegistrarMoto') }}' + '/' + dataTable.PK_CU_Codigo;
            $(".content-ajax").load(route_edit);
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('parqueadero.usuariosCarpark.edit') }}' + '/' + dataTable.PK_CU_Codigo;
            $(".content-ajax").load(route_edit);
        });

        $(".create").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.usuariosCarpark.create') }}';
            $(".content-ajax").load(route);
        });

        table.on('click', '.reporte', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $.ajax({}).done(function () {
                window.open('{{ route('parqueadero.reportesCarpark.reporteUsuario') }}' + '/' + dataTable.PK_CU_Codigo, '_blank');
            });
        });

        $(".reports").on('click', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $.ajax({}).done(function () {
                window.open('{{ route('parqueadero.reportesCarpark.reporteUsuariosRegistrados') }}', '_blank');
            });
        });
    });
</script>
<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Usuarios Registrados:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-simple btn-success btn-icon create">
                            <i class="fa fa-plus">
                            </i>Nuevo
                        </a><br>
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

        var table, url,columns;
        table = $('#listaUsuarios');
        url = "{{ route('parqueadero.usuariosCarpark.tablaUsuarios')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PK_CU_Codigo', name: 'Código'},
            {data: 'CU_Nombre1', name: 'Nombre'},
            {data: 'CU_Apellido1', name: 'Apellido'},
            {data: 'CU_Correo', name: 'Correo'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success verPerfil"  title="Perfil" ><i class="fa fa-address-card"></i></a>',
                data:'action',
                name:'Perfil',
                title:'Perfil',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority:2
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success RegistrarMoto"  title="Vehículo" ><i class="fa fa-motorcycle"></i></a>',
                data:'action',
                name:'Vehículo',
                title:'Vehículo',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority:2
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success reports"  title="Reporte" ><i class="fa fa-table"></i></a><a href="javascript:;" title="Editar" class="btn btn-primary edit" ><i class="icon-pencil"></i></a><a href="javascript:;" title="Eliminar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
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
            var route = '{{ route('parqueadero.usuariosCarpark.destroy') }}'+'/'+dataTable.PK_CU_Codigo;
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
                                if (request.status === 422 &&  xhr === 'success') {
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
                route_edit = '{{ route('parqueadero.usuariosCarpark.verPerfil') }}'+'/'+dataTable.PK_CU_Codigo;
            $(".content-ajax").load(route_edit);
        });
        
        table.on('click', '.RegistrarMoto', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('parqueadero.motosCarpark.RegistrarMoto') }}'+'/'+dataTable.PK_CU_Codigo;
            $(".content-ajax").load(route_edit);
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('parqueadero.usuariosCarpark.edit') }}'+'/'+dataTable.PK_CU_Codigo;
            $(".content-ajax").load(route_edit);
        });

        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.usuariosCarpark.create') }}';
            $(".content-ajax").load(route);
        });
        table.on('click', '.reports', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $.ajax({
            }).done(function(){
                window.location.href='{{ route('talento.humano.document.pdfRadicacion') }}'+'/'+dataTable.PK_PRSN_Cedula;
            });
        });
    });
</script>
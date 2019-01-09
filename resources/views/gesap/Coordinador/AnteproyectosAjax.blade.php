<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Anteproyectos registrados:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission('ADD_ANTEPROYECTO')<a href="javascript:;"
                                                       class="btn btn-simple btn-success btn-icon create"
                                                       title="Registar un nuevo anteproyecto">
                            <i class="fa fa-plus">
                            </i>Nuevo
                        </a>@endpermission
                        @permission('PARK_REPORT_USER')<a href="javascript:;"
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
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaAnteproyecto'])
                        @slot('columns', [
                            'Titulo',
                            
                            'Palabras clave',
                            'Duracion',
                            'Fecha Inicio',
                            'Fecha Fin',
                    
                            'Estado',
                         
                            'Acciones'
                        ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>
 
@push('plugins')

    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('assets/main/scripts/table-datatable.js') }}" type = "text/javascript" ></script>
    <script type="text/javascript">

    jQuery(document).ready(function () {

        var table, url, columns;
        table = $('#listaAnteproyecto');
        url = "{{ route('AnteproyectosGesap.List')}}";
        columns = [
            {data: 'NPRY_Titulo', name: 'NPRY_Titulo'},
            {data: 'NPRY_Keywords', name: 'NPRY_Keywords'},
            {data: 'NPRY_Descripcion', name: 'NPRY_Descripcion'},
            {data: 'NPRY_Duracion', name: 'NPRY_Duracion'},
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Estado', name: 'Estado'},
           
            {
                defaultContent: '@permission('REPORT_GESAP')<a href="javascript:;" class="btn btn-success reporte"  title="Reporte" ><i class="fa fa-table"></i></a>@endpermission @permission('UPDATE_ANTE')<a href="javascript:;" title="Editar" class="btn btn-primary editar" ><i class="icon-pencil"></i></a>@endpermission @permission('DELATE_ANTE')<a href="javascript:;" title="Eliminar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission',
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
            var route = '{{ route('Anteproyecto.destroy') }}' + '/' + dataTable.PK_NPRY_IdMctr008;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este anteproyecto?",
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
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun anteproyecto", "error");
                    }
                });

        });
        
        $(".create").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.create') }}';
            $(".content-ajax").load(route);
        });

        table.on('click', '.editar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('Anteproyecto.edit') }}' + '/' + dataTable.PK_NPRY_IdMctr008;
            $(".content-ajax").load(route_edit);
        });

    

    });
</script>
@endpush
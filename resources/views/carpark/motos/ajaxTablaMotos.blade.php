<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Vehículos Registrados:'])
            <br>            
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaMotos'])
                        @slot('columns', [
                            '#',
                            'Placa',
                            'Marca',
                            'Código Propietario',
                            'Perfil',
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
        table = $('#listaMotos');
        url = "{{ route('parqueadero.motosCarpark.tablaMotos')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CM_Placa', name: 'Placa'},
            {data: 'CM_Marca', name: 'Marca'},
            {data: 'FK_CM_CodigoUser', name: 'Código Propietario'},
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
            var route = '{{ route('parqueadero.motosCarpark.destroy') }}'+'/'+dataTable.PK_CM_IdMoto;
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
                route_edit = '{{ route('parqueadero.motosCarpark.verMoto') }}'+'/'+dataTable.PK_CM_IdMoto;
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
                route_edit = '{{ route('parqueadero.motosCarpark.editar') }}'+'/'+dataTable.PK_CM_IdMoto;
            $(".content-ajax").load(route_edit);
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
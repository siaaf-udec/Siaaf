<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Documentación registrada:'])
        <br>
        <div class="row">
            @permission('FUNC_RRHH')
            <div class="col-md-12">
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create">
                        <i class="fa fa-plus">
                        </i>Nuevo
                    </a>
                </div>
            </div>
            @endpermission
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">

                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-documentos'])
                    @slot('columns', [
                        '#',
                        'llave',
                        'Documento',
                        'Tipo',
                        'Acciones'
                    ])
                @endcomponent
            </div>
        </div>
    @endcomponent
</div>

<!-- Datatables  y Toastr functions -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var table, url, columns;
        table = $('#lista-documentos');
        url = "{{ route('talento.humano.tablaDocumentos')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PK_DCMTP_Id_Documento', "visible": false},
            {data: 'DCMTP_Nombre_Documento', name: 'documento'},
            {data: 'DCMTP_Tipo_Documento', name: 'tipo'},
            {
                defaultContent: '@permission("FUNC_RRHH")<a href="javascript:;" class="btn btn-primary edit" ><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission',
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
            var route = '{{ route('talento.humano.document.destroy') }}' + '/' + dataTable.PK_DCMTP_Id_Documento;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Esta seguro?",
                    text: "¿Esta seguro de eliminar el documento seleccionado?",
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
                        swal("Cancelado", "No se eliminó ningun documento", "error");
                    }
                });

        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                routeEdit = '{{ route('talento.humano.document.edit') }}' + '/' + dataTable.PK_DCMTP_Id_Documento;
            $(".content-ajax").load(routeEdit);
        });

        $(".create").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.document.create') }}';
            $(".content-ajax").load(route);
        });
    });
</script>
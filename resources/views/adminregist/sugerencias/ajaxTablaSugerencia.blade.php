<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Sugerencias'])
        <div class="clearfix"></div><br><br><br>
        <br>
        <div class="row">
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaSugerencias'])
                    @slot('columns', [
                        '#',
                        'Pregunta',
                        'Usuario',
                        'Correo',
                        'Estado',
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
        App.unblockUI();

        var table, url, columns;
        table = $('#listaSugerencias');
        url = "{{ route('adminRegist.sugerencia.data')}}";
        columns = [
            {data: 'PK_SU_IdSugerencia', name: 'PK_SU_IdSugerencia', "visible": false, searchable: false},
            {data: 'SU_Pregunta', name: 'SU_Pregunta'},
            {data: 'SU_Username', name: 'SU_Username'},
            {data: 'SU_Email', name: 'SU_Email'},
            {data: 'SU_Estado', name: 'SU_Estado'},
            {
                defaultContent: '@permission('ADMINREGIST_SU_DELETE')<a href="javascript:;" class="btn btn-simple btn-danger btn-icon mt-sweetalert remove"><i class="icon-trash"></i></a>@endpermission @permission('ADMINREGIST_ADSU')<a href="javascript:;" class="btn btn-primary answer"><i class="icon-envelope-letter"></i></a>@endpermission',
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
            var route = '{{ route('adminRegist.sugerencia.destroy') }}' + '/' + dataTable.PK_SU_IdSugerencia;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar los datos?",
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
                        swal("Cancelado", "No se eliminó ninguna novedad", "error");
                    }
                });
        });
        table.on('click', '.answer', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('adminRegist.sugerencia.index.correo') }}' + '/' + dataTable.PK_SU_IdSugerencia;
            $(".content-ajax").load(route_edit);
        });
    });
</script>
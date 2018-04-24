<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Novedades'])

        @slot('actions', [
            'link_upload' => [
                'link' => '',
                'icon' => 'icon-cloud-upload',
            ],
            'link_wrench' => [
                'link' => '',
                'icon' => 'icon-wrench',
            ],
            'link_trash' => [
                'link' => '',
                'icon' => 'icon-trash',
            ],
        ])
        <div class="clearfix"></div><br><br><br>
        <div class="row">
            @permission('ADMINREGIST_NOV_CREATE')
            <div class="col-md-12">
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon register"><i
                                class="fa fa-chevron-circle-right"></i>Registrar Novedad</a>

                </div>
            </div>
            @endpermission
            <div class="clearfix"></div>
            <br>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaNovedades'])
                    @slot('columns', [
                        '#',
                        'Novedad',
                        'Acciones'
                    ])
                @endcomponent
            </div>
        </div>
    @endcomponent
</div>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        App.unblockUI();
        /*
         * Referencia https://datatables.net/reference/option/
         */
        var table, url, columns;
        table = $('#listaNovedades');
        url = "{{ route('adminRegist.novedad.data')}}";
        columns = [
            {data: 'PK_NOV_IdNovedad', name: 'PK_NOV_IdNovedad', "visible": false, searchable: false},
            {data: 'NOV_NombreNovedad', name: 'NOV_NombreNovedad'},
            {
                defaultContent: '@permission('ADMINREGIST_NOV_UPDATE')<a href="javascript:;" title="Editar" class="btn btn-primary edit" ><i class="icon-pencil"></i></a>@endpermission @permission('ADMINREGIST_NOV_DELETE') <a href="javascript:;" class="btn btn-simple btn-danger btn-icon mt-sweetalert remove"><i class="icon-trash"></i></a>@endpermission',
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
            var route = '{{ route('adminRegist.novedad.destroy') }}' + '/' + dataTable.PK_NOV_IdNovedad;
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

        $(".register").on('click', function (e) {
            e.preventDefault();
            var route_create = '{{ route('adminRegist.novedad.create') }}';
            $(".content-ajax").load(route_create);
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('adminRegist.novedad.edit') }}' + '/' + dataTable.PK_NOV_IdNovedad;
            $(".content-ajax").load(route_edit);
        });

    });
</script>
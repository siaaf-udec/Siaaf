<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Sanciones'])
        <div class="clearfix">
        </div>
        <br><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'usuarios-table'])
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id',
                    'Funcionario',
                    'C.C',
                    'Correo',
                    'Administrador',
                    'Fecha de Sancion',
                    'Acciones' => ['style' => 'width:200px;']
                ])
            @endcomponent
        </div>
        <div class="clearfix"></div>
    @endcomponent
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        App.unblockUI('.portlet-form');
        var idFuncionario;
        var table, url, columns;
        table = $('#usuarios-table');
        url = "{{ route('listarSancionesSolicitudesFinalizadas.dataTable') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'id', "visible": false },
            {data: function(data){
                return data.consulta_usuario_audiovisuales.user.name +" "
                    +data.consulta_usuario_audiovisuales.user.lastname;
            },name:'Funcionario'},
            {data: 'consulta_usuario_audiovisuales.user.identity_no', name: 'C.C'},
            {data: 'consulta_usuario_audiovisuales.user.email', name: 'Correo'},
            {data: function(data){
                return data.conultar_administrador_entrega.name +" "
                    +data.conultar_administrador_entrega.lastname;
            },name:'Administrador Entrega'},
            {data: 'SNS_Fecha', name: 'Fecha'},
            {
                defaultContent:
                '@permission("AUDI_CANCEL_SANCTION")<a title="Anular sancion" href="javascript:;" class="btn btn-simple btn-danger btn-icon anular"><i class="icon-trash"></i></a>@endpermission' +
                '@permission("AUDI_VIEW_SANCTION")<a title="Ver Sancion" href="javascript:;" class="btn btn-simple btn-success btn-icon ver"><i class="icon-eye"></i></a>@endpermission',
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
        table.on('click', '.anular', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            swal(
                {
                    title: "Anular Sanciones",
                    text: "Las sanciones asignadas a esta solicitud seran eliminadas,desea anular la(s) sancion(es)",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        var route = '{{ route('audiovisuales.anular.sancion') }}';
                        var formDatas = new FormData();
                        var typeAjax = 'POST';
                        var async = async || false;
                        formDatas.append('SNS_Sancion_General',dataTable.SNS_Sancion_General);
                        formDatas.append('SNS_Numero_Orden',dataTable.SNS_Numero_Orden);
                        formDatas.append('FK_SNS_Id_Solicitud',dataTable.FK_SNS_Id_Solicitud);
                        formDatas.append('id_Sancion',dataTable.id);
                        formDatas.append('accion','anulacionGeneral');
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: typeAjax,
                            contentType: false,
                            data: formDatas,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                UIToastr.init(xhr, response.title, response.message);
                                table.ajax.reload();
                                App.unblockUI('.portlet-form');

                            },
                            error: function (response, xhr, request) {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        });
                    }
                }
            );
        });
        table.on('click', '.ver', function (e){
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('audiovisuales.listar.sanciones.asignadas.gestion') }}'+'/'+dataTable.SNS_Numero_Orden;
            $(".content-ajax").load(route);
        });
    });
</script>


{{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Reservas'])
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
        <div class="clearfix">
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    <a class="btn btn-outline dark prestamoAjax" data-toggle="modal">
                        <i class="fa fa-plus">
                        </i>
                        Prestamos
                    </a>
                    <a class="btn btn-outline dark sancionesAjax" data-toggle="modal">
                        <i class="fa fa-plus">
                        </i>
                        Sanciones
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'reservas-table-ajax'])
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Nombre ',
                    'Codigo',
                    'Fecha Solicitud',
                    'Acciones' => ['style' => 'width:90px;']
                ])
            @endcomponent
        </div>
        <div class="clearfix"></div>

    @endcomponent
</div>
{{-- END HTML SAMPLE --}}
<script type="text/javascript">
    jQuery(document).ready(function() {
        var table, url, columns;
        table = $('#reservas-table-ajax');
        url = "{{ route('gestionReserva.dataTable') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: function(data){
                        return data.conultar_usuario_developer.name +" " +data.conultar_usuario_developer.lastname;
                },name:'Nombre'},
            {data: 'conultar_usuario_developer.email', name: 'Codigo'},
            {data: 'PRT_Fecha_Inicio', name: 'Fecha Solicitud'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-info btn-icon verReserva"><i class="icon-list"></i>ver reserva</a>',
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
        table.on('click', '.verReserva', function (e) {
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
    });
</script>

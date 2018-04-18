<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Reservas'])
        @slot('actions', [
                'link_cancel' => [
                  'link' => '',
                  'icon' => 'fa fa-arrow-left',
                 ],
                ])
        <div class="clearfix">
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    @permission('AUDI_REQUESTS_VIEW_LENDING')
                    <a class="btn btn-outline dark prestamoAjax" data-toggle="modal">
                        <i class="fa fa-plus">
                        </i>
                        Prestamos
                    </a>
                    @endpermission
                </div>
            </div>
        </div>
        <br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'reservas-table-ajax'])
                @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'id',
                        'PRT_Num_Orden',
                        'Nombres',
                        'Correo Electronico',
                        'Tipo Identificacion',
                        'Numero',
                        'Acciones' => ['style' => 'width:90px;']
                    ])
            @endcomponent
        </div>
        <div class="clearfix"></div>
    @endcomponent
</div>
<script type="text/javascript">
    var ComponentsBootstrapMaxlength = function () {
        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                alwaysShow: true,
                appendToParent: true
            });

        }
        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };
    }();
    jQuery(document).ready(function() {
        ComponentsBootstrapMaxlength.init();
        var $text_area_Elementos_kit = $('#PRT_Informacion_Kit');
        ComponentsDateTimePickers.init();
        var table, url, columns;
        table = $('#reservas-table-ajax');
        url = "{{ route('gestionReserva.dataTable') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'id', "visible": false },
            {data: 'PRT_Num_Orden', "visible": false },
            {data: function(data){
                return data.consulta_usuario_audiovisuales.user.name +" "
                    +data.consulta_usuario_audiovisuales.user.lastname;
            },name:'PRT_Fecha_Inicio'},
            {data: 'consulta_usuario_audiovisuales.user.email', name: 'Correo Electronico'},
            {data: 'consulta_usuario_audiovisuales.user.identity_type', name: 'Tipo Identificacion'},
            {data: 'consulta_usuario_audiovisuales.user.identity_no', name: 'Numero'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-success btn-icon edit">Ver Reserva</i></a>',
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
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('audiovisuales.ListarReservasAcciones') }}'+'/'+dataTable.PRT_Num_Orden;
            $(".content-ajax").load(route);
        });
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
            $(".content-ajax").load(route);
        });
        $('.prestamoAjax').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
            $(".content-ajax").load(route);
        });
    });
</script>

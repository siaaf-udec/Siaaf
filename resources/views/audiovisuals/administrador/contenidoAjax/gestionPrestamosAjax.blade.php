<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'SOLICITUDES PRESTAMOS REALIZADOS'])
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    @permission('AUDI_REQUESTS_VIEW_RESERVATION')
                    <a class="btn btn-outline dark reservaAjax" data-toggle="modal">
                        <i class="fa fa-plus">
                        </i>
                        Reservas
                    </a>
                    @endpermission
                </div>
            </div>

            <div class="clearfix">
            </div>
            <br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'usuarios-table'])
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
        </div>
    @endcomponent
</div>
<script type="text/javascript">
    var ComponentsSelect2 = function() {
        var handleSelect = function() {
            $.fn.select2.defaults.set("theme", "bootstrap");
            var placeholder = "<i class='fa fa-search'></i>  " + "Seleccionar";
            $(".pmd-select2").select2({
                width: null,
                placeholder: placeholder,
                escapeMarkup: function(m) {
                    return m;
                }
            });
        }
        return {
            init: function() {
                handleSelect();
            }
        };
    }();
    jQuery(document).ready(function () {
        App.unblockUI('.portlet-form');
        ComponentsSelect2.init();
        var idFuncionario;
        var table, url, columns;
        table = $('#usuarios-table');
        url = "{{ route('listarFuncionarios.dataTable') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'id', "visible": false },
            {data: 'PRT_Num_Orden', "visible": false },
            {data: function(data){
                return data.consulta_usuario_audiovisuales.user.name +" "
                    +data.consulta_usuario_audiovisuales.user.lastname;
            },name:'PRT_Fecha_Inicio'},
            {data: 'consulta_usuario_audiovisuales.user.email', name: 'consulta_usuario_audiovisuales.user.email'},
            {data: 'consulta_usuario_audiovisuales.user.identity_type', name: 'consulta_usuario_audiovisuales.user.identity_type'},
            {data: 'consulta_usuario_audiovisuales.user.identity_no', name: 'consulta_usuario_audiovisuales.user.identity_no'},
            {
                defaultContent: '@permission("AUDI_REQUESTS_VIEW_LENDING")<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit">Finalizar Prestamo</i></a>@endpermission',
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
            var route = '{{ route('audiovisuales.EntregasPrestamo.index') }}'+'/'+dataTable.PRT_Num_Orden;
            $(".content-ajax").load(route);

        });
        $( ".reservaAjax" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('reserva.index') }}';
            $(".content-ajax").load(route);
        });
    });
</script>


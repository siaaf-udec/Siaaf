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
                    <a class="btn btn-outline dark sancionesRegistradasAjax" data-toggle="modal">
                        <i class="fa fa-plus">
                        </i>
                        Listar Sanciones
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
                        'Nombre Funcionario',
                        'Correo Electronico',
                        'Tipo Identificacion',
                        'Numero',
                        'Administrador Sancionó',
                        'Fecha Sancion',
                        'Observacion',
                        'Estado',
                        'Costo',

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
        App.unblockUI('.portlet-form');
        ComponentsBootstrapMaxlength.init();
        var $text_area_Elementos_kit = $('#PRT_Informacion_Kit');
        var table, url, columns;
        table = $('#reservas-table-ajax');
        url = "{{ route('listarSancionesCanceladas.dataTable') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'id', "visible": false },
            {data: function(data){
                return data.consulta_usuario_audiovisuales.user.name +" "
                    +data.consulta_usuario_audiovisuales.user.lastname;
            },name:'Funcionario'},
            {data: 'consulta_usuario_audiovisuales.user.email', name: 'consulta_usuario_audiovisuales.user.email'},
            {data: 'consulta_usuario_audiovisuales.user.identity_type', name: 'consulta_usuario_audiovisuales.user.identity_type'},
            {data: 'consulta_usuario_audiovisuales.user.identity_no', name: 'consulta_usuario_audiovisuales.user.identity_no'},
            {data: function(data){
                return data.consultar_administrador_entrega.user.name +" "
                    +data.consultar_administrador_entrega.user.lastname;
            },name:'Administrador'},
            {data: 'SNS_Fecha', name: 'SNS_Fecha'},
            {data: 'SNS_Descripcion', name: 'SNS_Descripcion'},
            {data: 'Estado', name: 'Estado'},
            {data: 'SNS_Costo', name: 'SNS_Costo'},

        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        $( ".sancionesRegistradasAjax" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.gestionPrestamos.sanciones.ajax') }}';
            $(".content-ajax").load(route);
        });
        $( "#link_cancel" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.gestionPrestamos.sanciones.ajax') }}';
            $(".content-ajax").load(route);
        });

    });
</script>
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
                    <a class="btn btn-outline dark prestamoAjax" data-toggle="modal">
                        <i class="fa fa-plus">
                        </i>
                        Prestamos
                    </a>
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
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" data-width="760" id="modal-ver-reserva" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-tv">
                            </i>
                            Informacion Reserva
                        </h2>
                    </div>
                    <div class="modal-body" >
                        {!! Form::open(['id' => 'from_detalles_reserva', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-6" >
                                <div id="kitArticulo">
                                </div>
                                    {!! Field::text('KIT',
                                    ['disabled','label' => 'Elemento:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                    ['help' => '', 'icon' => 'fa fa-user'])
                                    !!}
                                <br><br><br><br>
                                <p>
                                    {!! Field::text(
                                        'PRT_Fecha_Inicio',
                                        ['disabled','label'=>'Fecha Recibir Reserva','class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                        ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar'])
                                    !!}
                                </p>
                                <p>
                                    {!! Field::textarea('PRT_Observacion_Entrega',
                                                    ['label' => 'Entrega Estado Elementos', 'required', 'auto' => 'off', 'max' => '255', "rows" => '6'],
                                                    ['help' => 'Descripcion del estado de los elementos.', 'icon' => 'fa fa-quote-right']) !!}
                                </p>
                            </div>
                            <div class="col-md-6" >
                                <div id = "texareaP">
                                    {!! Field::textarea('PRT_Informacion_Kit',
                                                    ['disabled','label' => 'Descripción', 'required', 'auto' => 'off', 'max' => '255', "rows" => '6','disabled'],
                                                    ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-quote-right'])
                                                    !!}
                                </div>
                                <p>
                                    {!! Field::text(
                                        'PRT_Fecha_Fin',
                                        ['disabled','label'=>'Fecha Entregar Reserva','class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                        ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar'])
                                    !!}
                                </p>
                                <p>
                                    {!! Field::textarea('PRT_Observacion_Recibe',
                                                    ['label' => 'Recibe Estado Elementos', 'required', 'auto' => 'off', 'max' => '255', "rows" => '6'],
                                                    ['help' => 'Descripcion del estado de los elementos.', 'icon' => 'fa fa-quote-right']) !!}
                                </p>
                            </div>
                        </div>

                    <div class="modal-footer">
                        {!! Form::submit('Entregar Reserva', ['id'=>'botonReserva','class' => 'btn blue']) !!}
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        </div>
    @endcomponent
</div>
<script type="text/javascript">
    var ComponentsDateTimePickers = function () {
        var handleDatetimePicker = function () {
            if (!jQuery().datetimepicker) {
                return;
            }
            var tres=3;
            var fecha = new Date();
            fecha.setDate(fecha.getDate() + 1);
            var fecha2 = new Date();
            fecha2.setDate(fecha2.getDate() + tres);

            $(".date-time-picker").datetimepicker({
                autoclose: true,
                isRTL: App.isRTL(),
                format:"yyyy-mm-dd hh:ii",//FORMATO DE FECHA NUMERICO AÑO/MES/DIA
                //format: "dd MM yyyy - hh:ii",//FORMATO DE FECHA EN TEXTO
                fontAwesome: true,
                //todayBtn: true,//BOTON DE HOY...
                //startDate: new Date(),//EMPIEZE DESDE LA FECHA ACTUAL
                startDate: fecha,//Fecha Actual pero sin la hora
                endDate: fecha2,//Fecha Actual + 5 dias
                showMeridian: true, // HORA EN 24 HORAS
                pickerPosition: (App.isRTL() ? "bottom-left" : "bottom-right"),
            });
        }
        return {
            //main function to initiate the module
            init: function () {
                handleDatetimePicker();
            }
        };
    }();
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

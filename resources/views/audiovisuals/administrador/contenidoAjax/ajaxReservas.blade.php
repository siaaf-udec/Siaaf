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
                    'id',
                    'Nombre',
                    'Codigo',
                    'Fecha Solicitud',
                    'Elementos' => ['style' => 'width:90px;'],
                    'Acciones' => ['style' => 'width:90px;']
                ])
            @endcomponent
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
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
                                        ['label'=>'Fecha Recibir Reserva','class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
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
                                        ['label'=>'Fecha Entregar Reserva','class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
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
                        {!! Form::submit('Realizar reserva', ['id'=>'botonReserva','class' => 'btn blue']) !!}
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}

                    </div>
                    {!! Form::close() !!}
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>
        </div>
        </div>
    @endcomponent
</div>
{{-- END HTML SAMPLE --}}

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
                //todayBtn: true,//BOTON DE HOY
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
            {data: function(data){
                        return data.conultar_usuario_developer.name +" " +data.conultar_usuario_developer.lastname;
                },name:'Nombre'},
            {data: 'conultar_usuario_developer.email', name: 'Codigo'},
            {data: 'PRT_Fecha_Inicio', name: 'Fecha Solicitud'},
            {data: 'Elementos', name: 'Elementos'},
            {data: 'Acciones', name: 'Acciones'},

        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        table.on('click', '#1', function (e) {
            e.preventDefault();
            $('#PRT_Observacion_Entrega').empty();
            $('#PRT_Observacion_Recibe').empty();
            $('#modal-ver-reserva').modal('toggle');
            $text_area_Elementos_kit.empty();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            console.log(dataTable);
            $('input[name="PRT_Fecha_Inicio"]').val(dataTable.PRT_Fecha_Inicio);
            $('input[name="PRT_Fecha_Fin"]').val(dataTable.PRT_Fecha_Fin);
            $('#PRT_Observacion_Recibe').prop("disabled",true);
            $('#botonReserva').attr('value','Realizar Reserva');
            if(dataTable.PRT_FK_Kits_id != 1){
                $('#texareaP').show();
                route_ver = '{{ route('gestionVerReservaModal') }}'+ '/'+ dataTable.PRT_FK_Kits_id;
                $.get( route_ver, function( info ) {
                    $('#KIT').val(info.data[0].consulta_kit_articulo.KIT_Nombre);
                    console.log(info);
                    $(info.data).each(function (key,value) {
                        $text_area_Elementos_kit.append(value.consulta_tipo_articulo.TPART_Nombre);
                        $text_area_Elementos_kit.append('\n');
                    });
                });
            }else{
                $('#KIT').val('Articulos');
                route_ver = '{{ route('gestionVerReservaArticulosModal') }}'+ '/'+ dataTable.PRT_Num_Orden;
                $('#texareaP').show();
                $.get( route_ver, function( info ) {
                    console.log(info);
                    $(info.data).each(function (key,value) {
                        $text_area_Elementos_kit.append(value.consulta_tipo_articulo.TPART_Nombre);
                        $text_area_Elementos_kit.append('\n');
                    });
                });
            }
        });
        table.on('click', '#2', function (e) {
            e.preventDefault();
            //$('#from_detalles_reserva')[0].reset();
            $('#PRT_Observacion_Entrega').empty();
            $('#PRT_Observacion_Recibe').empty();
            $('#modal-ver-reserva').modal('toggle');
            $text_area_Elementos_kit.empty();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input[name="PRT_Fecha_Inicio"]').val(dataTable.PRT_Fecha_Inicio);
            $('input[name="PRT_Fecha_Fin"]').val(dataTable.PRT_Fecha_Fin);
            $('#PRT_Observacion_Entrega').prop("disabled",true);
            $('#PRT_Observacion_Entrega').append(dataTable.PRT_Observacion_Entrega);
            $('#PRT_Observacion_Recibe').prop("disabled",false);
            $('#botonReserva').attr('value','Finalizar Reserva');
            $('#botonReserva').attr('class' ,'btn green-meadow');
            if(dataTable.PRT_FK_Kits_id != 1){
                $('#texareaP').show();
                route_ver = '{{ route('gestionVerReservaModal') }}'+ '/'+ dataTable.PRT_FK_Kits_id ;
                $.get( route_ver, function( info ) {
                    $('#KIT').val(info.data[0].consulta_kit_articulo.KIT_Nombre);
                    console.log(info);
                    $(info.data).each(function (key,value) {
                        $text_area_Elementos_kit.append(value.consulta_tipo_articulo.TPART_Nombre);
                        $text_area_Elementos_kit.append('\n');
                    });
                });
            }
            else{

                $('#KIT').val('Articulos');
                route_ver = '{{ route('gestionVerReservaArticulosModal') }}'+ '/'+ dataTable.PRT_Num_Orden;
                $('#texareaP').show();
                $.get( route_ver, function( info ) {
                    console.log(info);
                    $(info.data).each(function (key,value) {
                        $text_area_Elementos_kit.append(value.consulta_tipo_articulo.TPART_Nombre);
                        $text_area_Elementos_kit.append('\n');
                    });
                });
            }
        });
        var realizar = function () {
            return{
                init: function () {
                    var dataTable = table.row($tr).data();
                    var route = '{{ route('realizarEntregaReserva') }}'+'/'+dataTable.PRT_Num_Orden;
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('PRT_Observacion_Entrega', $('#PRT_Observacion_Entrega').val());
                    formData.append('PRT_Observacion_Recibe', $('#PRT_Observacion_Recibe').val());
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {

                                $('#modal-ver-reserva').modal('hide');
                                $('#from_detalles_reserva')[0].reset(); //Limpia formulario
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
                }
            }
        };
        var form_create_kit = $('#from_detalles_reserva');
        var rules_create_kit = {
            PRT_Observacion_Entrega:{minlength: 5, required: true},

        };
        console.log(form_create_kit);
        FormValidationMd.init(form_create_kit,rules_create_kit,false,realizar());
    });
</script>

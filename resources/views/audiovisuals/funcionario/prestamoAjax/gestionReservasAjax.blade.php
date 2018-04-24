<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Reservas Realizadas'])
        <div class="clearfix">
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    <a class="btn btn-outline dark reservaAjax" data-toggle="modal">
                        <i class="fa fa-plus">
                        </i>
                        REALIZAR RESERVA
                    </a>

                </div>
            </div>
        </div>
        <br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'usuarios-table'])
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id',
                    'Funcionario',
                    'Fecha Entrega',
                    'Fecha Recibe',
                    'Acciones' => ['style' => 'width:140px;']
                ])
            @endcomponent
        </div>
        <div class="clearfix"></div>
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
    var handleBootstrapSwitch = function() {
        if (!$().bootstrapSwitch) {
            return;
        }
        $('.make-switch').bootstrapSwitch();
    };
    var ComponentsDateTimePickers = function () {
        var handleDatetimePicker = function () {
            if (!jQuery().datetimepicker) {
                return;
            }
            var fecha = new Date();
            var numHorasAnticipacion = horasHabiles/24;
            fecha.setDate(fecha.getDate()+numHorasAnticipacion);
            $(".date-time-picker").datetimepicker({
                autoclose: true,
                daysOfWeekDisabled:[0],
                hoursDisabled: '0,1,2,3,4,5,6,23,24',
                isRTL: App.isRTL(),
                format:"yyyy-mm-dd hh:ii",//FORMATO DE FECHA NUMERICO
                //format: "dd MM yyyy - hh:ii",//FORMATO DE FECHA EN TEXTO
                fontAwesome: true,
                //todayBtn: true,//BOTON DE HOY
                //startDate: new Date(),//EMPIEZE DESDE LA FECHA ACTUAL
                startDate: fecha,//Fecha Actual pero sin la hora
                //endDate: fecha2,//Fecha Actual + 5 dias
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
    jQuery(document).ready(function () {
        App.unblockUI('.portlet-form');
        var table, url, columns;
        table = $('#usuarios-table');
        url = "{{ route('listarFuncionarios.reservas.dataTable') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'id', "visible": false },
            {data: function(data){
                return data.consulta_usuario_audiovisuales.user.name +" "
                    +data.consulta_usuario_audiovisuales.user.lastname;
            },name:'Funcionario'},
            {data: 'PRT_Fecha_Inicio', name: 'PRT_Fecha_Inicio'},
            {data: 'PRT_Fecha_Fin', name: 'PRT_Fecha_Fin'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon cancelar">cancelar </a>'
                +'<a href="javascript:;" class="btn btn-simple btn-success btn-icon ver">Ver</i></a>',
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
        table.on('click', '.ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('ver.solictud.reserva.index') }}'+'/'+dataTable.PRT_Num_Orden;
            $(".content-ajax").load(route);
        });
        table.on('click', '.cancelar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var accion = 'validar';
            var route = '{{ route('cancelar.solictud.reserva') }}'+'/'+dataTable.PRT_Num_Orden + '/'+accion;
            $.ajax({
                url: route,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                cache: false,
                type: 'GET',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        console.log(response.data);
                        if(response.data == 'SANCION'){
                            swal(
                                'Oops...Presenta Sancion',
                                'Debe dirigirse al administrador de audiovisuales para verificar la solicitud',
                                'warning'
                            )
                        }
                        if(response.data == 'NOCANCELAR'){
                            swal(
                                'Oops...',
                                'La reserva no puede ser cancelada por motivos de anticipacion de cancelacion',
                                'info'
                            )
                        }
                        if(response.data == 'CANCELAR') {
                            swal({
                                    title: "INFORMACION",
                                    text: "se eliminara la solicitud reserva" +
                                    " esta seguro de continuar",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Eliminar",
                                    cancelButtonText: "cancelar",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                },
                                function (isConfirm) {
                                    if (isConfirm) {
                                        var accion = 'eliminar';
                                        var route = '{{ route('cancelar.solictud.reserva') }}' + '/' + dataTable.PRT_Num_Orden + '/' + accion;
                                        $.ajax({
                                            url: route,
                                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                            cache: false,
                                            type: 'GET',
                                            contentType: false,
                                            processData: false,
                                            beforeSend: function () {
                                                App.blockUI({target: '.portlet-form', animate: true});
                                            },
                                            success: function (response, xhr, request) {
                                                if (request.status === 200 && xhr === 'success') {
                                                    UIToastr.init(xhr, response.title, response.message);
                                                    table.ajax.reload();
                                                    App.unblockUI('.portlet-form');
                                                }
                                            },
                                            error: function (response, xhr, request) {
                                                if (request.status === 422 && xhr === 'error') {
                                                    UIToastr.init(xhr, response.title, response.message);
                                                    App.unblockUI('.portlet-form');
                                                }
                                            }
                                        });
                                    }
                                }
                            );
                        }
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'error') {
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
                    }
                }
            });
        });
        $( ".reservaAjax" ).on('click', function (e) {
            e.preventDefault();
            var  route_validar = '{{route('validarNumeroDeReservas')}}';
            $.get( route_validar , function( info ) {
                var numeroMaximoReservas = info.data;
                if(numeroMaximoReservas.numeroReservas){
                    swal(
                        'Oops...',
                        'Lo sentimos el usuario solo puede realizar un maximo de '+numeroMaximoReservas.numeroMaximo+' reservas!',
                        'error'
                    )
                }else{
                    var route = '{{ route('reserva.formRepeat.index') }}';
                    $(".content-ajax").load(route);
                }
            });
        });
    });
</script>

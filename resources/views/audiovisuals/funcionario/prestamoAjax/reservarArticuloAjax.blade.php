<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Asignar Reserva Articulo'])
        @slot('actions', [
              'link_cancel' => [
              'link' => '',
              'icon' => 'fa fa-arrow-left',
             ],
        ])
        <div class="row">
            <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
                <div class="modal fade" data-width="750" data-backdrop="static" data-keyboard="false" id="static" tabindex="-1">
                    <div class="modal-header modal-header-success">

                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-user">
                            </i>
                            Registrar Reserva
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'from_res_create', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-3">
                                <p>
                                    {!! Field::text('PRT_Fecha_Inicio',
                                        ['label'=>'Fecha Recibir Reserva','class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                        ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar'])
                                    !!}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    {!! Field::select('Seleccione cantidad de dias a reservar',
                                        null,
                                        ['name' => 'numDias'])
                                    !!}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    {!! Field::select('Seleccione cantidad de Horas a reservar',
                                        null,
                                        ['name' => 'numHoras'])
                                    !!}
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Continuar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Regresar', ['class' => 'btn red regresar']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
                {{-- END HTML MODAL CREATE--}}
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-2">
                    {!! Field::select('tipoArticulosSelect',
                         $tipoArticulos,
                    ['label' => 'Tipo Articulo'])
                    !!}
                </div>
                <div class="col-md-3">
                    {!! Field::text('fechaInicio',
                    ['disabled','label' => 'Fecha Recibe:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                    ['help' => 'Estado Articulo', 'icon' => 'fa fa-user'])
                    !!}
                </div>
                <div class="col-md-3">
                    {!! Field::text('fechaFin',
                    ['disabled','label' => 'Fecha Entrega:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                    ['help' => 'Estado Articulo', 'icon' => 'fa fa-user'])
                    !!}
                </div>
                <br>
                <div class="col-md-2">
                    <a class="btn btn-danger agregar_articulo" id="agregar" title="Quitar articulo" data-id_articulo='+identificador+' >
                        Agregar
                    </a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <a class="btn btn-warning quitar_articulo" id="finalizar" title="Quitar articulo" data-id_articulo='+identificador+' >
                    finalizar
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <br><br>
        <div id="contentFormularioPrestamos" class="hide">
            <div class="col-md-12" id="contentDiv">

            </div>
        </div>
        <div class="clearfix"></div>
    @endcomponent
    <div class="clearfix"></div>
</div>
<script type="text/javascript">
    $( document ).scroll(function(){
        $('#static .date-time-picker').datetimepicker('place'); //#modal is the id of the modal
    });
    jQuery(document).ready(function () {
        var numDias = JSON.stringify({{$validaciones[3]['VAL_PRE_Valor']}});//numDias
        var numHoras = JSON.stringify({{$validaciones[2]['VAL_PRE_Valor']}});//numHora
        var numhorasCancelar = JSON.stringify({{$validaciones[7]['VAL_PRE_Valor']}});
        var numDiasHabiles = parseInt(JSON.stringify({{$validaciones[12]['VAL_PRE_Valor']}}));
        var numDiasAnticipacion = parseInt(JSON.stringify({{$validaciones[13]['VAL_PRE_Valor']}}));
        var textArticulo,textFechaInicio,textFechaFin,
            boton_quitar,idTextTipoArticulo,idTextFechaInicio,idTextFechaFin,fila_completa,
            valueTipoArticulo,valueFechaInicio,valueFechaFin;
        var ComponentsDateTimePickers = function () {
            var handleDatetimePicker = function () {
                if (!jQuery().datetimepicker) {
                    return;
                }
                var fecha = new Date();
                fecha.setDate(fecha.getDate() + numDiasAnticipacion);
                var fecha2 = new Date();
                fecha2.setDate( fecha2.getDate() + (numDiasAnticipacion+numDiasHabiles) );
                $(".date-time-picker").datetimepicker({
                    autoclose: true,
                    isRTL: App.isRTL(),
                    format:"yyyy-mm-dd hh:ii",//FORMATO DE FECHA NUMERICO
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
        var FormSelect2 = function () {
            return {
                init: function () {
                    /*Configuracion de Select*/
                    $.fn.select2.defaults.set("theme", "bootstrap");
                    $(".pmd-select2").select2({
                        placeholder: "Selecccionar",
                        allowClear: true,
                        width: 'auto',
                        escapeMarkup: function (m) {
                            return m;
                        }
                    });
                }
            }
        }();
        var objectForm=[];
        for( i = 0; i <= numDias ; i++){
            var nombreDia;
            if( i == 0 )
                $('select[name="numDias"]').append(new Option('El mismo dia',0));
            if( i == 1 ){
                nombreDia=' dia';
                $('select[name="numDias"]').append(new Option(i+nombreDia,i));
            }
            if( i != 0 && i != 1){
                nombreDia=' dias';
                $('select[name="numDias"]').append(new Option(i+nombreDia,i));
            }
        }
        for( i = 1; i <= numHoras ; i++){
            var nombreHoras;
            if(i == 1){
                nombreHoras=' hora';
            }else{
                nombreHoras=' horas';
            }
            $('select[name="numHoras"]').append(new Option(i+nombreHoras,i));
        }
        $('select[name="numDias"]').val([]);
        $('select[name="numHoras"]').val([]);
        $('#static').modal('toggle');
        ComponentsDateTimePickers.init();
        FormSelect2.init();
        var identificador = 0;
        var createRes = function () {
            return{
                init: function () {
                   var route = '{{ route('cargarVistaReservaArticulos') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('PRT_Fecha_Inicio',$('#PRT_Fecha_Inicio').val() );
                    formData.append('numDias', $('select[name="numDias"]').val());
                    formData.append('numHoras', $('select[name="numHoras"]').val());
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                $('#fechaInicio').val(response.data['fechaInicial']);
                                $('#fechaFin').val(response.data['fechaFinal']);
                                $('#static').modal('hide');
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create = $('#from_res_create');
        var rules_create = {
            PRT_Fecha_Inicio:{required: true},
            numDias:{required: true},
            numHoras:{ required: true},
        };
        FormValidationMd.init(form_create,rules_create,false,createRes());
        $('#agregar').on('click',function (e){
            e.preventDefault();
            var tempObject =[];
            textArticulo = '<div class="col-md-4"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textArticuloC" id="selectArticulo'+identificador+'" data-id_articulo='+identificador+' name="textArticuloC'+identificador+'" type="text" disabled><label for="texArticuloC'+identificador+'" class="control-label">Ingrese Identificacion:</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            textFechaInicio = '<div class="col-md-4"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textFechaInicioC" id="textFechaInicio'+identificador+'" data-id_articulo='+identificador+' name="textFechaIncioC'+identificador+'" type="text" disabled><label for="textFechaInicioC'+identificador+'" class="control-label">Ingrese Identificacion:</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            textFechaFin = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textFechaFinC" id="textFechaFin'+identificador+'" data-id_articulo='+identificador+'  name="textFechaFinC'+identificador+'" type="text" disabled><label for="textFechaFinC'+identificador+'" class="control-label">Ingrese Identificacion:</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            boton_quitar = '<br><div class="col-md-1"><a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo='+identificador+' ><i class="icon-trash"></i></a> </div>';
            idTextTipoArticulo = "#selectArticulo"+identificador,idTextFechaInicio = "#textFechaInicio"+identificador,idTextFechaFin = "#textFechaFin"+identificador;
            $('#contentFormularioPrestamos').removeClass('hide');
            fila_completa = '<div class="row fila_articulo" data-id_articulo='+identificador+'>'+textArticulo+textFechaInicio+textFechaFin+boton_quitar +'</div>';
            $("#contentDiv").append(fila_completa);
            valueTipoArticulo = $("#tipoArticulosSelect option:selected").text(),
            valueFechaInicio = $('input:text[name="fechaInicio"]').val(),
            valueFechaFin = $('input:text[name="fechaFin"]').val();
            var valueTipoArticuloId = $('select[name="tipoArticulosSelect"]').val();
            var valueFechaFinId = $('#fechaFin').val();
            var valueFechaInicioId = $('#fechaInicio').val();
            $(idTextTipoArticulo).val(valueTipoArticulo);
            $(idTextFechaInicio).val(valueFechaInicio);
            $(idTextFechaFin).val(valueFechaFin);
            objectForm.push(
                {
                    id:identificador,
                    fechaInicio:valueFechaInicio,
                    fechaFin:valueFechaFin,
                    tipoArticulosSelect:valueTipoArticuloId

                });
            identificador++
        });
        $('#contentDiv').on('click', '.quitar_articulo', function(){
            $(".fila_articulo[data-id_articulo='"+$(this).data('id_articulo')+"']").html('');
            var num=$(this).data('id_articulo');
            objectForm =  objectForm.filter(function(el) {
                return el.id != num;
            });
        });
        $('#finalizar').on('click',function(){
            var routeCrearPrestamo = '{{ route('reservaRepeat.crear') }}';
            var typeAjax = 'POST';
            var async = async || false;
            var formDatas = new FormData();
            formDatas.append('infoPrestamo',JSON.stringify(objectForm));
            $.ajax({
                url: routeCrearPrestamo,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                cache: false,
                type: typeAjax,
                contentType: false,
                data: formDatas,
                processData: false,
                async: async,
                beforeSend: function () {                },
                success: function (response, xhr, request) {
                    UIToastr.init(xhr , response.title , response.message  );
                    //////////regresa menu principal
                    App.unblockUI('.portlet-form');
                    var route = '{{ route('audiovisuales.reservaArticulo.indexAjax') }}';
                    $(".content-ajax").load(route);
                },
                error: function (response, xhr, request) {
                    UIToastr.init(xhr , response.title , response.message  );
                }
            });
        });
        $('.regresar').on('click',function(){
            $('#static').modal('hide');
            var route = '{{ route('audiovisuales.reservaArticulo.indexAjax') }}';
            $(".content-ajax").load(route);

        });
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.reservaArticulo.indexAjax') }}';
            $(".content-ajax").load(route);
        });

    });
</script>
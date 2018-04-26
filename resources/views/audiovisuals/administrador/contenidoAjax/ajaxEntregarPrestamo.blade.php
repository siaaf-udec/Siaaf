<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Acciones Solicitud Prestamo'])
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" data-width="360" id="modal-recibir-kit" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-tv">
                            </i>
                            Recibir Kit
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'from_kit_recibir', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    {!! Field::textarea('elementosKit',
                                        ['label' => 'Elementos Del Kit', 'required', 'auto' => 'off', 'max' => '255', "rows" => '4'],
                                        ['help' => 'Elementos Del Kit.', 'icon' => 'fa fa-quote-right'])
                                    !!}
                                </p>
                                <p>
                                    {!! Field::text('observacionKit',
                                        ['label' => 'Descripcion Kit:'],
                                        ['help' => 'Descripcion Kit.', 'icon' => 'fa fa-ban'])
                                    !!}
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer col-md-offset-3">
                            @permission('AUDI_LENDING_KIT_GET')
                            {!! Form::submit('Recibir', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                            @endpermission
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" data-width="760" id="modal-tiempo-prestamo" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-user">
                            </i>
                            Tiempo Asignar
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'from_tiempo_sumar', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::text('tipoArticulo',
                                ['disabled','label' => 'tipo Articulo:', 'max' => '40', 'min' => '2', 'auto' => 'off','tabindex'=>'2','disabled'],
                                ['help' => 'Nombre Articulo', 'icon' => 'fa fa-user'])
                                !!}
                            </div>
                            <div class="col-md-6">
                                {!! Field::select('tiempoSelect',
                                     null,
                                ['label' => 'Tiempo Articulo'])
                                !!}
                            </div>
                        </div>

                        <div class="modal-footer">
                            @permission('AUDI_LENDING_EDIT')
                            {!! Form::submit('ACEPTAR', ['class' => 'btn blue']) !!}
                            {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                            @endpermission
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" data-width="520" id="modal-observation-prestamo" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-ok-circle">
                            </i>
                            Recibir Solicitud
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'from_observation', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                {!! Field::textarea(
                                    'observacionGeneral',
                                    ['label' => 'Observación', 'required', 'auto' => 'off', 'max' => '255', "rows" => '3'],
                                    ['help' => 'Escribe una observación.', 'icon' => 'fa fa-quote-right'])
                                !!}

                            </div>
                        </div>
                        <div class="modal-footer col-md-6 col-md-offset-3">
                            @permission('AUDI_LENDING_GET_ALL')
                            {!! Form::submit('ACEPTAR', ['class' => 'btn blue']) !!}
                            {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                            @endpermission
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" data-width="520" id="modal-advertencia-tiempo" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-time">
                            </i>
                            Tiempo Asignacion
                        </h2>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Field::text('tipoArticulo','El articulo no puede ser asignado mas tiempo',
                                ['disabled','label' => 'tipo Articulo:', 'max' => '40', 'min' => '2', 'auto' => 'off','tabindex'=>'2'],
                                ['help' => 'Nombre Articulo', 'icon' => 'fa fa-user'])
                                !!}
                            </div>
                        </div>
                        <div class="modal-footer col-md-2 col-md-offset-5">
                            {!! Form::button('ACEPTAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade bs-modal-lg" data-width="1000" id="modal-asignacion-sancion" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-ok-circle">
                            </i>
                            Asignacion de Sancion

                        </h2>
                    </div>
                    <div class="modal-body" id="contentSanciones">
                        {!! Form::open(['id' => 'from_sancion', 'class' => '', 'url' => '/forms']) !!}
                        @foreach($sanciones as $tipoSancion)
                            <div class="container-fluid fila_articulo" data-id_sancion={{$tipoSancion['id']}}>
                                <div class="row">
                                    <div class="col-md-3">
                                        <br>
                                        <br><br>
                                        {!! Field::text('nombre'.$tipoSancion['id'],$tipoSancion['TIPO_Nombre'],
                                             ['label' => 'Tipo Sancion', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                             ['icon' => 'fa fa-hourglass-half'])
                                        !!}
                                    </div>
                                    <div class="col-md-7">
                                        {!! Field::textarea('observacion'.$tipoSancion['id'],
                                            ['label' => 'observacion Sancion', 'required', 'auto' => 'off', 'max' => '255', "rows" => '4'],
                                            ['help' => 'Elementos Del Kit.', 'icon' => 'fa fa-quote-right'])
                                        !!}
                                    </div>
                                    <div class="col-md-2">
                                        <br><br><br>
                                        {!! Field::text('costo'.$tipoSancion['id'],
                                             ['label' => 'Costo de la Sancion', 'required', 'auto' => 'off', 'max' => '6'],
                                             ['icon' => 'fa fa-hourglass-half'])
                                        !!}
                                    </div>
                                    <br><br>
                                    <div class="icheck-inline col-md-3">
                                        <label>
                                            <input data-id_checked = '{!!$tipoSancion['id']!!}' type = "checkbox" class="icheck box@php echo $tipoSancion['id'] @endphp" data-checkbox="icheckbox_line-blue " data-label="Asignar">
                                        </label>
                                    </div>
                                </div>
                                <div class="row alert-warning" id="alerta">
                                    <label> {!!$tipoSancion['TIPO_Descripcion']!!}</label>
                                </div>
                            </div>
                            <br>
                        @endforeach
                        <div class="modal-footer col-md-offs-et-3">
                            @permission('AUDI_LENDING_CREATE_ASSENT')
                            {!! Form::button('Aplicar Sancion', ['class' => 'btn blue','id'=>'aplicarSancion']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                            @endpermission
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div id="contentFormularioPrestamos">
            @foreach($prestamos as $articulos)
                @if($articulos['PRT_FK_Estado']==2)
                    @php ++$contador @endphp
                    <div class="row fila_articulo" data-id_articulo={{$articulos['id']}}>
                        @if($articulos['consultaArticulos'] == null)
                            <div class="col-md-2">
                                {!! Field::text("textObser".$articulos['id'],$articulos['consultaKitArticulo']['KIT_Nombre'],
                                     ['disabled','label' => 'Nombre Kit', 'required', 'auto' => 'off', 'max' => '255', 'disabled'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-qrcode '])
                                !!}
                            </div>
                            <div class="col-md-2">
                                {!! Field::text("codigoKit".$articulos['id'],$articulos['consultaKitArticulo']['KIT_Codigo'],
                                     ['disabled','label' => 'Codigo Kit', 'required', 'auto' => 'off', 'max' => '255', 'disabled'],
                                     ['help' => 'Codigo del Kit.', 'icon' => 'fa fa-key'])
                                !!}
                            </div>
                            <div class="col-md-2">
                                {!! Field::text('tiempoArticulo'.$articulos['id'],$articulos['tiemporestante'],
                                     ['disabled','label' => 'Tiempo Entrega', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-hourglass-half '])
                                !!}
                            </div>
                            <div class="col-md-6">
                                {!! Field::text('PRT_Observacion_Entrega'.$articulos['id'],$articulos['PRT_Observacion_Entrega'],
                                     ['disabled','label' => 'Observacion Entrega', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                     ['help' => 'Escribe una descripción del Articulo.', 'icon' => 'fa fa-pencil'])
                                !!}
                            </div>
                            @else
                            <div class="col-md-2">
                                {!! Field::text("textObser".$articulos['id'],$articulos['consultaArticulos']['consultaTipoArticulo']['TPART_Nombre'],
                                     ['disabled','label' => 'Nombre Articulo', 'required', 'auto' => 'off', 'max' => '255', 'disabled'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-desktop '])
                                !!}
                            </div>
                            <div class="col-md-2">
                                {!! Field::text("codigoArticulo".$articulos['id'],$articulos['consultaArticulos']['ART_Codigo'],
                                     ['disabled','label' => 'Codigo Articulo', 'required', 'auto' => 'off', 'max' => '255', 'disabled'],
                                     ['help' => 'Codigo del Articulo.', 'icon' => 'fa fa-key'])
                                !!}
                            </div>
                            <div class="col-md-2">
                                {!! Field::text('tiempoArticulo'.$articulos['id'],$articulos['tiemporestante'],
                                     ['disabled','label' => 'Tiempo Entrega', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-hourglass-half'])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Field::text('PRT_Observacion_Entrega'.$articulos['id'],$articulos['PRT_Observacion_Entrega'],
                                     ['disabled','label' => 'Observacion Entrega', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                     ['help' => 'Escribe una descripción del Articulo.', 'icon' => 'fa fa-pencil'])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Field::text('PRT_Observacion_Recibe'.$articulos['id'],
                                     ['label' => 'Observacion Recibe', 'required', 'auto' => 'off', 'max' => '255'],
                                     ['help' => 'Escribe una descripción del Articulo.', 'icon' => 'fa fa-pencil'])
                                !!}
                            </div>
                        @endif
                        <div class="container-fluid">
                            @permission('AUDI_LENDING_EDIT')
                            <div class="col-md-6" >
                                @if($articulos['sancion']){{--No se presenta sacnicon por entrega --}}
                                {!! Form::button('Aplicar Sancion', ['class' => 'btn btn-danger aplicar_sancion','data-id_sancion'=>$articulos['id']]) !!}
                                {!! Form::button('Aumentar Tiempo', ['class' => 'btn btn-warning aumentar_tiempo','data-id_articulo'=>$articulos['id']]) !!}
                                @else
                                    {!! Form::button('Aplicar Sancion', ['class' => 'btn btn-warning aplicar_sancion','data-id_sancion'=>$articulos['id']]) !!}
                                @endif
                                @if($articulos['consultaArticulos'] == null)
                                    {!! Form::button('Ver Kit', ['class' => 'btn btn-success  recibir_kit','data-id_kit'=>$articulos['id']]) !!}
                                    @else
                                    {!! Form::button('Recibir Articulo', ['class' => 'btn btn-success  recibir_articulo','data-id_articulo'=>$articulos['id']]) !!}
                                @endif
                            @endpermission
                            </div>
                        </div>
                    </div>
                    <br>
                @endif
            @endforeach
            <br>
            <div class="col-md-offset-4">
                @permission('AUDI_LENDING_GET_ALL')
                    {!! Form::button('Aplicar Sancion General', ['class' => 'btn btn-warning  getAllSancion','data-id_articulo'=>$articulos['PRT_Num_Orden']]) !!}
                    {!! Form::button('Recibir Todo', ['class' => 'btn btn-success  getAll','data-id_articulo'=>$articulos['PRT_Num_Orden']]) !!}
                @endpermission
            </div>
        </div>
    </div>

    @endcomponent

<script type="text/javascript">
    var routeUpdate,idArticulo,idVal,observation,idArticuloTiempo,
        idPrestamoSolicitud;
    var idSancionSolicitud,sancionGeneral;
    var co = JSON.stringify({{$contador}});
    var contadorSancion = 0;
    var datosSanciones = [];
    var idFuncionario = JSON.stringify({{$prestamos[0]['PRT_FK_Funcionario_id']}});
    var ComponentsBootstrapMaxlength = function () {
        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                alwaysShow: true,
                appendToParent: true
            });
        }
        return {
            init: function () {
                handleBootstrapMaxlength();
            }
        };
    }();
    var handleiCheck = function() {
        if (!$().iCheck) {
            return;
        }
        $('.icheck').each(function() {
            var checkboxClass = $(this).attr('data-checkbox') ? $(this).attr('data-checkbox') : 'icheckbox_minimal-grey';
            var radioClass = $(this).attr('data-radio') ? $(this).attr('data-radio') : 'iradio_minimal-grey';

            if (checkboxClass.indexOf('_line') > -1 || radioClass.indexOf('_line') > -1) {
                $(this).iCheck({
                    checkboxClass: checkboxClass,
                    radioClass: radioClass,
                    insert: '<div class="icheck_line-icon"></div>' + $(this).attr("data-label")
                });
            } else {
                $(this).iCheck({
                    checkboxClass: checkboxClass,
                    radioClass: radioClass
                });
            }
        });
    };
    jQuery(document).ready(function () {
        App.unblockUI('.portlet-form');
        handleiCheck();
        var kitId;
        ComponentsSelect2.init();
        ComponentsBootstrapMaxlength.init();
        $('#contentFormularioPrestamos').on('click', '.recibir_articulo', function(){
            idArticulo = $(this).data('id_articulo');//id del prestamo
            idVal = '#PRT_Observacion_Recibe'+idArticulo;
            observation = $(idVal).val();
            if(observation == ''){

                swal(
                    'Oops...',
                    'Debe agregar una observacion para poder recibir el articulo',
                    'warning'
                )

            }else{
                $(".fila_articulo[data-id_articulo='"+$(this).data('id_articulo')+"']").html('');
                routeupdate = '{{ route('updatePrestamo') }}'+ '/'+ idArticulo+'/'+observation;
                $.get( routeupdate, function(){});
                co = co-1;
                if(co==0){
                    var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
                    $(".content-ajax").load(route);
                }
            }

        });
        $('#contentFormularioPrestamos').on('click', '.recibir_kit', function(){
            kitId = $(this).data('id_kit');
            var routeArticulos = '{{ route('listarArticulosKitEntregaAdministrador') }}' +'/' + kitId ;
            $('#elementosKit').empty();
            $.ajax({
                url: routeArticulos,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        $(response.data).each(function (key,value) {
                            $('#elementosKit').append(' - '+value.consulta_tipo_articulo.TPART_Nombre);
                            $('#elementosKit').append('\n');
                        });
                        $('#modal-recibir-kit').modal('toggle');
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
        $('#contentFormularioPrestamos').on('click', '.aumentar_tiempo', function(){
            idPrestamo=$(this).data('id_articulo');
            var numHoras='#tiempoArticulo'+idPrestamo;
            numHoras=$(numHoras).val();
            routeupdate = '{{ route('aumentarTiempo') }}'+ '/'+ idPrestamo+'/'+numHoras;
            $.get( routeupdate, function(info){
                idVal='#textObser'+idPrestamo;
                var tipoArticulo = $(idVal).val();
                if(info.data<=0){
                    $('#modal-advertencia-tiempo').modal('toggle');
                }else{
                    idPrestamoSolicitud = idPrestamo;
                    $('input[name="tipoArticulo"]').val(tipoArticulo);
                    for(i=1;i<=info.data;i++){
                        var nombreTiempo=i+' Hora';
                        $('#tiempoSelect').append(new Option(nombreTiempo,i));
                    }
                    $('#modal-tiempo-prestamo').modal('toggle');
                }
            });
        });
        $('#contentFormularioPrestamos').on('click', '.aplicar_sancion', function(){
            idSancionSolicitud = $(this).data('id_sancion');
            sancionGeneral = 0;
            $('#from_sancion')[0].reset();
            $('#modal-asignacion-sancion').modal('toggle');

        });
        $('#aplicarSancion').on('click',  function(){

            if(contadorSancion == 0){
                $('#modal-asignacion-sancion').modal('hide');
                swal("Opsss..!", "No ha asignado sanciones!", "warning");
                swal({
                        title: "Opsss..!",
                        text: "No ha asignado sanciones!",
                        type: 'warning',
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "ok",
                        closeOnConfirm: true,
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $('#modal-asignacion-sancion').modal('toggle');
                        }
                    }
                );
            }else{
                $('#modal-asignacion-sancion').modal('hide');
                swal({
                        title: "¿ Esta seguro ?",
                        text: 'Se aplicara las Sanciones seleccionadas',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Si",
                        cancelButtonText: "Cancelar",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            contadorSancion = 0;
                            var route_aplicar_sancion = '{{route('registrar.sancion') }}'+'/'+idFuncionario+'/'+sancionGeneral;
                            var typeAjax = 'POST';
                            var async = async || false;
                            var formDatas = new FormData();

                            formDatas.append('inSancion', JSON.stringify(datosSanciones));
                            $.ajax({
                                url: route_aplicar_sancion,
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
                                    datosSanciones = [];

                                    var route = '{{ route('reserva.index') }}';
                                    if(sancionGeneral == 1){
                                        $(".content-ajax").load(route);
                                    }else{

                                        co = co-1;
                                        $(".fila_articulo[data-id_articulo='" + idSancionSolicitud + "']").html('');
                                        if(co == 0){

                                            $(".content-ajax").load(route);
                                        }
                                    }
                                    UIToastr.init(xhr, response.title, response.message);
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
            }

        });
        var validatorSancion = $("#from_sancion").validate({
            errorElement: 'span',
            errorClass: 'help-block help-block-error',
            focusInvalid: true,
            ignore: "",
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
        });
        $ ('.icheck' ).on( 'ifClicked' , function ( event ) {
            var idSancion = $(this).data('id_checked');
            if(!$('.box'+idSancion).is(':checked') ){
                contadorSancion++;

                if ((validatorSancion.element("#observacion"+idSancion) == true) && (validatorSancion.element("#costo"+idSancion) == true)) {

                    var observacion = '#observacion' + idSancion;
                    var costo = '#costo' + idSancion;
                    observacion = $(observacion).val();
                    costo = $(costo).val();
                    datosSanciones.push(
                        {
                            id: idSancion,
                            observacion: observacion,
                            costo: costo,
                            idReserva: idSancionSolicitud,
                            sancionGeneral: sancionGeneral

                        });

                    UIToastr.init('success','Bien', 'Asignacion seleccionada');
                }else {
                    validatorSancion.element("#observacion"+idSancion);
                    validatorSancion.element("#costo"+idSancion);
                    $('#modal-asignacion-sancion').modal('hide');
                    swal({
                            title: "¿ Asiganacion ?",
                            text: 'Para asianar la sancion debe completar los campos',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "ok",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                $('.box'+idSancion).iCheck('uncheck');
                                $('#modal-asignacion-sancion').modal('toggle');
                            }
                        }
                    );
                }
            }else{
                contadorSancion--;
                UIToastr.init('warning','Bien', 'Aacba de remover la asignacion');
                datosSanciones = datosSanciones.filter(function (el) {
                    return el.id != idSancion;
                });

            }
        });
        $('.getAllSancion').on('click',function(){
            idSancionSolicitud = $(this).data('id_articulo');
            sancionGeneral = 1;
            $('#from_sancion')[0].reset();
            $('#modal-asignacion-sancion').modal('toggle');

        });
        $('.getAll').on('click',function(){
            idArticulo = $(this).data('id_articulo');
            $('#modal-observation-prestamo').modal('toggle');
        });
        var updateGeneralS = function(){
            return {
                init:function(){
                    var route =  '{{ route('updatesPrestamoGeneral') }}'+'/'+ idArticulo;
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('observacion', $('#observacionGeneral').val());
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
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                $('#modal-observation-prestamo').modal('hide');
                                $('#from_observation')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                                var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
                                $(".content-ajax").load(route);
                                App.unblockUI('.portlet-form');
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        }
                    });
                }
            }
        };
        var form_updateG = $('#from_observation');
        var rule_createG = {
            observacionGeneral:{required: true}
        };
        FormValidationMd.init(form_updateG,rule_createG,false,updateGeneralS());
        var updateKit = function(){
            return {
                init:function(){
                    var route =  '{{ route('updateKitAdmin') }}'+'/'+ kitId ;
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('observacionKit', $('#observacionKit').val());
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
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                App.unblockUI('.portlet-form');
                                co = co-1;
                                $('#from_kit_recibir')[0].reset();
                                $('#modal-recibir-kit').modal('hide');
                                $(".fila_articulo[data-id_articulo='"+kitId+"']").html('');
                                if( co == 0 ){
                                    var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
                                    $(".content-ajax").load(route);
                                }
                                $('#modal-recibir-kit').modal('hide');

                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        }

                    });
                }
            }
        };
        var form_updateG = $('#from_kit_recibir');
        var rule_createG = {
            observacionKit:{required: true}
        };
        FormValidationMd.init(form_updateG,rule_createG,false,updateKit());
        var moreTime = function(){
            return {
                init:function(){
                    var route =  '{{ route('moreTimeUpdate') }}'+'/'+ idPrestamoSolicitud;
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('hourAdd', $("#tiempoSelect option:selected").text());
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
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                App.unblockUI('.portlet-form');
                                $('#modal-tiempo-prestamo').modal('hide');
                                $('#from_tiempo_sumar')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                                var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        }

                    });
                }
            }
        };
        var form_sumar = $('#from_tiempo_sumar');
        var rule_sumar = {
            tipoArticulo : {required: true},
            tiempoSelect : {required: true}
        };
        FormValidationMd.init(form_sumar,rule_sumar,false,moreTime());
    });
</script>

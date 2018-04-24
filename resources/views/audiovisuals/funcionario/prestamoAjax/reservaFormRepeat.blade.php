    <div class="col-md-12">
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="static" tabindex="-1">
            <div class="modal-header modal-header-success">
                <h3 class="modal-title">
                    <i class="glyphicon glyphicon-user">
                    </i>
                    Seleccionar Programa
                </h3>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'from_programa', 'class' => '', 'url' => '/forms']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="note note-success">
                            <h4 class="block">Registrar Programa!</h4>
                            <p> Debe seleccionar un programa academico. </p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>
                            {!! Field::select('Seleccione Programa',$programas,
                                ['name' => 'FK_FUNCIONARIO_Programa'])
                            !!}
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p>
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                        </p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-fecha-reserva" tabindex="-1">
            <div class="modal-header modal-header-success">
                <h3 class="modal-title">
                    <i class="glyphicon glyphicon-user">
                    </i>
                    Fecha Reserva
                </h3>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'form_fecha', 'class' => '', 'url' => '/forms']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="note note-success">
                            <h4 class="block">Seleccione una fecha!</h4>
                            <p> Debe seleccionar una fecha de reserva, para poder asignar articulos. </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p>
                            {!! Field::text(
                                'PRT_Fecha_Inicio',
                                ['label'=>'Fecha Recibir Reserva','class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar'])
                            !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('Regresar', ['class' => 'btn blue','id'=> 'btnRegresar']) !!}
                {!! Form::button('Continuar', ['class' => 'btn blue','id'=> 'btnModalStatic']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Asignar Reserva'])
            @slot('actions', [
                  'link_cancel' => [
                  'link' => '',
                  'icon' => 'fa fa-arrow-left',
                 ],
            ])
            <div class="form-group">
                @permission('AUDI_LENDING_KIT_ART')
                <div class="col-md-9" id="dd">
                    <input type="checkbox" class="make-switch" checked data-on-text = "PRESTAMO KIT"  data-off-text = "PRESTAMO ARTICULO" data-on-color="warning" data-off-color="success">
                </div>
                @endpermission
            </div>
            <br><br>
            <div class="row" id="articulo">
                {!! Form::open(['id' => 'form_articulo', 'class' => '', 'url' => '/forms']) !!}
                <div class="col-md-3">
                    {!! Field::select('tipoArticulosSelect',
                         null,
                    ['label' => 'Tipo Articulo','required'])
                    !!}
                </div>
                <div class="col-md-3">
                    {!! Field::select('codigo',
                         null,
                    ['label' => 'Codigo','required'])
                    !!}
                </div>
                <div class="col-md-3">
                    {!! Field::select('tiempoArticulo',
                         null,
                    ['label' => 'Tiempo','required'])
                    !!}
                </div>
                <div class="col-md-3">
                    @permission('AUDI_LENDING_ASSIGN_ART')
                    <a class="btn btn-danger agregar_articulo" id="agregarArticulo" title="Quitar articulo"
                       data-id_articulo='+identificador+'>
                        Agregar
                    </a>
                    @endpermission
                </div>
                {!! Form::close() !!}
            </div>
            <div class="row" id="kit">
                {!! Form::open(['id' => 'form_kit', 'class' => '', 'url' => '/forms']) !!}
                <div class="col-md-3">
                    <br><br><br><br>
                    {!! Field::select('tipoKitsSelect',
                         null,
                    ['label' => 'Kit:','required'])
                    !!}
                </div>
                <div class="col-md-4">
                    {!! Field::textarea('ElementosKit',
                        ['disabled','label' => 'Elementos', 'required', 'auto' => 'off', 'max' => '255', "rows" => '5'],
                        ['help' => 'Elementos del kit.', 'icon' => 'fa fa-quote-right'])
                    !!}
                </div>
                <div class="col-md-3">
                    <br><br><br><br>
                    {!! Field::select('tiempoKit',
                         null,
                    ['label' => 'Tiempo Kit','required'])
                    !!}
                </div>
                <br>
                <div class="col-md-2">
                    <br><br><br><br>
                    @permission('AUDI_LENDING_ASSIGN_KIT')
                    <a class="btn btn-danger agregar_articulo" id="agregarKit" title="Quitar articulo"
                       data-id_articulo='+identificador+'>
                        Agregar
                    </a>
                    @endpermission
                </div>
                {!! Form::close() !!}
            </div>
            <div class="row">
                <div class="col-md-3">
                    @permission('AUDI_LENDING_CREATE')
                    <a class="btn btn-warning quitar_articulo" id="finalizar" title="Quitar articulo"
                       data-id_articulo='+identificador+'>
                        finalizar Reserva
                    </a>
                    @endpermission
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
        var horasHabiles = JSON.stringify({{$validaciones[10]['VAL_PRE_Valor']}});
        var maximoCantidadArticulos = JSON.stringify({{$validaciones[8]['VAL_PRE_Valor']}});
        var contadorMaximoCantidadArticulos = 0;
        var cantidadElementosKit =0;
        $( document ).scroll(function(){
            $('#modal-create-reserva .timepicker').datetimepicker('place'); //#modal is the id of the modal
        });
        var numeroDeOrden;
        var tipoSolicitud = 'reserva';
        jQuery(document).ready(function() {
            App.unblockUI('.portlet-form');
            ComponentsDateTimePickers.init();
            ComponentsSelect2.init();
            var abrirModal = JSON.stringify({{$numero}});
            //sino se encuentran registros abrir el modal para registrar
            if( abrirModal == 0 ){
                $('#static').modal('toggle');
            }else{
                $('#modal-fecha-reserva').modal('toggle');
            }

            var textArticulo, textTiempo, textObservacion,
                boton_quitar, idTextCodigo, idTextTipoArticulo, idTextTiempo, idTextObservacion, fila_completa,
                valueTipoArticulo, valueTiempo, valueObservacion ,textCodigo ,valueCodigo;
            function selectKitAjax(){
                var rutaCaragarKits = '{{ route('cargar.kits.selectKit.reserva') }}'+'/'+fechaInicialReserva;
                $.ajax({
                    url: rutaCaragarKits,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            $('#tipoKitsSelect').empty();
                            $('#tiempoKit').empty();
                            $('#ElementosKit').empty();
                            $(response.data).each(function (key, value) {
                                $('#tipoKitsSelect').append(new Option(value.KIT_Nombre, value.id));
                            });
                            $('#tipoKitsSelect').val([]);
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
            }
            function asignarKit(idKit){
                var rutaRemoverArticuloKit =
                    '{{ route('asignarKit') }}'+ '/'+ idKit;
                $.ajax({
                    url: rutaRemoverArticuloKit,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            $('#tipoKitsSelect').empty();
                            $('#tiempoKit').empty();
                            $('#ElementosKit').empty();
                            selectKitAjax();
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
            }
            function removerKit(idKit){
                var rutaRemoverKit =
                    '{{ route('removerKit') }}'+ '/'+ idKit;
                $.ajax({
                    url: rutaRemoverKit,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            $('#tipoArticulosSelect').empty();
                            $('#tiempoArticulo').empty();
                            $('#tipoKitsSelect').empty();
                            $('#tiempoKit').empty();
                            $('#ElementosKit').empty();
                            selectKitAjax();
                            selectTipoArticuloAjax();
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
            }
            function selectTipoArticuloAjax(){
                var rutaCaragarTipoArticulo = '{{ route('cargar.articulos.selectTipoArticulo.reserva') }}';
                $.ajax({
                    url: rutaCaragarTipoArticulo,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            $(response.data).each(function (key, value) {
                                $('#tipoArticulosSelect').append(new Option(value.TPART_Nombre, value.id));
                            });
                            $('#tipoArticulosSelect').val([]);
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
            }
            function asignarArticulo(idArticulo,fechaInicial,tiempoAsignar, numeroDeOrdenL){
                var idSolicitud;
                var rutaRemoverArticulo =
                    '{{ route('asignarArticuloReserva') }}'+ '/'+ idArticulo+'/'+fechaInicial+'/'+tiempoAsignar+'/'+numeroDeOrdenL;
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: rutaRemoverArticulo,
                    type: 'POST',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            $('#tipoArticulosSelect').empty();
                            $('#codigo').empty();
                            $('#tiempoArticulo').empty();
                            selectTipoArticuloAjax();
                            idSolicitud = response.data;
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
                return idSolicitud;
            }
            function removerArticulo(idSolcitud){
                var rutaRemoverArticulo =
                    '{{ route('eliminarSolicitudReserva') }}'+ '/'+ idSolcitud;
                $.ajax({
                    url: rutaRemoverArticulo,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            $('#tipoArticulosSelect').empty();
                            $('#tiempoArticulo').empty();
                            $('#tipoKitsSelect').empty();
                            $('#codigo').empty();
                            $('#tiempoKit').val('');
                            $('#ElementosKit').empty();
                            selectTipoArticuloAjax();
                            selectKitAjax();
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
            }
            function restarArticulos(array, llave, valor) {
                for (var i = 0; i < array.length; i++) {
                    if (array[i][llave] == valor) {
                        return (array[i]['cantidadElementos']);
                    }
                }
                return -1;
            }
            function encontrarIdArticulo(array, llave, valor) {
                for (var i = 0; i < array.length; i++) {
                    if (array[i][llave] == valor) {
                        return i;
                    }
                }
                return -1;
            }
            handleBootstrapSwitch();
            ComponentsBootstrapMaxlength.init();
            ComponentsSelect2.init();
            $('#articulo').hide();
            $('#kit').show();
            $('#finalizar').hide();
            $('#tiempoKit').val([]);
            var fechaInicialReserva;
            var conteoValidaciones = [];
            var conteo = 0;
            var identificador = 0;
            var tipoArticulo, tipoKit;
            $('.make-switch').on('switchChange.bootstrapSwitch', function (event, state) {
                if(state){
                    if (conteo == 0) {
                        $('#finalizar').hide();$('#articulo').hide();
                        $('#kit').show();
                    } else {
                        $('#finalizar').show();$('#articulo').hide();
                        $('#kit').show();
                    }
                }else{
                    if (conteo == 0) {
                        $('#finalizar').hide();$('#articulo').show();
                        $('#kit').hide();
                    } else {
                        $('#finalizar').show();$('#articulo').show();
                        $('#kit').hide();
                    }
                }
            });
            var validatorKit = $("#form_kit").validate({
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
            var validatorFecha = $("#form_fecha").validate({
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
                }
            });
            var validatorArticulo = $("#form_articulo").validate({
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
                }
            });
            $('#btnModalStatic').on('click', function (e) {
                if ((validatorFecha.element("#PRT_Fecha_Inicio") == true) ) {
                    fechaInicialReserva = $('#PRT_Fecha_Inicio').val();
                    $('#modal-fecha-reserva').modal('hide');
                    selectKitAjax();
                    selectTipoArticuloAjax();
                } else {
                    validatorFecha.element("#PRT_Fecha_Inicio");
                }
            });
            $("#btnRegresar").on('click', function (e) {
                e.preventDefault();
                $('#modal-fecha-reserva').modal('hide');
                var route = '{{ route('audiovisuales.gestionReservas.gestionReservasAjax') }}';
                $(".content-ajax").load(route);
            });

            $('#agregarArticulo').on('click', function (e) {
                if ((validatorArticulo.element("#tipoArticulosSelect") == true) && (validatorArticulo.element("#codigo") == true) && (validatorArticulo.element("#tiempoArticulo") == true) ) {
                    if (conteo == 0) {
                        if((contadorMaximoCantidadArticulos+1 )<= maximoCantidadArticulos) {
                            var rout_numeroOrden = '{{route('consultarUltimoNumeroDeOrden')}}';
                            $.get(rout_numeroOrden, function (info) {
                                numeroDeOrden = info.data;
                                var valueArticuloId = $('select[name="codigo"]').val();
                                var valueTiempoId = $('select[name="tiempoArticulo"]').val();
                                var kitArticulo = 'articulo';
                                var rutaRemoverArticulo =
                                    '{{ route('asignarArticuloReserva') }}' + '/' + valueArticuloId + '/' + fechaInicialReserva + '/' + valueTiempoId + '/' + numeroDeOrden + '/' + kitArticulo;
                                $.ajax({
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url: rutaRemoverArticulo,
                                    type: 'POST',
                                    beforeSend: function () {
                                        App.blockUI({target: '.portlet-form', animate: true});
                                    },
                                    success: function (response, xhr, request) {
                                        if (request.status === 200 && xhr === 'success') {
                                            App.unblockUI('.portlet-form');
                                            identificador = response.data;
                                            $('#finalizar').show();
                                            e.preventDefault();
                                            textArticulo = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textArticuloC" id="selectArticulo' + identificador + '" data-id_articulo=' + identificador + ' name="textArticuloC' + identificador + '" type="text" disabled><label for="texArticuloC' + identificador + '" class="control-label">Tipo Articulo:</label><i class=" fa fa-desktop "></i></div></div></div>';
                                            textCodigo = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textCodigoC" id="selectCodigo' + identificador + '" data-id_articulo=' + identificador + ' name="textCodigoC' + identificador + '" type="text" disabled><label for="texCodigoC' + identificador + '" class="control-label">Codigo :</label><i class=" fa fa-key "></i></div></div></div>';
                                            textTiempo = '<div class="col-md-2"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTiempoC" id="selectTiempo' + identificador + '" data-id_articulo=' + identificador + ' name="textTiempoC' + identificador + '" type="text" disabled><label for="textTiempoC' + identificador + '" class="control-label">Tiempo:</label><i class=" fa fa-hourglass-half "></i></div></div></div>';
                                            boton_quitar = '<br><div class="col-md-1"><a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo=' + identificador + ' ><i class="icon-trash"></i></a> </div>';
                                            idTextTipoArticulo = "#selectArticulo" + identificador,
                                                idTextCodigo = "#selectCodigo" + identificador,
                                                idTextTiempo = "#selectTiempo" + identificador;
                                            $('#contentFormularioPrestamos').removeClass('hide');
                                            fila_completa = '<div class="row fila_articulo" data-id_articulo=' + identificador + '>' + textArticulo + textCodigo + textTiempo + boton_quitar + '</div>';
                                            $("#contentDiv").append(fila_completa);
                                            valueTipoArticulo = $("#tipoArticulosSelect option:selected").text(), valueCodigo = $("#codigo option:selected").text(), valueTiempo = $("#tiempoArticulo option:selected").text();
                                            var valueArticuloId = $('select[name="codigo"]').val();
                                            var valueTiempoId = $('select[name="tiempoArticulo"]').val();
                                            $(idTextTipoArticulo).val(valueTipoArticulo);
                                            $(idTextCodigo).val(valueCodigo);
                                            $(idTextTiempo).val(valueTiempo);
                                            $('#tipoArticulosSelect').empty();
                                            $('#codigo').empty();
                                            $('#tiempoArticulo').empty();
                                            selectTipoArticuloAjax();
                                            conteoValidaciones.push(
                                                {
                                                    id: identificador,
                                                    cantidadElementos: 1
                                                }
                                            );
                                            contadorMaximoCantidadArticulos++;
                                        }
                                    },
                                    error: function (response, xhr, request) {
                                        if (request.status === 422 && xhr === 'success') {
                                            UIToastr.init(xhr, response.title, response.message);
                                            App.unblockUI('.portlet-form');
                                        }
                                    }
                                });
                            });
                        }else{
                            swal(
                                'Oops...',
                                'Lo sentimos el usuario solo puede solicitar una cantidad maxima de  '+ maximoCantidadArticulos +' articulos!',
                                'warning'
                            )
                        }
                    } else {
                        if((contadorMaximoCantidadArticulos+1 )<= maximoCantidadArticulos) {
                            var valueArticuloId = $('select[name="codigo"]').val();
                            var valueTiempoId = $('select[name="tiempoArticulo"]').val();
                            var kitArticulo = 'articulo';
                            var rutaRemoverArticulo =
                                '{{ route('asignarArticuloReserva') }}' + '/' + valueArticuloId + '/' + fechaInicialReserva + '/' + valueTiempoId + '/' + numeroDeOrden + '/' + kitArticulo;
                            $.ajax({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                url: rutaRemoverArticulo,
                                type: 'POST',
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        App.unblockUI('.portlet-form');
                                        identificador = response.data;
                                        $('#finalizar').show();
                                        e.preventDefault();
                                        textArticulo = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textArticuloC" id="selectArticulo' + identificador + '" data-id_articulo=' + identificador + ' name="textArticuloC' + identificador + '" type="text" disabled><label for="texArticuloC' + identificador + '" class="control-label">Tipo Articulo:</label><i class=" fa fa-desktop "></i></div></div></div>';
                                        textCodigo = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textCodigoC" id="selectCodigo' + identificador + '" data-id_articulo=' + identificador + ' name="textCodigoC' + identificador + '" type="text" disabled><label for="texCodigoC' + identificador + '" class="control-label">Codigo :</label><i class=" fa fa-key "></i></div></div></div>';
                                        textTiempo = '<div class="col-md-2"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTiempoC" id="selectTiempo' + identificador + '" data-id_articulo=' + identificador + ' name="textTiempoC' + identificador + '" type="text" disabled><label for="textTiempoC' + identificador + '" class="control-label">Tiempo:</label><i class=" fa fa-hourglass-half "></i></div></div></div>';
                                        boton_quitar = '<br><div class="col-md-1"><a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo=' + identificador + ' ><i class="icon-trash"></i></a> </div>';
                                        idTextTipoArticulo = "#selectArticulo" + identificador, idTextCodigo = "#selectCodigo" + identificador, idTextTiempo = "#selectTiempo" + identificador, idTextObservacion = "#textObser" + identificador;
                                        $('#contentFormularioPrestamos').removeClass('hide');
                                        fila_completa = '<div class="row fila_articulo" data-id_articulo=' + identificador + '>' + textArticulo + textCodigo + textTiempo + boton_quitar + '</div>';
                                        $("#contentDiv").append(fila_completa);
                                        valueTipoArticulo = $("#tipoArticulosSelect option:selected").text(), valueCodigo = $("#codigo option:selected").text(), valueTiempo = $("#tiempoArticulo option:selected").text();
                                        var valueArticuloId = $('select[name="codigo"]').val();
                                        var valueTiempoId = $('select[name="tiempoArticulo"]').val();
                                        $(idTextTipoArticulo).val(valueTipoArticulo);
                                        $(idTextCodigo).val(valueCodigo);
                                        $(idTextTiempo).val(valueTiempo);
                                        conteoValidaciones.push(
                                            {
                                                id: identificador,
                                                cantidadElementos: 1
                                            }
                                        );
                                        contadorMaximoCantidadArticulos++;
                                        $('#tipoArticulosSelect').empty();
                                        $('#codigo').empty();
                                        $('#tiempoArticulo').empty();
                                        selectTipoArticuloAjax();
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
                                    }
                                }
                            });
                        }else{
                            swal(
                                'Oops...',
                                'Lo sentimos el usuario solo puede solicitar una cantidad maxima de  '+ maximoCantidadArticulos +' articulos!',
                                'warning'
                            )
                        }
                    }
                    conteo++;
                }else{
                    validatorArticulo.element("#tipoArticulosSelect");
                    validatorArticulo.element("#tiempoArticulo");
                    validatorArticulo.element("#codigo");
                }
            });
            $('#agregarKit').on('click', function (e) {
                if ((validatorKit.element("#tipoKitsSelect") == true) && (validatorKit.element("#ElementosKit") == true) && (validatorKit.element("#tiempoKit") == true)) {
                    if (conteo == 0) {
                        if((contadorMaximoCantidadArticulos + cantidadElementosKit )<= maximoCantidadArticulos) {
                            var rout_numeroOrden = '{{route('consultarUltimoNumeroDeOrden')}}';
                            $.get(rout_numeroOrden, function (info) {
                                numeroDeOrden = info.data;
                                var valueArticuloId = $('select[name="tipoKitsSelect"]').val();
                                var valueTiempoId = parseInt($('select[name="tiempoKit"]').val());
                                var kitArticulo = 'kit';
                                var rutaRemoverArticulo =
                                    '{{ route('asignarArticuloReserva') }}' + '/' + valueArticuloId + '/' + fechaInicialReserva + '/' + valueTiempoId + '/' + numeroDeOrden + '/' + kitArticulo;
                                $.ajax({
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url: rutaRemoverArticulo,
                                    type: 'POST',
                                    beforeSend: function () {
                                        App.blockUI({target: '.portlet-form', animate: true});
                                    },
                                    success: function (response, xhr, request) {
                                        if (request.status === 200 && xhr === 'success') {
                                            App.unblockUI('.portlet-form');
                                            identificador = response.data;
                                            $('#finalizar').show();
                                            e.preventDefault();
                                            textKit = '<div class="col-md-3"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textKitC" id="selectKit' + identificador + '" data-id_articulo=' + identificador + ' name="textKitC' + identificador + '" type="text" disabled><label for="texKitC' + identificador + '" class="control-label">Kit :</label><i class=" fa fa-qrcode "></i></div></div></div>';
                                            textArea = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><textarea class="form-control textAreaKitC" rows="4" maxlength="255" id="textAreaKit' + identificador + '" data-id_articulo=' + identificador + ' name="textAreaKitC' + identificador + '" disabled></textarea> <label for="textAreaKitC' + identificador + '" class="control-label">Elementos :</label><i class=" fa fa-television "></i></div></div></div>';
                                            textTiempo = '<div class="col-md-2"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTiempoKitC" id="selectKitTiempo' + identificador + '" data-id_articulo=' + identificador + ' name="textTiempoKitC' + identificador + '" type="text" disabled><label for="textTiempoKitC' + identificador + '" class="control-label">Tiempo :</label><i class=" fa fa-hourglass-half "></i></div></div></div>';
                                            boton_quitar = '<br><div class="col-md-1"><br><br><br><a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo=' + identificador + ' ><i class="icon-trash"></i></a> </div>';
                                            idTextTipoKit = "#selectKit" + identificador, idTextTiempoKit = "#selectKitTiempo" + identificador, idTextObservacion = "#textObserKit" + identificador, idTextArea = "#textAreaKit" + identificador;
                                            $('#contentFormularioPrestamos').removeClass('hide');
                                            fila_completa = '<div class="row fila_articulo" data-id_articulo=' + identificador + '>' + textKit + textArea + textTiempo + boton_quitar + '</div>';
                                            $("#contentDiv").append(fila_completa);
                                            var valueTipokit = $("#tipoKitsSelect option:selected").text(),
                                                valueTiempoKit = $("#tiempoKit option:selected").text(),
                                                valueElementos = $("#ElementosKit").val();
                                            var valueTipoKitId = $('select[name="tipoKitsSelect"]').val();
                                            var valueTiempoKitId = $('select[name="tiempoKit"]').val();
                                            $(idTextTipoKit).val(valueTipokit);
                                            $(idTextTiempoKit).val(valueTiempoKit);
                                            $(idTextArea).val(valueElementos);
                                            selectKitAjax();
                                            contadorMaximoCantidadArticulos = contadorMaximoCantidadArticulos + cantidadElementosKit;
                                            conteoValidaciones.push(
                                                {
                                                    id: identificador,
                                                    cantidadElementos: cantidadElementosKit
                                                }
                                            );
                                        }
                                    },
                                    error: function (response, xhr, request) {
                                        if (request.status === 422 && xhr === 'success') {
                                            UIToastr.init(xhr, response.title, response.message);
                                            App.unblockUI('.portlet-form');
                                        }
                                    }
                                });
                            });
                        }else{
                            swal(
                                'Oops...',
                                'Lo sentimos el usuario solo puede solicitar una cantidad maxima de  '+ maximoCantidadArticulos +' articulos!',
                                'warning'
                            )
                        }
                    }else{
                        if((contadorMaximoCantidadArticulos + cantidadElementosKit )<= maximoCantidadArticulos) {
                            var valueArticuloId = $('select[name="tipoKitsSelect"]').val();
                            var valueTiempoId = parseInt($('select[name="tiempoKit"]').val());
                            var kitArticulo = 'kit';
                            var rutaRemoverArticulo =
                                '{{ route('asignarArticuloReserva') }}' + '/' + valueArticuloId + '/' + fechaInicialReserva + '/' + valueTiempoId + '/' + numeroDeOrden + '/' + kitArticulo;
                            $.ajax({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                url: rutaRemoverArticulo,
                                type: 'POST',
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        App.unblockUI('.portlet-form');
                                        identificador = response.data;
                                        $('#finalizar').show();
                                        e.preventDefault();
                                        textKit = '<div class="col-md-3"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textKitC" id="selectKit' + identificador + '" data-id_articulo=' + identificador + ' name="textKitC' + identificador + '" type="text" disabled><label for="texKitC' + identificador + '" class="control-label">Kit :</label><i class=" fa fa-qrcode "></i></div></div></div>';
                                        textArea = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><textarea class="form-control textAreaKitC" rows="4" maxlength="255" id="textAreaKit' + identificador + '" data-id_articulo=' + identificador + ' name="textAreaKitC' + identificador + '" disabled></textarea> <label for="textAreaKitC' + identificador + '" class="control-label">Elementos :</label><i class=" fa fa-television "></i></div></div></div>';
                                        textTiempo = '<div class="col-md-2"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTiempoKitC" id="selectKitTiempo' + identificador + '" data-id_articulo=' + identificador + ' name="textTiempoKitC' + identificador + '" type="text" disabled><label for="textTiempoKitC' + identificador + '" class="control-label">Tiempo :</label><i class=" fa fa-hourglass-half "></i></div></div></div>';
                                        boton_quitar = '<br><div class="col-md-1"><br><br><br><a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo=' + identificador + ' ><i class="icon-trash"></i></a> </div>';
                                        idTextTipoKit = "#selectKit" + identificador, idTextTiempoKit = "#selectKitTiempo" + identificador, idTextObservacion = "#textObserKit" + identificador, idTextArea = "#textAreaKit" + identificador;
                                        $('#contentFormularioPrestamos').removeClass('hide');
                                        fila_completa = '<div class="row fila_articulo" data-id_articulo=' + identificador + '>' + textKit + textArea + textTiempo + boton_quitar + '</div>';
                                        $("#contentDiv").append(fila_completa);
                                        var valueTipokit = $("#tipoKitsSelect option:selected").text(),
                                            valueTiempoKit = $("#tiempoKit option:selected").text(),
                                            valueElementos = $("#ElementosKit").val();
                                        var valueTipoKitId = $('select[name="tipoKitsSelect"]').val();
                                        var valueTiempoKitId = $('select[name="tiempoKit"]').val();
                                        $(idTextTipoKit).val(valueTipokit);
                                        $(idTextTiempoKit).val(valueTiempoKit);
                                        $(idTextArea).val(valueElementos);
                                        selectKitAjax();
                                        contadorMaximoCantidadArticulos = contadorMaximoCantidadArticulos + cantidadElementosKit;
                                        conteoValidaciones.push(
                                            {
                                                id: identificador,
                                                cantidadElementos: cantidadElementosKit
                                            }
                                        );
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
                                    }
                                }
                            });
                        }else{
                            swal(
                                'Oops...',
                                'Lo sentimos el usuario solo puede solicitar una cantidad maxima de  '+ maximoCantidadArticulos +' articulos!',
                                'warning'
                            )
                        }
                    }
                    conteo++;
                    $('#finalizar').show();
                } else {
                    validatorKit.element("#tipoKitsSelect");
                    validatorKit.element("#ElementosKit");
                    validatorKit.element("#tiempoKit");

                }
            });
            $('#contentDiv').on('click', '.quitar_articulo', function () {
                conteo = conteo - 1;
                if (conteo == 0) {
                    $('#finalizar').hide();
                }
                $(".fila_articulo[data-id_articulo='" + $(this).data('id_articulo') + "']").html('');
                var num = $(this).data('id_articulo');
                var restarCantidadDeArticulos = restarArticulos(conteoValidaciones,'id',num);
                contadorMaximoCantidadArticulos = contadorMaximoCantidadArticulos - restarCantidadDeArticulos;
                conteoValidaciones = conteoValidaciones.filter(function (el) {
                    return el.id != num;
                });
                removerArticulo(num);
            });
            //cambio de select de articulos tiempo
            $('#tipoArticulosSelect').on('change', function () {
                tipoArticulo = $(this).val();
                var routeCodigoArticulo = '{{ route('listarCodigoArticuloSeleReserva') }}' + '/' + tipoArticulo +'/'+fechaInicialReserva;
                $.ajax({
                    url: routeCodigoArticulo,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success :function (res, xhr, request){
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            $('#codigo').empty();
                            $(res.data).each(function (key, value) {
                                $('#codigo').append(new Option(value.ART_Codigo, value.id));
                            });
                            $('#codigo').val([]);
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
                var routeTimpoArticulo = '{{ route('listarTiempoArticuloSele') }}' + '/' + tipoArticulo;
                $('#tiempoArticulo').empty('whatever');
                $.ajax({
                    url: routeTimpoArticulo,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            var tiempo = parseInt(response.data[0]['VAL_PRE_Valor']);
                            var nombreTiempo;
                            for (var i = 1; i <= tiempo; i++) {
                                if (i == 1) {
                                    nombreTiempo = i + ' Hora';
                                } else {
                                    nombreTiempo = i + ' Horas';
                                }
                                $('#tiempoArticulo').append(new Option(nombreTiempo, i));
                            }
                            $('#tiempoArticulo').val([]);
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
            });
            $('#tipoKitsSelect').on('change', function () {
                tipokit = $(this).val();
                kit = $(this).val();
                var routeArticulos = '{{ route('listarArticulosKitAdministrador') }}' + '/' + kit;
                $.ajax({
                    url: routeArticulos,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            cantidadElementosKit =0;
                            $('#ElementosKit').empty();
                            $(response.data).each(function (key, value) {
                                $('#ElementosKit').append(value.consulta_tipo_articulo.TPART_Nombre);
                                $('#ElementosKit').append('\n');
                                cantidadElementosKit++;
                            });
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
                var routeTimpoKit = '{{ route('listarTiempoKitSele') }}' + '/' + kit;
                $('#tiempoKit').empty('whatever');
                $.ajax({
                    url: routeTimpoKit,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            var tiempoKit = parseInt(response.data[0]['VAL_PRE_Valor']);
                            var nombreTiempoKit;
                            for (var i = 1; i <= tiempoKit; i++) {
                                if (i == 1) {
                                    nombreTiempoKit = i + ' Hora';
                                } else {
                                    nombreTiempoKit = i + ' Horas';
                                }
                                $('#tiempoKit').append(new Option(nombreTiempoKit, i));
                            }
                            $('#tiempoKit').val([]);
                        }
                    }
                });
            });
            //btn_ingresar_identificacion
            $('#finalizar').on('click', function (e) {
                e.preventDefault();
                var route = '{{ route('audiovisuales.gestionReservas.gestionReservasAjax') }}';
                $(".content-ajax").load(route);
            });

            var createPrograma = function () {
                return{
                    init: function () {
                        var route = '{{ route('crearFuncionarioPrograma.storePrograma') }}';
                        var type = 'POST';
                        var async = async || false;
                        var formData = new FormData();
                        formData.append('FK_FUNCIONARIO_Programa', $('select[name="FK_FUNCIONARIO_Programa"]').val());
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
                                    $('#static').modal('hide');
                                    $('#modal-fecha-reserva').modal('toggle');
                                    $('#from_programa')[0].reset();
                                    UIToastr.init(xhr , response.title , response.message  );
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
            var form_create = $('#from_programa');
            var rules_create = {
                FK_FUNCIONARIO_Programa:{required: true}
            };
            FormValidationMd.init(form_create,rules_create,false,createPrograma());
            $('#link_cancel').on('click', function (e) {
                e.preventDefault();
                var route = '{{ route('audiovisuales.gestionReservas.gestionReservasAjax') }}';
                $(".content-ajax").load(route);
            });
        });

    </script>

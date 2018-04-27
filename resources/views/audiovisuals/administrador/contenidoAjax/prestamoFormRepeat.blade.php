<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Artículos Solicitados'])
            @slot('actions', [
                  'link_cancel' => [
                  'link' => '',
                  'icon' => 'fa fa-arrow-left',
                 ],
            ])
            <div class="form-group">
                @permission('AUDI_REQUESTS_KIT_ART')
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
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        {!! Field::text('observacionEntrega',
                        ['label' => 'Descripcion:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                        ['help' => 'Estado Articulo', 'icon' => 'fa fa-user'])
                        !!}
                    </div>
                    <br>
                    <div class="col-md-2">
                        @permission('AUDI_REQUESTS_ASSIGN_ART')
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
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        <br><br><br><br>
                        {!! Field::select('tiempoKit',
                             null,
                        ['label' => 'Tiempo Kit','required'])
                        !!}
                    </div>
                    <div class="col-md-2">
                        <br><br><br><br>
                        {!! Field::text('observacionEntregaKit',
                        ['label' => 'Descripcion:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                        ['help' => 'Estado Articulo', 'icon' => 'fa fa-quote-right'])
                        !!}
                    </div>
                    <br>
                    <div class="col-md-2">
                        <br><br><br><br>
                        @permission('AUDI_REQUESTS_ASSIGN_KIT')
                        <a class="btn btn-danger agregar_articulo" id="agregarKit" title="Quitar articulo"
                           data-id_articulo='+identificador+'>
                            Agregar
                        </a>
                        @endpermission
                    </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    @permission('AUDI_REQUESTS_CREATE')
                    <a class="btn btn-warning quitar_articulo" id="finalizar" title="Quitar articulo"
                       data-id_articulo='+identificador+'>
                        finalizar
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
    var maximoCantidadArticulos = JSON.stringify({{$validaciones[0]['VAL_PRE_Valor']}});
    var maximoCantidadTipoArticulosRepetidos = JSON.stringify({{$validaciones[1]['VAL_PRE_Valor']}});
    var contadorMaximoCantidadArticulos = 0;
    var contadorMaximoCantidadTipoArticulosRepetidos = 0;
    var cantidadElementosKit =0;
    jQuery(document).ready(function () {
        App.unblockUI('.portlet-form');
        var textArticulo, textTiempo, textObservacion,
            boton_quitar, idTextCodigo, idTextTipoArticulo, idTextTiempo, idTextObservacion, fila_completa,
            valueTipoArticulo, valueTiempo, valueObservacion ,textCodigo ,valueCodigo;
        function selectKitAjax(){
            var rutaCaragarKits = '{{ route('cargar.kits.selectKit') }}';
            $.ajax({
                url: rutaCaragarKits,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        $(response.data).each(function (key, value) {
                            $('#tipoKitsSelect').append(new Option(value.KIT_Nombre, value.id));
                        });
                        $('#tipoKitsSelect').val([]);
                    }
                }
                ,
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'error') {
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
                        $('#observacionEntregaKit').val('');
                        $('#ElementosKit').empty();
                        selectKitAjax();
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
                        /////CAMPOS ARTICULO
                        $('#tipoArticulosSelect').empty();
                        $('#tiempoArticulo').empty();
                        $('#observacionEntrega').val('');
                        ////////////CAMPOS KIT
                        $('#tipoKitsSelect').empty();
                        $('#tiempoKit').empty();
                        $('#observacionEntregaKit').val('');
                        $('#ElementosKit').empty();
                        selectKitAjax();
                        selectTipoArticuloAjax();
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
        function selectTipoArticuloAjax(){
            var rutaCaragarTipoArticulo = '{{ route('cargar.articulos.selectTipoArticulo') }}';
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
                    if (request.status === 422 &&  xhr === 'error') {
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
                    }
                }
            });
        }
        function asignarArticulo(idArticulo){
            var rutaRemoverArticulo =
                '{{ route('asignarArticulo') }}'+ '/'+ idArticulo;
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
                        $('#codigo').empty();
                        $('#tiempoArticulo').empty();
                        $('#observacionEntrega').val('');
                        selectTipoArticuloAjax();

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
        function removerArticulo(idArticulo){
            var rutaRemoverArticulo =
                '{{ route('removerArticulo') }}'+ '/'+ idArticulo;
            $.ajax({
                url: rutaRemoverArticulo,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        /////CAMPOS ARTICULO
                        $('#tipoArticulosSelect').empty();
                        $('#tiempoArticulo').empty();
                        $('#observacionEntrega').val('');
                        ////////////CAMPOS KIT
                        $('#tipoKitsSelect').empty();
                        $('#codigo').empty();
                        $('#tiempoKit').empty();
                        $('#observacionEntregaKit').val('');
                        $('#ElementosKit').empty();
                        selectTipoArticuloAjax();
                        selectKitAjax();
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
        function encontrarIdArticulo(array, llave, valor) {
            for (var i = 0; i < array.length; i++) {
                if (array[i][llave] == valor) {
                    return i;
                }
            }
            return -1;
        }
        function restarArticulos(array, llave, valor) {
            for (var i = 0; i < array.length; i++) {
                if (array[i][llave] == valor) {
                    return (array[i]['cantidadElementos']);
                }
            }
            return -1;
        }
        handleBootstrapSwitch();
        ComponentsBootstrapMaxlength.init();
        ComponentsSelect2.init();
        selectKitAjax();
        selectTipoArticuloAjax();
        $('#articulo').hide();
        $('#finalizar').hide();
        $('#tiempoKit').val([]);
        var objectForm = [];
        var conteoValidaciones = [];
        var conteo = 0;
        var tempObject = [];
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
        function agregarArticuloContent(){
            conteo++;
            $('#finalizar').show();
            var tempObject = [];
            textArticulo = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textArticuloC" id="selectArticulo' + identificador + '" data-id_articulo=' + identificador + ' name="textArticuloC' + identificador + '" type="text" disabled><label for="texArticuloC' + identificador + '" class="control-label">Tipo Articulo:</label><i class=" fa fa-desktop "></i></div></div></div>';
            textCodigo ='<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textCodigoC" id="selectCodigo' + identificador + '" data-id_articulo=' + identificador + ' name="textCodigoC' + identificador + '" type="text" disabled><label for="texCodigoC' + identificador + '" class="control-label">Codigo :</label><i class=" fa fa-key "></i></div></div></div>';
            textTiempo = '<div class="col-md-2"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTiempoC" id="selectTiempo' + identificador + '" data-id_articulo=' + identificador + ' name="textTiempoC' + identificador + '" type="text" disabled><label for="textTiempoC' + identificador + '" class="control-label">Tiempo:</label><i class=" fa fa-hourglass-half "></i></div></div></div>';
            textObservacion = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textObservacionC" id="textObser' + identificador + '" data-id_articulo=' + identificador + '  name="textObservacionC' + identificador + '" type="text" disabled><label for="textObservacionC' + identificador + '" class="control-label">Descripcion:</label><i class=" fa fa-pencil "></i></div></div></div>';
            boton_quitar = '<br><div class="col-md-1"><a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo=' + identificador + ' ><i class="icon-trash"></i></a> </div>';
            idTextTipoArticulo = "#selectArticulo" + identificador,idTextCodigo ="#selectCodigo" + identificador, idTextTiempo = "#selectTiempo" + identificador, idTextObservacion = "#textObser" + identificador;
            $('#contentFormularioPrestamos').removeClass('hide');
            fila_completa = '<div class="row fila_articulo" data-id_articulo=' + identificador + '>' + textArticulo + textCodigo + textTiempo + textObservacion + boton_quitar + '</div>';
            $("#contentDiv").append(fila_completa);
            valueTipoArticulo = $("#tipoArticulosSelect option:selected").text(),valueCodigo = $("#codigo option:selected").text(), valueTiempo = $("#tiempoArticulo option:selected").text(), valueObservacion = $('input:text[name="observacionEntrega"]').val();
            var valueArticuloId = $('select[name="codigo"]').val();
            var valueTiempoId = $('select[name="tiempoArticulo"]').val();
            $(idTextTipoArticulo).val(valueTipoArticulo);
            $(idTextCodigo).val(valueCodigo);
            $(idTextTiempo).val(valueTiempo);
            $(idTextObservacion).val(valueObservacion);
            conteoValidaciones.push(
                {
                    id : identificador,
                    cantidadElementos :1
                }
            );
            contadorMaximoCantidadArticulos++;
            objectForm.push(
                {
                    id: identificador,
                    tiempo: valueTiempoId,
                    observacionEntrega: valueObservacion,
                    tipoArticulosSelect: valueArticuloId,
                    kit: false
                });

            asignarArticulo(valueArticuloId);
            identificador++
        }
        function agregarKitContent(){
            conteo++;
            $('#finalizar').show();
            textKit = '<div class="col-md-3"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textKitC" id="selectKit' + identificador + '" data-id_articulo=' + identificador + ' name="textKitC' + identificador + '" type="text" disabled><label for="texKitC' + identificador + '" class="control-label">Kit :</label><i class=" fa fa-qrcode "></i></div></div></div>';
            textArea = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><textarea class="form-control textAreaKitC" rows="4" maxlength="255" id="textAreaKit' + identificador + '" data-id_articulo=' + identificador + ' name="textAreaKitC' + identificador + '" disabled></textarea> <label for="textAreaKitC' + identificador + '" class="control-label">Elementos :</label><i class=" fa fa-television "></i></div></div></div>';
            textTiempo = '<div class="col-md-2"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTiempoKitC" id="selectKitTiempo' + identificador + '" data-id_articulo=' + identificador + ' name="textTiempoKitC' + identificador + '" type="text" disabled><label for="textTiempoKitC' + identificador + '" class="control-label">Tiempo :</label><i class=" fa fa-hourglass-half "></i></div></div></div>';
            textObservacion = '<div class="col-md-3"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textObservacionKitC" id="textObserKit' + identificador + '" data-id_articulo=' + identificador + '  name="textObservacionKitC' + identificador + '" type="text" disabled><label for="textObservacionKitC' + identificador + '" class="control-label">Descripcion:</label><i class=" fa fa-pencil"></i></div></div></div>';
            boton_quitar = '<br><div class="col-md-1"><br><br><br><a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo=' + identificador + ' ><i class="icon-trash"></i></a> </div>';
            idTextTipoKit = "#selectKit" + identificador, idTextTiempoKit = "#selectKitTiempo" + identificador, idTextObservacion = "#textObserKit" + identificador, idTextArea = "#textAreaKit" + identificador;
            $('#contentFormularioPrestamos').removeClass('hide');
            fila_completa = '<div class="row fila_articulo" data-id_articulo=' + identificador + '>' + textKit + textArea + textTiempo + textObservacion + boton_quitar + '</div>';
            $("#contentDiv").append(fila_completa);
            var valueTipokit = $("#tipoKitsSelect option:selected").text(),
                valueTiempoKit = $("#tiempoKit option:selected").text(),
                valueObservacionKit = $('input:text[name="observacionEntregaKit"]').val(),
                valueElementos = $('#ElementosKit').val();
            var valueTipoKitId = $('select[name="tipoKitsSelect"]').val();
            var valueTiempoKitId = $('select[name="tiempoKit"]').val();
            $(idTextTipoKit).val(valueTipokit);
            $(idTextTiempoKit).val(valueTiempoKit);
            $(idTextObservacion).val(valueObservacionKit);
            $(idTextArea).val(valueElementos);
            contadorMaximoCantidadArticulos = contadorMaximoCantidadArticulos + cantidadElementosKit;
            conteoValidaciones.push(
                {
                    id : identificador,
                    cantidadElementos :cantidadElementosKit
                }
            );
            asignarKit(valueTipoKitId);
            objectForm.push(
                {
                    id: identificador,
                    tiempo: valueTiempoKitId,
                    observacionEntrega: valueObservacionKit,
                    tipoArticulosSelect: valueTipoKitId,
                    kit: true

                });
            identificador++
        }
        $('#agregarArticulo').on('click', function (e) {
            if ((validatorArticulo.element("#tipoArticulosSelect") == true) && (validatorArticulo.element("#tiempoArticulo") == true) && (validatorArticulo.element("#observacionEntrega") == true)) {
                if((contadorMaximoCantidadArticulos+1 )<= maximoCantidadArticulos){
                    agregarArticuloContent();
                }else{
                    swal(
                        'Oops...',
                        'Lo sentimos el usuario solo puede solicitar una cantidad maxima de  '+ maximoCantidadArticulos +' articulos!',
                        'warning'
                    )
                }
            } else {
                validatorArticulo.element("#tipoArticulosSelect");
                validatorArticulo.element("#tiempoArticulo");
                validatorArticulo.element("#observacionEntrega");
                validatorArticulo.element("#codigo");
            }
        });
        $('#agregarKit').on('click', function (e) {
            if ((validatorKit.element("#tipoKitsSelect") == true) && (validatorKit.element("#ElementosKit") == true) && (validatorKit.element("#observacionEntregaKit") == true)) {
                if((contadorMaximoCantidadArticulos + cantidadElementosKit )<= maximoCantidadArticulos){
                    agregarKitContent();
                }else{
                    swal(
                        'Oops...',
                        'Lo sentimos el usuario solo puede solicitar una cantidad maxima de  '+ maximoCantidadArticulos +' articulos!',
                        'warning'
                    )
                }
            } else {
                validatorKit.element("#tipoKitsSelect");
                validatorKit.element("#ElementosKit");
                validatorKit.element("#tiempoKit");
                validatorKit.element("#observacionEntregaKit");
            }
        });
        $('#contentDiv').on('click', '.quitar_articulo', function () {
            conteo = conteo - 1;
            if (conteo == 0) {
                $('#finalizar').hide();
            }
            $(".fila_articulo[data-id_articulo='" + $(this).data('id_articulo') + "']").html('');
            var num = $(this).data('id_articulo');
            var index = encontrarIdArticulo(objectForm,'id',num);
            var restarCantidadDeArticulos = restarArticulos(conteoValidaciones,'id',num);
            contadorMaximoCantidadArticulos = contadorMaximoCantidadArticulos - restarCantidadDeArticulos;
            conteoValidaciones = conteoValidaciones.filter(function (el) {
                return el.id != num;
            });
            var x =JSON.parse(JSON.stringify(objectForm[index]));
            if(x.kit){

                removerKit(x.tipoArticulosSelect);
            }else{

                removerArticulo(x.tipoArticulosSelect);
            }
            objectForm = objectForm.filter(function (el) {
                return el.id != num;
            });

        });
        //cambio de select de articulos tiempo
        $('#tipoArticulosSelect').on('change', function () {

            tipoArticulo = $(this).val();
            //codigo del controlador Articulos
            var routeCodigoArticulo = '{{ route('listarCodigoArticuloSele') }}' + '/' + tipoArticulo;
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
                    if (request.status === 422 &&  xhr === 'error') {
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
                    if (request.status === 422 &&  xhr === 'error') {
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
            $('#ElementosKit').empty();
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
                        $(response.data).each(function (key, value) {
                            $('#ElementosKit').append(value.consulta_tipo_articulo.TPART_Nombre);
                            $('#ElementosKit').append('\n');
                            cantidadElementosKit++;
                        });

                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'error') {
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
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'error') {
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
                    }
                }
            });
        });
        $('#finalizar').on('click', function () {
            var routeCrearPrestamo = '{{ route('prestamoRepeat.crear') }}';
            var typeAjax = 'POST';
            var async = async || false;
            var formDatas = new FormData();
            formDatas.append('infoPrestamo', JSON.stringify(objectForm));
            formDatas.append('idFuncionario', idFuncionarioD);
            console.log(formDatas);
            $.ajax({
                url: routeCrearPrestamo,
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
                    UIToastr.init(xhr, response.title, response.message);
                    App.unblockUI('.portlet-form');
                    var route = '{{ route('audiovisuales.gestionPrestamos.indexAjax') }}';
                    $(".content-ajax").load(route);
                },
                error: function (response, xhr, request) {
                    UIToastr.init(xhr, response.title, response.message);
                    App.unblockUI('.portlet-form');
                }
            });
        });
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.gestionPrestamos.indexAjax') }}';
            $(".content-ajax").load(route);
        });
    });
</script>
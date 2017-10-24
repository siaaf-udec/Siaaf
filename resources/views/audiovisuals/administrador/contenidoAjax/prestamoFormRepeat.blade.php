<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Asignar Prestamo'])
        <div class="row" id="btnAriculo">
            <div class="col-md-3">
                <a class="btn btn-danger agregar_articulo" id="vistaArticulo" data-id_articulo='+identificador+' >
                    Prestamo Articulo
                </a>
            </div>
        </div>
        <div class="row" id="btnKit">
            <div class="col-md-3">
                <a class="btn btn-danger agregar_articulo" id="vistaKit" data-id_kit='+identificador+' >
                    Prestamo Kit
                </a>
            </div>
        </div>
        <br><br>
        <div class="row" id="articulo">
            <div class="col-md-12">
                    <div class="col-md-3">
                            {!! Field::select('tipoArticulosSelect',
                                 $tipoArticulos,
                            ['label' => 'Tipo Articulo'])
                            !!}
                    </div>
                    <div class="col-md-3">
                            {!! Field::select('tiempoArticulo',
                                 null,
                            ['label' => 'Tiempo'])
                            !!}
                    </div>
                    <div class="col-md-2">
                            {!! Field::text('observacionEntrega',
                            ['label' => 'Descripcion:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                            ['help' => 'Estado Articulo', 'icon' => 'fa fa-user'])
                            !!}
                    </div>
                    <br>
                    <div class="col-md-1">
                        <a class="btn btn-danger agregar_articulo" id="agregarArticulo" title="Quitar articulo" data-id_articulo='+identificador+' >
                            Agregar
                        </a>
                    </div>

            </div>
        </div>
        <div class="row" id="kit">
            <div class="col-md-12">
                <div class="col-md-3">
                    <br><br><br>
                    {!! Field::select('tipoKitsSelect',
                         $kits,
                    ['label' => 'Tipo Articulo'])
                    !!}
                </div>
                <div class="col-md-2">
                    {!! Field::textarea('ElementosKit',
                        ['label' => 'Elementos', 'required', 'auto' => 'off', 'max' => '255', "rows" => '4'],
                        ['help' => 'Elementos del kit.', 'icon' => 'fa fa-quote-right'])
                    !!}
                </div>
                <div class="col-md-3">
                    <br><br><br>
                    {!! Field::select('tiempoKit',
                         null,
                    ['label' => 'Tiempo Kit'])
                    !!}
                </div>
                <div class="col-md-2">
                    <br><br><br>
                    {!! Field::text('observacionEntregaKit',
                    ['label' => 'Descripcion:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                    ['help' => 'Estado Articulo', 'icon' => 'fa fa-user'])
                    !!}
                </div>
                <br>
                <div class="col-md-1">
                    <br><br><br>
                    <a class="btn btn-danger agregar_articulo" id="agregarKit" title="Quitar articulo" data-id_articulo='+identificador+' >
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
    var textArticulo,textTiempo,textObservacion,
            boton_quitar,idTextTipoArticulo,idTextTiempo,idTextObservacion,fila_completa,
                valueTipoArticulo,valueTiempo,valueObservacion;
    var objectForm=[];
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
    $('#articulo').hide();
    $('#kit').hide();
    $('#vistaKit').hide();
    $('#finalizar').hide();
    var numHorasKit = JSON.stringify({{$validaciones[4]['VAL_PRE_Valor']}});
    for(i=1;i<=numHorasKit;i++){
        if( i == 1 ){
            $('select[name="tiempoKit"]').append(new Option(i+'hora',i));
        }else{
            $('select[name="tiempoKit"]').append(new Option(i+'horas',i));
        }
    }
    jQuery(document).ready(function () {
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.gestionPrestamos.indexAjax') }}';
            $(".content-ajax").load(route);
        });
        FormSelect2.init();
        var identificador = 0;
        $('#vistaArticulo').on('click',function (e){
            $('#finalizar').show();
            $('#articulo').show();
            $('#kit').hide();
            $('#vistaKit').show();
            $('#vistaArticulo').hide();
            $('#vistaKit').show();
        });
        $('#vistaKit').on('click',function (e){
            $('#finalizar').show();
            $('#articulo').hide();
            $('#kit').show();
            $('#vistaKit').hide();
            $('#vistaArticulo').hide();
            $('#vistaArticulo').show();
        });
        $('#agregarArticulo').on('click',function (e){
            e.preventDefault();
            console.log(idFuncionarioD)
            var tempObject =[]
            textArticulo ='<div class="col-md-4"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textArticuloC" id="selectArticulo'+identificador+'" data-id_articulo='+identificador+' name="textArticuloC'+identificador+'" type="text" disabled><label for="texArticuloC'+identificador+'" class="control-label">Ingrese Identificacion:</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            textTiempo = '<div class="col-md-4"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTiempoC" id="selectTiempo'+identificador+'" data-id_articulo='+identificador+' name="textTiempoC'+identificador+'" type="text" disabled><label for="textTiempoC'+identificador+'" class="control-label">Ingrese Identificacion:</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            textObservacion = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textObservacionC" id="textObser'+identificador+'" data-id_articulo='+identificador+'  name="textObservacionC'+identificador+'" type="text" disabled><label for="textObservacionC'+identificador+'" class="control-label">Ingrese Identificacion:</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            boton_quitar = '<br><div class="col-md-1"><a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo='+identificador+' ><i class="icon-trash"></i></a> </div>';
            idTextTipoArticulo="#selectArticulo"+identificador,idTextTiempo="#selectTiempo"+identificador,idTextObservacion="#textObser"+identificador;
            $('#contentFormularioPrestamos').removeClass('hide');
            fila_completa = '<div class="row fila_articulo" data-id_articulo='+identificador+'>'+textArticulo+textTiempo+textObservacion+boton_quitar +'</div>';
            $("#contentDiv").append(fila_completa);
            valueTipoArticulo= $("#tipoArticulosSelect option:selected").text(),valueTiempo = $("#tiempoArticulo option:selected").text(),valueObservacion= $('input:text[name="observacionEntrega"]').val();
            var valueTipoArticuloId=$('select[name="tipoArticulosSelect"]').val();
            var valueTiempoId=$('select[name="tiempoArticulo"]').val();
           // console.log('valor del idarticulo='+valueTipoArticuloId)
            $(idTextTipoArticulo).val(valueTipoArticulo);
            $(idTextTiempo).val(valueTiempo);
            $(idTextObservacion).val(valueObservacion);
            objectForm.push(
                {
                    id:identificador,
                    tiempo:valueTiempoId ,
                    observacionEntrega:valueObservacion,
                    tipoArticulosSelect:valueTipoArticuloId,
                    kit:false

                });
            console.log(objectForm);
            identificador++
        });
        $('#agregarKit').on('click',function (e){
            e.preventDefault();
            console.log(idFuncionarioD)
            var tempObject =[]
            textKit ='<div class="col-md-3"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textKitC" id="selectKit'+identificador+'" data-id_articulo='+identificador+' name="textKitC'+identificador+'" type="text" disabled><label for="texKitC'+identificador+'" class="control-label">Kit :</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            textArea ='<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><textarea class="form-control textAreaKitC" rows="4" maxlength="255" id="textAreaKit'+identificador+'" data-id_articulo='+identificador+' name="textAreaKitC'+identificador+'" disabled></textarea> <label for="textAreaKitC'+identificador+'" class="control-label">Elementos :</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            textTiempo = '<div class="col-md-2"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTiempoKitC" id="selectKitTiempo'+identificador+'" data-id_articulo='+identificador+' name="textTiempoKitC'+identificador+'" type="text" disabled><label for="textTiempoKitC'+identificador+'" class="control-label">Tiempo :</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            textObservacion = '<div class="col-md-3"><br><br><br><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textObservacionKitC" id="textObserKit'+identificador+'" data-id_articulo='+identificador+'  name="textObservacionKitC'+identificador+'" type="text" disabled><label for="textObservacionKitC'+identificador+'" class="control-label">Descripcion:</label><span class="help-block"> Ingrese Estado "Activo","Inactivo" </span><i class=" fa fa-credit-card "></i></div></div></div>';
            boton_quitar = '<br><div class="col-md-1"><br><br><br><a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo='+identificador+' ><i class="icon-trash"></i></a> </div>';
            idTextTipoKit="#selectKit"+identificador,idTextTiempoKit="#selectKitTiempo"+identificador,idTextObservacion="#textObserKit"+identificador,idTextArea="#textAreaKit"+identificador;
            $('#contentFormularioPrestamos').removeClass('hide');
            fila_completa = '<div class="row fila_articulo" data-id_articulo='+identificador+'>'+textKit+textArea+textTiempo+textObservacion+boton_quitar +'</div>';
            $("#contentDiv").append(fila_completa);
            var valueTipokit = $("#tipoKitsSelect option:selected").text(),valueTiempoKit = $("#tiempoKit option:selected").text(),valueObservacionKit= $('input:text[name="observacionEntregaKit"]').val(),valueElementos = $('#ElementosKit').val();
            var valueTipoKitId = $('select[name="tipoKitsSelect"]').val();
            var valueTiempoKitId = $('select[name="tiempoKit"]').val();
            // console.log('valor del idarticulo='+valueTipoArticuloId)
            $(idTextTipoKit).val(valueTipokit);
            $(idTextTiempoKit).val(valueTiempoKit);
            $(idTextObservacion).val(valueObservacionKit);
            $(idTextArea).val(valueElementos);
            objectForm.push(
                {
                    id:identificador,
                    tiempo:valueTiempoKitId ,
                    observacionEntrega:valueObservacionKit,
                    tipoArticulosSelect:valueTipoKitId,
                    kit:true

                });
            console.log(objectForm);
            identificador++
        });
        $('#contentDiv').on('click', '.quitar_articulo', function(){
            console.log('Quitando articulo '+$(this).data('id_articulo'));
            $(".fila_articulo[data-id_articulo='"+$(this).data('id_articulo')+"']").html('');
            var num=$(this).data('id_articulo');
            objectForm =  objectForm.filter(function(el) {
                return el.id != num;
            });
            console.log(objectForm);
        });

        //cambio de select de articulos tiempo
        var tipoArticulo
        $('#tipoArticulosSelect').on('change', function () {
            console.log('entra');
            tipoArticulo = $(this).val();
            var routeTimpoArticulo = '{{ route('listarTiempoArticuloSele') }}' +'/' + tipoArticulo  ;
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
                        for(var i = 1;i <= tiempo;i++){
                            if(i == 1){
                                nombreTiempo=i+' Hora';
                            }else{
                                nombreTiempo=i+' Horas';
                            }
                            $('#tiempoArticulo').append(new Option(nombreTiempo,i));
                        }
                    }
                }
            });
        });
        var tipoKit
        $('#tipoKitsSelect').on('change', function () {
            console.log('entraCambioKit');
            tipokit= $(this).val();
            kit = $(this).val();
            var routeArticulos = '{{ route('listarArticulosKit') }}' +'/' + kit ;
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
                        console.log(response.data);
                        $(response.data).each(function (key,value) {
                            $('#ElementosKit').append(value.consulta_tipo_articulo.TPART_Nombre);
                            $('#ElementosKit').append('\n');
                        });

                    }
                }
            });
        });
        //btn_ingresar_identificacion
        $('#finalizar').on('click',function(){
            var routeCrearPrestamo = '{{ route('prestamoRepeat.crear') }}';
            var typeAjax = 'POST';
            var async = async || false;
            var formDatas = new FormData();
            formDatas.append('infoPrestamo',JSON.stringify(objectForm));
            formDatas.append('idFuncionario',idFuncionarioD);
            $.ajax({
                url: routeCrearPrestamo,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                cache: false,
                type: typeAjax,
                contentType: false,
                data: formDatas,
                processData: false,
                async: async,
                beforeSend: function () {

                },
                success: function (response, xhr, request) {
                    console.log('guarda');
                    UIToastr.init(xhr , response.title , response.message  );
                    //////////regresa menu principal
                    App.unblockUI('.portlet-form');
                    var route = '{{ route('audiovisuales.gestionPrestamos.indexAjax') }}';
                    $(".content-ajax").load(route);
                },
                error: function (response, xhr, request) {
                    console.log('no guarda');
                    UIToastr.init(xhr , response.title , response.message  );
                }
            });
        });
    });
</script>
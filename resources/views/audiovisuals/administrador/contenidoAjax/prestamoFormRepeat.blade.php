<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Asignar Prestamo'])
        @slot('actions', [
                'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
               ],
        ])
        <div class="row">
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
    jQuery(document).ready(function () {
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.gestionPrestamos.indexAjax') }}';
            $(".content-ajax").load(route);
        });
        FormSelect2.init();
        var identificador = 0;
        $('#agregar').on('click',function (e){
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
                    tipoArticulosSelect:valueTipoArticuloId

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
        });
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
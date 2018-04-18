<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Elementos del Kit '.$nombreKit])
        @slot('actions', [
              'link_cancel' => [
              'link' => '',
              'icon' => 'fa fa-arrow-left',
             ],
        ])
        <div id="contentAgregarArticulos" >
            <div class="row" id="articulo">
                <div class="col-md-2">
                    {!! Field::select('tipoArticulosSelect',
                         null,
                    ['label' => 'Tipo Articulo','required'])
                    !!}
                </div>
                <div class="col-md-2">
                    {!! Field::select('codigoSelect',
                         null,
                    ['label' => 'Codigo','required'])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Field::text('caracteristicaA',
                        ['label' => 'Caracteristica:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                        ['icon' => 'fa fa-keyboard-o'])
                    !!}
                </div>
                <br>
                @permission("AUDI_KIT_EDIT")
                <div class="col-md-2">
                    <a class="btn btn-success agregar_articulo" id="agregarArticulo" data-id_articulo=identificador>
                        Agregar
                    </a>
                </div>
                @endpermission
            </div>
        </div>
        <div >
            <div class="col-md-6">
                @permission("AUDI_KIT_EDIT")
                <a class="btn btn-warning finalizarKitBoton">
                    FINALIZAR MODIFICACION KIT
                </a>
                @endpermission
            </div>
        </div>
        <div class="clearfix"></div>
        <br><br>
        <div id="contentFormularioArticulos">
            <div class="col-md-12" id="contentDiv">
        @if (count($articulos) >= 1)
            @foreach ($articulos as $elementos)
                <div class="row fila_articulo" data-id_articulo='{{$elementos->id}}'>
                    <div class="col-md-2">
                        {!! Field::text('tipoArticulo',$elementos->consultaTipoArticulo->TPART_Nombre,
                            ['disabled','label' => 'Tipo:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                            ['icon' => 'fa fa-briefcase'])
                        !!}
                    </div>
                    <div class="col-md-2">
                        {!! Field::text('codigoSelect',$elementos->ART_Codigo,
                            ['disabled','label' => 'Codigo:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                            ['icon' => 'fa fa-key'])
                        !!}
                    </div>
                    <div class="col-md-6">
                        {!! Field::text('caracteristica',$elementos->ART_Descripcion,
                            ['disabled','label' => 'Caracteristica:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                            ['icon' => 'fa fa-keyboard-o'])
                        !!}
                    </div>
                    <br>
                    <div class="col-md-2">
                        @permission("AUDI_KIT_EDIT")
                        <a class="btn btn-danger quitar_articulo" id="agregarArticulo" data-id_articulo= {{$elementos->id}}>
                            Remover
                        </a>
                        @endpermission
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning" id="alerta">
                <a> ¡Este Kit no contiene ningun elemento !</a>
            </div>
        @endif
            </div>
        </div>
        <div class="clearfix"></div>
    @endcomponent
</div>
<script type="text/javascript">

    jQuery(document).ready(function () {
        swal("Remover Articulos!", "los articulos removidos podrán ser asignados a este kit u otro kit que este creado previamente");
        var objectForm=[];
        var identificador = 0;
        var textTipoArticulo , textCodigoArticulo ,textCaracteristica,boton_quitar;
        var idTextTipoArticulo ,idTextCodigoArticulo ,idTextCaracteristica;
        var fila_completa;
        var valueTipoArticulo ,valueCodigoArticulo ,valueCaracteristicaArticulo;
        ComponentsBootstrapMaxlength.init();
        ComponentsSelect2.init();
        function cargarSelect(){
            var rutaCaragarTipoArticulo = '{{ route('cargar.tipoArticulos.selectKit') }}';
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
                }
                ,
                error: function (response, xhr, request) {
                    if (request.status === 422 && xhr === 'error') {
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
                    }
                }
            });
        }
        function asignarArticuloAlkit(idArticulo,idKit){

            var rutaAsignarArticuloAlkit =
                '{{ route('AsignarArticuloAlkit') }}'+ '/'+ idArticulo+ '/'+ idKit;
            $.ajax({
                url: rutaAsignarArticuloAlkit,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        $('#tipoArticulosSelect').empty();
                        $('#codigoSelect').empty();
                        $('#caracteristicaA').val('');
                        cargarSelect();
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
        function removerArticuloKit(idArticulo){
            var rutaRemoverArticuloKit =
                '{{ route('removerArticuloKit') }}'+ '/'+ idArticulo;
            $.ajax({
                url: rutaRemoverArticuloKit,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        $('#tipoArticulosSelect').empty();
                        $('#codigoSelect').empty();
                        $('#caracteristicaA').val('');
                        cargarSelect();
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
        cargarSelect();
        $('#agregarArticulo').on('click',function(){
            $('#alerta').addClass("hide");
            var idArticuloSelect = $('select[name="codigoSelect"]').val();
            textTipoArticulo = '<div class="col-md-2"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTipoArticuloC" id="textTipoArticulo'+identificador+'" data-id_articulo='+identificador+' name="textTipoArticuloC'+identificador+'" type="text" disabled><label for="textTipoArticuloC'+identificador+'" class="control-label">Tipo :</label><i class=" fa fa-credit-briefcase "></i></div></div></div>';
            textCodigoArticulo = '<div class="col-md-2"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textCodigoArticuloC" id="textCodigoArticulo'+identificador+'" data-id_articulo='+identificador+' name="textCodigoArticuloC'+identificador+'" type="text" disabled><label for="textCodigoArticuloC'+identificador+'" class="control-label">Codigo :</label><i class=" fa fa-key "></i></div></div></div>';
            textCaracteristica = '<div class="col-md-6"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textCaracteristicaC" id="textCaracteristica'+identificador+'" data-id_articulo='+identificador+'  name="textCaracteristicaC'+identificador+'" type="text" disabled><label for="textCaracteristicaC'+identificador+'" class="control-label">Caracteristica :</label><i class=" fa fa-keyboard-o"></i></div></div></div>';
            boton_quitar = '<br><div class="col-md-2">@permission("AUDI_KIT_EDIT")<a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo='+idArticuloSelect+' >Remover</a>@endpermission </div>';

            idTextTipoArticulo = "#textTipoArticulo"+identificador,idTextCodigoArticulo = "#textCodigoArticulo"+identificador,idTextCaracteristica= "#textCaracteristica"+identificador;
            fila_completa = '<div class="row fila_articulo" data-id_articulo='+idArticuloSelect+'>'+textTipoArticulo+textCodigoArticulo+textCaracteristica+boton_quitar +'</div>';
            $("#contentDiv").append(fila_completa);
            valueTipoArticulo = $("#tipoArticulosSelect option:selected").text();
            valueCodigoArticulo = $("#codigoSelect option:selected").text();
            valueCaracteristicaArticulo = $('input:text[name="caracteristicaA"]').val();
            $(idTextTipoArticulo).val(valueTipoArticulo);
            $(idTextCodigoArticulo).val(valueCodigoArticulo);
            $(idTextCaracteristica).val(valueCaracteristicaArticulo);
            var idArticuloSelect = $('select[name="codigoSelect"]').val();
            var idKitCreado = '{{$idKit}}';
            asignarArticuloAlkit(idArticuloSelect,idKitCreado);
            objectForm.push(
                {
                    id:identificador,
                    idArticuloObj:idArticuloSelect
                });
            identificador++;
        });
        $('#tipoArticulosSelect').on('change',function(){
            var idTipoArticuloVall = $(this).val();
            var routeCodigoArticulo = '{{ route('listarCodigoArticuloSele') }}' + '/' + idTipoArticuloVall;
            $.ajax({
                url: routeCodigoArticulo,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success :function (res, xhr, request){
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');

                        $('#codigoSelect').empty();
                        $(res.data).each(function (key, value) {
                            $('#codigoSelect').append(new Option(value.ART_Codigo, value.id));
                        });
                        $('#codigoSelect').val([]);
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 && xhr === 'error') {
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
                    }
                }
            });

        });
        $('#codigoSelect').on('change',function(){
            var idCodigoArticuloVal = $(this).val();
            $('#caracteristica').val();
            var routeCaracteristicaArticulo = '{{ route('listarCaracteristicaArticulo') }}' + '/' + idCodigoArticuloVal;
            $.ajax({
                url: routeCaracteristicaArticulo,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success :function (response, xhr, request){
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        $('#caracteristicaA').val(response.data[0]['ART_Descripcion']);
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 && xhr === 'error') {
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
                    }
                }
            });
        });
        $('#contentDiv').on('click', '.quitar_articulo', function(){
            var num = $(this).data('id_articulo');
            $(".fila_articulo[data-id_articulo='"+$(this).data('id_articulo')+"']").html('');
            removerArticuloKit(num);

        });
        $(".finalizarKitBoton").on('click',function(){
            if(objectForm.length == 0){
                swal(
                    {
                        title: "No ha ingrasados articulos al kit.",
                        text: "¿ Desea salir sin ingresar ningun articulo ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Si",
                        cancelButtonText: "No",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            var route = '{{ route('audiovisuales.gestionKits.indexAjax') }}';
                            $(".content-ajax").load(route);
                        }
                    }
                );
            }else{
                var route = '{{ route('audiovisuales.gestionKits.indexAjax') }}';
                $(".content-ajax").load(route);
            }
        });
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.gestionKits.indexAjax') }}';
            $(".content-ajax").load(route);
        });
    });
</script>
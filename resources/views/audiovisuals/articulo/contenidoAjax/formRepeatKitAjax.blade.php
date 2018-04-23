<div class="col-md-12">
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Crear Kit'])
    @slot('actions', [
          'link_cancel' => [
          'link' => '',
          'icon' => 'fa fa-arrow-left',
         ],
    ])
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['id' => 'from_kit_create', 'class' => '', 'url' => '/forms']) !!}
                <div class="col-md-2">
                    {!! Field::text('KIT_Nombre',
                       ['label' => 'Nombre Kit', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                       ['help' => 'Nombre del Kit', 'icon' => 'fa fa-keyboard-o'] )
                    !!}
                </div>
                <div class="col-md-3">
                    {!! Field::select('KIT_FK_Tiempo',
                         [
                            4 => 'Asignado',
                            3 => 'Libre'
                         ],
                        ['label' => 'Tipo Tiempo'])
                    !!}
                </div>
                <div class="col-md-3">
                    {!! Field::text('KIT_Codigo',
                        ['label' => 'Codigo', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                        ['help' => 'Codigo Del Kit', 'icon' => 'fa fa-key'])
                    !!}
                </div>
                <br>
                <div class="col-md-2">
                    @permission("AUDI_KIT_CREATE")
                    {!! Form::submit('Crear', ['class' => 'btn blue','id' =>'botonCrear' ]) !!}
                    @endpermission
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="hide" id="finalizarKitDiv">
        <div class="col-md-6">
            <a class="btn btn-success finalizarKitBoton">
                FINALIZAR ASIGNACIÓN DE ARTICULOS
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <br><br>
    <div id="contentAgregarArticulos" class="hide">
        {!! Form::open(['id' => 'form_articulo', 'class' => '', 'url' => '/forms']) !!}
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
                {!! Field::text('caracteristica',
                ['disabled','label' => 'Caracteristica:', 'max' => '240', 'min' => '2', 'required', 'auto' => 'off'],
                ['icon' => 'fa fa-keyboard-o'])
                !!}
            </div>
            <br>
            <div class="col-md-2">
                @permission("AUDI_KIT_CREATE")
                <a class="btn btn-danger agregar_articulo" id="agregarArticulo" data-id_articulo=identificador>
                    Agregar
                </a>
                @endpermission
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div id="contentFormularioArticulos" class="hide">
        <div class="col-md-12" id="contentDiv">

        </div>
    </div>
    <div class="clearfix"></div>
@endcomponent
<div class="clearfix"></div>
</div>
<script type="text/javascript">

    jQuery(document).ready(function () {
        App.unblockUI('.portlet-form');
        var objectForm=[];
        var identificador = 0;
        var textTipoArticulo , textCodigoArticulo ,textCaracteristica,boton_quitar;
        var idTextTipoArticulo ,idTextCodigoArticulo ,idTextCaracteristica;
        var fila_completa;
        var valueTipoArticulo ,valueCodigoArticulo ,valueCaracteristicaArticulo;
        var idKitCreado;
        ComponentsBootstrapMaxlength.init();
        ComponentsSelect2.init();
        function encontrarIdArticulo(array, llave, valor) {
            for (var i = 0; i < array.length; i++) {
                if (array[i][llave] == valor) {
                    return i;
                }
            }
            return -1;
        }
        function selectTipoArticuloAjax(){
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
                },
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
                        $('#caracteristica').val('');
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
                        $('#caracteristica').val(['']);
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
        var createKit = function () {
            return {
                init: function () {
                    var route = '{{ route('kit.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('KIT_Nombre', $('input:text[name="KIT_Nombre"]').val());
                    formData.append('KIT_FK_Tiempo', $('select[name="KIT_FK_Tiempo"]').val());
                    formData.append('KIT_Codigo', $('input:text[name="KIT_Codigo"]').val());
                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                                $('#KIT_Nombre').attr('disabled','disabled');
                                $('#KIT_FK_Tiempo').attr('disabled','disabled');
                                $('#KIT_Codigo').attr('disabled','disabled');
                                UIToastr.init(xhr , response.title , response.message  );
                                idKitCreado = response.data;
                                swal(
                                    {
                                        title: "¿ Desea Agregar Articulos al Kit ?",
                                        type: "info",
                                        showCancelButton: true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Si",
                                        cancelButtonText: "No",
                                        closeOnConfirm: true,
                                        closeOnCancel: true
                                    },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            $("#finalizarKitDiv").removeClass('hide');
                                            $("#contentAgregarArticulos").removeClass('hide');
                                            $("#botonCrear").hide();

                                            $('#tipoArticulosSelect').empty('whatever');
                                            selectTipoArticuloAjax();

                                        }else{
                                            var route = '{{ route('audiovisuales.gestionKits.indexAjax') }}';
                                            $(".content-ajax").load(route);
                                        }
                                    }
                                );
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
        var form_kit_create = $('#from_kit_create');
        var rules_kit_create = {
            KIT_Nombre: {
                minlength: 3, required: true, remote: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('kit.validar') }}",
                    type: "post"
                }
            },
            KIT_FK_Tiempo :{
                required: true
            },
            KIT_Codigo:{
                required: true,
                minlength: 3
            }

        };
        var messagesKit = {
            KIT_Nombre: {
                remote: 'El Kit ya Existe.'
            }
        };
        FormValidationMd.init(form_kit_create, rules_kit_create, messagesKit,createKit());
        $("#from_kit_create").validate({
            onkeyup: false //turn off auto validate whilst typing
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
                     if (request.status === 422 &&  xhr === 'error') {
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
                        $('#caracteristica').val(response.data[0]['ART_Descripcion']);
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
        $('#agregarArticulo').on('click',function(){
            if ((validatorArticulo.element("#tipoArticulosSelect") == true) && (validatorArticulo.element("#caracteristica") == true) && (validatorArticulo.element("#codigoSelect") == true) ){
                textTipoArticulo = '<div class="col-md-4"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textTipoArticuloC" id="textTipoArticulo'+identificador+'" data-id_articulo='+identificador+' name="textTipoArticuloC'+identificador+'" type="text" disabled><label for="textTipoArticuloC'+identificador+'" class="control-label">Tipo :</label><i class=" fa fa-briefcase"></i></div></div></div>';
                textCodigoArticulo = '<div class="col-md-4"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textCodigoArticuloC" id="textCodigoArticulo'+identificador+'" data-id_articulo='+identificador+' name="textCodigoArticuloC'+identificador+'" type="text" disabled><label for="textCodigoArticuloC'+identificador+'" class="control-label">Codigo :</label><i class=" fa fa-key"></i></div></div></div>';
                textCaracteristica = '<div class="col-md-3"><div class="form-group form-md-line-input"><div class="input-icon"><input class="form-control textCaracteristicaC" id="textCaracteristica'+identificador+'" data-id_articulo='+identificador+'  name="textCaracteristicaC'+identificador+'" type="text" disabled><label for="textCaracteristicaC'+identificador+'" class="control-label">Caracteristica:</label><i class=" fa fa-keyboard-o"></i></div></div></div>';
                boton_quitar = '<br><div class="col-md-1">@permission("AUDI_KIT_CREATE")<a class="btn btn-danger quitar_articulo" href="#" title="Quitar articulo" data-id_articulo='+identificador+' ><i class="icon-trash"></i></a>@endpermission</div>';
                idTextTipoArticulo = "#textTipoArticulo"+identificador,idTextCodigoArticulo = "#textCodigoArticulo"+identificador,idTextCaracteristica= "#textCaracteristica"+identificador;
                $('#contentFormularioArticulos').removeClass('hide');
                fila_completa = '<div class="row fila_articulo" data-id_articulo='+identificador+'>'+textTipoArticulo+textCodigoArticulo+textCaracteristica+boton_quitar +'</div>';
                $("#contentDiv").append(fila_completa);
                valueTipoArticulo = $("#tipoArticulosSelect option:selected").text();
                valueCodigoArticulo = $("#codigoSelect option:selected").text();
                valueCaracteristicaArticulo = $('input:text[name="caracteristica"]').val();
                $(idTextTipoArticulo).val(valueTipoArticulo);
                $(idTextCodigoArticulo).val(valueCodigoArticulo);
                $(idTextCaracteristica).val(valueCaracteristicaArticulo);
                var idArticuloSelect = $('select[name="codigoSelect"]').val();
                asignarArticuloAlkit(idArticuloSelect,idKitCreado);
                objectForm.push(
                    {
                        id:identificador,
                        idArticuloObj:idArticuloSelect
                    });
                identificador++;
            }else{
                validatorArticulo.element("#tipoArticulosSelect");
                validatorArticulo.element("#caracteristica");
                validatorArticulo.element("#codigoSelect");
            }

        });
        $('#contentDiv').on('click', '.quitar_articulo', function(){
            var num = $(this).data('id_articulo');
            var index = encontrarIdArticulo(objectForm,'id',num);
            var idArticuloRemover = objectForm[index];
            idArticuloRemover = idArticuloRemover.idArticuloObj;
            objectForm =  objectForm.filter(function(el) {
                return el.id != num;
            });
            $(".fila_articulo[data-id_articulo='"+$(this).data('id_articulo')+"']").html('');
            removerArticuloKit(idArticuloRemover);
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
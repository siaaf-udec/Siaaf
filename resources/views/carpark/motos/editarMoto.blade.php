<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario edición de vehículos'])
        @slot('actions', [
               'link_cancel' => [
                   'link' => '',
                   'icon' => 'fa fa-arrow-left',
                                ],
                ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ($infoMoto,['id'=>'form_moto_update', 'url' => '/forms']) !!}

                <div class="form-body">

                    <div class="row">
                        <div class="col-md-6">

                            {!! Field:: text('PK_CM_IdMoto',$infoMoto['PK_CM_IdMoto'],['label'=>'Código del vehículo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                         ['icon'=>'fa fa-id-card-o'] ) !!}

                            {!! Field:: text('CM_Placa',$infoMoto['CM_Placa'],['label'=>'Placa del vehículo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite la placa del vehículo a registrar.','icon'=>'fa fa-motorcycle'] ) !!}

                          


                        </div>
                        <div class="col-md-6">
                            
                              {!! Field:: text('CM_Marca',$infoMoto['CM_Marca'],['label'=>'Marca del vehículo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite la marca del vehículo.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CM_NuPropiedad',$infoMoto['CM_NuPropiedad'],['label'=>'Número de tarjeta de propiedad:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite el número de la tarjeta de propiedad del vehículo.','icon'=>'fa fa-id-card-o'] ) !!}

                           {{--  {!! Field:: text('CM_NuSoat',$infoMoto['CM_NuSoat'],['label'=>'Número del SOAT:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite el número del SOAT vigente.','icon'=>'fa fa-id-card-o'] ) !!}

                            {!! Field::date('CM_FechaSoat',['label' => 'Fecha de vencimiento del SOAT', 'auto' => 'on', 'data-date-format' => "yyyy-mm-dd",'data-date-start-date' => "+0d",'placeholder'=>'Valor Fecha'],['help' => 'Digite la fecha de vencimiento del SOAT', 'icon' => 'fa fa-calendar']) !!}
 --}}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-md-offset-0">
                            <div class="col-md-4">
                                <span class="label label-primary">Seleccione la foto del vehículo</span>
                                @permission('PARK_UPDATE_MOTO')<a href="javascript:;"><img
                                            src="{{ asset(Storage::url($infoMoto['CM_UrlFoto'])) }}"
                                            class=" img-circle UpdateFotoMoto" id="FotoPerfil" height="250" width="250"
                                            data-toggle="modal"></a>@endpermission
                            </div>
                           {{--  <div class="col-md-4">
                                <span class="label label-primary">Tarjeta de propiedad del vehículo</span>
                                @permission('PARK_UPDATE_MOTO')<a href="javascript:;"><img
                                            src="{{ asset(Storage::url($infoMoto['CM_UrlPropiedad'])) }}"
                                            class=" UpdateFotoPropiedad" id="FotoPerfil" height="250" width="250"
                                            data-toggle="modal"></a>@endpermission
                            </div>
                            <div class="col-md-4">
                                <span class="label label-primary">SOAT del vehículo</span>
                                @permission('PARK_UPDATE_MOTO')<a href="javascript:;"><img
                                            src="{{ asset(Storage::url($infoMoto['CM_UrlSoat'])) }}"
                                            class="  UpdateFotoSOAT" id="FotoPerfil" height="250" width="250"
                                            data-toggle="modal"></a>@endpermission
                            </div> --}}
                        </div>
                    </div>


                </div>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            @permission('PARK_UPDATE_MOTO')<a href="javascript:;"
                                                           class="btn btn-outline red button-cancel"><i
                                        class="fa fa-angle-left"></i>
                                Cancelar
                            </a>@endpermission

                            @permission('PARK_UPDATE_MOTO'){{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}@endpermission
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endcomponent


<!-- Modal Update Foto -->
    <div class="clearfix"></div>
    <div class="modal fade" id="modal-update-FotoMoto" tabindex="-1">
        <div class="modal-header modal-header-success">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"></button>
            <h2 class="modal-title">
                <i class="glyphicon glyphicon-user"></i>
                Editar Foto Del Vehículo
            </h2>
        </div>
        <div class="modal-body ">
            {!! Form::model ($infoMoto, ['id'=>'form_update_FotoMoto', 'url' => '/forms'])  !!}
            <div class="row">
                <div class="col-md-12 col-md-offset-3">
                    <p>
                        {!! Field::file('CM_UrlFotoM') !!}
                    </p>
                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    @permission('PARK_UPDATE_MOTO'){{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}@endpermission
                </div>
            </div>
        </div>
        <div class="modal-footer">

            {!! Form::close() !!}
        </div>

    </div>

    <!-- Fin Modal Update Foto -->

    <!-- Modal Update Propiedad -->
    <div class="clearfix"></div>
    <div class="modal fade" id="modal-update-FotoProp" tabindex="-1">
        <div class="modal-header modal-header-success">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"></button>
            <h2 class="modal-title">
                <i class="glyphicon glyphicon-user"></i>
                Editar Foto De Tarjeta De Propiedad Del Vehículo
            </h2>
        </div>
        <div class="modal-body ">
            {!! Form::model ($infoMoto, ['id'=>'form_update_FotoPropiedad', 'url' => '/forms'])  !!}
            <div class="row">
                <div class="col-md-12 col-md-offset-3">
                    <p>
                        {!! Field::file('CM_UrlPropiedadM') !!}
                    </p>
                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    @permission('PARK_UPDATE_MOTO'){{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}@endpermission
                </div>
            </div>
        </div>
        <div class="modal-footer">

            {!! Form::close() !!}
        </div>

    </div>

    <!-- Fin Modal Update Propiedad -->

    <!-- Modal Update SOAT -->
    <div class="clearfix"></div>
    <div class="modal fade" id="modal-update-FotoSOAT" tabindex="-1">
        <div class="modal-header modal-header-success">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"></button>
            <h2 class="modal-title">
                <i class="glyphicon glyphicon-user"></i>
                Editar Foto De SOAT Del Vehículo
            </h2>
        </div>
        <div class="modal-body ">
            {!! Form::model ($infoMoto, ['id'=>'form_update_FotoSOAT', 'url' => '/forms'])  !!}
            <div class="row">
                <div class="col-md-12 col-md-offset-3">
                    <p>
                        {!! Field::file('CM_UrlSoatM') !!}
                    </p>
                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    @permission('PARK_UPDATE_MOTO'){{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}@endpermission
                </div>
            </div>
        </div>
        <div class="modal-footer">

            {!! Form::close() !!}
        </div>

    </div>

    <!-- Fin Modal Update SOAT -->

</div>
<!-- file script -->
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type = "text/javascript" > </script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        /*Configuracion de input tipo fecha*/
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            regional: 'es',
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yyyy-mm-dd',
            firstDay: 1,
            showMonthAfterYear: false,
            yearSuffix: ''
        });
        /*FIN Configuracion de input tipo fecha*/
        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
        });

        var updateMoto = function () {
            return {
                init: function () {
                    var route = '{{ route('parqueadero.motosCarpark.update') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();

                    formData.append('PK_CM_IdMoto', $('input:text[name="PK_CM_IdMoto"]').val());
                    formData.append('CM_Placa', $('input:text[name="CM_Placa"]').val());
                    formData.append('CM_Marca', $('input:text[name="CM_Marca"]').val());
                    formData.append('CM_NuPropiedad', $('input:text[name="CM_NuPropiedad"]').val());
                    // formData.append('CM_NuSoat', $('input:text[name="CM_NuSoat"]').val());
                    // formData.append('CM_FechaSoat', $('#CM_FechaSoat').val());

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
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_moto_update')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.motosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form = $('#form_moto_update');
        var formRules = {
            CM_UrlFoto: {required: true},
            CM_Placa: {minlength: 5, maxlength: 6, required: true, noSpecialCharacters:true},
            CM_Marca: {required: true, minlength: 5, maxlength: 50, noSpecialCharacters:true},
            CM_NuPropiedad: {required: true, minlength: 5, maxlength: 20, noSpecialCharacters:true},
            // CM_NuSoat: {required: true, minlength: 5, maxlength: 20, noSpecialCharacters:true},
            // CM_UrlPropiedad: {required: true},
            // CM_UrlSoat: {required: true},
        };

        var formMessage = {
            CM_Placa: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CM_Marca: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CM_NuPropiedad: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            // CM_NuSoat: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };                                                              
        FormValidationMd.init(form, formRules, formMessage, updateMoto());

        ////////////////////////////////////////////////////////////////////////
        /////////////////////Función Editar Foto Moto ///////////////////////////////////
        var updateFotoMoto = function () {
            return {
                init: function () {
                    var codigo = <?php echo $infoMoto['PK_CM_IdMoto'];?>
                    //var route = '{{ route('parqueadero.usuariosCarpark.updateFotoUsuario') }}'+'/'+codigo;
                    var route = '{{ route('parqueadero.motosCarpark.updateFotoMoto') }}';
                    route = route.concat("/", codigo);
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();

                    var File = document.getElementById("CM_UrlFotoM");

                    formData.append('CM_UrlFoto', File.files[0]);

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
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#modal-update-FotoMoto').modal('hide');
                                $('#form_update_FotoMoto')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.motosCarpark.editar') }}' + '/' + codigo;
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var formFotoMoto = $('#form_update_FotoMoto');
        var formFotoRulesMoto = {
            CM_UrlFotoM: {required: true},
        };
        FormValidationMd.init(formFotoMoto, formFotoRulesMoto, false, updateFotoMoto());

        /////////////////////Fin Función Editar Foto Moto////////////////////////////////

        /////////////////////Función Editar Foto Propiedad ///////////////////////////////////
        var updateFotoPropiedad = function () {
            return {
                init: function () {
                    var codigo = <?php echo $infoMoto['PK_CM_IdMoto'];?>
                    //var route = '{{ route('parqueadero.usuariosCarpark.updateFotoUsuario') }}'+'/'+codigo;
                    var route = '{{ route('parqueadero.motosCarpark.updateFotoPropiedad') }}';
                    route = route.concat("/", codigo);
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();

                    var File = document.getElementById("CM_UrlPropiedadM");

                    formData.append('CM_UrlPropiedad', File.files[0]);

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
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#modal-update-FotoProp').modal('hide');
                                $('#form_update_FotoPropiedad')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.motosCarpark.editar') }}' + '/' + codigo;
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var formFotoPropiedad = $('#form_update_FotoPropiedad');
        var formFotoRulesPropiedad = {
            CM_UrlPropiedadM: {required: true},
        };
        FormValidationMd.init(formFotoPropiedad, formFotoRulesPropiedad, false, updateFotoPropiedad());

        /////////////////////Fin Función Editar Foto Propiedad////////////////////////////////

        /////////////////////Función Editar Foto SOAT ///////////////////////////////////
        var UpdateFotoSOAT = function () {
            return {
                init: function () {
                    var codigo = <?php echo $infoMoto['PK_CM_IdMoto'];?>
                    //var route = '{{ route('parqueadero.usuariosCarpark.updateFotoUsuario') }}'+'/'+codigo;
                    var route = '{{ route('parqueadero.motosCarpark.UpdateFotoSOAT') }}';
                    route = route.concat("/", codigo);
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();

                    var File = document.getElementById("CM_UrlSoatM");

                    formData.append('CM_UrlSoat', File.files[0]);

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
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#modal-update-FotoSOAT').modal('hide');
                                $('#form_update_FotoSOAT')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.motosCarpark.editar') }}' + '/' + codigo;
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var formFotoSOAT = $('#form_update_FotoSOAT');
        var formFotoRulesSOAT = {
            CM_UrlSoatM: {required: true},
        };
        FormValidationMd.init(formFotoSOAT, formFotoRulesSOAT, false, UpdateFotoSOAT());

        /////////////////////Fin Función Editar Foto SOAT////////////////////////////////

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.motosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });


        //////////// Editar la fotos //////////////////////

        $(".UpdateFotoMoto").on('click', function (e) {
            e.preventDefault();
            $('#modal-update-FotoMoto').modal('toggle');

        });

        $(".UpdateFotoPropiedad").on('click', function (e) {
            e.preventDefault();
            $('#modal-update-FotoProp').modal('toggle');

        });

        $(".UpdateFotoSOAT").on('click', function (e) {
            e.preventDefault();
            $('#modal-update-FotoSOAT').modal('toggle');

        });

        ////////////Fin Editar Foto Perfil ////////////////////////
        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('parqueadero.motosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>

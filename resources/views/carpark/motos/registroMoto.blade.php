<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de vehículos'])
        @slot('actions', [
              'link_cancel' => [
                  'link' => '',
                  'icon' => 'fa fa-arrow-left',
                               ],
               ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ($codigoUsuario,['id'=>'form_moto_create', 'url' => '/forms']) !!}

                <div class="form-body">

                    <div class="row">
                        <div class="col-md-6">

                            {!! Field:: text('FK_CM_CodigoUser',$codigoUsuario,['label'=>'Código del usuario:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                         ['help' => 'Digite la placa del vehículo a registrar.','icon'=>'fa fa-id-card-o'] ) !!}

                            {!! Field:: text('CM_Placa',null,['label'=>'Placa del vehículo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite la placa del vehículo a registrar.','icon'=>'fa fa-motorcycle'] ) !!}

                            {!! Field:: text('CM_Marca',null,['label'=>'Marca del vehículo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite la marca del vehículo.','icon'=>'fa fa-credit-card'] ) !!}


                        </div>
                        <div class="col-md-6">

                            {!! Field:: text('CM_NuPropiedad',null,['label'=>'Número de tarjeta de propiedad:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite el número de la tarjeta de propiedad del vehículo.','icon'=>'fa fa-id-card-o'] ) !!}

                            {!! Field:: text('CM_NuSoat',null,['label'=>'Número del SOAT:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite el número del SOAT vigente.','icon'=>'fa fa-id-card-o'] ) !!}

                            {!! Field::date('CM_FechaSoat',['label' => 'Fecha de vencimiento del SOAT', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],['help' => 'Digite la fecha de vencimiento del SOAT', 'icon' => 'fa fa-calendar']) !!}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-md-offset-0">
                            <div class="col-md-4">
                                <span class="label label-primary">Seleccione la foto del vehículo</span>
                                {!! Field::file('CM_UrlFoto') !!}
                            </div>
                            <div class="col-md-4">
                                <span class="label label-primary">Tarjeta de propiedad del vehículo</span>
                                {!! Field::file('CM_UrlPropiedad') !!}
                            </div>
                            <div class="col-md-4">
                                <span class="label label-primary">SOAT del vehículo</span>
                                {!! Field::file('CM_UrlSoat') !!}
                            </div>
                        </div>
                    </div>


                </div>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            @permission('CREATE_MOTO_CARPARK')<a href="javascript:;"
                                                           class="btn btn-outline red button-cancel"><i
                                        class="fa fa-angle-left"></i>
                                Cancelar
                            </a>@endpermission

                            @permission('CREATE_MOTO_CARPARK'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcomponent
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

        var createMoto = function () {
            return {
                init: function () {
                    var route = '{{ route('parqueadero.motosCarpark.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    var FileMoto = document.getElementById("CM_UrlFoto");
                    var FileProp = document.getElementById("CM_UrlPropiedad");
                    var FileSOAT = document.getElementById("CM_UrlSoat");


                    formData.append('CM_Placa', $('input:text[name="CM_Placa"]').val());
                    formData.append('CM_Marca', $('input:text[name="CM_Marca"]').val());
                    formData.append('CM_NuPropiedad', $('input:text[name="CM_NuPropiedad"]').val());
                    formData.append('CM_NuSoat', $('input:text[name="CM_NuSoat"]').val());
                    formData.append('CM_FechaSoat', $('#CM_FechaSoat').val());

                    formData.append('CM_UrlFoto', FileMoto.files[0]);
                    formData.append('CM_UrlPropiedad', FileProp.files[0]);
                    formData.append('CM_UrlSoat', FileSOAT.files[0]);

                    formData.append('FK_CM_CodigoUser', $('input:text[name="FK_CM_CodigoUser"]').val());


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
                                $('#form_moto_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.motosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form = $('#form_moto_create');
        var formRules = {
            CM_UrlFoto: {required: true, extension: "jpg|png"},
            CM_Placa: {minlength: 5, maxlength: 6, required: true, noSpecialCharacters:true},
            CM_Marca: {required: true, minlength: 5, maxlength: 50, noSpecialCharacters:true},
            CM_NuPropiedad: {required: true, minlength: 5, maxlength: 20, noSpecialCharacters:true},
            CM_NuSoat: {required: true, minlength: 5, maxlength: 20, noSpecialCharacters:true},
            CM_FechaSoat: {required: true},
            CM_UrlPropiedad: {required: true, extension: "jpg|png"},
            CM_UrlSoat: {required: true, extension: "jpg|png"},
        };
        var formMessage = {
            CM_Placa: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CM_Marca: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CM_NuPropiedad: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CM_NuSoat: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };

        FormValidationMd.init(form, formRules, formMessage, createMoto());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>

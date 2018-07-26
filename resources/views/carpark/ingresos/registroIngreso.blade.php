<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro manual de entradas y salidas del parqueadero'])
        @slot('actions', [
               'link_cancel' => [
                   'link' => '',
                   'icon' => 'fa fa-arrow-left',
                                ],
                ])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                {!! Form::open (['id'=>'form_ingreso_create', 'url' => '/forms']) !!}

                <div class="form-body">

                    {!! Field:: text('CodigoUsuario',null,['label'=>'Documento del usuario:','class'=> 'form-control', 'autofocus', 'maxlength'=>'12','autocomplete'=>'off'],['help' => 'Numero de identificacion del usuario.','icon'=>'fa fa-user']) !!}

                    {!! Field:: text('PlacaMoto',null,['label'=>'Placa del vehículo:','class'=> 'form-control', 'autofocus', 'maxlength'=>'6','autocomplete'=>'off'],['help' => 'Digite la placa del vehículo.','icon'=>'fa fa-user']) !!}

                  
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('PARK_CREATE_INGRESO')<a href="javascript:;"
                                                              class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission
                                @permission('PARK_CREATE_INGRESO'){{ Form::submit('Registrar Acción', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
        });
        
        var createAccion = function () {
            return {
                init: function () {
                    var route = '{{ route('parqueadero.ingresosCarpark.verificar') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('CodigoUsuario', $('input:text[name="CodigoUsuario"]').val());
                    formData.append('PlacaMoto', $('input:text[name="PlacaMoto"]').val());

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
                                if (response.data == 422) {
                                    xhr = "warning"
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('parqueadero.ingresosCarpark.index.ajax') }}';
                                    $(".content-ajax").load(route);
                                } else {
                                    $('#form_ingreso_create')[0].reset(); //Limpia formulario                                    
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('parqueadero.ingresosCarpark.confirmar') }}' + '/' + response.data;
                                    $(".content-ajax").load(route);
                                }

                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.ingresosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        }
                    });
                }
            }
        };

        var form = $('#form_ingreso_create');

        var formRules = {
            CodigoUsuario: {required: true, maxlength: 12, minlength: 5, number: true, noSpecialCharacters:true},
            PlacaMoto: {required: true, maxlength: 6, minlength: 5, noSpecialCharacters:true},

        };
        var formMessage = {
            CodigoUsuario: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            PlacaMoto: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, createAccion());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.ingresosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('parqueadero.ingresosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>

<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de confirmación de acción'])
        @slot('actions', [
        'link_cancel' => [
            'link' => '',
            'icon' => 'fa fa-arrow-left',
                         ],
         ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$infoMoto], ['id'=>'form_confirm_ingreso', 'url' => '/forms'])  !!}

                <div class="form-body">

                    <div class="row">

                        <div class="col-md-6">
                            <img src="{{ asset(Storage::url($infoUsuario['CU_UrlFoto'])) }}" class="img-circle"
                                 height="250" width="250">
                        </div>

                        <div class="col-md-6">
                            <img src="{{ asset(Storage::url($infoMoto['CM_UrlFoto'])) }}" class="" height="250"
                                 width="250">
                        </div>

                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-6">

                            {!! Field:: text('CI_CodigoUser',$infoUsuario['PK_CU_Codigo'],['label'=>'Código del usuario:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CI_NombresUser',$infoUsuario['CU_Nombre1'].' '.$infoUsuario['CU_Apellido1'],['label'=>'Nombre del usuario:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}


                        </div>
                        <div class="col-md-6">

                            {!! Field:: text('CI_Placa',$infoMoto['CM_Placa'],['label'=>'Placa del vehículo:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CI_CodigoMoto',$infoMoto['PK_CM_IdMoto'],['label'=>'Código del vehículo:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                        </div>

                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('CREATE_INGRESO_CARPARK')<a href="javascript:;"
                                                              class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>@endpermission
                                @permission('CREATE_INGRESO_CARPARK'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
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

        var createAccion = function () {
            return {
                init: function () {
                    var route = '{{ route('parqueadero.ingresosCarpark.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('CI_NombresUser', $('input:text[name="CI_NombresUser"]').val());
                    formData.append('CI_CodigoUser', $('input:text[name="CI_CodigoUser"]').val());
                    formData.append('CI_Placa', $('input:text[name="CI_Placa"]').val());
                    formData.append('CI_CodigoMoto', $('input:text[name="CI_CodigoMoto"]').val());

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
                                $('#form_confirm_ingreso')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.ingresosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        }
                    });
                }
            }
        };

        var form = $('#form_confirm_ingreso');

        var formRules = {
            CI_NombresUser: {required: true},
            CI_CodigoUser: {required: true},
            CI_Placa: {required: true},
            CI_CodigoMoto: {required: true}

        };
        FormValidationMd.init(form, formRules, false, createAccion());

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

    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos del personal'])
            <div class="col-md-6">
                <div class="btn-group">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon back">
                        <i class="fa fa-arrow-circle-left"></i>Volver
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$infoMoto], ['id'=>'form_perfil_usuario', 'url' => '/forms'])  !!}

                    <div class="form-body">

                        <div class="row">

                            <div class="col-md-4">
                                <img src="{{ asset(Storage::url($infoMoto['CM_UrlFoto'])) }}" class="img-circle" height="250" width="250">
                            </div>

                            <div class="col-md-4">
                                <img src="{{ asset(Storage::url($infoMoto['CM_UrlPropiedad'])) }}" class="" height="250" width="250">
                            </div>

                            <div class="col-md-4">
                                <img src="{{ asset(Storage::url($infoMoto['CM_UrlSoat'])) }}" class="" height="250" width="250">
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                
                                {!! Field:: text('CM_Placa',$infoMoto['CM_Placa'],['label'=>'Placa del vehículo:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                {!! Field:: text('CM_NuPropiedad',$infoMoto['CM_NuPropiedad'],['label'=>'Número de la tarjeta de propiedad:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                {!! Field:: text('CM_NuSoat',$infoMoto['CM_NuSoat'],['label'=>'Número del SOAT del vehículo:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            </div>                            
                            <div class="col-md-6">

                                {!! Field:: text('FK_CM_CodigoUser',$infoUsuario['CU_Nombre1'],['label'=>'Nombre del Dueño:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                {!! Field:: text('FK_CM_CodigoUser2',$infoUsuario['CU_Apellido1'],['label'=>'Apellido del dueño:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                {!! Field:: text('CM_Marca',$infoMoto['CM_Marca'],['label'=>'Marca del vehículo:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            </div>

                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-5">                                    
                                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                                        Volver
                                    </a>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
        @endcomponent
    </div>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {    

    $('.button-cancel').on('click', function (e) {
        e.preventDefault();
        var route = '{{ route('parqueadero.motosCarpark.index.ajax') }}';
        $(".content-ajax").load(route);
    });

   $( ".back" ).on('click', function (e) {
       //e.preventDefault();
       var route = '{{ route('parqueadero.motosCarpark.index.ajax') }}';
       $(".content-ajax").load(route);
   });   



});

</script>

    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Perfil del usuario'])
           @slot('actions', [
           'link_cancel' => [
               'link' => '',
               'icon' => 'fa fa-arrow-left',
                            ],
            ])
            
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$infoUsuario], ['id'=>'form_perfil_usuario', 'url' => '/forms'])  !!}

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div>

                                    <img src="{{ asset(Storage::url($infoUsuario[0]['CU_UrlFoto'])) }}" class=" img-circle" height="250" width="250">
                                    <br><br>
                                </div>                                    

                                    {!! Field:: text('PK_CU_Codigo',$infoUsuario[0]['PK_CU_Codigo'],['label'=>'Código interno:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                    {!! Field:: text('CU_Cedula',$infoUsuario[0]['CU_Cedula'],['label'=>'Cedula de ciudadanía:','readonly', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el número cedula del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                    {!! Field:: text('CU_Nombre1',$infoUsuario[0]['CU_Nombre1'],['label'=>'Primer Nombre','readonly','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el primer nombre del usuario.','icon'=>'fa fa-user']) !!}

                                    {!! Field:: text('CU_Nombre2',$infoUsuario[0]['CU_Nombre2'],['label'=>'Segundo Nombre:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el segundo nombre del usuario.','icon'=>'fa fa-user'] ) !!}
                            </div>
                            <div class="col-md-6">
                                    {!! Field:: text('CU_Apellido1',$infoUsuario[0]['CU_Apellido1'],['label'=>'Primer Apellido:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!}

                                    {!! Field:: text('CU_Apellido2',$infoUsuario[0]['CU_Apellido2'],['label'=>'Segundo Apellido:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!}

                                    {!! Field:: text('CU_Telefono',$infoUsuario[0]['CU_Telefono'],['label'=>'Teléfono:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el número de teléfono del usuario.','icon'=>'fa fa-phone'] ) !!}

                                    {!! Field:: email('CU_Correo',$infoUsuario[0]['CU_Correo'],['label'=>'Correo electrónico:','readonly', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'60','autocomplete'=>'off'],
                                                                     ['help' => 'Digite un correo electronico válido.','icon'=>'fa fa-envelope-open '] ) !!}

                                    {!! Field:: text('CU_Direccion',$infoUsuario[0]['CU_Direccion'],['label'=>'Dirección:','readonly', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'30','autocomplete'=>'off'],
                                                                     ['help' => 'Digite la dirección del usuario.','icon'=>'fa fa-building-o'] ) !!}

                                    {!! Field:: text('FK_CU_IdDependencia',$infoUsuario[0]['relacionUsuariosDependencia']['CD_Dependencia'],['label'=>'Dependencia:','readonly', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'30','autocomplete'=>'off'],
                                                                     ['help' => 'Digite la dirección del usuario.','icon'=>'fa fa-address-card'] ) !!}

                                    {!! Field:: text('FK_CU_IdEstado',$infoUsuario[0]['relacionUsuariosEstado']['CE_Estados'],['label'=>'Estado:','readonly', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'30','autocomplete'=>'off'],
                                                                     ['help' => 'Digite la dirección del usuario.','icon'=>'fa fa-flag-o'] ) !!}
                                    
                            </div>

                        </div>  

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-4">                                    
                                    @permission('ADMIN_CARPARK')<a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                                        Volver
                                    </a>@endpermission
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
        var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
        $(".content-ajax").load(route);
    });



    $( "#link_cancel" ).on('click', function (e) {
       var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
       $(".content-ajax").load(route);
   });




});

</script>

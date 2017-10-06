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
                {!! Form::model ([$infoUsuario], ['id'=>'form_perfil_usuario', 'url' => '/forms'])  !!}

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div>

                                    <img src="{{ asset(Storage::url($infoUsuario['CU_UrlFoto'])) }}" class=" img-circle" height="250" width="250">
                                    <br><br>
                                </div>                                    

                                    {!! Field:: text('PK_CU_Codigo',$infoUsuario['PK_CU_Codigo'],['label'=>'Código interno:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                    {!! Field:: text('CU_Cedula',$infoUsuario['CU_Cedula'],['label'=>'Cedula de ciudadanía:','readonly', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el número cedula del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                    {!! Field:: text('CU_Nombre1',$infoUsuario['CU_Nombre1'],['label'=>'Primer Nombre','readonly','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el primer nombre del usuario.','icon'=>'fa fa-user']) !!}

                                    {!! Field:: text('CU_Nombre2',$infoUsuario['CU_Nombre2'],['label'=>'Segundo Nombre:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el segundo nombre del usuario.','icon'=>'fa fa-user'] ) !!}
                            </div>
                            <div class="col-md-6">
                                    {!! Field:: text('CU_Apellido1',$infoUsuario['CU_Apellido1'],['label'=>'Primer Apellido:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!}

                                    {!! Field:: text('CU_Apellido2',$infoUsuario['CU_Apellido2'],['label'=>'Segundo Apellido:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!}

                                    {!! Field:: text('CU_Telefono',$infoUsuario['CU_Telefono'],['label'=>'Teléfono:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite el número de teléfono del usuario.','icon'=>'fa fa-phone'] ) !!}

                                    {!! Field:: email('CU_Correo',$infoUsuario['CU_Correo'],['label'=>'Correo electrónico:','readonly', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'60','autocomplete'=>'off'],
                                                                     ['help' => 'Digite un correo electronico válido.','icon'=>'fa fa-envelope-open '] ) !!}

                                    {!! Field:: text('CU_Direccion',$infoUsuario['CU_Direccion'],['label'=>'Dirección:','readonly', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'30','autocomplete'=>'off'],
                                                                     ['help' => 'Digite la dirección del usuario.','icon'=>'fa fa-building-o'] ) !!}
                                    
                                    {!! Field::select('FK_CU_IdDependencia', null,['name' => 'SelectDependencia','label'=>'Dependencia: ']) !!}

                                    {!! Field::select('FK_CU_IdEstado',['1'=>'Activo', '2'=>'Inactivo'],null,['label'=>'Estado del Usuario: ']) !!}
                            </div>

                        </div>  

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-4">                                    
                                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                                        Cancelar
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

    /* Configuración del Select cargado de la BD */

        var $widget_select_SelectDependencia = $('select[name="SelectDependencia"]');

        var route_Dependencia = '{{ route('parqueadero.usuariosCarpark.listDependencias') }}';
        $.get(route_Dependencia, function(response, status){
            $( response.data ).each(function( key,value ) {
                $widget_select_SelectDependencia.append(new Option(value.CD_Dependencia, value.PK_CD_IdDependencia));
            });
            $widget_select_SelectDependencia.val([]);
        });

    /*Configuracion de Select*/

    //$('#FK_CU_IdDependencia').val("$infoDependencia['PK_CD_IdDependencia']").trigger("$infoDependencia['CD_Dependencia']");
    // $("#FK_CU_IdDependencia option").each(function(){
    // if ($(this).text() == $infoDependencia['CD_Dependencia']){
    //     $(this).attr("selected","selected");
    // }
    // });

    ///////////////////////
    $.fn.select2.defaults.set("theme", "bootstrap");
    $(".pmd-select2").select2({
        placeholder: "Seleccionar",
        allowClear: true,
        width: 'auto',
        escapeMarkup: function (m) {
            return m;
        }
    });  

    $('.button-cancel').on('click', function (e) {
        e.preventDefault();
        var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
        $(".content-ajax").load(route);
    });

   $( ".back" ).on('click', function (e) {
       //e.preventDefault();
       var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
       $(".content-ajax").load(route);
   });   



});

</script>

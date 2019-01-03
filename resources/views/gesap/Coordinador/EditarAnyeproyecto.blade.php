<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de usuarios'])
        @slot('actions', [
            'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
                             ],
         ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                   {!! Form::model ([$infoAnte],[
                   'id' => 'form_editar_anteproyecto']) !!}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <span class="label label-primary">Modifique los datos necesarios</span>
                                 <br><br>
                            </div>
                            
                          
                             <div class="form-group divcode">
                                
                            </div>
                        <br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <a href="https://www.ucundinamarca.edu.co/index.php/proteccion-de-datos-personales" target="_blank">- Ver la Resolución No. 050 de 2018 , tratamiento de datos personales</a>
                        </div>


                        <div class="col-md-6">

                            {!! Field:: text('NPRY_Titulo',$infoAnte['NPRY_Titulo'],['label'=>'TITULO:','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                           
                            {!! Field:: text('NPRY_Keywords',$infoAnte['NPRY_Keywords'],['label'=>'PALABRAS CLAVE:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Duracion',$infoAnte['NPRY_Duracion'],['label'=>'DURACION:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                      
                            {!! Field:: date('NPRY_FechaR',$infoAnte['NPRY_FechaR'],['label'=>'FECHA INICIO:','class'=> 'form-control','autocomplete'=>'off'],
                                                             ['help' => 'Digite la fecha de inicio del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                            {!! Field:: date('NPRY_FechaL',$infoAnte['NPRY_FechaL'],['label'=>'FECHA FIN:', 'class'=> 'form-control', 'autocomplete'=>'off'],
                                                             ['help' => 'Digite la fecha fin del anteproyecto.','icon'=>'fa fa-calendar '] ) !!}

                           

                            {!! Field::select('NPRY_Estado',['1'=>'EN ESPERA', '2'=>'EN REVISION', '3'=>'PENDIENTE', '4'=>'APROVADO', '5'=>'APLAZADO', '6'=>'RECHAZADO', '7'=>'COMPLETADO'],null,['label'=>'ESTADO: ']) !!}

                            
                        
                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('ADD_ANTEPROYECTO')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('ADD_ANTEPROYECTO'){{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                    <br>
                    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endcomponent
</div>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function () {

/* Configuración del Select cargado de la BD */

var $widget_select_SelectDependencia = $('select[name="SelectDependencia"]');

var valorSelected =
    <?php echo $infoUsuario['FK_CU_IdDependencia']; ?>

var route_Dependencia = '{{ route('parqueadero.usuariosCarpark.listDependencias') }}';
$.get(route_Dependencia, function (response, status) {
    $(response.data).each(function (key, value) {
        $widget_select_SelectDependencia.append(new Option(value.CD_Dependencia, value.PK_CD_IdDependencia));
    });
    $widget_select_SelectDependencia.val();
    $('#FK_CU_IdDependencia').val(valorSelected);
});

var $widget_select_SelectEstado = $('select[name="SelectEstado"]');

var valorSelectedEstado =
    <?php echo $infoUsuario['FK_CU_IdEstado']; ?>

var route_Estado = '{{ route('parqueadero.usuariosCarpark.listEstados') }}';
$.get(route_Estado, function (response, status) {
    $(response.data).each(function (key, value) {
        $widget_select_SelectEstado.append(new Option(value.CE_Estados, value.PK_CE_IdEstados));
    });
    $widget_select_SelectEstado.val([]);
    $('#FK_CU_IdEstado').val(valorSelectedEstado);
});


/*Configuracion de Select*/

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

jQuery.validator.addMethod("letters", function(value, element) {
    return this.optional(element) || /^[a-z," "]+$/i.test(value);
});
jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
    return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
});

//////////////////////FUNCION DE EDITAR//////////////////////////////////////

var editarUsers = function () {
    return {
        init: function () {
            var route = '{{ route('parqueadero.usuariosCarpark.update') }}';
            var type = 'POST';
            var async = async || false;

            var formData = new FormData();

            formData.append('PK_CU_Codigo', $('input:text[name="PK_CU_Codigo"]').val());
            formData.append('CU_Cedula', $('input:text[name="CU_Cedula"]').val());
            formData.append('CU_Nombre1', $('input:text[name="CU_Nombre1"]').val());
            // formData.append('CU_Nombre2', $('input:text[name="CU_Nombre2"]').val());
            formData.append('CU_Apellido1', $('input:text[name="CU_Apellido1"]').val());
            // formData.append('CU_Apellido2', $('input:text[name="CU_Apellido2"]').val());
            formData.append('CU_Telefono', $('input:text[name="CU_Telefono"]').val());
            formData.append('CU_Correo', $('input[name="CU_Correo"]').val());
            formData.append('CU_Direccion', $('input:text[name="CU_Direccion"]').val());
            formData.append('FK_CU_IdEstado', $('select[name="SelectEstado"]').val());
            formData.append('FK_CU_IdDependencia', $('select[name="SelectDependencia"]').val());

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
                        $('#form_update_usuario')[0].reset(); //Limpia formulario
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
                        var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
                        location.href="{{route('parqueadero.usuariosCarpark.index')}}";
                        //$(".content-ajax").load(route);
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

var form = $('#form_update_usuario');
var formRules = {
    CU_UrlFoto: {required: true, extension: "jpg|png"},
    CU_Cedula: {minlength: 8, maxlength: 10, required: false, number: true,},
    PK_CU_Codigo: {required: false, minlength: 5, maxlength: 12, number: true},
    CU_Nombre1: {required: true, letters: true},
    // CU_Nombre2: {letters: true},
    CU_Apellido1: {required: true, letters: true},
    // CU_Apellido2: {letters: true},
    CU_Telefono: {required: false, noSpecialCharacters:true},
    CU_Correo: {required: true, email: true},
    CU_Direccion: {required: false, noSpecialCharacters:true},
    FK_CU_IdDependencia: {required: true},
    FK_CU_IdEstado: {required: true},
    acceptTeminos: {required: true},
};
var formMessage = {
    CU_Nombre1: {letters: 'Solo se pueden ingresar letras'},
    // CU_Nombre2: {letters: 'Solo se pueden ingresar letras'},
    CU_Apellido1: {letters: 'Solo se pueden ingresar letras'},
    // CU_Apellido2: {letters: 'Solo se pueden ingresar letras'},
    CU_Telefono: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
    CU_Direccion: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
};
FormValidationMd.init(form, formRules, formMessage, editarUsers());
</script>
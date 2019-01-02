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
                   {!! Form::open ([
                   'route' => 'AnteproyectosGesap.createanteproyecto',
                   'method' => 'POST',
                   'id' => 'form_crear_anteproyecto']) !!}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <span class="label label-primary">Ingrese  Los Datos</span>
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

                            {!! Field:: text('NPRY_Titulo',null,['label'=>'TITULO:','class'=> 'form-control', 'autofocus', 'maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                            {!! Field:: text('NPRY_Keywords',null,['label'=>'PALABRAS CLAVE:', 'class'=> 'form-control', 'autofocus','maxlength'=>'200','autocomplete'=>'off'],
                                                             ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Duracion',null,['label'=>'DURACION:', 'class'=> 'form-control', 'autofocus','maxlength'=>'2','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                      
                            {!! Field:: date('NPRY_FechaR',null,['label'=>'FECHA INICIO:','class'=> 'form-control','autocomplete'=>'off'],
                                                             ['help' => 'Digite la fecha de inicio del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                            {!! Field:: date('NPRY_FechaL',null,['label'=>'FECHA FIN:', 'class'=> 'form-control', 'autocomplete'=>'off'],
                                                             ['help' => 'Digite la fecha fin del anteproyecto.','icon'=>'fa fa-calendar '] ) !!}

                           

                            {!! Field::select('NPRY_Estado',['1'=>'EN ESPERA', '2'=>'EN REVISION', '3'=>'PENDIENTE', '4'=>'APROVADO', '5'=>'APLAZADO', '6'=>'RECHAZADO', '7'=>'COMPLETADO'],null,['label'=>'ESTADO: ']) !!}

                            
                            {!! Field::checkbox('acceptTeminos2', '1', ['label' => 'Acepta términos y condiciones de la resolución numero 050 de 2018.','required']) !!}

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

                                @permission('ADD_ANTEPROYECTO'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
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
<!-- file script -->
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        /*Configuracion de Select*/
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecccionar",
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

        var createAnte = function () {
            return {
                init: function () {
                    var route = '{{ route('AnteproyectosGesap.createanteproyecto') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                  

                    formData.append('NPRY_Titulo', $('input:text[name="NPRY_Titulo"]').val());
                    formData.append('NPRY_Keywords', $('input:text[name="NPRY_Keywords"]').val());
                    formData.append('NPRY_Duracion', $('input:text[name="NPRY_Duracion"]').val());
                    formData.append('NPRY_FechaR', $('input:text[name="NPRY_FechaR"]').val());
                    formData.append('NPRY_FechaL', $('input:text[name="NPRY_FechaL"]').val());
                    formData.append('NPRY_Estado', $('input[name="NPRY_Estado"]').val());
                 
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
                                if (response.data == 422) {
                                    xhr = "warning"
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
                                    location.href="{{route('AnteproyectosGesap.index')}}";
                                } else {
                                    $('#form_anteproyecto_create')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
                                    location.href="{{route('AnteproyectosGesap.index')}}";
                                     }
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
        var form = $('#form_anteproyecto_create');
        var formRules = {
         
            NPRY_Titulo: {minlength: 25, maxlength: 100, required: true, number: true,},
            NPRY_Keywords: {required:false, minlength: 50, maxlength: 200, number: true},
            NPRY_Duracion: {required: true, letters: true,minlength: 50, maxlength: 200, number: true},
            NPRY_FechaR: {required: true, letters: true},
            NPRY_FechaR: {noSpecialCharacters:true},
            NPRY_Estado: {required: true},
            acceptTeminos2: {required: true},
        };

        FormValidationMd.init(form, formRules, formMessage, createUsers());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
            location.href="{{route('AnteproyectosGesap.index')}}";
            //$(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
            location.href="{{route('AnteproyectosGesap.index')}}";
            //$(".content-ajax").load(route);
        });
     
      

    });

</script>

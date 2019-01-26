
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario para subir Actividades del Mctr008'])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            {!! Form::model ([$datos], ['id'=>'form_subir_actividad', 'url' => '/forms'])  !!}
       <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                               <br>
                            <br>
                 
                            
                             </div>


                        <div class="col-md-6">

                                {!! Field:: text('NPRY_Titulo',$datos[0]['MCT_Actividad'],['label'=>'Actividad:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                                {!! Field:: text('NPRY_Keywords',$datos[0]['MCT_descripcion'],['label'=>'DESCRIPCIÓN:', 'class'=> 'form-control','readonly', 'autofocus','maxlength'=>'200','autocomplete'=>'off'],
                                                                ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                              
                               </div>
                               <h4>'---'</h4>
                               {!! Field:: textArea('NPRY_Descripcion',null,['label'=>'INFORMACIÓN:', 'class'=> 'form-control', 'autofocus','maxlength'=>'500','autocomplete'=>'off'],
                                                                ['help' => 'Coloque una breve descrición del Anteproyecto.','icon'=>'fa fa-book'] ) !!}

                    </div>
                    

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('GESAP_CREATE_USER')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('GESAP_CREATE_USER'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
                            </div>
                            
                        </div>
                        
                    </div>
                    @permission('GESAP_ADMIN_MCT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Agregar Observación
                        </a>@endpermission
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaAnteproyecto'])
                        @slot('columns', [
                            'Observación',
                            'Realizada por'
                            
                        ])
                    @endcomponent
                     <br>
                     {!! Form::close() !!}
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
$(document).ready(function(){
   //alert('mierda') ;

    var $widget_select_Pre_Director = $('select[name="SelectPre_Director"]');

    var route_Pre_Director = '{{ route('AnteproyectoGesap.listarpredirector') }}';
    $.get(route_Pre_Director, function (response, status) {
    $(response.data).each(function (key, value) {
        $widget_select_Pre_Director.append(new Option(value.User_Nombre1, value.PK_User_Codigo ));
    });
    $widget_select_Pre_Director.val([]);
    $('#FK_NPRY_Pre_Director').val();
    });

    jQuery.validator.addMethod("numbers", function(value, element) {
            return this.optional(element) || /^[0-9," "]+$/i.test(value);
        });
    jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
        });
  
/*Configuracion de Select*/
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Seleccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

       


   //$("#Registrar").on('click', function(){
     //  alert('Entro');
       var crearante = function(){
           return{
               init : function (){
                    var formData = new FormData();
                    var route = '{{ route('AnteproyectosGesap.store') }}';
                    var async = async || false;

                    formData.append('NPRY_Titulo', $('input:text[name="NPRY_Titulo"]').val());
                    formData.append('NPRY_Keywords', $('input:text[name="NPRY_Keywords"]').val());
                    formData.append('NPRY_Descripcion', $('input:text[name="NPRY_Descripcion"]').val());
                    formData.append('NPRY_Duracion', $('input:text[name="NPRY_Duracion"]').val());
                    formData.append('FK_NPRY_Pre_Director', $('select[name="SelectPre_Director"]').val());
                    formData.append('FK_NPRY_Estado', '1');
                    
                    $.ajax({
                        url: route,
                        type: 'POST',
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: async || false,
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
                                                $('#form_anteproyectos_create')[0].reset(); 
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
                                            
                    })

               }
           }
       }
       var form = $('#form_anteproyectos_create');
        var formRules = {
            NPRY_Titulo: {minlength: 8, maxlength: 100, required: true,},
            NPRY_Keywords: {minlength: 30, maxlength: 200, required: true,},
            NPRY_Descripcion: {minlength: 30, maxlength: 250, required: true,},
            NPRY_Duracion: {minlength: 1, maxlength: 2,required: true,numbers: true,noSpecialCharacters: true,},
            SelectPre_Director: {required: true},
            FK_NPRY_Estado: {required: true},
            acceptTeminos2:{required: true},
        };

        var formMessage = {
            NPRY_Duracion: {numbers: 'Solo se pueden ingresar numeros'},
            NPRY_Duracion: {noSpecialCharacters: 'Solo se pueden ingresar numeros'},
        
        };

        FormValidationMd.init(form, formRules, formMessage, crearante());
        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
            location.href="{{route('AnteproyectosGesap.index')}}";
            //$(".content-ajax").load(route);
        });
   // });
    
})
</script>    

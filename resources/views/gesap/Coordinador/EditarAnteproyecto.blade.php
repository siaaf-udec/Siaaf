<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos del Anteproyecto'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$infoAnte], ['id'=>'form_update_anteproyecto', 'url' => '/forms'])  !!}

                <div class="form-body">
                    <div class="row">
                       
                            {!! Field:: text('PK_NPRY_IdMctr008',$infoAnte[0]['PK_NPRY_IdMctr008'],['label'=>'Código interno:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Codigo Interno Del Anteproyecto.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('NPRY_Titulo',$infoAnte[0]['NPRY_Titulo'],['label'=>'TITULO:','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                            {!! Field:: text('NPRY_Keywords',$infoAnte[0]['NPRY_Keywords'],['label'=>'PALABRAS CLAVE:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Descripcion',$infoAnte[0]['NPRY_Descripcion'],['label'=>'DESCRIPCION:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Duracion',$infoAnte[0]['NPRY_Duracion'],['label'=>'DURACION:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}
                            {!! Field:: text('NPRY_FCH_Radicacion',$infoAnte[0]['NPRY_FCH_Radicacion'],['label'=>'FECHA RADIACIÓN:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-user'] ) !!}
                          
                            
                            {!! Field:: text('FK_NPRY_Estado',$infoAnte['Estado'],['label'=>'ESTADO:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-user'] ) !!}  
                            
                            {!! Field::select('FK_NPRY_Pre_Director', null,['name' => 'SelectPre_Director','label'=>'Pre Director:']) !!}
                      
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                @permission('UPDATE_ANTE')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission
                                @permission('UPDATE_ANTE'){{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endcomponent


<!-- Modal Update Foto -->
   
    <div class="modal-footer">

{!! Form::close() !!}
</div>

    <!-- Fin Modal Update Foto -->


</div>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {
        
   
   
        var $widget_select_Pre_Director = $('select[name="SelectPre_Director"]');
        var valorSelectedPre = <?php echo $infoAnte[0]['FK_NPRY_Pre_Director']; ?>

        var route_Pre_Director = '{{ route('AnteproyectoGesap.listarpredirector') }}';
        $.get(route_Pre_Director, function (response, status) {
        $(response.data).each(function (key, value) {
            $widget_select_Pre_Director.append(new Option(value.User_Nombre1, value.PK_User_Codigo ));
        });
            $widget_select_Pre_Director.val([]);
            $('#FK_NPRY_Pre_Director').val(valorSelectedPre);
        });

        
        $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });

            jQuery.validator.addMethod("numbers", function(value, element) {
            return this.optional(element) || /^[0-9," "]+$/i.test(value);
        });
     jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
        });
        
     $estado = '{{ $infoAnte[0]['FK_NPRY_Estado'] }}';
    var updateAnte = function(){
        
           return{
               init : function (){
                    var formData = new FormData();
                    var route = '{{ route('AnteproyectoGesap.updateAnte') }}';
                    var async = async || false;
                    
                    formData.append('NPRY_Titulo', $('input:text[name="NPRY_Titulo"]').val());
                    formData.append('NPRY_Keywords', $('input:text[name="NPRY_Keywords"]').val());
                    formData.append('NPRY_Descripcion', $('input:text[name="NPRY_Descripcion"]').val());
                    formData.append('NPRY_Duracion', $('input:text[name="NPRY_Duracion"]').val());
                    formData.append('FK_NPRY_Pre_Director', $('select[name="SelectPre_Director"]').val());
                    //formData.append('FK_NPRY_Estado', $estado;
                    formData.append('PK_NPRY_IdMctr008', $('input:text[name="PK_NPRY_IdMctr008"]').val());
                    
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
                                $('#form_update_anteproyecto')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
                                location.href="{{route('AnteproyectosGesap.index')}}";
                                
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
       var form = $('#form_update_anteproyecto');
        var formRules = {
            NPRY_Titulo: {minlength: 1, maxlength: 100, required: true,},
            NPRY_Keywords: {minlength: 1, maxlength: 200, required: true,},
            NPRY_Descripcion: {minlength: 1, maxlength: 250, required: true,},
            NPRY_Duracion: {minlength: 1, maxlength: 2,required: true,numbers: true,noSpecialCharacters: true,},
            SelectPre_Director: {required: true},
            SelectEstado: {required: true},
         
        };

        var formMessage = {
            NPRY_Duracion: {numbers: 'Solo se pueden ingresar numeros'},
            NPRY_Duracion: {noSpecialCharacters: 'Solo se pueden ingresar numeros'},
        
        };

        FormValidationMd.init(form, formRules, formMessage, updateAnte());



    $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
            location.href="{{route('AnteproyectosGesap.index')}}";
            //$(".content-ajax").load(route);
        });
    });
</script>

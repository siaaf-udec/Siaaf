<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de monitoreo y control:'])
    <h4 style="margin-top: 0px;">Proceso: Controlar la calidad.</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([[$calidad],[$idProceso],[$infoProyecto]],['id'=>'form_create_proceso_20', 'url' => '/forms']) !!}
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">

                            {!! Field:: hidden ('idProyecto', $infoProyecto[0]['PK_CP_Id_Proyecto'])!!}
                            {!! Field:: hidden ('idProceso', $idProceso) !!}  
                            {!! Field:: hidden ('idAseguramiento', $calidad['PK_CPA_Id_Aseguramiento']) !!}  

                            {!! Field::select('Desempeño_select',
                            ['1' => 'Muy bueno', '2' => 'Bueno',
                            '3' => 'Malo', '4' => 'Muy malo'],
                            null,
                            [ 'label' => 'Desempeño del equipo:', 'name' => 'Desempeño', 'required']) !!}

                            {!! Field::textArea('Recomendaciones',['label' => 'Recomendaciones:', 'required', 'auto' => 'off', 'max' => '500', "rows" => '2'],
                            ['help' => 'Escribe las recomendaciones para el equipo.', 'icon' => 'fa fa-quote-right']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                                Cancelar
                            </a>
                            {{ Form::submit('Guardar', ['class' => 'btn blue']) }}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });

        $(".pmd-select2").select2({
            width: '100%',
            placeholder: "Selecccionar",
        });

        var enviarFormulario = function() {
            return {
                init: function() {
                    console.log($('input:hidden[name="idProceso"]').val());
                    var route = '{{route('calidadpcs.procesosCalidad.storeProceso20')}}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    
                    formData.append('Recomendaciones', $('#Recomendaciones').val());
                    formData.append('Desempeño', $('select[name="Desempeño"]').val());
                    formData.append('Proceso_id',$('input:hidden[name="idProceso"]').val());
                    formData.append('Proyecto_id',$('input:hidden[name="idProyecto"]').val());
                    formData.append('idAseguramiento',$('input:hidden[name="idAseguramiento"]').val());
                    
                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function() {
                            App.blockUI({
                                target: '.portlet-form',
                                animate: true
                            });
                        },
                        success: function(response, xhr, request) {
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_create_proceso_20')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{route('calidadpcs.proyectosCalidad.index.ajax')}}';
                                location.href = "{{route('calidadpcs.proyectosCalidad.index')}}";
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form = $('#form_create_proceso_20');
        var formRules = {
            Recomendaciones:{ required: true, minlength: 2, maxlength: 500, noSpecialCharacters:true, letters:false },
            Desempeño:{ required: true },
        };
        var formMessage = {
            Recomendaciones: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, enviarFormulario());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

    });
</script>
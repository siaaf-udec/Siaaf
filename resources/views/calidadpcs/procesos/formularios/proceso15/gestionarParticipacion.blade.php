<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de ejecucion:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Proceso: Gestionar la participación de los interesados.</h4>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
        <div class="col-md-10 col-md-offset-1">
            {!! Form::model ([[$idProceso],[$idProyecto],[$infoProyecto]],['id'=>'form_create_proceso_15', 'url' => '/forms']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">

                        {!! Field:: hidden ('idProyecto', $idProyecto) !!}  
                        {!! Field:: hidden ('idProceso', $idProceso) !!}  

                        {!! Field::textArea('Necesidades',['label' => 'Necesidades:', 'required', 'auto' => 'off', 'max' => '500', "rows" => '2'],
                                        ['help' => 'Escribe el alcance del proyecto.', 'icon' => 'fa fa-quote-right']) !!}

                        {!! Field::textArea('Expectativas',['label' => 'Expectativas:', 'required', 'auto' => 'off', 'max' => '500', "rows" => '2'],
                                        ['help' => 'Escribe el alcance del proyecto.', 'icon' => 'fa fa-quote-right']) !!}
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                       <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                            Cancelar
                        </a>
                        {{ Form::submit('Continuar', ['class' => 'btn blue']) }}
                        
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
<script type="text/javascript">
    jQuery(document).ready(function() {

        var enviarFormulario = function() {
            return {
                init: function() {
                    var route = '{{route('calidadpcs.procesosCalidad.storeProceso15')}}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    
                    formData.append('Proyecto_id',$('input:hidden[name="idProyecto"]').val());
                    formData.append('Proceso_id',$('input:hidden[name="idProceso"]').val());
                    formData.append('Necesidades', $("#Necesidades").val());
                    formData.append('Expectativas',$("#Expectativas").val());
                    
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
                                $('#form_create_proceso_15')[0].reset(); //Limpia formulario
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
        var form = $('#form_create_proceso_15');
        var formRules = {
            // Numero_acta: {
            //     minlength: 2,
            //     maxlength: 20,
            //     required: true,
            //     noSpecialCharacters: true
            // },
            // Duracion: {
            //     minlength: 1,
            //     maxlength: 2,
            //     required: true,
            //     noSpecialCharacters: true
            // },
        };
        var formMessage = {
            // Numero_acta: {
            //     noSpecialCharacters: 'Existen caracteres que no son válidos'
            // },
        };
        FormValidationMd.init(form, formRules, formMessage, enviarFormulario());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });
        

    });
</script> 
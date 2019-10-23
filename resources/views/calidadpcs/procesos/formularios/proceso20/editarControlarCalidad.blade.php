<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de monitoreo y control:'])
    <h4 style="margin-top: 0px;">Editar proceso: Controlar la calidad.</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([[$calidad],[$idProceso],[$idProyecto]],['id'=>'form_create_proceso_20', 'url' => '/forms']) !!}
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">

                            {!! Field:: hidden ('idAseguramiento', $calidad['PK_CPA_Id_Aseguramiento']) !!}  

                            {!! Field::select('Desempeño_select',
                            ['1' => 'Muy bueno', '2' => 'Bueno',
                            '3' => 'Malo', '4' => 'Muy malo'],
                            null,
                            [ 'label' => 'Desempeño del equipo:', 'name' => 'Desempeño']) !!}

                            {!! Field::textArea('Recomendaciones',['label' => 'Recomendaciones:', 'required', 'auto' => 'off', 'max' => '300', "rows" => '2'],
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
<script type="text/javascript">
    jQuery(document).ready(function() {

        route_edit = "{{ route('calidadpcs.procesosCalidad.info20') }}"+ '/'+ {{$idProyecto}};
        $.get(route_edit, function(info){
            $('select[name="Desempeño"]').val(info[0]['CPA_Desempeño']);
            $('select[name="Desempeño"]').trigger('change');
            $('#Recomendaciones').val(info[0]['CPA_Recomendaciones']);
        });

        $(".pmd-select2").select2({
            width: '100%',
            placeholder: "Selecccionar",
        });

        var enviarFormulario = function() {
            return {
                init: function() {
                    console.log($('input:hidden[name="idProceso"]').val());
                    var route = '{{route('calidadpcs.procesosCalidad.updateProceso20')}}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    
                    formData.append('Recomendaciones', $('#Recomendaciones').val());
                    formData.append('Desempeño', $('select[name="Desempeño"]').val());
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
                                //$(".content-ajax").load(route);
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
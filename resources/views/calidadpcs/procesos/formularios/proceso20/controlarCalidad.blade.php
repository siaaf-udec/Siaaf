<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de monitoreo y control:'])
    <h4 style="margin-top: 0px;">Proceso: Controlar la calidad.</h4>
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="panel-group accordion" id="date-range">
                    <!--Primer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_1"><strong>CMMI:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                <strong>Nivel de madurez:</strong> 2. <br><strong>Meta especifica:</strong>  Aseguramiento de la calidad del proceso y del producto.<br><strong>Propósito: </strong>El propósito 
                                del Aseguramiento de la Calidad del Proceso y del Producto (PPQA) es proporcionar al personal y a la gerencia una visión objetiva de los procesos y de los productos de trabajo 
                                asociados.<br><br><strong>Notas introductorias: </strong>El área de proceso de Aseguramiento de la Calidad del Proceso y del Producto implica las siguientes actividades: y Evaluar 
                                objetivamente los procesos realizados y los productos de trabajo frente a las descripciones de proceso, los estándares y los procedimientos aplicables. y Identificar y documentar 
                                las no conformidades. y Proporcionar realimentación al personal del proyecto y a los gerentes sobre los resultados de las actividades de aseguramiento de la calidad. y Asegurar que 
                                se tratan las no conformidades.<br><br>Evaluar objetivamente los procesos y los productos de trabajo.<br>- Evaluar objetivamente los procesos.<br>- Evaluar objetivamente los productos 
                                de trabajo.<br>Proporcionar una visión objetiva.<br>- Comunicar y resolver las no conformidades.<br>- Establecer los registros.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Segundo acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_2"><strong>SCRUM:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                Roles Scrum que son necesarios para este proceso:<br><strong>Product Owner: </strong>{{ $equipoScrum[1]['CE_Nombre_Persona'] }}<br><strong>Scrum Master:</strong> 
                                    {{$equipoScrum[0]['CE_Nombre_Persona'] }}.<br><br><strong>Equipo desarrollo</strong>
                                    @foreach ($integrantes_equipo as $integrante)
                                    <br><strong>Integrante: </strong> {{$integrante->CE_Nombre_Persona}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Tercer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_3"><strong>PMBOK:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                <strong>Proceso: </strong>Controlar la Calidad.<br><br><strong>Controlar la Calidad: </strong>Es el proceso por el que se monitorea y se registran los resultados de 
                                la ejecución de las actividades de control de calidad, a fin de evaluar el desempeño y recomendar los cambios necesarios.<br><br>La Gestión de la Calidad del Proyecto 
                                incluye los procesos y actividades de la organización ejecutora que establecen las políticas de calidad, los objetivos y las responsabilidades de calidad para que el 
                                proyecto satisfaga las necesidades para las que fue acometido. La Gestión de la Calidad del Proyecto utiliza políticas y procedimientos para implementar el sistema de 
                                gestión de la calidad de la organización en el contexto del proyecto, y, en la forma que resulte adecuada, apoya las actividades de mejora continua del proceso, tal y 
                                como las lleva a cabo la organización ejecutora. La Gestión de la Calidad del Proyecto trabaja para asegurar que se alcancen y se validen los requisitos del proyecto, 
                                incluidos los del producto.
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
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
<script src = "{{ asset('assets/main/calidadpcs/table-datatable.js') }}" type = "text/javascript" ></script>
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
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de ejecucion:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Proceso: Gestionar la participación de los interesados.</h4>
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
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Verificación.<br><strong>Propósito: </strong>El propósito de la Verificación (VER) es asegurar 
                                que los productos de trabajo seleccionados cumplen los requisitos especificados.<br><br><strong>Notas introductorias: </strong>El área de proceso Verificación implica lo siguiente: 
                                preparación de la verificación, realización de la verificación e identificación de acciones correctivas. La verificación incluye la verificación del producto y de los productos de 
                                trabajo intermedios frente a todos los requisitos seleccionados, incluyendo requisitos de cliente, de producto y de componente de producto. Para líneas de producto, también se debería 
                                verificar los activos base y sus mecanismos asociados de variación de la línea de producto. A lo largo de las áreas de proceso, donde se utilizan los términos “producto” y “componente 
                                de producto”, los significados también abarcan los servicios, los sistemas de servicio y sus componentes. La verificación es, intrínsecamente, un proceso incremental debido a que se 
                                realiza durante el desarrollo del producto y de los productos de trabajo, comenzando con la verificación de los requisitos, continuando con la verificación de los productos de trabajo 
                                que se van desarrollando, y culminando con la verificación del producto terminado.<br><br>Preparar la verificación.<br>- Seleccionar los productos de trabajo para la verificación.<br>
                                - Establecer el entorno de verificación.<br>- Establecer los procedimientos y los criterios de verificación.<br>Realizar las revisiones entre pares.<br>- Preparar las revisiones entre 
                                pares.<br>-	Realizar las revisiones entre pares.<br>- Analizar los datos de las revisiones entre pares.
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
                                    Roles Scrum que son necesarios para este proceso:<br><strong>Scrum Master:</strong>{{$equipoScrum[0]['CE_Nombre_Persona'] }}.<br><strong>Equipo desarrollo</strong>
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
                                <strong>Proceso:</strong>Gestionar la Participación de los Interesados.<br><br><strong>Gestionar la Participación de los Interesados: </strong> El proceso de comunicarse 
                                y trabajar con los interesados para satisfacer sus necesidades/expectativas, abordar los incidentes en el momento en que ocurren y fomentar la participación adecuada de los 
                                interesados en las actividades del proyecto a lo largo del ciclo de vida del mismo.<br><br>La Gestión de los Interesados del Proyecto incluye los procesos necesarios para 
                                identificar a las personas, grupos u organizaciones que pueden afectar o ser afectados por el proyecto, para analizar las expectativas de los interesados y su impacto en el 
                                proyecto, y para desarrollar estrategias de gestión adecuadas a fin de lograr la participación eficaz de los interesados en las decisiones y en la ejecución del proyecto. La 
                                gestión de los interesados también se centra en la comunicación continua con los interesados para comprender sus necesidades y expectativas, abordando los incidentes en el momento 
                                en que ocurren, gestionando conflictos de intereses y fomentando una adecuada participación de los interesados en las decisiones y actividades del proyecto. La satisfacción de los 
                                interesados debe gestionarse como uno de los objetivos clave del proyecto.
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
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
                                        ['help' => 'Escribe las necesidades del proyecto.', 'icon' => 'fa fa-quote-right']) !!}

                        {!! Field::textArea('Expectativas',['label' => 'Expectativas:', 'required', 'auto' => 'off', 'max' => '500', "rows" => '2'],
                                        ['help' => 'Escribe las expextativas del proyecto.', 'icon' => 'fa fa-quote-right']) !!}
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
<script src = "{{ asset('assets/main/calidadpcs/table-datatable.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });

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
            Necesidades:{ required: true, minlength: 2, maxlength: 500, noSpecialCharacters:true, letters:false },
            Expectativas:{ required: true, minlength: 2, maxlength: 500, noSpecialCharacters:true, letters:false },
        };
        var formMessage = {
            Necesidades: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Expectativas: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, enviarFormulario());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });
    });
</script> 
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de ejecucion:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Editar proceso: Aseguramiento de calidad.</h4>
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
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Gestión Integrada del proyecto.<br><strong>Propósito: </strong>El propósito de la 
                                Gestión Integrada del Proyecto (IPM) es establecer y gestionar el proyecto y la involucración de las partes interesadas relevantes de acuerdo a un proceso 
                                integrado y definido, que se adapta a partir del conjunto de procesos estándar de la organización.<br><strong>Notas introductorias</strong><br>La Gestión 
                                Integrada del Proyecto implica las siguientes actividades:<br>Establecer el proceso definido del proyecto al inicio del mismo, mediante la adaptación del 
                                conjunto de procesos estándar de la organización.<br>Gestionar el proyecto utilizando el proceso definido del proyecto.<br>Establecer el entorno de trabajo para 
                                el proyecto, basándose en los estándares del entorno de trabajo de la organización.<br>Establecer los equipos que tienen la tarea de conseguir los objetivos del 
                                proyecto.<br>Utilizar y contribuir a los activos de proceso de la organización.<br>Posibilitar que los intereses de las partes interesadas relevantes se identifiquen, 
                                se consideren y, cuando sea apropiado, se traten durante el proyecto.<br>Asegurar que las partes interesadas relevantes (1) realizan sus tareas de forma coordinada 
                                y oportuna; (2) tratan los requisitos, los planes, los objetivos, los problemas y los riesgos del proyecto; (3) cumplen sus compromisos; (4) e identifican, siguen 
                                y resuelven las cuestiones de coordinación.<br>Coordinar y colaborar con las partes interesadas relevantes.<br>Gestionar la involucración de las partes interesadas.
                                <br>Gestionar las dependencias.<br>Resolver las cuestiones de coordinación.
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
                                <strong>Proceso:</strong> Aseguramiento de calidad.<br><br><strong>Realizar el Aseguramiento de Calidad: </strong>Es el proceso que consiste en auditar 
                                los requisitos de calidad y los resultados de las mediciones de control de calidad, para asegurar que se utilicen las normas de calidad y las definiciones operacionales 
                                adecuadas.
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="col-md-10 col-md-offset-1">
            {!! Form::model ([$practicas],['id'=>'form_create_proceso_11', 'url' => '/forms']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Field:: hidden ('idAseguramiento', $practicas->PK_CPA_Id_Aseguramiento) !!} 

                        {!! Field::textArea('Aseguramiento',$practicas->CPA_Aseguramiento,['label' => 'Buenas practicas a realizar para asegurar la calidad del proyecto:', 'required', 'auto' => 'off', 'max' => '500', "rows" => '2'],
                                        ['help' => 'Escribe las buenas practicas.', 'icon' => 'fa fa-quote-right']) !!}
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                        <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                            Cancelar
                        </a>
                        {{ Form::submit('Actualizar', ['class' => 'btn blue']) }}
                      
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
                    var route = '{{route('calidadpcs.procesosCalidad.updateProceso11')}}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();

                    formData.append('idAseguramiento',$('input:hidden[name="idAseguramiento"]').val());
                    formData.append('Aseguramiento', $('#Aseguramiento').val());
                    
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
                                $('#form_create_proceso_11')[0].reset(); //Limpia formulario
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
        var form = $('#form_create_proceso_11');
        var formRules = {
            Practicas: { required: true, minlength: 2, maxlength: 500, noSpecialCharacters:true, letters:false },
        };
        var formMessage = {
            Practicas: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, enviarFormulario());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

    });
</script> 
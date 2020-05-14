<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de monitoreo y control:'])
    <h4 style="margin-top: 0px;">Proceso: Controlar la participación de los interesados.</h4>
    
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="panel-group accordion" id="date-range">
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_3"><strong>PMBOK:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                <strong>Proceso: </strong>Controlar la Participación de los Interesados.<br><br><strong> Controlar la Participación de los Interesados: </strong> El proceso de 
                                monitorear globalmente las relaciones de los interesados del proyecto y ajustar las estrategias y los planes para involucrar a los interesados.<br><br>
                                La Gestión de los Interesados del Proyecto incluye los procesos necesarios para identificar a las personas, grupos u organizaciones que pueden afectar o ser afectados 
                                por el proyecto, para analizar las expectativas de los interesados y su impacto en el proyecto, y para desarrollar estrategias de gestión adecuadas a fin de lograr la 
                                participación eficaz de los interesados en las decisiones y en la ejecución del proyecto. La gestión de los interesados también se centra en la comunicación continua con 
                                los interesados para comprender sus necesidades y expectativas, abordando los incidentes en el momento en que ocurren, gestionando conflictos de intereses y fomentando 
                                una adecuada participación de los interesados en las decisiones y actividades del proyecto. La satisfacción de los interesados debe gestionarse como uno de los objetivos 
                                clave del proyecto.
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
        <div class="col-md-10 col-md-offset-1">
            {!! Form::model ([[$interesados],[$idProceso],[$idProyecto]],['id'=>'form_create_proceso_24', 'url' => '/forms']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">

                        {!! Field:: hidden ('id_Proyecto', $idProyecto)!!}

                        {!! Field:: hidden ('id_interesado', $interesados['PK_CPI_Id_Interesados']) !!}  

                        {!! Field::select('participacion',
                                          ['1' => 'Buena', '2' => 'Mala'],
                                          null,
                                          [ 'label' => 'Como fue la participacion de los interesados:','name' => 'Participacion']) !!}

                        {!! Field::textArea('Observaciones',['label' => 'Observaciones:', 'required', 'auto' => 'off', 'max' => '500', "rows" => '2'],
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

        route_edit = "{{ route('calidadpcs.procesosCalidad.info24') }}"+ '/'+ {{$idProyecto}};
        $.get(route_edit, function(info){
            $('select[name="Participacion"]').val(info[0]['CPI_Participacion']);
            $('select[name="Participacion"]').trigger('change');
            $('#Observaciones').val(info[0]['CPI_Observaciones']);
        });
       

        $(".pmd-select2").select2({
                width: '100%',
                placeholder: "Selecccionar",
            });

            var enviarFormulario = function() {
            return {
                init: function() {
                    console.log($('input:hidden[name="idProceso"]').val());
                    var route = '{{route('calidadpcs.procesosCalidad.updateProceso24')}}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    
                    formData.append('Observaciones', $('#Observaciones').val());
                    formData.append('Participacion', $('select[name="Participacion"]').val());
                    formData.append('idInteresado',$('input:hidden[name="id_interesado"]').val());
                    
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
                                $('#form_create_proceso_24')[0].reset(); //Limpia formulario
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
        var form = $('#form_create_proceso_24');
        var formRules = {
            Observaciones:{ required: true, minlength: 2, maxlength: 500, noSpecialCharacters:true, letters:false },
            Participacion:{ required: true },
        };
        var formMessage = {
            Observaciones: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, enviarFormulario());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });


    });
</script> 
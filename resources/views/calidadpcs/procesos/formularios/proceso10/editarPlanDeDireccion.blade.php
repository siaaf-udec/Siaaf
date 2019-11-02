<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de ejecucion:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Editar proceso: Plan para la Dirección del proyecto.</h4>
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
                                <strong>Nivel de madurez:</strong> 2. <br><strong>Meta especifica:</strong> Gestión de Acuerdos con Proveedores.<br><strong>Propósito: </strong>El propósito de 
                                la Gestión de Acuerdos con Proveedores (SAM) es gestionar la adquisición de productos y servicios de proveedores.<strong>Notas introductorias: </strong>El alcance
                                de esta área de proceso aborda la adquisición de productos, servicios y componentes de producto y de servicio que pueden ser entregados al cliente del proyecto o 
                                incluidos en un producto o sistema de servicios. Estas prácticas del área de proceso también pueden ser utilizadas para otros propósitos que beneficien al proyecto 
                                (p.ej., compra de consumibles). Esta área de proceso no se aplica en todos los contextos en los que se adquieren los componentes comerciales (COTS), sino que se 
                                aplica en los casos donde hay modificaciones a los componentes (COTS), en componentes comerciales de gobierno, o en software libre, que son un valor importante 
                                para el proyecto o que representan un riesgo importante para el proyecto. En las áreas de proceso, donde se utilizan los términos “producto” y “componente de 
                                producto”, sus significados también abarcan servicios, sistemas de servicio y sus componentes. El área de proceso Gestión de Acuerdos con proveedores implica las 
                                siguientes actividades:<br>Ejecutar los acuerdos del proveedor.<br>Aceptar la entrega de los productos adquiridos.<br>Asegurar una transición satisfactoria de los 
                                productos adquiridos.
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
                                <strong>Proceso:</strong> Plan para la Dirección del Proyecto.<br><br><strong>Desarrollar el Plan para la Dirección del Proyecto: </strong> Es el proceso de definir, 
                                preparar y coordinar todos los planes secundarios e incorporarlos en un plan integral para la dirección del proyecto. Las líneas base y planes secundarios integrados 
                                del proyecto pueden incluirse dentro del plan para la dirección del proyecto.
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
            {!! Form::model ([[$idProceso],[$idProyecto],[$alcance],[$infoProyecto]],['id'=>'form_plan_direccion', 'url' => '/forms']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Field:: hidden ('metodologia_id',$alcance->PK_CPPD_Id_Direccion) !!}
                        {!! Field:: hidden ('idProceso',$idProceso) !!}
                        {!! Field:: hidden ('idProyecto',$idProyecto) !!}


                        {!! Field::textArea('Alcance',$alcance->CPPD_Alcance,['label' => 'Alcance:', 'auto' => 'off', "rows" => '4','readonly'],
                                        ['help' => 'Escribe el alcance del proyecto.', 'icon' => 'fa fa-quote-right']) !!}

                        {!! Field::textArea('Metodologia',$alcance->CPPD_Metodologia,['label' => 'Metodologia de trabajo:', 'required', 'auto' => 'off', 'max' => '500', "rows" => '4'],
                                        ['help' => 'Escribe la metodologia del proyecto.', 'icon' => 'fa fa-commenting-o']) !!}
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
                    var route = '{{route('calidadpcs.procesosCalidad.updateProceso10')}}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    
                    formData.append('Metodologia', $('#Metodologia').val());
                    formData.append('id_metodologia',$('input:hidden[name="metodologia_id"]').val());
                    
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
                                $('#form_plan_direccion')[0].reset(); //Limpia formulario
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
        var form = $('#form_plan_direccion');
        var formRules = {
            Metodologia: { required: true, minlength: 2, maxlength: 500, noSpecialCharacters:true, letters:false},
        };
        var formMessage = {
            Metodologia: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, enviarFormulario());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });
    });
</script> 
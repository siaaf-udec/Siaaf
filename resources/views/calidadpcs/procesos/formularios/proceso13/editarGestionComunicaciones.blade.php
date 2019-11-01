<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de ejecucion:'])
    <div class="row">
        <div class="col-md-12">
            <h4 style="margin-top: 0px;">Editar proceso: Gestionar las Comunicaciones.</h4>
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
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Integración del producto.<br><strong>Propósito: </strong>El propósito de la Integración del Producto 
                                (PI) es ensamblar el producto a partir de sus componentes, asegurar que el producto, una vez integrado, se comporta correctamente (es decir, posee la funcionalidad y los atributos 
                                de calidad requeridos) y entregar el producto.<br><br><strong>Notas introductorias: </strong>Esta área de proceso trata la integración de componentes de producto dentro de componentes 
                                de producto más complejos o dentro de productos completos. El alcance de esta área de proceso es lograr la integración del producto completo a través de un ensamblaje progresivo de los 
                                componentes de producto, en una etapa o en etapas incrementales, de acuerdo a una estrategia y procedimientos de integración definidos. En todas las áreas de procesos donde se utilizan 
                                los términos “producto” y “componente de producto”, sus significados pretenden también englobar servicios, sistemas de servicios y sus componentes. Un aspecto crítico de la integración 
                                del producto es la gestión de las interfaces, internas y externas, de los productos y de los componentes de producto para asegurar la compatibilidad entre las interfaces. Estas interfaces 
                                no se restringen a las interfaces de usuario, sino que también se aplican a las interfaces entre componentes del producto, incluyendo fuentes de datos internas y externas, middleware y 
                                otros componentes que pueden o no estar dentro del control de la organización de desarrollo, pero de las que depende el producto. Debería prestarse atención a la gestión de la interfaz a 
                                lo largo del proyecto.<br>Prepararse para la integración del producto.<br>- Establecer una estrategia de integración.<br>- Establecer el entorno de integración del producto.<br>- Establecer 
                                los procedimientos y los criterios de integración del producto.<br>Asegurar la compatibilidad de las interfaces.<br>- Revisar la completitud de las descripciones de las interfaces.<br>
                                - Gestionar las interfaces. SG 3.<br>Ensamblar los componentes de producto y entregar el producto.<br>-	Confirmar la disponibilidad de los componentes de producto para la integración.<br>
                                - Ensamblar los componentes de producto.<br>- Evaluar los componentes de producto ensamblados.<br>-	Empaquetar y entregar el producto o componente de producto.
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
                                <strong>Proceso:</strong> Adquirir, desarrollar y dirigir equipo del proyecto.<br><br><strong>Gestionar las Comunicaciones: </strong>El proceso de crear, recopilar, 
                                distribuir, almacenar, recuperar y realizar la disposición final de la información del proyecto de acuerdo con el plan de gestión de las comunicaciones.
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
                {!! Form::model ([[$idProceso],[$idProyecto],[$comunicacion]],['id'=>'form_create_proceso_13', 'url' => '/forms']) !!}
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">

                            {!! Field:: hidden ('idGestion', $comunicacion->PK_CPC_Id_Comunicaciones) !!}

                            {!! Field::select('Medio',['Oral' => 'Oral', 'Escrita' => 'Escrita', 'Virtual' => 'Virtual'],null,
                                    [ 'label' => 'Medio:', 'name'=> 'TipoMedio']) !!}

                            <div id="campo_adicional">
                                {!! Field:: text('Redaccion',['label'=>'Especificaciones:', 'max' => '500', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}
                            </div>
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

        route_edit = "{{ route('calidadpcs.procesosCalidad.info13') }}"+ '/'+ {{$idProyecto}};
        $.get(route_edit, function(info){
            $('select[name="TipoMedio"]').val(info[0]['CPC_Medio']);
            $('select[name="TipoMedio"]').trigger('change');
            $('input:text[name="Redaccion"]').val(info[0]['CPC_Redaccion']);
        });

        $('#campo_adicional').hide();
        $('select[name="TipoMedio"]').change(function() {
            if ($('select[name="TipoMedio"]').val() == 'Escrita' || $('select[name="TipoMedio"]').val() == 'Virtual') {
                $('#campo_adicional').show();
            } else {
                $('#campo_adicional').hide();
                $("#Redaccion").val('');
            }
        })
        $(".pmd-select2").select2({
            width: '100%',
            placeholder: "Selecccionar",
        });

        // console.log({{$comunicacion}});

        var enviarFormulario = function() {
            return {
                init: function() {
                    console.log($('input:hidden[name="Id_Proyecto"]').val());
                    var route = '{{route('calidadpcs.procesosCalidad.updateProceso13')}}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    
                    formData.append('idGestion',$('input:hidden[name="idGestion"]').val());
                    formData.append('Medio', $('select[name="TipoMedio"]').val() );
                    formData.append('Redaccion',$('input:text[name="Redaccion"]').val());
                    
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
                                $('#form_create_proceso_13')[0].reset(); //Limpia formulario
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
        var form = $('#form_create_proceso_13');
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
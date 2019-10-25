<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de ejecucion:'])
    <div class="row">
        <div class="col-md-12">
            <h4 style="margin-top: 0px;">Proceso: Gestionar las Comunicaciones.</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([[$idProceso],[$idProyecto],[$infoProyecto]],['id'=>'form_create_proceso_13', 'url' => '/forms']) !!}
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">

                            {!! Field:: hidden ('Id_Proyecto', $idProyecto) !!}
                            {!! Field:: hidden ('Id_Proceso', $idProceso) !!}

                            {!! Field::select('Medio',
                            ['Oral' => 'Oral', 'Escrita' => 'Escrita', 'Virtual' => 'Virtual'],
                            null,
                            [ 'label' => 'Medio:', 'name'=> 'TipoMedio']) !!}
                            <div id="campo_adicional">

                                {!! Field:: text('Redaccion',['label'=>'Especificaciones:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
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
        var enviarFormulario = function() {
            return {
                init: function() {
                    console.log($('input:hidden[name="Id_Proyecto"]').val());
                    var route = '{{route('calidadpcs.procesosCalidad.storeProceso13')}}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    
                    formData.append('Proyecto_id',$('input:hidden[name="Id_Proyecto"]').val());
                    formData.append('Proceso_id',$('input:hidden[name="Id_Proceso"]').val());
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
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-plus', 'title' => 'Registrar Anteproyecto'])
        @permission('SEE_ALL_PROJECT_GESAP')
        @slot('actions', [
        'link_back' => [
        'link' => '',
        'icon' => 'fa fa-arrow-left',
        ],
        ])
        @endpermission
        <div class="row">
            {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-register-min']) !!}
            <div class="form-wizard">
                <div class="form-body">
                    <ul class="nav nav-pills nav-justified steps">
                        <li>
                            <a href="#tab1" data-toggle="tab" class="step">
                                <span class="number"> 1 </span>
                                <span class="desc"><i class="fa fa-check"></i> Anteproyecto </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc"><i class="fa fa-check"></i> Estudiantes </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab" class="step">
                                <span class="number"> 3 </span>
                                <span class="desc"><i class="fa fa-check"></i> Tiempos </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab" class="step">
                                <span class="number"> 4 </span>
                                <span class="desc"><i class="fa fa-check"></i> Documentos </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab5" data-toggle="tab" class="step">
                                <span class="number"> 5 </span>
                                <span class="desc"><i class="fa fa-check"></i> Confirmar </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <h3 class="block">Datos del Proyecto</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12 ">
                                    {!! Field::textarea('title',
                                    ['label' => 'Titulo del proyecto', 'rows' => '3','max' => '500', 'min' => '4', 'required', 'auto' => 'off'],
                                    ['help' => 'Ingrese el titulo del proyecto', 'icon' => 'fa fa-user']) !!}

                                </div>
                                <hr>
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    {!! Field::textarea('Keywords',
                                    ['label' => 'Palabras Clave', 'rows' => '1','max' => '300', 'min' => '4', 'required', 'auto' => 'off'],
                                    ['help' => 'Ingrese las palabras claves de su proyecto', 'icon' => 'fa fa-key']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h3 class="block">Estudiantes proponentes</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-8 col-lg-6">
                                    {!! Field::select('estudiante1',$estudiantes,null,
                                    [ 'label' => 'Estudiante 1', 'required', 'auto' => 'off','class'=>'sel']) !!}
                                </div>
                                <div class="col-xs-12 col-md-8 col-lg-6">
                                    {!! Field::select('estudiante2',array_replace(["0"=>"No aplica"],$estudiantes),0,
                                    [ 'label' => 'Estudiante 2','required', 'auto' => 'off','class'=>'sel']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <h3 class="block">Tiempos del Proyecto</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 col-lg-4">
                                    {!! Field::tel('duracion',
                                    ['label' => 'Duracion del Proyecto', 'max' => '2', 'min' => '1', 'required', 'auto' => 'off'],['help' => 'Duracion del Proyecto', 'icon' => 'fa fa-clock-o']) !!}
                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-4">
                                    {!! Field::date('FechaR',
                                    ['label' => 'Fecha de Radicacion','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => ""],
                                    ['help' => '', 'icon' => 'fa fa-calendar']) !!}
                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-4">
                                    {!! Field::date('FechaL',
                                    ['label' => 'Fecha limite de evaluacion','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                    ['help' => '', 'icon' => 'fa fa-calendar']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <h3 class="block">Documentos radicados</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12" id="file">
                                    <div class="form-md-line-input" style="margin: 0 0 35px;">
                                        <div class="fileinput-new input-icon" data-provides="fileinput">
                                            <label for="estudiante1" class="control-label"
                                                   style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">MINr008
                                                o E.A</label>
                                            <div class="input-group input-large">
                                                <div class=" form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"
                                                       style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                                                    <span class="fileinput-filename" style="position:absolute"> </span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
												<span class="fileinput-new"> Seleccionar Documento </span>
												<span class="fileinput-exists"> Cambiar </span>
												<input type="file" name="Min" class="other-file" required
                                                       id="Min"  accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf"> </span>
                                                <a href="javascript:;"
                                                   class="input-group-addon btn red fileinput-exists"
                                                   data-dismiss="fileinput"> Quitar </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-md-line-input" style="margin: 0 0 35px;">
                                        <div class="fileinput-new input-icon" data-provides="fileinput">
                                            <label for="estudiante1" class="control-label"
                                                   style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Requerimientos(Opcional)</label>
                                            <div class="input-group input-large">
                                                <div class=" form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"
                                                       style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                                                    <span class="fileinput-filename" style="position:absolute"> </span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
												<span class="fileinput-new"> Seleccionar Documento </span>
												<span class="fileinput-exists"> Cambiar </span>
												<input type="file" name="Requerimientos" class="other-file"
                                                       id="Requerimientos" accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
											</span>
                                                <a href="javascript:;"
                                                   class="input-group-addon btn red fileinput-exists"
                                                   data-dismiss="fileinput"> Quitar </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab5">
                            <h3 class="block">Confirmacion</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Titulo:</label>
                                        <div class="col-md-8">
                                            <p class="form-control-static" data-display="title"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Palabras Clave:</label>
                                        <div class="col-md-8">
                                            <p class="form-control-static" data-display="Keywords"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Estudiantes:</label>
                                        <div class="col-md-8">
                                            <p class="form-control-static" data-display="estudiante1"></p>
                                            <p class="form-control-static" data-display="estudiante2"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Duracion del proyecto:</label>
                                        <div class="col-md-8">
                                            <p class="form-control-static" data-display="duracion"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Fecha de Radicacion:</label>
                                        <div class="col-md-8">
                                            <p class="form-control-static" data-display="FechaR"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Fecha Limite de Evaluacion:</label>
                                        <div class="col-md-8">
                                            <p class="form-control-static" data-display="FechaL"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <a href="javascript:;" class="btn default button-previous">
                                <i class="fa fa-angle-left"></i> Volver
                            </a>
                            <a href="javascript:;" class="btn btn-outline green button-next">
                                Continuar<i class="fa fa-angle-right"></i>
                            </a>
                            {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    @endcomponent
</div>

@push('functions')
    <!--Local Scripts-->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/gesap/js/form-wizard-5.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        $('.portlet-form').attr("id", "form_wizard_1");


        jQuery(document).ready(function () {

            $('.select2-selection--single').addClass('form-control');
            var form = $('#form-register-min');

            /*Configuracion de input tipo fecha*/
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true,
                regional: 'es',
                closeText: 'Cerrar',
                minDate: null,
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                dateFormat: 'yyyy-mm-dd',
                showMonthAfterYear: false,
                yearSuffix: ''
            });

            /*Configuracion de Select*/
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Selecccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });
            $('.pmd-select2', form).change(function () {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });

            var rules = {
                title: {required: true, minlength: 6, maxlength: 500},
                estudiante1: {required: true, notEqualTo: '#estudiante2'},
                estudiante2: {required: true, notEqualTo: '#estudiante1'},
                Keywords: {required: true, minlength: 4, maxlength: 300},
                duracion: {required: true, minlength: 1, maxlength: 2, number: true},
                FechaR: {required: true},
                FechaL: {required: true},
                Min: {required: true, extension: "pdf|doc|docx"},
                Requerimientos: {extension: "pdf|doc|docx"}
            };

            var wizard = $('#form_wizard_1');

            var createProject = function () {
                return {
                    init: function () {
                        var route = '{{ route('min.store') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('title', $('#title').val());
                        formData.append('estudiante1', $('select[name="estudiante1"]').val());
                        formData.append('estudiante2', $('select[name="estudiante2"]').val());
                        formData.append('Keywords', $('#Keywords').val());
                        formData.append('duracion', $('#duracion').val());
                        formData.append('FechaR', $('#FechaR').val());
                        formData.append('FechaL', $('#FechaL').val());

                        var fileMin = document.getElementById("Min");
                        formData.append('Min', fileMin.files[0]);

                        var fileReq = document.getElementById("Requerimientos");
                        if ($('#Requerimientos').get(0).files.length === 0) {
                            formData.append('Requerimientos', "Vacio");
                        } else {
                            formData.append('Requerimientos', fileReq.files[0]);
                        }
                        ;

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    //$('#form-register-min')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('min.index.ajax') }}';
                                    //window.location.href=route;
                                    $(".content-ajax").load(route);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            }
                        });
                    }
                }
            };

            var messages = {
                Min: {extension: "Ingrese un documento valido (*.txt,*.pdf,*.doc,*.docx)"},
                Requerimientos: {extension: "Ingrese un documento valido (*.txt,*.pdf,*.doc,*.docx)"},
                estudiante1: {notEqualTo: 'No puede ser el mismo que estudiante 2'},
                estudiante2: {notEqualTo: 'No puede ser el mismo que estudiante 1'}
            };

            FormWizard.init(wizard, form, rules, messages, createProject());

            $('#link_back').on('click', function (e) {
                e.preventDefault();
                var route = '{{ route('min.index.ajax') }}';
                $(".content-ajax").load(route);
            });
        });
    </script>
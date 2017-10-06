{{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Crear Solicitud'])
        @slot('actions', [

        'link_upload' => [
        'link' => '',
        'icon' => 'icon-cloud-upload',
        ],
        'link_wrench' => [
        'link' => '',
        'icon' => 'icon-wrench',
        ],
        'link_trash' => [
        'link' => '',
        'icon' => 'icon-trash',
        ],

        ])

        <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
              rel="stylesheet" type="text/css"/>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light " id="form_wizard_1">
                    <div class="portlet-body form">
                        {!! Form::open(['id' => 'form_sol_create', 'class' => '', 'url' => '/forms']) !!}
                        <div class="form-body">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Field::select('SOL_laboratorios',
                                                        ['Aulas de computo' => 'Aulas de computo',
                                                        'Ciencias agropecuarias y ambientales' => 'Ciencias agropecuarias y ambientales'],
                                                        null,
                                                        [ 'label' => 'Seleccione el espacio academico que requiere:']) !!}

                                {!! Field::select('SOL_programa',
                                                    ['1' => 'Ingenieria de sistemas', '2' => 'Ingenieria Ambiental'
                                                    ,'3' => 'Ingenieria agronomica' ,'4' => 'Psicologia' ],
                                                    null,
                                                    [ 'label' => 'Seleccione programa:']) !!}

                                {!! Field::radios('SOL_ReqGuia',['Si'=>'Si', 'No'=>'No'], ['list', 'label'=>'¿Requiere guia de practica?', 'icon'=>'fa fa-user']) !!}

                                <div id="req_guia">
                                    {!! Field::text('SOL_nombreGuia',null,['label'=>'Nombre de la guia:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                ['icon'=>'fa fa-group'] ) !!}
                                </div>

                                {!! Field::text('SOL_nucleo_tematico',null,['label'=>'Nucleo tematico:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                ['help' => 'Digite el nucleo tematico.','icon'=>'fa fa-building-o'] ) !!}

                                {!! Field::radios('SOL_software',['Si'=>'Si', 'No'=>'No'], ['list', 'label'=>'¿Requiere software?', 'icon'=>'fa fa-user']) !!}

                                <div id="req_soft">
                                    {!! Field::select('Seleccione software entre los dispobiles actualmente:',$software,
                                    ['name' => 'SOL_NombSoft'])
                                    !!}
                                </div>

                                {!! Field::text('SOL_grupo',null,['label'=>'Grupo:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                ['icon'=>'fa fa-group'] ) !!}

                                {!! Field::text('SOL_cant_estudiantes',null,['label'=>'Cantidad de estudiantes:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                ['icon'=>'fa fa-group'] ) !!}

                                {!! Field::checkboxes('SOL_dias',
                                ['Lunes' => 'Lunes', 'Martes' => 'Martes', 'Miercoles' => 'Miercoles', 'Jueves' => 'Jueves', 'Viernes' => 'Viernes','Sabado' => 'Sabado'],null,
                                ['inline', 'label' => 'Seleccione los dias que requiere el espacio:']) !!}

                                {!! Field::text(
                                'SOL_hora_inicio',
                                ['label' => 'Hora de inicio:', 'class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'auto' => 'off'],
                                ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}

                                {!! Field::text(
                                'SOL_hora_fin',
                                ['label' => 'Hora de fin:', 'class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'auto' => 'off'],
                                ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}


                                {!! Field::date(
                                'SOL_fecha_inicial',
                                ['required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                ['label' => 'Fecha inicial', 'icon' => 'fa fa-calendar']) !!}

                                {!! Field::date(
                                'SOL_fecha_final',
                                ['required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                ['label' => 'Fecha final', 'icon' => 'fa fa-calendar']) !!}
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="javascript:;" class="btn btn-outline red button-cancel">
                                            Cancelar
                                        </a>
                                        {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
</div>
{{-- END HTML SAMPLE --}}



<!--//mensaje validacion-->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/main/scripts/form-wizard.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        /*Mostrar campos ocultos*/
        $("#req_guia").css("display", "none");
        $("input[name=SOL_ReqGuia]").click(function () {
            if ($('input:radio[name=SOL_ReqGuia]:checked').val() == "Si") {
                $("#req_guia").css("display", "block");
            } else {
                $("#req_guia").css("display", "none");
            }

        });
        $("#req_soft").css("display", "none");
        $("input[name=SOL_software]").click(function () {
            if ($('input:radio[name=SOL_software]:checked').val() == "Si") {
                $("#req_soft").css("display", "block");
            } else {
                $("#req_soft").css("display", "none");
            }

        });
        /*Fin mostrar campos ocultos*/


        /*CAMPO DE HORA*/
        var ComponentsDateTimePickers = function () {
            var handleTimePickers = function () {

                if (jQuery().timepicker) {

                    $('.timepicker-no-seconds').timepicker({
                        autoclose: true,
                        minuteStep: 5
                    });

                }
            }

            return {
                init: function () {
                    handleTimePickers();
                }
            };
        }();
        jQuery(document).ready(function () {
            ComponentsDateTimePickers.init();
        });

        /*VALIDACIONES*/
        var form = $('#form_sol_create');
        var rules = {
            SOL_grupo: {minlength: 1, required: true, number: true}
        };
        var messages = {
            SOL_ReqGuia: {
                remote: "hOLA PRUEBA MENSAJE VAL."
            }
        };
        var wizard = $('#form_wizard_1');
        /*Crear Solicitud*/
        var createUsers = function () {
            return {
                init: function () {
                    var route = '{{ route('espacios.academicos.espacad.registrosol') }}';
                    var type = 'POST';
                    var async = async || false;
                    //CAPTURO LOS VALORES DEL CHECKBOX
                    var selected = null;
                    $("input:checkbox:checked").each(function () {
                        if ($(this).val() != 'on') {
                            if (selected == null) {
                                selected = $(this).val();
                            } else {
                                selected = selected + ", " + $(this).val();
                            }
                        }
                    });
                    //Comprobando que guia no venga vacia
                    if ($("#SOL_nombreGuia").val() == null) {
                        guia = "No";
                    } else {
                        guia = $("#SOL_nombreGuia").val();
                    }

                    console.log(selected);
                    var formData = new FormData();
                    formData.append('SOL_espacio', $('select[name="SOL_laboratorios"]').val());
                    formData.append('SOL_programa', $('select[name="SOL_programa"]').val());
                    formData.append('SOL_ReqGuia', guia);
                    formData.append('SOL_nucleo_tematico', $('input:text[name="SOL_nucleo_tematico"]').val());
                    formData.append('SOL_grupo', $('input:text[name="SOL_grupo"]').val());
                    formData.append('SOL_NombSoft', $('select[name="SOL_NombSoft"]').val());
                    formData.append('SOL_cant_estudiantes', $('input:text[name="SOL_cant_estudiantes"]').val());
                    formData.append('SOL_dias', selected);
                    formData.append('SOL_hora_inicio', $('input:text[name="SOL_hora_inicio"]').val());
                    formData.append('SOL_hora_fin', $('input:text[name="SOL_hora_fin"]').val());
                    formData.append('SOL_fecha_inicial', $('#SOL_fecha_inicial').val());
                    formData.append('SOL_fecha_final', $('#SOL_fecha_final').val());

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
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_sol_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var ruta = '{{ route('espacios.academicos.espacad.indexajax') }}';
                                $(".content-ajax").load(ruta);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form_edit = $('#form_sol_create');
        var rules_edit = {
            SOL_programa: {required: true},
            SOL_ReqGuia: {required: true},
            SOL_nucleo_tematico: {required: true, minlength: 3, maxlength: 20},
            SOL_grupo: {required: true, number: true},
            SOL_cant_estudiantes: {required: true, number: true},
            SOL_dias: {required: true}
        };
        FormValidationMd.init(form_edit, rules_edit, false, createUsers());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var ruta = '{{ route('espacios.academicos.espacad.indexajax') }}';
            $(".content-ajax").load(ruta);
        });
    });
</script>


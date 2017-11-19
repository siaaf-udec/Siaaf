@permission('ACAD_REALIZAR_SOLICITUDES')
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'glyphicon glyphicon-pencil', 'title' => 'Crear Solicitud grupal'])
        @slot('actions', [

       'link_cancel' => [
                'link' => 'indexDoc',
                'icon' => 'fa fa-arrow-left',
            ]

        ])

        <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
              rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
              rel="stylesheet" type="text/css"/>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light " id="form_wizard_1">
                    <div class="portlet-body form">
                        {!! Form::open(['id' => 'form_sol_create', 'class' => '', 'url' => '/forms']) !!}
                        <div class="form-body">
                            <div class="col-md-10 col-md-offset-1">

                                {!! Field::select('Espacio académico:',$espacios,
                                    ['id' => 'SOL_laboratorios', 'name' => 'SOL_laboratorios'])
                                    !!}

                                {!! Field::select('SOL_programa',
                                                    ['Ingenieria de sistemas' => 'Ingeniería de sistemas',
                                                     'Ingenieria Ambiental' => 'Ingeniería Ambiental',
                                                     'Ingenieria agronomica' => 'Ingeniería agronomica',
                                                     'Psicologia' => 'Psicología',
                                                      'Administracion de empresas' => 'Administración de empresas',
                                                      'Contaduria' => 'Contaduría',
                                                      'Otro' => 'Otro'],
                                                    null,
                                                    [ 'label' => 'Programa al que pertenece:']) !!}

                                {!! Field::radios('SOL_ReqGuia',['Si'=>'Si', 'No'=>'No'], ['list', 'label'=>'¿Requiere guía de practica?', 'icon'=>'fa fa-user']) !!}

                                <div id="req_guia">
                                    {!! Field::text('SOL_nombreGuia',null,['label'=>'Nombre de la guía:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'50','autocomplete'=>'off'],
                                ['icon'=>'fa fa-group'] ) !!}
                                </div>

                                {!! Field::text('SOL_Nucleo_Tematico',null,['label'=>'Núcleo temático:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'50','autocomplete'=>'off'],
                                ['help' => 'Digite el núcleo temático.','icon'=>'fa fa-building-o'] ) !!}

                                {!! Field::radios('FK_SOL_Id_Software',['Si'=>'Si', 'No'=>'No'], ['list', 'label'=>'¿Requiere software?', 'icon'=>'fa fa-user']) !!}

                                <div id="req_soft">
                                    {!! Field::select('Seleccione software entre los disponiles actualmente:',$software,
                                    ['name' => 'SOL_NombSoft'])
                                    !!}
                                </div>

                                {!! Field::text('SOL_Grupo',null,['label'=>'Grupo:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'50','autocomplete'=>'off'],
                                ['icon'=>'fa fa-group'] ) !!}

                                {!! Field::text('SOL_Cant_Estudiantes',null,['label'=>'Cantidad de estudiantes:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'2','autocomplete'=>'off'],
                                ['icon'=>'fa fa-group'] ) !!}

                                {!! Field::checkboxes('SOL_Dias',
                                ['Lunes' => 'Lunes', 'Martes' => 'Martes', 'Miercoles' => 'Miercoles', 'Jueves' => 'Jueves', 'Viernes' => 'Viernes','Sabado' => 'Sabado'],null,
                                ['inline', 'label' => 'Seleccione los días que requiere el espacio:']) !!}

                                {!! Field::text(
                                'SOL_Hora_Inicio',
                                ['label' => 'Hora de inicio:', 'class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'auto' => 'off'],
                                ['help' => 'Seleccione la hora.', 'icon' => 'fa fa-clock-o']) !!}

                                {!! Field::text(
                                'SOL_Hora_Fin',
                                ['label' => 'Hora de fin:', 'class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'auto' => 'off'],
                                ['help' => 'Seleccione la hora.', 'icon' => 'fa fa-clock-o']) !!}


                                {!! Field::text(
                               'SOL_Rango_Fechas',
                               ['required','readonly', 'auto' => 'off', 'class' => 'range-date-time-picker', 'label' => 'Seleccione el rango de fechas en que solicita el espacio:'],
                               ['help' => 'Seleccione un rango de fechas.', 'icon' => 'fa fa-calendar'])       !!}

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="javascript:;" class="btn red button-cancel">
                                            Cancelar
                                        </a>
                                        @permission('ACAD_REALIZAR_SOLICITUDES')
                                        {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                                        @endpermission
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

{{--Timepicker--}}
<script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"
        type="text/javascript"></script>
{{--Wizard--}}
<script src="{{ asset('assets/main/scripts/form-wizard.js') }}" type="text/javascript"></script>
{{--Date Range--}}
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
        type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Seleccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });
        moment.locale('es');
        //Campo de hora
        $('#SOL_Hora_Inicio').timepicker();
        $('#SOL_Hora_Fin').timepicker();
        //Campo daterange
        $('input[name="SOL_Rango_Fechas"]').daterangepicker();
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
        $("input[name=FK_SOL_Id_Software]").click(function () {
            if ($('input:radio[name=FK_SOL_Id_Software]:checked').val() == "Si") {
                $("#req_soft").css("display", "block");
            } else {
                $("#req_soft").css("display", "none");
            }
        });
        /*Fin mostrar campos ocultos*/
        var wizard = $('#form_wizard_1');
        /*Crear Solicitud*/
        var createUsers = function () {
            return {
                init: function () {
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
                    var horaInicio = Date.parse('01/01/2001 ' + $('input:text[name="SOL_Hora_Inicio"]').val());
                    var horaFin = Date.parse('01/01/2001 ' + $('input:text[name="SOL_Hora_Fin"]').val());
                    if (horaInicio >= horaFin) {
                        UIToastr.init('error', '¡Error!', 'Verifique los campos de hora.');
                    } else if (selected == null) {
                        UIToastr.init('error', '¡Error!', 'Verifique los días seleccionados.');
                    } else {
                        var route = '{{ route('espacios.academicos.solacad.registroSolicitud') }}';
                        var type = 'POST';
                        var async = async || false;

                        //Comprobando que guia no venga vacia
                        if ($("#SOL_nombreGuia").val() == "") {
                            guia = "No";
                        } else {
                            guia = $("#SOL_nombreGuia").val();
                        }
                        //Validacion de si solicitan software o no
                        if ($('select[name="SOL_NombSoft"]').val() == null || $('select[name="SOL_NombSoft"]').val() == "") {
                            soft = 1;
                        } else {
                            soft = $('select[name="SOL_NombSoft"]').val();
                        }

                        var formData = new FormData();
                        formData.append('SOL_Espacio', $('select[name="SOL_laboratorios"]').val());
                        formData.append('SOL_programa', $('select[name="SOL_programa"]').val());
                        formData.append('SOL_ReqGuia', guia);
                        formData.append('SOL_Nucleo_Tematico', $('input:text[name="SOL_Nucleo_Tematico"]').val());
                        formData.append('SOL_Grupo', $('input:text[name="SOL_Grupo"]').val());
                        formData.append('SOL_NombSoft', soft);
                        formData.append('SOL_Cant_Estudiantes', $('input:text[name="SOL_Cant_Estudiantes"]').val());
                        formData.append('SOL_Dias', selected);
                        formData.append('SOL_Hora_Inicio', $('input:text[name="SOL_Hora_Inicio"]').val());
                        formData.append('SOL_Hora_Fin', $('input:text[name="SOL_Hora_Fin"]').val());
                        formData.append('SOL_Rango_Fechas', $('#SOL_Rango_Fechas').val());

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
                                    $('#form_sol_create')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var ruta = '{{ route('espacios.academicos.solacad.indexDocAjax') }}';
                                    $(".content-ajax").load(ruta);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });

                    }

                }
            }
        };

        var form_edit = $('#form_sol_create');
        var rules_edit = {
            SOL_programa: {required: true},
            SOL_ReqGuia: {required: true},
            FK_SOL_Id_Software: {required: true},
            SOL_Nucleo_Tematico: {required: true, minlength: 3, maxlength: 50},
            SOL_Grupo: {required: true, maxlength: 50},
            SOL_Cant_Estudiantes: {required: true, number: true, maxlength: 2, range: [1, 99]},
            SOL_laboratorios: {required: true},
            SOL_Hora_Fin: {required: true},
            SOL_Rango_Fechas: {required: true}

        };
        FormValidationMd.init(form_edit, rules_edit, false, createUsers());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var ruta = '{{ route('espacios.academicos.solacad.indexDocAjax') }}';
            $(".content-ajax").load(ruta);
        });
    });
</script>
@endpermission

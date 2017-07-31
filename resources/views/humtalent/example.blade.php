@extends('material.layouts.dashboard')

@section('page-title', 'Documentos Requeridos:')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de documentos solicitados'])
        {!! Form::open (['id'=>'form-radicar','class'=>'form-horizontal','method'=>'POST', 'route'=> ['talento.humano.radicarDocumentos']]) !!}
        <div class="form-wizard">
            <div class="form-body">
                <ul class="nav nav-pills nav-justified steps">
                    <li>
                        <a href="#tab1" data-toggle="tab" class="step">
                            <span class="number"> 1 </span>
                            <span class="desc">
                                    <i class="fa fa-check-square"></i> Documentación sin entregar </span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab" class="step">
                            <span class="number"> 2 </span>
                            <span class="desc">
                                    <i class="fa fa-check-square"></i> Documentación pendiente </span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab" class="step">
                            <span class="number"> 3 </span>
                            <span class="desc">
                                    <i class="fa fa-check-square"></i> Documentación completa </span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab" class="step">
                            <span class="number"> 4 </span>
                            <span class="desc">
                                    <i class="fa fa-check-square"></i> Docente afiliado </span>
                        </a>
                    </li>

                </ul>
                <div id="bar" class="progress progress-striped" role="progressbar">
                    <div class="progress-bar progress-bar-success"> </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <h3 class="block">&nbsp;&nbsp;Seleccione si desea iniciar la radicación de documentos:</h3>
                        <div class="form-group">
                            <div class="col-md-offset-1 col-md-9">
                                {!! Field::checkboxes('estado1',
                                    ['iniciar' => 'Iniciar el proceso'],null,
                                    ['label' => 'Seleccione la opción: ']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="tab2">

                        <div class="form-group">
                            <div class="col-md-offset-1 col-md-10">
                                <br><br>
                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example-table-ajax">
                                    <thead>
                                    <th>Número de Cedula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Rol</th>
                                    <th>Área o Programa</th>
                                    </thead>
                                    @foreach($empleados as $empleado)
                                        <tbody>
                                        <td>{{$empleado->PK_PRSN_Cedula}}</td>
                                        <td>{{$empleado->PRSN_Nombres}}</td>
                                        <td>{{$empleado->PRSN_Apellidos}}</td>
                                        <td>{{$empleado->PRSN_Rol}}</td>
                                        <td>{{$empleado->PRSN_Area}}</td>
                                        </tbody>
                                    @endforeach
                                </table>
                                <br>
                                {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula) !!}

                                {!!  Field::checkboxes('FK_Personal_Documento',$docs,$seleccion,['list', 'label'=>'Seleccione si fue entregado el Documento']) !!}
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-0    ">
                                        {!! Field::date('EDCMT_Fecha',
                                           ['label'=>'Fecha en la que se recibió la documentación','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                           ['help' => 'Seleccione la fecha de radicación.', 'icon' => 'fa fa-calendar']) !!}
                                    </div>
                                </div>
                                <br>
                                {!! Form::submit('Guardar',['class'=>'btn blue','btn-icon remove']) !!}

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="tab3">
                        <h3 class="block">&nbsp;&nbsp;Seleccione si se entrego toda la documentación del empleado:</h3>
                        <div class="form-group">
                            <div class="col-md-offset-1 col-md-9">
                                {!! Field::checkboxes('estado3',
                                    ['exito' => 'La documentación fue entregada'],null,
                                    ['label' => 'Seleccione la opción: ']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="tab4">
                        <h3 class="block">&nbsp;&nbsp;Presione el boton para finalizar el estado del empleado</h3>
                        <div class="form-group">
                            <div class="col-md-offset-1 col-md-9">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <a href="javascript:;" class="btn default button-previous">
                            <i class="fa fa-angle-left"></i> Atrás </a>
                        <a href="javascript:;" class="btn btn-outline green button-next"> Continuar
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <a href="javascript:;" class="btn green button-submit"> Finalizar
                            <i class="fa fa-check"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    @endcomponent
@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript" charset="UTF-8"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/form-wizard.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script>
    var ComponentsDateTimePickers = function () {
        var handleDatePickers = function () {
            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    language: 'es',
                    closeText: 'Cerrar',
                    prevText: '<Ant',
                    nextText: 'Sig>',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                    weekHeader: 'Sm',
                    dateFormat: 'yyyy-mm-dd',
                    firstDay: 1,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                });
            }
        }

        return {
            init: function () {
                handleDatePickers();
            }
        };
    }();
    var FormWizard = function () {


        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().bootstrapWizard) {
                    return;
                }

                function format(state) {
                    if (!state.id) return state.text; // optgroup
                    return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
                }

                $("#country_list").select2({
                    placeholder: "Select",
                    allowClear: true,
                    formatResult: format,
                    width: 'auto',
                    formatSelection: format,
                    escapeMarkup: function (m) {
                        return m;
                    }
                });

                var form = $('#form-radicar');
                var error = $('.alert-danger', form);
                var success = $('.alert-success', form);

                form.validate({
                    doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
                        //account
                        'estado1[]': {
                            required: true,
                            maxlength:1
                        },
                        EDCMT_Fecha: {
                            required: true,

                        },
                        'estado3[]': {
                            required: true,
                            maxlength:1
                        }

                    },

                    messages: { // custom messages for radio buttons and checkboxes
                        'estado1[]': {
                            required: "Debe seleccionar una opción",
                            maxlength: jQuery.validator.format("Solo puede seleccionar una opción")
                        },
                        EDCMT_Fecha: {
                            required: "Debe seleccionar una fecha",

                        },
                        'estado3[]': {
                            required: "Debe seleccionar una opción",
                            maxlength: jQuery.validator.format("Solo puede seleccionar una opción")
                        }

                    },

                    errorPlacement: function(error, element) {
                        if (element.is(':checkbox')) {
                            error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                        } else if (element.is(':radio')) {
                            error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                        } else {
                            error.insertAfter(element); // for other inputs, just perform default behavior
                        }
                    },

                    invalidHandler: function (event, validator) { //display error alert on form submit
                        success.hide();
                        error.show();
                        toastr.options.closeButton = true;
                        toastr.options.showDuration= 1000;
                        toastr.options.hideDuration= 1000;
                        toastr.error('Debe corregir algunos campos','Error:')
                        App.scrollTo(error, -200);
                    },

                    highlight: function (element) { // hightlight error inputs
                        $(element)
                            .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                    },

                    unhighlight: function (element) { // revert the change done by hightlight
                        $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },

                    success: function (label) {
                        if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                            label
                                .closest('.form-group').removeClass('has-error').addClass('has-success');
                            label.remove(); // remove error label here
                        } else { // display success icon for other inputs
                            label
                                .addClass('valid') // mark the current input as valid and display OK icon
                                .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                        }
                    },

                    submitHandler: function (form) {
                        success.show();
                        error.hide();
                        form.submit();
                        //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                    }

                });

                var displayConfirm = function() {
                    $('#tab3 .form-control-static', form).each(function(){
                        var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                        if (input.is(":radio")) {
                            input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                        }
                        if (input.is(":text") || input.is("textarea")) {
                            $(this).html(input.val());
                        } else if (input.is("select")) {
                            $(this).html(input.find('option:selected').text());
                        } else if (input.is(":radio") && input.is(":checked")) {
                            $(this).html(input.attr("data-title"));
                        } else if ($(this).attr("data-display") == 'payment[]') {
                            var payment = [];
                            $('[name="payment[]"]:checked', form).each(function(){
                                payment.push($(this).attr('data-title'));
                            });
                            $(this).html(payment.join("<br>"));
                        }
                    });
                }

                var handleTitle = function(tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    // set wizard title
                    $('.step-title', $('#form_wizard_1')).text('Paso ' + (index + 1) + ' de ' + total);
                    // set done steps
                    jQuery('li', $('#form_wizard_1')).removeClass("done");
                    var li_list = navigation.find('li');
                    for (var i = 0; i < index; i++) {
                        jQuery(li_list[i]).addClass("done");
                    }

                    if (current == 1) {
                        $('#form_wizard_1').find('.button-previous').hide();
                    } else {
                        $('#form_wizard_1').find('.button-previous').show();
                    }

                    if (current >= total) {
                        $('#form_wizard_1').find('.button-next').hide();
                        $('#form_wizard_1').find('.button-submit').show();
                        displayConfirm();
                    } else {
                        $('#form_wizard_1').find('.button-next').show();
                        $('#form_wizard_1').find('.button-submit').hide();
                    }
                    App.scrollTo($('.page-title'));
                }

                // default form wizard
                $('#form_wizard_1').bootstrapWizard({
                    'nextSelector': '.button-next',
                    'previousSelector': '.button-previous',
                    onTabClick: function (tab, navigation, index, clickedIndex) {
                        return false;

                        success.hide();
                        error.hide();
                        if (form.valid() == false) {
                            return false;
                        }

                        handleTitle(tab, navigation, clickedIndex);
                    },
                    onNext: function (tab, navigation, index) {
                        success.hide();
                        error.hide();

                        if (form.valid() == false) {
                            return false;
                        }

                        handleTitle(tab, navigation, index);
                    },
                    onPrevious: function (tab, navigation, index) {
                        success.hide();
                        error.hide();

                        handleTitle(tab, navigation, index);
                    },
                    onTabShow: function (tab, navigation, index) {
                        var total = navigation.find('li').length;
                        var current = index + 1;
                        var $percent = (current / total) * 100;
                        $('#form_wizard_1').find('.progress-bar').css({
                            width: $percent + '%'
                        });
                    }
                });

                $('#form_wizard_1').find('.button-previous').hide();
                $('#form_wizard_1 .button-submit').click(function () {
                    swal("Documentación radicada!", "El proceso de documentación del empleado ha finalizado ", "success");
                }).hide();

                //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
                $('#country_list', form).change(function () {
                    form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
                });
            }

        };

    }();

    var ComponentsSelect2 = function() {

        var handleSelect = function() {

            $.fn.select2.defaults.set("theme", "bootstrap");

            $(".pmd-select2").select2({
                width: null,
                placeholder: "Selecccionar",
            });

        }

        return {
            init: function() {
                handleSelect();
            }
        };

    }();

    jQuery(document).ready(function() {
        $('.caption-subject').append( "<span class='step-title'> Paso 1 de 4 </span>" );
        $('.portlet-sortable').attr("id","form_wizard_1");
        FormWizard.init();
        ComponentsSelect2.init();
        ComponentsDateTimePickers.init();
    });




</script>
@endpush
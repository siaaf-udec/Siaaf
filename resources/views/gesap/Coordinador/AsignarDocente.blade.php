@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Anteproyectos')

@section('page-title', 'Asignar Docentes')

@section('page-description', 'Asignacion de directores y jurados')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-users', 'title' => 'Asignar'])
<div class="row">
        <div class="col-md-6" style="z-index: 1;">
            <div class="btn-group">
                <a href="{{ route('min.index') }}">
                    <button id="sample_editable_1_new" class="btn green" style="margin-bottom:-8px;"> 
                        <i class="fa fa-list"></i>Listar
                    </button>
                </a> 
            </div>
        </div>
    
        @foreach ($anteproyectos as $anteproyecto)
        {!! Form::open(['route' => 'anteproyecto.guardardocente', 'method' => 'post', 'novalidate','class'=>'form-horizontal','id'=>'submit_form']) !!}    
            {!! Field::hidden('PK_anteproyecto', $anteproyecto->PK_NPRY_idMinr008) !!}    
            <div class="form-wizard">
                <div class="form-body">
                    <ul class="nav nav-pills nav-justified steps">
                        <li>
                            <a href="#tab1" data-toggle="tab" class="step">
                                <span class="number"> 1 </span>
                                <span class="desc"><i class="fa fa-check"></i> Escoger Director </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc"><i class="fa fa-check"></i> Escoger Jurados </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab" class="step">
                                <span class="number"> 3 </span>
                                <span class="desc"><i class="fa fa-check"></i> Confirmar </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <div class="tab-content">
                        <div class="alert alert-danger display-none">
                            <button class="close" data-dismiss="alert"></button> Errores.Por favor revisar nuevamente  
                        </div>
                        <div class="alert alert-success display-none">
                            <button class="close" data-dismiss="alert"></button> La asignacion ha sido satisfactoria    
                        </div>
                        <div class="tab-pane active" id="tab1">
                            <h3 class="block">Escoger Director</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-6 col-md-offset-3">
                                @if(!empty($director))
                                    @foreach ($director as $direc)
                                        {!! Field::hidden('PK_director', $direc->PK_NPRY_idCargo) !!}    
                                        {!! Field::select('director',$docentes,$direc->Cedula)!!}
                                    @endforeach
                                @else
                                    {!! Field::select('director',$docentes,null) !!}
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h3 class="block">Escoger Jurados</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-6 col-md-offset-3">
                                    @if(!empty($jurado1))
                                    @foreach ($jurado1 as $jur1)
                                        {!! Field::hidden('PK_jurado1', $jur1->PK_NPRY_idCargo) !!}    
                                        {!! Field::select('jurado1',$docentes,$jur1->Cedula)!!}
                                    @endforeach
                                @else
                                    {!! Field::select('jurado1',$docentes,null) !!}
                                @endif
                                    
                                    <hr>
                                    @if(!empty($jurado2))
                                    @foreach ($jurado2 as $jur2)
                                        {!! Field::hidden('PK_jurado2', $jur2->PK_NPRY_idCargo) !!}    
                                        {!! Field::select('jurado2',$docentes,$jur2->Cedula)!!}
                                    @endforeach
                                @else
                                    {!! Field::select('jurado2',$docentes,null) !!}
                                @endif
                                    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <h3 class="block">Datos</h3>
                            <div class="form-group">
                                <label class="control-label col-md-3">Anteproyecto:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="username"> {{$anteproyecto->NPRY_Titulo}} </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Director:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="director"> </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Jurado 1:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="jurado1"> </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Jurado 2:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="jurado2"> </p>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>  
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <a href="javascript:;" class="btn default button-previous">
                                <i class="fa fa-angle-left"></i> Volver </a>
                            <a href="javascript:;" class="btn btn-outline green button-next"> Continuar
                                <i class="fa fa-angle-right"></i>
                            </a>
                            {{Form::button('Guardar<i class="fa fa-check"></i>', array('type' => 'submit', 'class' => 'btn green button-submit'))}}
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

                            
    @endforeach
</div>
    @endcomponent
@endsection



@push('plugins')
    <script src="{{asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/form-wizard.min.js') }}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>


@endpush

@push('functions')
<script type="text/javascript">
    
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

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    //account
                    director: {
                        required: true
                    },
                    jurado1: {
                        required: true
                    },
                    jurado2: {
                        required: true
                    },
        
                },

                messages: { // custom messages for radio buttons and checkboxes
                    'payment[]': {
                        required: "Please select at least one option",
                        minlength: jQuery.validator.format("Please select at least one option")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
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
                toastr.error('Campos Incorrectos','Error en el Registro:')
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
                    form[0].submit();
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
    $('.caption-subject').append( "<span class='step-title'> Paso 1 de 3 </span>" );
    $('.portlet-sortable').attr("id","form_wizard_1");
    FormWizard.init();
    ComponentsSelect2.init();
});
    
    

</script>

@endpush
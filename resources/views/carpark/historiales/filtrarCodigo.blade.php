@permission('PARK_REPORT_HISTOCODIGO')
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de filtrado de un reporte por código.'])
        @slot('actions', [
              'link_cancel' => [
                  'link' => '',
                  'icon' => 'fa fa-arrow-left',
                               ],
       ])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                {!! Form::open (['id'=>'form_filtrar_codigo','method'=>'POST','target'=>'_blank','route'=> ['parqueadero.reportesCarpark.filtradoCodigo']]) !!}

                <div class="form-body">

                    {!! Field:: text('CodigoUsuario',null,['label'=>'Código del usuario:','class'=> 'form-control', 'autofocus', 'maxlength'=>'9','autocomplete'=>'off'],['help' => 'Digite el código del usuario.','icon'=>'fa fa-user']) !!}

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('PARK_REPORT_HISTOCODIGO')<a href="javascript:;"
                                                                            class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission
                                @permission('PARK_REPORT_HISTOCODIGO'){{ Form::submit('Generar Reporte', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endcomponent
</div>
@endpermission

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    var FormValidationMd = function() {
        var handleValidation = function() {

            var form1 = $('#form_filtrar_codigo');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span',
                errorClass: 'help-block help-block-error',
                focusInvalid: true,
                ignore: "",
                rules: {

                    CodigoUsuario: {
                        required: true,
                        number: true,
                        minlength: 9,
                        maxlength: 9
                    }


                },
                messages:{

                    CodigoUsuario: {
                        required: "Debe ingresar un número de código valido."
                    }


                },

                invalidHandler: function(event, validator) {
                    success1.hide();
                    error1.show();
                    toastr.options.closeButton = true;
                    toastr.options.showDuration= 1000;
                    toastr.options.hideDuration= 1000;
                    toastr.error('Debe corregir algunos campos','Reporte fallido:')
                    App.scrollTo(error1, -200);
                },

                errorPlacement: function(error, element) {
                    if (element.is(':checkbox')) {
                        error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                    } else if (element.is(':radio')) {
                        error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                    } else {
                        error.insertAfter(element);
                    }
                },

                highlight: function(element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error');
                },

                unhighlight: function(element) {
                    $(element)
                        .closest('.form-group').removeClass('has-error');
                },

                success: function(label) {
                    label
                        .closest('.form-group').removeClass('has-error');
                },

                submitHandler: function(form1) {
                    success1.show();
                    error1.hide();
                    form1.submit();
                }
            });
        }

        return {
            init: function() {
                handleValidation();
            }
        };
    }();

    var ComponentsBootstrapMaxlength = function () {

        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                limitReachedClass: "label label-danger",
                alwaysShow: true
            });
        };

        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };

    }();

    jQuery(document).ready(function () {

        FormValidationMd.init();
        ComponentsBootstrapMaxlength.init();


        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.historialesCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('parqueadero.historialesCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>

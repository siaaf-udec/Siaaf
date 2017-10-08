<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de filtrado de un reporte por fecha.'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                {!! Form::open (['id'=>'form_filtrar_fecha', 'url' => '/forms']) !!}

                <div class="form-body">                    

                    {!! Field::text(
                            'date_range',
                            ['required', 'readonly', 'auto' => 'off', 'class' => 'range-date-time-picker'],
                            ['help' => 'Selecciona un rango de fechas.', 'icon' => 'fa fa-calendar']) !!}
                                    
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">                                
                                <a href="javascript:;" class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>
                                {{ Form::submit('Generar Reporte', ['class' => 'btn blue']) }}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endcomponent
</div>

<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"><scripts>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">

var ComponentsDateTimePickers = function () {

        var handleDateRangePickers = function () {
            if (!jQuery().daterangepicker) {
                return;
            }
            $('.range-date-time-picker').daterangepicker({
                    opens: (App.isRTL() ? 'left' : 'right'),
                    startDate: moment().subtract('days', 29),
                    endDate: moment(),
                    //minDate: '01/01/2012',
                    //maxDate: '12/31/2014 ',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Hoy': [moment(), moment()],
                        'Ayer': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        'Últimos 7 Días': [moment().subtract('days', 6), moment()],
                        'Últimos 30 Días': [moment().subtract('days', 29), moment()],
                        'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                        'Mes Anterior': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    buttonClasses: ['btn'],
                    applyClass: 'green',
                    cancelClass: 'red',
                    format: 'yyyy-mm-dd',
                    separator: ' a ',
                    locale: {
                        applyLabel: '<i class="fa fa-check"></i>',
                        cancelLabel: '<i class="fa fa-times"></i>',
                        fromLabel: 'Desde',
                        toLabel: 'A',
                        customRangeLabel: 'Rango Personalizado',
                        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        firstDay: 1
                    }
                },
                function (start, end) {
                    $('.range-date-time-picker span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );
            //Set the initial state of the picker label
            $('.range-date-time-picker span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        }
        
    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        
        var createAccion = function () {
            return {
                init: function () {
                    var route = '{{ route('parqueadero.ingresosCarpark.verificar') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('FechasLimite', $('input:text[name="FechasLimite"]').val());
                    console.log($('input:[name="FechasLimite"]').val());

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
                                $('#form_filtrar_fecha')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                //var route = '{{ route('parqueadero.ingresosCarpark.index.ajax') }}';
                                var route = '{{ route('parqueadero.historialesCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                //var route = '{{ route('parqueadero.ingresosCarpark.index.ajax') }}';
                                var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        }
                    });
                }
            }
        };

        var form = $('#form_filtrar_fecha');

        var formRules = {
            FechasLimite: {required: true}

        };
        FormValidationMd.init(form, formRules, false, createAccion());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.historialesCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>

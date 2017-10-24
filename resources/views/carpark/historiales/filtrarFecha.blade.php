@permission('REPORT_HISTOFECHA_CARPARK')
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de filtrado de un reporte por fecha.'])
        @slot('actions', [
              'link_cancel' => [
                  'link' => '',
                  'icon' => 'fa fa-arrow-left',
                               ],
        ])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                {!! Form::open (['id'=>'form_filtrar_fecha','method'=>'POST','target'=>'_blank','route'=> ['parqueadero.reportesCarpark.filtradoFecha']]) !!}

                <div class="form-body">

                    {!! Field::text('FechasLimite',['label'=>'Rango De Fechas','required', 'auto' => 'off', 'class' => 'range-date-time-picker'],['help' => 'Selecciona un rango de fechas.', 'icon' => 'fa fa-calendar'])       !!}

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('REPORT_HISTOFECHA_CARPARK')<a href="javascript:;"
                                                                           class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission
                                @permission('REPORT_HISTOFECHA_CARPARK'){{ Form::submit('Generar Reporte', ['class' => 'btn blue']) }}@endpermission
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
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
        type="text/javascript"></script>

<script type="text/javascript">


    var ComponentsDateTimePickers = function () {

        var handleDateRangePickers = function () {
            $('.range-date-time-picker').daterangepicker({
                    opens: (App.isRTL() ? 'left' : 'right'),
                    startDate: moment().subtract('days', 29),
                    endDate: moment(),

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
                    $('.range-date-time-picker span').html(start.format('yyyy-mm-dd') + '/' + end.format('yyyy-mm-dd'));
                }
            );

            $('.range-date-time-picker span').html(moment().subtract('days', 29).format('yyyy-mm-dd') + ' - ' + moment().format('yyyy-mm-dd'));
        }

        return {
            init: function () {
                handleDateRangePickers();
            }
        };

    }();

    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();

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

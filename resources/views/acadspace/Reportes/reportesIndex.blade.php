@extends('material.layouts.dashboard')

@push('styles')
<!-- MODAL -->
{{--//Estilos a usar en el formulario--}}
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{  asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{  asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Formatos Academicos'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            <br>

    </div>
    <div class="clearfix">
    </div>
    <br>
    <div class="col-md-7 col-md-offset-2">
        {!! Form::open (['method'=>'POST', 'route'=> ['espacios.academicos.report.repEst']]) !!}

        <div class="form-body">

            {!! Field::text('date_range',['required', 'readonly', 'auto' => 'off', 'class' => 'range-date-time-picker'],
            ['help' => 'Selecciona un rango de fechas.', 'icon' => 'fa fa-calendar'])       !!}


            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0" align="center">
                        {{ Form::submit('Reporte Estudiantes', ['class' => 'btn blue']) }}

                    </div>
                </div>
            </div>


            {!! Form::close() !!}
        </div>


    </div>
    <div class="clearfix">
    </div>

    </div>
    @endcomponent
    </br>
    </br>
    </br>
    </br>

    </div>
    {{-- END HTML SAMPLE --}}
@endsection

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts necesarios para usar plugins
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}

@push('plugins')
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.quicksearch.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/stewartlord-identicon/identicon.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/stewartlord-identicon/pnglib.js') }}" type="text/javascript"></script>

<!-- SCRIPT DATATABLE -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<!-- SCRIPT MODAL -->
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<!-- SCRIPT Validacion Maxlength -->
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Personalizadas -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<!-- SCRIPT MENSAJES TOAST-->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
@endpush

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts para inicializar componentes Javascript como
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}
@push('functions')
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">    </script>
<!-- Estandar Mensajes -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">    </script>
<!-- Estandar Datatable -->
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">   </script>
<script>

    /*PINTAR TABLA*/
    $(document).ready(function()
    {

    });


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
                    dateFormat: 'yyyy-mm-dd',
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
                    $('.range-date-time-picker span').html(start.format('yyyy-mm-dd') + ' - ' + end.format('yyyy-mm-dd'));
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

    jQuery(document).ready(function() {
        ComponentsDateTimePickers.init();
    });
</script>
@endpush

@permission('auxapoyo')
@extends('material.layouts.dashboard')

@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title', 'Formatos Academicos')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Formatos Academicos'])

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
            <div class="clearfix"> </div><br><br><br>
            <div class="row">
                <div class="col-md-7 col-md-offset-2">

                    {!! Field::text('date_range',['required', 'readonly', 'auto' => 'off', 'class' => 'range-date-time-picker'],
                        ['help' => 'Selecciona un rango de fechas.', 'icon' => 'fa fa-calendar'])       !!}

                </div>

                <div class="col-md-7 col-md-offset-5">
                    <br>
                    {!! link_to_route('espacios.academicos.editAct',$title='Reporte Estudiantes', $parameters=0,
                                                $atributes=  ['class' => 'btn blue button-submit']) !!}
                    <br><br>
                    {!! link_to_route('espacios.academicos.descargarArchivo',$title='Reporte Docentes', $parameters=0,
                    $atributes=  ['class' => 'btn blue button-submit']) !!}
                    <br>
                </div>
            </div>
        @endcomponent
    </div>
@endsection

@push('plugins')
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/dropzone.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function() {
        /*Crear Solicitud Formato*/
        var DireccionReport = function () {
            return{
                init: function () {
                    var route = '{{ route('espacios.academicos.formacad.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('titulo', $('input:text[name="txt_nombre"]').val());
                    formData.append('descripcion', $('input:text[name="txt_descripcion"]').val());

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'danger') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var route = '{{route('espacios.academicos.formacad.store')}}';
        var formatfile = 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.pdf';
        var numfile = 2;
        DireccionReport.init();
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

            $('.range-date-time-picker span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
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
@endpermission
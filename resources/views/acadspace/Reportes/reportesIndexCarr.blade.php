@extends('material.layouts.dashboard')
@permission('auxapoyo')
@section('page-title', 'Reportes:')
@push('styles')
    <!-- toastr Styles -->
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{  asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{  asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet"
          type="text/css"/>

    <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Reportes por carrera'])
            <div class="row">
                {{--DIVISION NAV--}}
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open (['method'=>'POST', 'route'=> ['espacios.academicos.report.repCarr'], 'target'=>'_blank']) !!}
                    <div class="form-body">
                        {!! Field::select('SOL_carrera',
                                      ['1' => 'Ingeniería de Sistemas', '2' => 'Ingeniería Ambiental',
                                      '3' => 'Ingeniería Agronomica', '4' => 'Administración',
                                      '5' => 'Psicología', '6' => 'Contaduría'],
                                      null,
                                      [ 'label' => 'Seleccione la carrera :']) !!}

                        {!! Field::text('date_range',['required', 'readonly', 'auto' => 'off', 'class' => 'range-date-time-picker'],
                        ['help' => 'Selecciona un rango de fechas.', 'icon' => 'fa fa-calendar'])       !!}
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0" align="center">
                                    {{ Form::submit('Generar Reporte', ['class' => 'btn blue']) }}

                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
    </div>
    {{-- FIN DIVISION NAV--}}

    @endcomponent

@endsection

@push('plugins')
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}"
            type="text/javascript"></script>@endpush

@push('functions')
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('input[name="date_range"]').daterangepicker();

        });


    </script>
@endpush
@endpermission
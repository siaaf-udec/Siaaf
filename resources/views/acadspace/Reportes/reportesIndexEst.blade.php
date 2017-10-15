@extends('material.layouts.dashboard')

@section('page-title', 'Reportes:')
@push('styles')
<!-- toastr Styles -->

<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />

<link href="{{  asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{  asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Reportes'])

            <div class="row">
                    {{--DIVISION NAV--}}
                    <div class="col-md-7 col-md-offset-2">
                        {!! Form::open (['method'=>'POST', 'route'=> ['espacios.academicos.report.repEst']]) !!}

                        <div class="form-body">
                            {!! Field::select('SOL_laboratorios',
                                ['Aulas de Computo' => 'Aulas de Computo',
                                'Laboratorio psicologia' => 'Laboratorio psicologia',
                                'Ciencias agropecuarias y ambientales' => 'Ciencias agropecuarias y ambientales'],
                                null,
                                [ 'label' => 'Seleccione el espacio academico que requiere:']) !!}

                            {!! Field::text('date_range',['required', 'readonly', 'auto' => 'off', 'class' => 'range-date-time-picker'],
                            ['help' => 'Selecciona un rango de fechas.', 'icon' => 'fa fa-calendar'])       !!}


                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12 col-md-offset-0" align="center">
                                        {{ Form::submit('Reporte Docentes', ['class' => 'btn blue']) }}

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
    </div>
@endsection

@push('plugins')
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>@endpush

@push('functions')
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">    </script>
<!-- Estandar Mensajes -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">    </script>
<!-- Estandar Datatable -->
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">   </script>
<script>

    /*PINTAR TABLA*/
    $(document).ready(function()
    {
        moment.locale('es');
        $('input[name="date_range"]').daterangepicker();
        $("#SOL_laboratorios").change(function (event) {
            /*Cargar select de aulas*/
            $.get("cargarSalasReportes/" + event.target.value + "", function (response) {
                $("#aula").empty();
                $("#aula").append("<option value='seleccione'>Seleccione</option>")
                for (i = 0; i < response.length; i++) {
                    $("#aula").append("<option value='" + response[i].PK_SAL_id_sala + "'>" + response[i].SAL_nombre_sala + "</option>")
                }
            });
        });


    });



</script>
@endpush

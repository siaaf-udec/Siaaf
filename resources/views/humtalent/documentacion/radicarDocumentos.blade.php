@extends('material.layouts.dashboard')

@section('page-title', 'Documentos Requeridos:')
@push('styles')
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered portlet-form">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class=" icon-book-open font-green"></i>
                    <span class="caption-subject bold uppercase">Recepción de Documentos </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="clearfix"> </div><br><br><br>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open (['method'=>'POST', 'route'=> ['talento.humano.radicarDocumentos'], 'role'=>"form"]) !!}
                        {{ csrf_field() }}
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
                            {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula) !!}

                            {!!  Field::checkboxes('FK_Personal_Documento',$docs,$seleccion,['list', 'label'=>'Seleccione si fue entregado el Documento']) !!}
                             {!! Field::date('EDCMT_Fecha',
                                ['label'=>'Fecha','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                ['help' => 'Selecciona la fecha de radicación.', 'icon' => 'fa fa-calendar']) !!}

                         {!! Form::submit('Guardar',['class'=>'btn blue','btn-icon remove']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript" charset="UTF-8"></script>
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
    jQuery(document).ready(function() {
        ComponentsDateTimePickers.init();
    });
</script>
@endpush
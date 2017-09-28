{{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Crear Solicitud'])
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
<div class="row">
<div class="col-md-12">
<div class="portlet light " id="form_wizard_1">
<div class="portlet-body form">
{!! Form::open(['id' => 'form_sol_create', 'class' => 'form-horizontal', 'url' => '/forms']) !!}
    <div class="form-body">
        <div class="col-md-10 col-md-offset-1">
            {!! Field::radios('SOL_ReqGuia',['Si'=>'Si', 'No'=>'No'], ['list', 'label'=>'Requiere guia de practica', 'icon'=>'fa fa-user']) !!}

            {!! Field::text('SOL_nucleo_tematico',null,['label'=>'Nucleo tematico:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
            ['help' => 'Digite el nucleo tematico.','icon'=>'fa fa-building-o'] ) !!}



            {!! Field::text('SOL_grupo',null,['label'=>'Grupo:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
            ['icon'=>'fa fa-group'] ) !!}

            {!! Field::text('SOL_cant_estudiantes',null,['label'=>'Cantidad de estudiantes:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
            ['icon'=>'fa fa-group'] ) !!}

            {!! Field::checkboxes('SOL_dias',
            ['Lunes' => 'Lunes', 'Martes' => 'Martes', 'Miercoles' => 'Miercoles', 'Jueves' => 'Jueves', 'Viernes' => 'Viernes','Sabado' => 'Sabado'],
            ['label' => 'Dias de la semana', 'inline', 'icon'=>'fa fa-user']) !!}

            {!! Field::text(
            'SOL_hora_inicio',
            ['label' => 'Hora de inicio', 'class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'auto' => 'off'],
            ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}

            {!! Field::text(
            'SOL_hora_fin',
            ['label' => 'Hora de fin', 'class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'auto' => 'off'],
            ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}


            {!! Field::date(
            'SOL_fecha_inicial',
            ['required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
            ['label' => 'Fecha inicial', 'icon' => 'fa fa-calendar']) !!}

            {!! Field::date(
            'SOL_fecha_final',
            ['required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
            ['label' => 'Fecha final', 'icon' => 'fa fa-calendar']) !!}
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                    {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
@endcomponent
</div>
{{-- END HTML SAMPLE --}}
<script src="{{ asset('assets/main/scripts/form-wizard.js') }}" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {



});
</script>

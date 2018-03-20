@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'EVALUACION'])
 {!! Form::open (['method'=>'POST', 'route'=> ['registrarEvaluacion.registrarEvaluacion',$N,$id,$convenio], 'role'=>"form"]) !!}
@if($Pregunta)
@php $N=0; @endphp 
@foreach($Pregunta as $row)
<div class="lead">
    <strong>
        @php 
        $N=$N+1; 
        echo $N.")";
        @endphp
    </strong>
    {{ $row->PRGT_Enunciado}}
</div>
{!! Field::hidden('Pregunta_'.$N, $row->PK_PRGT_Pregunta) !!}   
   
    {!! Field::radios('Respuesta_'.$row->PK_PRGT_Pregunta,['1' => 'Deficiente', '2' => 'Insuficioente','3' => 'Aceptable', '4' =>'Sobresaliente','5' => 'Excelente'],['list', 'label' => 'Selecciona una opcion']) !!}
 
    @endforeach
@endif
{{ Form::submit('Registrar', ['class' => 'btn blue']) }}
{{ Form::reset('Cancelar', ['class' => 'btn btn-danger atras']) }}
{!! Form::close() !!}

 @endcomponent

<script type="text/javascript">
jQuery(document).ready(function () {  

  $('.atras').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('documentosConvenios.documentosConvenios',[$convenio]) }}';
            $(".content-ajax").load(route);
        });
});
</script>
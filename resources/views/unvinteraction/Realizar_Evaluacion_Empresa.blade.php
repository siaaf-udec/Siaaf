@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'EVALUACION'])
  {!! Form::open (['method'=>'POST', 'route'=> ['Registrar_Evaluacion_Empresa.Registrar_Evaluacion_Empresa',$N,$id,$convenio], 'role'=>"form"]) !!}
        @if($Pregunta)
            <?php
                $N=0;
            ?>
            @foreach($Pregunta as $row)
                <div class="lead">
                    <strong>
                        <?php
                        $N=$N+1;
                echo $N.")";
                ?> 
                    </strong>
                    {{ $row->Enunciado}}
                </div>
                {!! Field::hidden('Pregunta_'.$N, $row->PK_Preguntas) !!}
                {!! Field::radios( 'Respuesta_'.$row->PK_Preguntas,
                            ['1' => 'Deficiente', '2' => 'Insuficioente','3' => 'Aceptable', '4' => 'Sobresaliente','5' => 'Excelente'],
                            
                            ['list', 'label' => 'Selecciona una opcion']) !!}
 
    @endforeach
@endif
{{ Form::submit('Registrar', ['class' => 'btn blue atras']) }}
{{ Form::reset('Cancelar', ['class' => 'btn btn-danger atras']) }}
{!! Form::close() !!}
@endcomponent
<script type="text/javascript">
jQuery(document).ready(function () {  

  $('.atras').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('Documentos_Convenios.Documentos_Convenios',[$convenio]) }}';
            $(".content-ajax").load(route);
        });
  
});
</script>
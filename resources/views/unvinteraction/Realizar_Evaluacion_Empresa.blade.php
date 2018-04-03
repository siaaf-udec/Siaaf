@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'EVALUACION'])
@permission(['Eva_pre3'])
@if($pregunta3)
    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Convenio']) !!}
    <div class="form-wizard">
        @php $N1=0; @endphp 
       
            @foreach($pregunta3 as $row)
                <div class="lead">
                    <strong>
                        @php 
                        $N1=$N1+1; 
                        echo $N1.")";
                        @endphp
                    </strong>
                    {{ $row->PRGT_Enunciado}}
                </div>
                {!! Field::hidden('Pregunta_'.$N1, $row->PK_PRGT_Pregunta) !!} 
               
                {!! Field::select('Respuesta_'.$N1,['1' => 'Deficiente', '2' => 'Insuficioente','3' => 'Aceptable', '4' =>'Sobresaliente','5' => 'Excelente'],[ 'label' => 'Selecciona una opcion de respuesta','required'])!!}
        
            @endforeach
            {!! Form::submit('Agregar', ['class' => 'btn blue']) !!}
            {{ Form::reset('Cancelar', ['class' => 'btn btn-danger atras']) }}
    </div>
    {!! Form::close() !!}
@endif
@endpermission
@permission(['Eva_pre4'])
@if($pregunta4)
    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-pregunta2']) !!}
        @php $N2=0; @endphp 
            @foreach($pregunta4 as $row)
                <div class="lead">
                    <strong>
                        @php 
                        $N2=$N2+1; 
                        echo $N2.")";
                        @endphp
                    </strong>
                    {{ $row->PRGT_Enunciado}}
                </div>
                {!! Field::hidden('2Pregunta_'.$N2, $row->PK_PRGT_Pregunta) !!} 
                {!! Field::select('2Respuesta_'.$N2,['1' => 'Deficiente', '2' => 'Insuficioente','3' => 'Aceptable', '4' =>'Sobresaliente','5' => 'Excelente'],[ 'label' => 'Selecciona una opcion de respuesta','required'])!!}
            @endforeach
            {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
            {{ Form::reset('Cancelar', ['class' => 'btn btn-danger atras']) }}
    {!! Form::close() !!}
@endif
@endpermission

@endcomponent
@permission(['Eva_pre3'])
<script type="text/javascript">
   
jQuery(document).ready(function () {  
    ComponentsSelect2.init();
    $('.atras').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('documentosConvenios.documentosConvenios',[$convenio]) }}';
            $(".content-ajax").load(route);
        });
    
    var form = $('#form-Agregar-Convenio');
        var wizard = $('#form_wizard_1');
        var rules = {
            
        };
        var crearConvenio = function() {
            return {
                init: function() {
                    var route = '{{ route('registrarEvaluacionEmpresa.registrarEvaluacionEmpresa',[$id,$convenio,$N1]) }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    for(i=1;i<=<?= $N1 ?> ;i++){
                        formData.append('Pregunta_'+i, $('input[name=Pregunta_'+i+']').val());
                        formData.append('Respuesta_'+i, $('select[name="Respuesta_'+i+'"]').val());
                    } 
                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        success: function(response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                                 var route = '{{ route('documentosConvenios.documentosConvenios',[$convenio])}}';
                                $(".content-ajax").load(route);
                                
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var messages = {};
        FormValidationMd.init(form, rules, false, crearConvenio());    
  
            

});
</script>
@endpermission
@permission(['Eva_pre4'])
<script type="text/javascript">
   
jQuery(document).ready(function () {  
ComponentsSelect2.init();
  $('.atras').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('documentosConvenios.documentosConvenios',[$convenio]) }}';
            $(".content-ajax").load(route);
        });
    
    var form = $('#form-pregunta2');
        var wizard = $('#form_wizard_1');
        var rules = {
            
        };
        var crearConvenio = function() {
            return {
                init: function() {
                    var route = '{{ route('registrarEvaluacionEmpresa.registrarEvaluacionEmpresa',[$id,$convenio,$N2]) }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    for(i=1;i<=<?= $N2 ?> ;i++){
                        formData.append('Pregunta_'+i, $('input[name=2Pregunta_'+i+']').val());
                        formData.append('Respuesta_'+i, $('select[name="2Respuesta_'+i+'"]').val());
                    } 
                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        success: function(response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                                var route = '{{ route('documentosConvenios.documentosConvenios',[$convenio]) }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var messages = {};
        FormValidationMd.init(form, rules, false, crearConvenio());    
  
            

});
</script>
@endpermission

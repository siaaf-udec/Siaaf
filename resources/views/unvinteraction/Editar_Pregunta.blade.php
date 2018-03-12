
   
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EDICION  DE ESTADOS'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="form-body">
                            {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Modificar-Pregunta']) !!}
                            <div class="form-wizard">
                            {!! Field:: textarea('Enunciado',$Pregunta->Enunciado,['label'=>'Enunciado de la pregunta','class'=> 'form-control', 'autofocus', 'size'=>'100px','autocomplete'=>'off'],['help' => 'Agregar el enunciado de la pregunta','icon'=>'fa fa-graduation-cap'] ) !!}
                            {!! Field::select('FK_TBL_Tipo_Pregunta',$Pregunta1,$Pregunta->FK_TBL_Tipo_Pregunta,[ 'label' => 'Selecciona un tipo de pregunta'])!!}
                            <div class="form-actions">
                              <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                    {{ Form::submit('Editar', ['class' => 'btn blue']) }}
                                    {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                                  </div>
                                    
                                    

                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        @endcomponent
    </div>

<script>
jQuery(document).ready(function () {
    
    $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            };
            
    var form=$('#form-Modificar-Pregunta');
    var wizard =  $('#form_wizard_1');
            
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('Modificar_Pregunta.Modificar_Pregunta',[$Pregunta->PK_Preguntas]) }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('Enunciado', $('#Enunciado').val());
                    formData.append('FK_TBL_Tipo_Pregunta', $('select[name="FK_TBL_Tipo_Pregunta"]').val());
                   
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        UIToastr.init(xhr , response.title , response.message  );
                        var route = '{{ route('Pregunta_Ajax.Pregunta_Ajax') }}';
                        $(".content-ajax").load(route);
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'success') {
                        UIToastr.init(xhr, response.title, response.message);
                    }
                }
                    });
                }
            }
        };    
    
    var messages = {};
        
    FormValidationMd.init( form, rules, messages , crearConvenio());
    
    $('.atras').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('Pregunta_Ajax.Pregunta_Ajax') }}';
            $(".content-ajax").load(route);
        });
  });   
</script>

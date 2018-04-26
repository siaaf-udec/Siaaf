<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EDICION  DE TIPOS DE PREGUNTAS'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="form-body">
                            {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Modificar-Pregunta']) !!}
                            <div class="form-wizard">
                            {!! Field:: text('TPPG_Tipo',$pregunta->TPPG_Tipo,['label'=>'Tipo de pregunta','class'=> 'form-control', 'autofocus','required' => 'required', 'maxlength'=>'20', 'size'=>'100px','autocomplete'=>'off'],['help' => 'Agregar el tipo de pregunta','icon'=>'fa fa-graduation-cap'] ) !!}
                            
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
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {
     App.unblockUI('.portlet-form');
    $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            TPPG_Tipo: {required: true},
    };
    var form=$('#form-Modificar-Pregunta');
    var wizard =  $('#form_wizard_1');
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('modificarTipoPregunta.modificarTipoPregunta',[$pregunta->PK_TPPG_Tipo_Pregunta]) }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('TPPG_Tipo', $('#TPPG_Tipo').val());
                   
                   
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
								App.blockUI({target: '.portlet-form', animate: true});
							},
                        success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        UIToastr.init(xhr , response.title , response.message  );
                        var route = '{{ route('tipoPreguntaAjax.tipoPreguntaAjax') }}';
                        $(".content-ajax").load(route); 
                        App.unblockUI('.portlet-form');
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'error') {
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
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
            var route = '{{ route('tipoPreguntaAjax.tipoPreguntaAjax') }}';
            $(".content-ajax").load(route);
        });
  });   
</script>

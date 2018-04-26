<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EDICION  DE ESTADOS'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="form-body">
                            {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Modificar-Estado']) !!}
                            <div class="form-wizard">
                                {!! Field:: text('ETAD_Estado',$estado->ETAD_Estado,['label'=>'Estado', 'class'=> 'form-control', 'autofocus','required' => 'required', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Nombre de la sede','icon'=>'fa fa-line-chart'] ) !!}
                        
                                {{ Form::submit('Editar', ['class' => 'btn blue']) }}
                                {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                                 
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
    </div>
    @endcomponent
</div>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">
<script>
jQuery(document).ready(function () {
    App.unblockUI('.portlet-form');
    $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            ETAD_Estado: {required: true}
    };  
    var form=$('#form-Modificar-Estado');
    var wizard =  $('#form_wizard_1');
            
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('modificarEstados.modificarEstados',[$estado->PK_ETAD_Estado]) }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('ETAD_Estado', $('#ETAD_Estado').val());
                   
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
                        var route = '{{ route('estadosAjax.estadosAjax') }}';
                        $(".content-ajax").load(route);
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
            var route = '{{ route('estadosAjax.estadosAjax') }}';
            $(".content-ajax").load(route);
        });
  });   
</script>

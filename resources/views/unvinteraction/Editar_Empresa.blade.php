<div class="col-md-12">
 @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de empresas'])
<div class="row">
                <div class="col-md-7 col-md-offset-2">
                   
                    <div class="form-body">

                        {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Modificar-Empresa']) !!}
                    <div class="form-wizard">
                        
                        {!! Field:: text('Nombre_Empresa',$Empresa->Nombre_Empresa,['label'=>'Nombre de la empresa', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digitar el ombre de la empresa','icon'=>'fa fa-user'] ) !!}
                        {!! Field:: text('Razon_Social',$Empresa->Razon_Social,['label'=>'Razon saocial', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'digitar la razon social de la empresa','icon'=>'fa fa-user'] ) !!}
                        {!! Field:: text('Telefono',$Empresa->Telefono,['label'=>'Telefono', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digitar el numero de telefono de la empresa','icon'=>'fa fa-user'] ) !!}
                        {!! Field:: text('Direccion',$Empresa->Direccion,['label'=>'Direccion de la empresa', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'digitar la direcion de la empresa','icon'=>'fa fa-user'] ) !!}
                        

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

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
     <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function () {
  $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            };
            
    var form=$('#form-Modificar-Empresa');
    var wizard =  $('#form_wizard_1');
            
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('Modificar_Empresa.Modificar_Empresa',[$Empresa->PK_Empresa]) }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('Nombre_Empresa', $('#Nombre_Empresa').val());
                    formData.append('Razon_Social', $('#Razon_Social').val());
                    formData.append('Telefono', $('#Telefono').val());
                    formData.append('Direccion', $('#Direccion').val());
                   
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
                        var route = '{{ route('Empresas_Ajax.Empresas_Ajax') }}';
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
            var route = '{{ route('Empresas_Ajax.Empresas_Ajax') }}';
            $(".content-ajax").load(route);
        });
  
});
</script>

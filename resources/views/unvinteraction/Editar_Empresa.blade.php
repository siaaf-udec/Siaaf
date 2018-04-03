<div class="col-md-12">
 @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de empresas'])
<div class="row">
    <div class="col-md-7 col-md-offset-2">
        <div class="form-body">
            {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Modificar-Empresa']) !!}
            <div class="form-wizard">
                {!! Field:: text('EMPS_Nombre_Empresa',$empresa->EMPS_Nombre_Empresa,['label'=>'Nombre de la empresa', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digitar el ombre de la empresa','icon'=>'fa fa-user'] ) !!}
                
                {!! Field:: text('EMPS_Razon_Social',$empresa->EMPS_Razon_Social,['label'=>'Razon saocial', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'digitar la razon social de la empresa','icon'=>'fa fa-user'] ) !!}
                
                {!! Field:: text('EMPS_Telefono',$empresa->EMPS_Telefono,['label'=>'Telefono', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digitar el numero de telefono de la empresa','icon'=>'fa fa-user'] ) !!}
                
                {!! Field:: text('EMPS_Direccion',$empresa->EMPS_Direccion,['label'=>'Direccion de la empresa', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'digitar la direcion de la empresa','icon'=>'fa fa-user'] ) !!}
                
                {{ Form::submit('Editar', ['class' => 'btn blue']) }}
                {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                
                    
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
    @endcomponent
</div>
<script type="text/javascript">
jQuery(document).ready(function () {
  $('.portlet-form').attr("id", "form_wizard_1");
    var rules = {
            EMPS_Nombre_Empresa:{required: true},
            EMPS_Razon_Social:  {required: true},
            EMPS_Telefono:      {required: true},
            EMPS_Direccion:     {required: true}
    };        
    var form=$('#form-Modificar-Empresa');
    var wizard =  $('#form_wizard_1');
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('modificarEmpresa.modificarEmpresa',[$empresa->PK_EMPS_Empresa]) }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('EMPS_Nombre_Empresa', $('#EMPS_Nombre_Empresa').val());
                    formData.append('EMPS_Razon_Social', $('#EMPS_Razon_Social').val());
                    formData.append('EMPS_Telefono', $('#EMPS_Telefono').val());
                    formData.append('EMPS_Direccion', $('#EMPS_Direccion').val());
                   
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
                        var route = '{{ route('empresasAjax.empresasAjax') }}';
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
            var route = '{{ route('empresasAjax.empresasAjax') }}';
            $(".content-ajax").load(route);
        });
  
});
</script>

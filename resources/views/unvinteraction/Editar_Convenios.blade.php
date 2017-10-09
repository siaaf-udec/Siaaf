<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EDICION  DEL CONVENIO'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="form-body">
                           
                        {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Modificar-Convenio']) !!}
                        <div class="form-wizard">
                            {!! Field:: text('Nombre',$Convenio->Nombre,['label'=>'nombre del convenio', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Nombre de convenio','icon'=>'fa fa-line-chart'] ) !!}
                        
                            {!! Field::date('Fecha_Inicio',$Convenio->Fecha_Inicio,['label'=>'Fecha Inicio','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
                        
                            {!! Field::date('Fecha_Fin',$Convenio->Fecha_Fin,['label'=>'Fecha Final','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
                            
                            {!! Field::select('FK_TBL_Estado',$Estado,$Convenio->FK_TBL_Estado,[ 'label' => 'Selecciona un estado'])!!}
                        
                            {!! Field::select('FK_TBL_Sede',$Sede,$Convenio->FK_TBL_Sede,[ 'label' => 'Selecciona una   sede'])!!}
                        <div class="form-actions">
                              <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                    {{ Form::submit('Editar', ['class' => 'btn blue']) }}
                                     {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                                  </div>
                                    {!! Form::close() !!}
                                   

                                </div>
                            </div>
                        </div>
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
            
    var form=$('#form-Modificar-Convenio');
    var wizard =  $('#form_wizard_1');
            
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('Modificar_Convenios.Modificar_Convenios',[$Convenio->PK_Convenios]) }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('Nombre', $('#Nombre').val());
                    formData.append('Fecha_Inicio', $('#Fecha_Inicio').val());
                    formData.append('Fecha_Fin', $('#Fecha_Fin').val());
                    formData.append('FK_TBL_Estado', $('select[name="FK_TBL_Estado"]').val());
                    formData.append('FK_TBL_Sede', $('select[name="FK_TBL_Sede"]').val());
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
                        var route = '{{ route('Convenios_Ajax.Convenios_Ajax') }}';
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
            var route = '{{ route('Convenios_Ajax.Convenios_Ajax') }}';
            $(".content-ajax").load(route);
        });
  });   
</script>

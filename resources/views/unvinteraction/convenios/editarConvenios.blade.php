<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EDICION  DEL CONVENIO'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="form-body">
                           
                        {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Modificar-Convenio']) !!}
                        <div class="form-wizard">
                            {!! Field:: text('CVNO_Nombre',$convenio->CVNO_Nombre,['label'=>'nombre del convenio', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off','required'],['help' => 'Nombre de convenio','icon'=>'fa fa-line-chart'] ) !!}
                        
                            {!! Field::date('CVNO_Fecha_Inicio',$convenio->CVNO_Fecha_Inicio,['label'=>'Fecha Inicio','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'seleciona una fecha', 'icon' => 'fa fa-calendar']) !!}
                        
                            {!! Field::date('CVNO_Fecha_Fin',$convenio->CVNO_Fecha_Fin,['label'=>'Fecha Final','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'seleciona una fecha', 'icon' => 'fa fa-calendar']) !!}
                            
                            {!! Field::select('FK_TBL_Estado_Id',$estado,$convenio->FK_TBL_Estado_Id,[ 'label' => 'Selecciona un estado'])!!}
                        
                            {!! Field::select('FK_TBL_Sede_Id',$sede,$convenio->FK_TBL_Sede_Id,[ 'label' => 'Selecciona una   sede,'required'
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
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {
    ComponentsDateTimePickers.init();
    ComponentsSelect2.init();
    App.unblockUI('.portlet-form');
    $('.portlet-form').attr("id","form_wizard_1");
     var rules = {
            CVNO_Nombre: {required: true},
            CVNO_Fecha_Inicio: {required: true},
            CVNO_Fecha_Fin: {required: true},
            FK_TBL_Sede_Id: {required: true},
            FK_TBL_Estado_Id: {required: true}
            
        };
    var form=$('#form-Modificar-Convenio');
    var wizard =  $('#form_wizard_1');
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('modificarConvenios.modificarConvenios',[$convenio->PK_CVNO_Convenio]) }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('CVNO_Nombre', $('#CVNO_Nombre').val());
                    formData.append('CVNO_Fecha_Inicio', $('#CVNO_Fecha_Inicio').val());
                    formData.append('CVNO_Fecha_Fin', $('#CVNO_Fecha_Fin').val());
                    formData.append('FK_TBL_Estado_Id', $('select[name="FK_TBL_Estado_Id"]').val());
                    formData.append('FK_TBL_Sede_Id', $('select[name="FK_TBL_Sede_Id"]').val());
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
                        var route = '{{ route('conveniosAjax.conveniosAjax') }}';
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
            var route = '{{ route('conveniosAjax.conveniosAjax') }}';
            $(".content-ajax").load(route);
        });
  });   
</script>

<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos del Anteproyecto'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$infoAnte], ['id'=>'form_update_anteproyecto', 'url' => '/forms'])  !!}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                        {!! Field:: text('PK_NPRY_IdMctr008',$infoAnte['PK_NPRY_IdMctr008'],['label'=>'Código interno:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Codigo Interno Del Anteproyecto.','icon'=>'fa fa-credit-card'] ) !!}

                        {!! Field:: text('NPRY_Titulo',$infoAnte['NPRY_Titulo'],['label'=>'TITULO:','readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                            {!! Field:: text('NPRY_Keywords',$infoAnte['NPRY_Keywords'],['label'=>'PALABRAS CLAVE:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Descripcion',$infoAnte['NPRY_Descripcion'],['label'=>'DESCRIPCION:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                            {!! Field:: text('NPRY_Duracion',$infoAnte['NPRY_Duracion'],['label'=>'DURACION:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                            {!! Field::select('FK_NPRY_Estado', null,['name' => 'SelectEstado','label'=>'Estado :']) !!}
                 

                            {!! Field::select('FK_NPRY_Pre_Director', null,['name' => 'SelectPre_Director','label'=>'Pre Director:']) !!}
                   
                          
                      </div>
          
                    </div>
                    {!! Field::select('FK_NPRY_Pre_Director', null,['name' => 'Estudiante1','label'=>'Estudiante N°1:']) !!}
                   
                   {!! Field::select('FK_NPRY_Pre_Director', null,['name' => 'Estudiante2','label'=>'Estudiante N°2:']) !!}
          
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                @permission('ADMIN_GESAP')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission
                                @permission('ADMIN_GESAP'){{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endcomponent


<!-- Modal Update Foto -->
   
    <div class="modal-footer">

{!! Form::close() !!}
</div>

    <!-- Fin Modal Update Foto -->


</div>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {
        
        var $widget_select_SelectEstado = $('select[name="SelectEstado"]');

var valorSelected = <?php echo $infoAnte['FK_NPRY_Estado']; ?>

var route_Estado = '{{ route('AnteproyectoGesap.listarEstado') }}';
$.get(route_Estado, function (response, status) {
    $(response.data).each(function (key, value) {
        $widget_select_SelectEstado.append(new Option(value.EST_estado, value.PK_EST_Id));
    });
    $widget_select_SelectEstado.val();
    $('#FK_NPRY_Estado').val(valorSelected);
});


var $widget_select_Pre_Director = $('select[name="SelectPre_Director"]');
var valorSelectedPre =
        <?php echo $infoAnte['FK_NPRY_Pre_Director']; ?>

var route_Pre_Director = '{{ route('AnteproyectoGesap.listarpredirector') }}';
$.get(route_Pre_Director, function (response, status) {
$(response.data).each(function (key, value) {
    $widget_select_Pre_Director.append(new Option(value.User_Nombre1, value.PK_User_Codigo ));
});
$widget_select_Pre_Director.val([]);
$('#FK_NPRY_Pre_Director').val(valorSelectedPre);
});


$.fn.select2.defaults.set("theme", "bootstrap");
    $(".pmd-select2").select2({
        placeholder: "Seleccionar",
        allowClear: true,
        width: 'auto',
        escapeMarkup: function (m) {
            return m;
        }
    });

     
    $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
            location.href="{{route('AnteproyectosGesap.index')}}";
            //$(".content-ajax").load(route);
        });
    });
</script>


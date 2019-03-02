       <!--MODAL CREAR COMENTARIO-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-coment" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_create-coment', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Comentario</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: textArea('Desicion',null,['label'=>'El porque de la Desición:','class'=> 'form-control', 'autofocus','maxlength'=>'4000','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el por que de la decision, tenga en cuenta que esta informacion se le mostrara al estudiante.','icon'=>'fa fa-book']) !!}
                                     {!! Field::select('Estado',['1'=>'EN ESPERA', '4'=>'APROBADO','5'=>'REPROBADO','6'=>'APLAZADO'],null,['label'=>'DECISIÓN: ']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                
            </div>
            <!--MODAL CREAR COMENTARIO-->
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario para Califiacr el Formato Mctr008'])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            {!! Form::model ([$datos],['id'=>'form_subir_actividad', 'url' => '/forms'])  !!}
       <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                               <br>
                               <br>
                        </div>
                        <div class="col-md-6">
                                {!! Field:: text('MCT_Actividad',$datos['NPRY_Titulo'],['label'=>'Titulo:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}                      
                                {!! Field:: text('MCT_Actividad',$datos['Director'],['label'=>'Director:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}
                                {!! Field:: text('MCT_Actividad',$datos['Estado'],['label'=>'Estado Anteproyecto:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                               
                               </div>
                             
                        </div>

                    <h4> Desiciónes de los jurados</h4>
                    <br><br>
                    @permission('PROYECT_COMENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Tomar Desición
                        </a>@endpermission
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'DesicionJurados'])
                        @slot('columns', [
                            'Jurado',
                            'Estado AnteProyecto',
                            'Observaciónes'                           
                        ])
                    @endcomponent
                    <h4> Observaciónes del Mct Hecha Por los Jurados</h4>
                     <br>
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'ListaComentariosJurados'])
                        @slot('columns', [
                            'Fecha de realización',
                            'Observación',
                            'Realizada por',
                            'Actividad'
                            
                        ])
                    @endcomponent
                     <br>
                     <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('BACK_DOCENTE')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Regresar
                                </a>@endpermission
                            </div>
                            
                        </div>
                        
                    </div>
                     {!! Form::close() !!}
                 </div>
        </div>

    @endcomponent
</div>

<!-- file script -->
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    ////////widget/////////

    /* var $widget_Select_Estado = $('select[name="Select_Estado"]');

    var route_Estado = '{{ route('DocenteGesap.listarEstadoJurado') }}';

    $.get(route_Estado, function (response, status) {
    $(response.data).each(function (key, value) {
        $widget_Select_Estado.append(new Option(value.EST_estado, value.PK_EST_Id ));
    });
    $widget_Select_Estado.val([]);
    $('#Estado').val();
    });
 */

        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Seleccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); 
        });
   ////////////FIN WIDGET////////////////
   ////////////MODEL//////////////
        //id = 111100009;
        id = 111109999;

      var CrearComentario = function () {
                return {
                    init: function () {
                        var route = '{{ route('DocenteGesap.CambiarEstadoJurado') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();

                        formData.append('JR_Comentario', $('#Desicion').val());
                        formData.append('FK_NPRY_Estado', $('#Estado').val());
                        formData.append('FK_User_Codigo', id);
                        formData.append('PK_NPRY_Id_Mctr008', '{{$datos['PK_NPRY_IdMctr008']}}');
                       
                      

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                                   // table.ajax.reload();
                                    $('#modal-create-coment').modal('hide');
                                    $('#from_create-coment')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('DocenteGesap.CalificarJurado') }}' + '/' + '{{$datos['PK_NPRY_IdMctr008']}}';
                                    $(".content-ajax").load(route);
                             }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('DocenteGesap.CalificarJurado') }}' + '/' + '{{$datos['PK_NPRY_IdMctr008']}}';
                                    $(".content-ajax").load(route);
                               }
                            }
                        });
                    }
                }
            };
            var form = $('#from_create-coment');
            var rules = {
                Desicion: {required: true, minlength: 1, maxlength: 600},
                Select_Estado :{required: true},
            };

                FormValidationMd.init(form, rules, false, CrearComentario());
/////////FIN MODEL////////
//////tabla1/////////////
        var table, url, columns;
        table = $('#DesicionJurados');
        url = '{{ route('DocenteGesap.DesicionJurados') }}'+'/'+'{{$datos['PK_NPRY_IdMctr008']}}';
         
        columns = [
            {data: 'Jurado', name: 'Jurado'},
            {data: 'Estado', name: 'Estado'},
            {data: 'JR_Comentario', name: 'JR_Comentario'},
          
            
        ];

        dataTableServer.init(table, url, columns);
        table = table.DataTable();
////////////tabla2/////////

        var table1, url1, columns1;
        table1 = $('#ListaComentariosJurados');
        url1 = '{{ route('DocenteGesap.ComentariosJu') }}'+'/'+'{{$datos['PK_NPRY_IdMctr008']}}';
         
        columns1 = [
            {data: 'created_at', name: 'created_at'},
            {data: 'OBS_observacion', name: 'OBS_observacion'},
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Actividad', name: 'Actividad'}
          
            
        ];

        dataTableServer.init(table1, url1, columns1);
        table1 = table1.DataTable();

        

        $('.gestionar').on('click', function (e) {
                e.preventDefault();
                $('#modal-create-coment').modal('toggle');
            });
             
    $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('DocenteGesap.index.ajax') }}';
            location.href="{{route('DocenteGesap.index')}}";
            //$(".content-ajax").load(route);
        });
            
           

})
</script>    

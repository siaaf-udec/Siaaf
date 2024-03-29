       <!--MODAL CREAR COMENTARIO-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-coment" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                    {!! Form::model([$datos],['id' => 'from_create-coment', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Comentario</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                {!! Field:: TextArea('Desicion',$datos['Comentarios_Jurado'],['label'=>'Tipo:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el por que de la decision, tenga en cuenta que esta informacion se le mostrara al estudiante.','icon'=>'fa fa-book']) !!}
                                @if($datos['N_Radicado'] == 1)
                                {!! Field::select('Estado',[ '4'=>'APROBADO','5'=>'REPROBADO','6'=>'APLAZADO'],null,['label'=>'DECISIÓN: ']) !!}
                 
                                @endif
                                @if($datos['N_Radicado'] == 2)
                                {!! Field::select('Estado',[ '4'=>'APROBADO','5'=>'REPROBADO'],null,['label'=>'DECISIÓN: ']) !!}
                 
                                @endif
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
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario para Calificar el Libro'])
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
                              
                               
                               </div>
                             
                        </div>
                        {!! Field:: text('MCT_Actividad',$datos['NPRY_Titulo'],['label'=>'Titulo:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}                      
                                {!! Field:: text('MCT_Actividad',$datos['Director'],['label'=>'Director:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}
                                {!! Field:: text('MCT_Actividad',$datos['Estado'],['label'=>'Estado Anteproyecto:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}



                    <h4> Desiciónes de los jurados</h4>
                    <br><br>
                    @if($datos['Estado'] == 'RADICADO')
                    @permission('GESAP_DOCENTE_DECISION_JUDMENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Tomar Desición
                        </a>@endpermission
                    @endif
                    
                    @if($datos['N_Radicado'] == 1)
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'DesicionJurados'])
                        @slot('columns', [
                            'Jurado',
                            'Desición Jurado',
                            'Observaciónes'                      
                        ])
                    @endcomponent
                    @endif
                    
                    @if($datos['N_Radicado'] == 2)
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'DesicionJurados2'])
                        @slot('columns', [
                            'Jurado',
                            'Desición Jurado Actual',
                            'Observaciónes Anteriores',
                            'Observaciónes Actuales'                        
                        ])
                    @endcomponent
                    @endif
                    
                    <h4> Observaciónes del Libro Hechas Por los Jurados</h4>
                     <br>
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'ListaComentariosJurados'])
                        @slot('columns', [
                            'Fecha de Realización',
                            'Observación',
                            'Realizada por',
                            'Actividad'
                            
                        ])
                    @endcomponent
                     <br>
                     <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('GESAP_DOCENTE_CANCEL')<a href="javascript:;"
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
       // id = 111100009;
        id = 111109999;

      var CrearComentario = function () {
                return {
                    init: function () {
                        var route = '{{ route('DocenteGesap.CambiarEstadoJuradoProyecto') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();

                        formData.append('JR_Comentario_Proyecto', $('#Desicion').val());
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
                                    var route = '{{ route('DocenteGesap.CalificarProyectoJurado') }}' + '/' + '{{$datos['PK_NPRY_IdMctr008']}}';
                                    $(".content-ajax").load(route);
                             }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('DocenteGesap.CalificarProyectoJurado') }}' + '/' + '{{$datos['PK_NPRY_IdMctr008']}}';
                                    $(".content-ajax").load(route);
                               }
                            }
                        });
                    }
                }
            };
            var form = $('#from_create-coment');
            var rules = {
                Desicion: {required: true, minlength: 1, maxlength: 4000},
                Estado :{required: true},
            };

                FormValidationMd.init(form, rules, false, CrearComentario());
/////////FIN MODEL////////
//////tabla1/////////////
        var table, url, columns;
        table = $('#DesicionJurados');
        url = '{{ route('DocenteGesap.DesicionJuradosProyecto') }}'+'/'+'{{$datos['PK_NPRY_IdMctr008']}}';
         
        columns = [
            {data: 'Jurado', name: 'Jurado'},
            {data: 'Estado', name: 'Estado'},
            {data: 'JR_Comentario_Proyecto', name: 'JR_Comentario_Proyecto'},
          
            
        ];

        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        
       
        var table, url, columns;
        table = $('#DesicionJurados2');
        url = '{{ route('DocenteGesap.DesicionJuradosProyecto') }}'+'/'+'{{$datos['PK_NPRY_IdMctr008']}}';
         
        columns = [
            {data: 'Jurado', name: 'Jurado'},
            {data: 'Estado', name: 'Estado'},
            {data: 'JR_Comentario_Proyecto', name: 'JR_Comentario_Proyecto'},
            {data: 'JR_Comentario_Proyecto_2', name: 'JR_Comentario_Proyecto_2'},   
        ];

        dataTableServer.init(table, url, columns);
        table = table.DataTable();
////////////tabla2/////////

        var table1, url1, columns1;
        table1 = $('#ListaComentariosJurados');
        url1 = '{{ route('DocenteGesap.ComentariosJuProyecto') }}'+'/'+'{{$datos['PK_NPRY_IdMctr008']}}';
         
        columns1 = [
            {data: 'created_at', name: 'created_at'},
            {data: 'OBS_Observacion', name: 'OBS_Observacion'},
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
            location.href="{{route('DocenteGesap.indexProyecto')}}";
            //$(".content-ajax").load(route);
        });
            
           

})
</script>    

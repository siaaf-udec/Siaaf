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
                                   {!! Field:: textArea('OBS_observacion',null,['label'=>'Comentario:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su comentario acerca esta actividad','icon'=>'fa fa-book']) !!}
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
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario para revisar Actividades del Mctr008'])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            {!! Form::model ([$datos], ['id'=>'form_subir_actividad', 'url' => '/forms'])  !!}
       <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                               <br>
                               <br>
                        </div>
                        <div class="col-md-6">
                        
                               </div>
                             
                        </div>
                        {!! Field:: text('MCT_Actividad',$datos['Estado'],['label'=>'ESTADO:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                       
                                {!! Field:: text('MCT_Actividad',$datos[0]['MCT_Actividad'],['label'=>'Actividad:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                                {!! Field:: textArea('MCT_Descripcion',$datos[0]['MCT_Descripcion'],['label'=>'DESCRIPCIÓN:', 'class'=> 'form-control','readonly', 'autofocus','autocomplete'=>'off'],
                                                                ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                               
                        {!! Field:: textArea('CMMT_Commit',$datos['Commit'],['label'=>'INFORMACIÓN:', 'class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Coloque una breve descrición del Anteproyecto.','icon'=>'fa fa-book'] ) !!}

                    

                    <h4> Observaciónes acerca de esta Actividad del Mct</h4>
                    <br><br>
                    @permission('GESAP_DOCENTE_COMENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Agregar Observación
                        </a>@endpermission
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'ListaComentarios'])
                        @slot('columns', [
                    
                            'Observación',
                            'Realizada por',
                            'Fecha De Realización'
                          
                            
                        ])
                    @endcomponent
                     <br>
                     <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-2">
                            @if($datos['Primera'] != $datos[0]['PK_MCT_IdMctr008'])
                                @permission('GESAP_DOCENTE_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline red button-anterior"><i
                                            class="fa fa-angle-left"></i>
                                    Actividad Anterior
                                </a>@endpermission
                                @endif
                                @permission('GESAP_DOCENTE_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Regresar
                                </a>@endpermission
                                @if($datos['Ultima'] != $datos[0]['PK_MCT_IdMctr008'])
                                @permission('GESAP_DOCENTE_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline blue button-siguiente"><i
                                            class="fa fa-angle-rigth"></i>
                                    Siguente Actividad
                                </a>@endpermission
                                @endif
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
 
    //id = 123400009 ;
    id2 = 111100009 ;

    var table, url, columns;
        table = $('#ListaComentarios');
        url = '{{ route('DocenteGesap.ComentariosJurado') }}'+'/'+'{{$datos[0]['PK_MCT_IdMctr008']}}'+'/'+'{{$datos['Anteproyecto']}}';
         
        columns = [
            //{data: 'updated_at', name: 'updated_at'},
            {data: 'OBS_Observacion', name: 'OBS_Observacion'},
            {data: 'Usuario', name: 'Usuario'},
            {data: 'created_at', name: 'created_at'},
        ];

        dataTableServer.init(table, url, columns);
        table = table.DataTable();
     
            $('.gestionar').on('click', function (e) {
                e.preventDefault();
                $('#modal-create-coment').modal('toggle');
            });
            id = 111100009;
            var CrearComentario = function () {
                return {
                    init: function () {
                        var route = '{{ route('DocenteGesap.ComentarioStoreJurado') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id2);
                        formData.append('OBS_observacion', $('#OBS_observacion').val());
                        formData.append('OBS_Formato', 1);
                      

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
                                    var route = '{{ route('DocenteGesap.RequerimientosJurado') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('DocenteGesap.RequerimientosJurado') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                }
                            }
                        });
                    }
                }
            };
            var form = $('#from_create-coment');
            var rules = {
                OBS_observacion: {required: true, minlength: 1, maxlength: 600},
              
            };

            FormValidationMd.init(form, rules, false, CrearComentario());
           
            $('.button-anterior').on('click', function (e) {
            e.preventDefault();
            idn = 0;
            id = '{{$datos[0]['PK_MCT_IdMctr008']}}'
            var route = '{{ route('DocenteGesap.navegacionActividadesR') }}' + '/' + id + '/'+ '{{$datos['Proyecto']}}' + '/'+idn;
             //location.href="{{route('DocenteGesap.index')}}";
            $(".content-ajax").load(route);
        });
        
        $('.button-siguiente').on('click', function (e) {
            e.preventDefault();
            idn = 1;
            id = '{{$datos[0]['PK_MCT_IdMctr008']}}'
            var route = '{{ route('DocenteGesap.navegacionActividadesR') }}' + '/' + id + '/'+ '{{$datos['Proyecto']}}' + '/'+idn;
             //location.href="{{route('DocenteGesap.index')}}";
            $(".content-ajax").load(route);
        });

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            
            var route = '{{ route('DocenteGesap.VerRequerimientosJurado') }}' + '/' + '{{$datos['Anteproyecto']}}';;
            //location.href="{{route('DocenteGesap.index')}}";
            $(".content-ajax").load(route);
        });
   
})
</script>    

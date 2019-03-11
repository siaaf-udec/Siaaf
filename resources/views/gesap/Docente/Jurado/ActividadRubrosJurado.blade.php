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
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario para subir Actividades del Mctr008'])
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
                                {!! Field:: text('MCT_Actividad',$datos['Estado'],['label'=>'ESTADO DE LA ACTIVIDAD:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                       
                                {!! Field:: text('MCT_Actividad',$datos[0]['MCT_Actividad'],['label'=>'Actividad:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                                {!! Field:: textArea('MCT_Descripcion',$datos[0]['MCT_Descripcion'],['label'=>'DESCRIPCIÓN:', 'class'=> 'form-control','readonly', 'autofocus','maxlength'=>'200','autocomplete'=>'off'],
                                                                ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                               
                               </div>
                             
                        </div>
                        {!! Field:: text('CMMT_Commit',$datos['Commit'],['label'=>'INFORMACIÓN:', 'class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Coloque una breve descrición del Anteproyecto.','icon'=>'fa fa-book'] ) !!}
                    <br><br>
                    <h4>DETALLES RUBROS</h4> 
                    <br><br>                    
                    <h4>Detalles de persona</h4>
                    <br><br>
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_Personal'])
                    @slot('columns', [
                            'Nombre',
                            'Funcion En el proyecto',
                            'Tipo de vinculación',
                            'Dedicación Horas/Semana',
                            'Entidad a la que pertenece',
                            'Solicitado en efectivo UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
    
                    ])
                    @endcomponent
                    <br><br>                    
                    <h4>Descripción de equipo</h4>
                    <br><br>
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_Equipo'])
                    @slot('columns', [
                            'Descripción',
                            'Laboratorio y/o espacio academico',
                            'Actividad del cronograma',
                            'Justificación',
                            'Cantidad',
                            'ValorUnitario',
                            'Solicitado en efectivo a UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
    
                    ])
                    @endcomponent
                    <br><br>                    
                    <h4>Descripción de materiales e insumos</h4>
                    <br><br>
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_Material'])
                    @slot('columns', [
                            'Descrición',
                            'Justificación',
                            'Cantidad',
                            'Valor Unitario',
                            'Solicitado en efectivo a UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
                    ])
                    @endcomponent
                    <br><br>                    
                    <h4>Descripción de servicios tecnológicos</h4>
                    <br><br>
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_Tecnologico'])
                    @slot('columns', [
                        'Descrición',
                            'Justificación',
                            'Valor',
                            'Entidad',
                            'Solicitado en efectivo a UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
                    ])
                    @endcomponent
                    <br><br>

                    

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
                            'Realizada por'
                            
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


 
    //id = 123400009 ;
    id2 = 111100009 ;

    var table, url, columns;
        table = $('#ListaComentarios');
        url = '{{ route('DocenteGesap.ComentariosJurado') }}'+'/'+'{{$datos[0]['PK_MCT_IdMctr008']}}'+'/'+'{{$datos['Anteproyecto']}}';
         
        columns = [
            //{data: 'updated_at', name: 'updated_at'},
            {data: 'OBS_Observacion', name: 'OBS_Observacion'},
            {data: 'Usuario', name: 'Usuario'},
          
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
                                    var route = '{{ route('DocenteGesap.VerActividadJurado') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('DocenteGesap.VerActividadJurado') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
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
           

//rubro personal
        var tabler, urlr, columnsr;
        tabler = $('#Rubro_Personal');
        urlr = '{{ route('DocenteGesap.RubroPersonal') }}'+'/'+'{{$datos['Anteproyecto']}}';
        columnsr = [
            
            {data: 'RBR_PER_Nombre', name: 'RBR_PER_Nombre'},
            {data: 'RBR_PER_Funcion', name: 'RBR_PER_Funcion'},
            {data: 'RBR_PER_Tipo', name: 'RBR_PER_Tipo'},
            {data: 'RBR_PER_Dedicacion', name: 'RBR_PER_Dedicacion'},
            {data: 'RBR_PER_Entidad', name: 'RBR_PER_Entidad'},
            {data: 'RBR_PER_Solicitado_Udec', name: 'RBR_PER_Solicitado_Udec'},
            {data: 'RBR_PER_Contra_Udec', name: 'RBR_PER_Contra_Udec'},
            {data: 'RBR_PER_Contra_Otro', name: 'RBR_PER_Contra_Otro'},
            {data: 'RBR_PER_Total', name: 'RBR_PER_Total'},  
        ];
        dataTableServer.init(tabler, urlr, columnsr);
        tabler = tabler.DataTable();
///Rubro equipo
var tableef, urlef, columnsef;
        tableef = $('#Rubro_Equipo');
        urlef = '{{ route('DocenteGesap.RubroEquipos') }}'+'/'+'{{$datos['Anteproyecto']}}';
        columnsef = [
            
            {data: 'RBR_EQP_Descripcion', name: 'RBR_EQP_Descripcion'},
            {data: 'RBR_EQP_Lab', name: 'RBR_EQP_Lab'},
            {data: 'RBR_EQP_Actividades', name: 'RBR_EQP_Actividades'},
            {data: 'RBR_EQP_Justificacion', name: 'RBR_EQP_Justificacion'},
            {data: 'RBR_EQP_Cantidad', name: 'RBR_EQP_Cantidad'},
            {data: 'RBR_EQP_Val', name: 'RBR_EQP_Val'},
            {data: 'RBR_EQP_Solicitado', name: 'RBR_EQP_Solicitado'},
            {data: 'RBR_EQP_Contra_Udec', name: 'RBR_EQP_Contra_Udec'},
            {data: 'RBR_EQP_Contra_Otro', name: 'RBR_EQP_Contra_Otro'},
            {data: 'RBR_EQP_Total', name: 'RBR_EQP_Total'},  
        ];
        dataTableServer.init(tableef, urlef, columnsef);
        tableef = tableef.DataTable();
////rubro equipo
var tablemf, urlmf, columnsmf;
        tablemf = $('#Rubro_Material');
        urlmf = '{{ route('DocenteGesap.RubroMaterial') }}'+'/'+'{{$datos['Anteproyecto']}}';
        columnsmf = [
            
              
            {data: 'RBR_MTL_Descripcion', name: 'RBR_MTL_Descripcion'},
            {data: 'RBR_MTL_Justificacion', name: 'RBR_MTL_Justificacion'},
            {data: 'RBR_MTL_Cantidad', name: 'RBR_MTL_Cantidad'},
            {data: 'RBR_MTL_Val', name: 'RBR_MTL_Val'},
            {data: 'RBR_MTL_Solicitado_Udec', name: 'RBR_MTL_Solicitado_Udec'},
            {data: 'RBR_MTL_Contra_Udec', name: 'RBR_MTL_Contra_Udec'},
            {data: 'RBR_MTL_Contra_Otro', name: 'RBR_MTL_Contra_Otro'},
            {data: 'RBR_MTL_Total', name: 'RBR_MTL_Total'},
        ];
        dataTableServer.init(tablemf, urlmf, columnsmf);
        tablemf = tablemf.DataTable();
//rubro tecnologico
var tabletf, urltf, columnstf;
        tabletf = $('#Rubro_Tecnologico');
        urltf = '{{ route('DocenteGesap.RubroTecnologico') }}'+'/'+'{{$datos['Anteproyecto']}}';
        columnstf = [
            
             
            {data: 'RBR_TEC_Descripcion', name: 'RBR_TEC_Descripcion'},
            {data: 'RBR_TEC_Justificacion', name: 'RBR_TEC_Justificacion'},
            {data: 'RBR_TEC_Val', name: 'RBR_TEC_Val'},
            {data: 'RBR_TEC_Entidad', name: 'RBR_TEC_Entidad'},
            {data: 'RBR_TEC_Solicitado_Udec', name: 'RBR_TEC_Solicitado_Udec'},
            {data: 'RBR_TEC_Contra_Udec', name: 'RBR_TEC_Contra_Udec'},
            {data: 'RBR_TEC_Contra_Otro', name: 'RBR_TEC_Contra_Otro'},
            {data: 'RBR_TEC_Total', name: 'RBR_TEC_Total'},
        ];
        dataTableServer.init(tabletf, urltf, columnstf);
        tabletf = tabletf.DataTable();


        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            
            var route = '{{ route('DocenteGesap.VerActividadesJurado') }}' + '/' + '{{$datos['Anteproyecto']}}';;
            //location.href="{{route('DocenteGesap.index')}}";
            $(".content-ajax").load(route);
        });
    
})
</script>    

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
                                    {!! Field:: date('OBS_Limit',null,['label'=>'Fecha limite:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Coloque acá la fecha esperada de revision','icon'=>'fa fa-book']) !!}
                             
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
             <!--MODAL CREAR Resultado-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-Resultado" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create-Resultado', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Resultado</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: Text('MCT_Resultado',null,['label'=>'Resultado:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Producto_Esperado',null,['label'=>'Producto Esperado:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Indicador',null,['label'=>'Indicador :','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Beneficiario',null,['label'=>'Beneficiario :','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field::select('MCT_Categoria',['Conocimiento y/o nuevo desarrollo'=>'Conocimiento y/o nuevo desarrollo', 'Fortalecimiento de la capacidad cientifica'=>'Fortalecimiento de la capacidad cientifica',
                                                         'Apropiación social del conocimiento'=>'Apropiación social del conocimiento'],null,['label'=>'Categoria: ']) !!}
                                 
                               
                               
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
            <!--MODAL CREAR Resultado-->
            <!--MODAL EDITAR Resultado-->
            <!-- Modal -->
            <div class="modal fade" id="modal-edit-Resultado" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_edit-Resultado', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Editar Resultado</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                 
                                   {!! Field:: Text('MCT_EDITAR_Resultado',null,['label'=>'Resultado:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Producto_Esperado',null,['label'=>'Producto Esperado:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Indicador',null,['label'=>'Indicador :','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Beneficiario',null,['label'=>'Beneficiario :','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field::select('MCT_EDITAR_Categoria',['Conocimiento y/o nuevo desarrollo'=>'Conocimiento y/o nuevo desarrollo', 'Fortalecimiento de la capacidad cientifica'=>'Fortalecimiento de la capacidad cientifica',
                                                         'Apropiación social del conocimiento'=>'Apropiación social del conocimiento'],null,['label'=>'Categoria: ']) !!}
                                 
                               
                               
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
            <!--MODAL EDITAR Resultado-->
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
                                {!! Field:: text('MCT_Actividad',$datos['Estado'],['label'=>'ESTADO:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                       
                                {!! Field:: text('MCT_Actividad',$datos[0]['MCT_Actividad'],['label'=>'Actividad:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                                {!! Field:: text('MCT_Descripcion',$datos[0]['MCT_descripcion'],['label'=>'DESCRIPCIÓN:', 'class'=> 'form-control','readonly', 'autofocus','maxlength'=>'500','autocomplete'=>'off'],
                                                                ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                               
                               </div>
                             
                        </div>
                        {!! Field:: text('CMMT_Commit',$datos['Commit'],['label'=>'INFORMACIÓN:', 'class'=> 'form-control', 'autofocus','maxlength'=>'500','readonly','autocomplete'=>'off'],
                    
                                                                ['help' => 'Coloque una breve descrición del Anteproyecto.','icon'=>'fa fa-book'] ) !!}
                    @if($datos['Estado'] != "APROVADO" )
                                
                    @permission('ACTIVITY_STUDENT_COMENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon person"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Agregar Resultado
                        </a>@endpermission
                    @endif
                    <br><br>
                    @if($datos['Estado'] != "APROVADO" )
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Resultados'])
                    @slot('columns', [
                            'Resultado',
                            'Producto Esperado',
                            'Indicador',
                            'Beneficio',
                            'Categoria',
                            'Acciones'
    
                    ])
                    @endcomponent
                    @endif
                    @if($datos['Estado'] == "APROVADO" )
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'ResultadosF'])
                    @slot('columns', [
                            'Resultado',
                            'Producto Esperado',
                            'Indicador',
                            'Beneficio',
                            'Categoria'
    
                    ])
                    @endcomponent
                    @endif

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('STUDENT_BACK')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>@endpermission
                               
                            </div>
                            
                        </div>
                        
                    </div>
                    <h4> Observaciónes acerca de esta Actividad del Mct</h4>
                    <br><br>
                    @permission('ACTIVITY_STUDENT_COMENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Agregar Observación
                        </a>@endpermission
                    
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'ListaComentarios'])
                        @slot('columns', [
                            'Fecha de realización',
                            'Observación',
                            'Realizada por',
                            'Fecha esperdad de respuesta'
                            
                        ])
                    @endcomponent
                     <br>
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
    
    $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecciónar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

    id = 123456189 ;

    var table, url, columns;
        table = $('#ListaComentarios');
        url = '{{ route('EstudianteGesap.Comentarios') }}'+'/'+'{{$datos[0]['PK_MCT_IdMctr008']}}'+'/'+'{{$datos['Anteproyecto']}}';
         
        columns = [
            {data: 'updated_at', name: 'updated_at'},
            {data: 'OBS_observacion', name: 'OBS_observacion'},
            {data: 'Usuario', name: 'Usuario'},            
            {data: 'OBS_Limit', name: 'OBS_Limit'},
            
        ];

        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        
            $('.gestionar').on('click', function (e) {
                e.preventDefault();
                $('#modal-create-coment').modal('toggle');
            });
            


            var CrearComentario = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.ComentarioStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id);
                        formData.append('OBS_observacion', $('#OBS_observacion').val());
                        formData.append('OBS_Limit', $('[name="OBS_Limit"]').val());
                  

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
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
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
                OBS_Limit:{required:true},
            };

            FormValidationMd.init(form, rules, false, CrearComentario());

     
        var table1, url1, columns1;
        
        table1 = $('#Resultados');
       
           
        url1 = '{{ route('EstudianteGesap.Resultados') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columns1 = [
            
            {data: 'MCT_Resultado', name: 'MCT_Resultado'},
            {data: 'MCT_Producto_Esperado', name: 'MCT_Producto_Esperado'},
            {data: 'MCT_Indicador', name: 'MCT_Indicador'},
            {data: 'MCT_Beneficiario', name: 'MCT_Beneficiario'},
            {data: 'MCT_Categoria', name: 'MCT_Categoria'},  
           
            {
                defaultContent: ' @permission('ANTE_JURADO')<a href="javascript:;" title="Eliminar" class="btn btn-danger Eliminar" ><i class="icon-trash"></i></a>@endpermission @permission('ANTE_JURADO')<a href="javascript:;" title="Editar" class="btn btn-warning Editar" ><i class="icon-pencil"></i></a>@endpermission ' ,
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table1, url1, columns1);
        table1 = table1.DataTable();
       
        var tabler, urlr, columnsr;
        tabler = $('#ResultadosF');
        urlr = '{{ route('EstudianteGesap.Resultados') }}'+'/'+'{{$datos['Anteproyecto']}}';
        columnsr = [
            
            {data: 'MCT_Resultado', name: 'MCT_Resultado'},
            {data: 'MCT_Producto_Esperado', name: 'MCT_Producto_Esperado'},
            {data: 'MCT_Indicador', name: 'MCT_Indicador'},
            {data: 'MCT_Beneficiario', name: 'MCT_Beneficiario'},
            {data: 'MCT_Categoria', name: 'MCT_Categoria'},  
        ];
        dataTableServer.init(tabler, urlr, columnsr);
        tabler = tabler.DataTable();

        
        $('.person').on('click', function (e) {
            e.preventDefault();
            $('#modal-create-Resultado').modal('toggle');
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
                 return this.optional(element) || /^[0-9]+$/i.test(value);
        });
        var CrearResultado = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.ResultadoStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('MCT_Resultado', $('#MCT_Resultado').val());
                        formData.append('MCT_Producto_Esperado', $('#MCT_Producto_Esperado').val());
                        formData.append('MCT_Indicador', $('#MCT_Indicador').val());
                        formData.append('MCT_Beneficiario', $('#MCT_Beneficiario').val());
                        formData.append('MCT_Categoria', $('#MCT_Categoria').val());
                        
            
///LA OTRA TABLA///
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id);
                        formData.append('CMMT_Commit', 'Tabla Subida');
                        formData.append('FK_CHK_Checklist', 1);
            


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
                                    $('#modal-create-Resultado').modal('hide');
                                    $('#form_create-Resultado')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var form1 = $('#form_create-Resultado');
            var rules1 = {
                
                MCT_Resultado:{minlength: 1, maxlength: 100, required: true},
                MCT_Producto_Esperado:{minlength: 1, maxlength: 100, required: true},
                MCT_Indicador:{minlength: 1, maxlength: 100, required: true,},       
                MCT_Beneficiario:{minlength: 1, maxlength: 100, required: true},
                MCT_Categoria:{required: true},       
           
            };


            FormValidationMd.init(form1, rules1, false, CrearResultado()); 

            table1.on('click', '.Eliminar', function (e) {
            e.preventDefault();
            $tr1 = $(this).closest('tr');

            var dataTable1 = table1.row($tr1).data();
            var route1 = '{{ route('EstudianteGesap.ResultadoDelete') }}' + '/' + dataTable1.PK_Id_Resultados;
            var type1 = 'DELETE';
            var async1 = async1 || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este Resultado?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: route1,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type1,
                            contentType: false,
                            processData: false,
                            async: async1,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    table1.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun Resultado", "error");
                    }
                });

        });
        var id_actividad = 0;
        table1.on('click', '.Editar', function (e) {
            e.preventDefault();
            $('#modal-edit-Resultado').modal('toggle');
            $tr1 = $(this).closest('tr');
            var dataTable1 = table1.row($tr1).data();
            id_actividad = dataTable1.PK_Id_Resultados;
            $('#MCT_EDITAR_Resultado').val(dataTable1.MCT_Resultado);
            $('#MCT_EDITAR_Producto_Esperado').val(dataTable1.MCT_Producto_Esperado);
            $('#MCT_EDITAR_Indicador').val(dataTable1.MCT_Indicador);
            $('#MCT_EDITAR_Beneficiario').val(dataTable1.MCT_Beneficiario);
            $('#MCT_EDITAR_Categoria').val(dataTable1.MCT_Categoria);
        });

        var EditarResultado = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.EditarResultado') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();      
                        formData.append('PK_Id_Resultados', id_actividad);
                        formData.append('MCT_EDITAR_Resultado', $('#MCT_EDITAR_Resultado').val());
                        formData.append('MCT_EDITAR_Producto_Esperado', $('#MCT_EDITAR_Producto_Esperado').val());
                        formData.append('MCT_EDITAR_Indicador', $('#MCT_EDITAR_Indicador').val());
                        formData.append('MCT_EDITAR_Beneficiario', $('#MCT_EDITAR_Beneficiario').val());
                        formData.append('MCT_EDITAR_Categoria', $('#MCT_EDITAR_Categoria').val());
                        

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
                                    $('#modal-edit-Resultado').modal('hide');
                                    $('#form_edit-Resultado')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var form2 = $('#form_edit-Resultado');
            var rules2 = {
                MCT_EDITAR_Resultado:{minlength: 1, maxlength: 100, required: true},
                MCT_EDITAR_Producto_Esperado:{minlength: 1, maxlength: 100, required: true},
                MCT_EDITAR_Indicador:{minlength: 1, maxlength: 100, required: true,},       
                MCT_EDITAR_Beneficiario:{minlength: 1, maxlength: 100, required: true},
                MCT_EDITAR_Categoria:{required: true},       
                 
             };


            FormValidationMd.init(form2, rules2, false, EditarResultado()); 

        
        
      


        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('EstudianteGesap.VerActividades') }}' + '/' + '{{$datos['Anteproyecto']}}';

            //location.href="{{route('EstudianteGesap.index')}}";
           $(".content-ajax").load(route);
        });
   
    
})
</script>    

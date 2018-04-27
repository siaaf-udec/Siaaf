@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'INFORMNACION DEL CONVENIO'])
<div class="portlet-body">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_1_1" data-toggle="tab"> DOCUMENTOS </a>
        </li>
        <li>
            <a href="#tab_1_2" data-toggle="tab"> PARTICIPANTES </a>
        </li>
        <li>
            <a href="#tab_1_3" data-toggle="tab"> EMPRESAS </a>
        </li>
    </ul>
<div class="tab-content">
    <div class="tab-pane fade active in" id="tab_1_1">
        <div class="actions">
            @permission(['INTE_ADD_DOC_CON']) @php if ($estado == 1){ @endphp
            <a id="archivo1" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a> @php } @endphp @endpermission
        </div>
        <div class="row">
            <div class="clearfix"> </div><br><br><br><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Documentos'])
                    @slot('columns', 
                        [ '#' => ['style' => 'width:20px;'],
                        'ID',
                        'Entidad',
                        'Acciones' => ['style' => 'width:160px;'] 
                    ])
                @endcomponent
            </div>
        </div>
    </div>
    <!-- TABLAS  PARTICIPANTES -->
    <div class="tab-pane fade" id="tab_1_2">
        <div class="col-md-12">
            @permission(['INTE_ADD_PARTI']) @php if ($estado == 1){ @endphp
            <div class="actions">
                <a id="archivo2" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>
            </div>
            @php } @endphp @endpermission
        </div>

        <div class="row">
            <div class="clearfix"> </div><br><br><br><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Paticipantes']) 
                    @slot('columns', [ '#' => ['style' => 'width:20px;'],
                    'Identificacion',
                    'Nombres',
                    'Apellidos',
                    'Acciones' => ['style' => 'width:160px;']
                    ])
                @endcomponent
            </div>
        </div>
    </div>
    <!-- TABLAS EMPRESAS PARTICIPANTES -->
    <div class="tab-pane fade" id="tab_1_3">

        <div class="col-md-12">
            @permission(['INTE_ADD_EMP_PARTY']) @php if ($estado == 1){ @endphp
            <div class="actions">
                <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>
            </div>
            @php } @endphp @endpermission
        </div>

        <div class="row">

            <div class="clearfix"> </div><br><br><br><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Empresas_Paticipantes'])
                    @slot('columns', [ '#' => ['style' => 'width:20px;'],
                        'ID',
                        'Identificacion', 
                        'Empresa',
                        'Acciones' => ['style' => 'width:160px;']
                    ]) 
                @endcomponent
            </div>
        </div>

    </div>

</div>
    @endcomponent
<div class="col-md-12">
    <!-- Modal -->
    <div class="modal fade" id="documento" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> SUBIR ARCHIVO</h1>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'my-dropzone', 'class' => 'dropzone dropzone-file-area', 'url'=>'/form']) !!}
                    <h3 class="sbold">Arrastra o da click aquí para cargar archivos</h3>
                    {!! Form::close() !!}
                    <br>{!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!} {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                </div>

            </div>
        </div>
    </div>
</div>

<!-- AGREGAR PARTICIPANTE -->
<div class="col-md-12">
    <!-- Modal -->
    <div class="modal fade" id="participante" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Participante']) !!}
                <div class="form-wizard">
                    <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR PARTICIPANTE</h1>
                    </div>
                    <div class="modal-body">
                        {!! Field:: tel('identity_no',null,['label'=>'Numero Documento','class'=> 'form-control', 'autofocus','required', 'maxlength'=>'10','autocomplete'=>'off'],['help' => 'Digita el nunemero de cedula.','icon'=>'fa fa-credit-card']) !!}
                        
                        {!! Field::date('PTPT_Fecha_Inicio',['label'=>'Fecha Inicio','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'seleciona una fecha', 'icon' => 'fa fa-calendar']) !!} 
                        
                        {!! Field::date('PTPT_Fecha_Fin',['label'=>'Fecha Final','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'seleciona una fecha', 'icon' => 'fa fa-calendar']) !!}

                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Agregar', ['class' => 'btn blue']) !!} 
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- AGREGAR EMPRESA PARTICIPANTE -->
<div class="col-md-12">
    <!-- Modal -->
    <div class="modal fade" id="empresa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Empresas']) !!}
                <div class="form-wizard">
                    <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR EMPRESA</h1>
                    </div>
                    <div class="modal-body">
                        {!! Field:: tel('FK_TBL_Empresa',null,['label'=>'Identificacion de la empresa','class'=> 'form-control', 'autofocus','required', 'maxlength'=>'10','autocomplete'=>'off'],['help' => 'Digita el nunemero de identificacion de la empresa.','icon'=>'fa fa-credit-card']) !!}
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Agregar', ['class' => 'btn blue']) !!}
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
<!-- FIN MODALS -->
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/interaccion/js/Dropzone.js') }}" type="text/javascript"></script>   
<script type="text/javascript">
     var ComponentsDateTimePickers = function () {
            var handleDatePickers = function () {
                if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        rtl: App.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        regional: 'es',
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                        weekHeader: 'Sm',
                        dateFormat: 'yyyy-mm-dd',
                        firstDay: 1,
                        yearSuffix: '',
                        startDate: null,
                       
                    });
                }
            }
            return {
                init: function () {
                    handleDatePickers();
                }
            };
        }();
    jQuery(document).ready(function() {
        ComponentsDateTimePickers.init();
         App.unblockUI('.portlet-form');
        var table, url, id;
        table = $('#Listar_Documentos');
        var documento = function () {
            return { 
                init:function(){
                    $('#documento').modal('hide');
                    
                    
                }
            }; 
        }
        var route = '{{route('subirDocumentoConvenio.subirDocumentoConvenio',[$id])}}';
        var formatfile = '.pdf'; 
        var numfile = 1; 
        $("#my-dropzone").dropzone(FormDropzone.init(route, formatfile, numfile, documento(),name));
        
        var table, url, columns;
        table = $('#Listar_Documentos');
        url = "{{ route('listarDocumentosConvenios.listarDocumentosConvenios',[$id]) }}";
        columns = [
            {data: 'DT_Row_Index'},
                    {data: 'PK_DOCU_Documentacion',"visible": true,name: "PK_DOCU_Documentacion",className: 'none'},
                    {data: 'DOCU_Nombre',searchable: true,name: "DOCU_Nombre"},
                    {data: 'action',
                    name: 'action',
                    title: 'Acciones',
                    orderable: false,
                    searchable: false,
                    exportable: false,
                    printable: false,
                    className: 'text-center',
                    render: null,
                    serverSide: false,
                    responsivePriority: 2,
                        defaultContent: ' @permission(['INTE_DES_DOC_CON'])<a href="#" target="_blank" class="btn btn-simple btn-whrite btn-icon descargar" title="Descargar Documento"><i class="fa fa-cloud-download"> DESCARGAR</i></a>@endpermission'
                    }
        ];
        dataTableServer.init(table, url, columns);
        
            $("#archivo1").on('click', function(e) {
                e.preventDefault();
                $('#documento').modal('toggle');
            });

            table = table.DataTable();
            table.on('click', '.descargar', function(e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = table.row($tr).data();
                $.ajax({
                    type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function(data) {
                    window.location.href = '{{ route('documentoDescarga.documentoDescarga') }}'+'/'+ O.PK_DOCU_Documentacion+'/@php echo $id; @endphp';
                    
                });
            });

        });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
         App.unblockUI('.portlet-form');
        var table, url, columns;
        table = $('#Listar_Paticipantes');
        url = "{{ route('listarParticipantesConvenios.listarParticipantesConvenios',[$id]) }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'usuarios_participantes.dato_usuario.identity_no',"visible": true,name: "identity_no"},
            {data: 'usuarios_participantes.dato_usuario.name',searchable: true,name: "name"},
            {data: 'usuarios_participantes.dato_usuario.lastname', searchable: true,name: "lastname"},
            {data: 'action',
            name: 'action',
            title: 'Acciones',
            orderable: false,
            searchable: false,
            exportable: false,
            printable: false,
            className: 'text-center',
            render: null,
            serverSide: false,
            responsivePriority: 2,
                defaultContent: '@permission(['INTE_EVA_EMPRESA']) @php if ($estado == 1){ @endphp<a href="#" target="_blank" class="btn btn-simple btn-warning btn-icon evaluar1" title="Evaluar Usuario"><i class="icon-pencil"> EVALUAR </i></a> @php } @endphp @endpermission @permission(['INTE_DES_DOC_USU'])<a href="#" class="btn btn-simple btn-success btn-icon doc1" title="Documentos usuario"><i class="icon-notebook"></i></a>@endpermission @permission(['INTE_VER_EVA'])<a href="#" target="_blank" class="btn btn-simple btn-info btn-icon ver1" title="Ver Evaluacion"><i class="icon-eye"> VER </i></a>@endpermission @permission(['INTE_DELET_PART']) @php if ($estado == 1){ @endphp <a href="#" target="_blank" class="btn btn-simple btn-danger btn-icon delete" title="eliminar"><i class="icon-close"></i></a> @php } @endphp @endpermission'


                    }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
            table.on('click', '.evaluar1', function(e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data(),
                    route_edit = '{{ route('realizarEvaluacion.realizarEvaluacion') }}'+'/'+dataTable.usuarios_participantes.dato_usuario.identity_no+'/@php echo $id; @endphp/@php echo $estado; @endphp';
                $(".content-ajax").load(route_edit);
            });
            table.on('click', '.doc1', function(e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data(),
                    route_edit='{{route('documentoUsuario.documentoUsuario')}}'+'/'+dataTable.FK_TBL_Usuarios_Id+'/@php echo $id @endphp/@php echo $estado @endphp';
                $(".content-ajax").load(route_edit);
            });
            table.on('click', '.ver1', function(e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data(),
                    route_edit='{{route('listarEvaluacionesUsuario.listarEvaluacionesUsuario') }}'+'/'+dataTable.usuarios_participantes.dato_usuario.identity_no+'/@php echo $id @endphp/@php echo $estado @endphp ';
                $(".content-ajax").load(route_edit);
            });
        
            table.on('click', '.delete', function(e) {
                e.preventDefault();
				$tr = $(this).closest('tr');
				var o = table.row($tr).data();
				var route = '{{route('eliminarParticipante.eliminarParticipante')}}/'+o.PK_PTPT_Participantes;
				var type = 'DELETE';
				var async = async || false;
				swal({
					title: "¿Esta seguro?",
                    text: "¿Esta seguro de eliminar el participante seleccionado?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
					 function(isConfirm){
					if (isConfirm) {
						$.ajax({
							url: route,
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            cache: false,
                            type: type,
                            contentType: false,
                            processData: false,
                            async: async,
                            success: function (response, xhr, request) {
								if (request.status === 200 && xhr === 'success') {
									table.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 &&  xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
						});
						swal.close();
					} else {
                        swal("Cancelado", "No se eliminó ningun proyecto", "error");
                    }
                });
            });
        
            $("#archivo2").on('click', function(e) {
                e.preventDefault();
                $('#participante').modal('toggle');
            });
            
            $('.portlet-form').attr("id","form_wizard_1");
             var rules = {
                identity_no: {required: true,number: true},
                };
            var form = $('#form-Participante');
            var wizard = $('#form_wizard_1');
            var agregarParticipante = function() {
                return {
                    init: function() {
                        var route = '{{ route('participanteConvenio.participanteConvenio',[$id]) }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('identity_no', $('#identity_no').val());
                        formData.append('PTPT_Fecha_Inicio', $('#PTPT_Fecha_Inicio').val());
                        formData.append('PTPT_Fecha_Fin', $('#PTPT_Fecha_Fin').val());

                        $.ajax({
                            url: route,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
								App.blockUI({target: '.portlet-form', animate: true});
							},
                            success: function(response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    if(response.title == '¡Lo sentimos!'){ 
                                        UIToastr.init('error', response.title,response.message);
                                        App.unblockUI('.portlet-form'); 
                                    }else{ 
                                        $('#participante').modal('hide');
                                        $('#form-Participante')[0].reset();
                                        table.ajax.reload();
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
                                    }
                                }
                            },
                            error: function(response, xhr, request) {
                                UIToastr.init(xhr, 'usuario ya existente', 'el usuario a insertar ya esta en el convenio');
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    }
                }
            };

            var messages = {};

            FormValidationMd.init(form, rules, messages, agregarParticipante());

        });
</script>
<script type="text/javascript">
        jQuery(document).ready(function() {
             App.unblockUI('.portlet-form');
            var table, url, columns;
            table = $('#Listar_Empresas_Paticipantes');
            url = "{{ route('listarEmpresasParticipantesConvenios.listarEmpresasParticipantesConvenios',[$id]) }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'PK_EMPT_Empresa_Participante',"visible": true, name: "PK_EMPT_Empresa_Participante"},
                {data: 'patricipantes_empresas.PK_EMPS_Empresa',searchable: true,name: "patricipantes_empresas.PK_EMPS_Empresa"},
                {data: 'patricipantes_empresas.EMPS_Nombre_Empresa',searchable: true,name: "patricipantes_empresas.EMPS_Nombre_Empresa"},
                {data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2,
                        defaultContent: '@php if ($estado == 1){ @endphp @permission(['INTE_EVA_PASANTE'])  <a href="#" target="_blank" class="btn btn-simple btn-warning btn-icon evaluar2" title="Evaluar Empresa"><i class="icon-pencil"> EVALUAR </i></a>@endpermission @php } @endphp   @permission(['INTE_VER_EVA'])<a href="#" target="_blank" class="btn btn-simple btn-info btn-icon ver2" title="Ver Evaluacion"><i class="icon-eye"> VER </i></a>@endpermission  @php if ($estado == 1){ @endphp @permission(['INTE_DELET_PART'])  <a href="#" target="_blank" class="btn btn-simple btn-danger btn-icon delete1" title="eliminar"><i class="icon-close"></i></a>@endpermission @php } @endphp'
                    }
        ];
        dataTableServer.init(table, url, columns);
        

            table = table.DataTable();
            table.on('click', '.evaluar2', function(e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data(),
                    route_edit = '{{ route('realizarEvaluacionEmpresa.realizarEvaluacionEmpresar') }}'+'/'+dataTable.patricipantes_empresas.PK_EMPS_Empresa+'/@php echo  $id; @endphp/@php echo  $estado; @endphp';

                $(".content-ajax").load(route_edit);
            });

            table.on('click', '.ver2', function(e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data(),
                    route_edit = '{{ route('listarEvaluacionEmpresa.listarEvaluacionEmpresa') }}'+'/'+dataTable.patricipantes_empresas.PK_EMPS_Empresa+'/@php echo $id @endphp/@php echo $estado @endphp ';
                $(".content-ajax").load(route_edit);
            });
            table.on('click', '.delete1', function(e) {
                e.preventDefault();
				$tr = $(this).closest('tr');
				var o = table.row($tr).data();
				var route = '{{route('eliminarEmpresa.eliminarEmpresa')}}/'+o.PK_EMPT_Empresa_Participante;
				var type = 'DELETE';
				var async = async || false;
				swal({
					title: "¿Esta seguro?",
                    text: "¿Esta seguro de eliminar el participante seleccionado?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
					 function(isConfirm){
					if (isConfirm) {
						$.ajax({
							url: route,
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            cache: false,
                            type: type,
                            contentType: false,
                            processData: false,
                            async: async,
                            success: function (response, xhr, request) {
								if (request.status === 200 && xhr === 'success') {
									table.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);                                    App.unblockUI('.portlet-form');
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 &&  xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            }
						});
						swal.close();
					} else {
                        swal("Cancelado", "No se eliminó ningun proyecto", "error");
                    }
                });
            });
            $("#archivo3").on('click', function(e) {
                e.preventDefault();
                $('#empresa').modal('toggle');
            });

            $('.portlet-form').attr("id","form_wizard_1");
             var rules = {
                FK_TBL_Empresa: {required: true,number: true},
                };
            var form = $('#form-Empresas');
            var wizard = $('#form_wizard_1');
            var agregarEmpresa = function() {
                return {
                    init: function() {
                        var route = '{{ route('empresaConvenio.empresaConvenio',[$id]) }}';
                        var type = 'POST';
                        var async = async || false;
                        var formData = new FormData();
                        formData.append('FK_TBL_Empresa', $('#FK_TBL_Empresa').val());
                        $.ajax({
                            url: route,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
								App.blockUI({target: '.portlet-form', animate: true});
							},
                            success: function(response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    if(response.title == '¡Lo sentimos!'){ 
                                        UIToastr.init('error', response.title,response.message);
                                        App.unblockUI('.portlet-form'); 
                                    }else{ 
                                        $('#empresa').modal('hide');
                                        table.ajax.reload();
                                        $('#form-Empresas')[0].reset();
                                        UIToastr.init(xhr, response.title,response.message);
                                        App.unblockUI('.portlet-form');
                                    }
                                }
                            },
                            error: function(response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, '!Lo sentimos¡', 'la empresa ingrsada ya se encuentra  o no existe');
                                    App.unblockUI('.portlet-form');
                                }
                            }
                        });
                    }
                }
            };
            var messages = {};
            FormValidationMd.init(form, rules, messages, agregarEmpresa());
        });

    </script>

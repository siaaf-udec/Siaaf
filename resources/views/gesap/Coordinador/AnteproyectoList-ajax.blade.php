<div class="col-md-12">
	@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'Lista de Anteproyectos'])
	<div class="row">
		<div class="col-md-6">
			<div class="btn-group">
				@permission('CREATE_PROJECT_GESAP')
				<a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>
				@endpermission
			</div>
		</div>
		<div class="clearfix"> </div>
        <br>
        <br>
		<div class="col-md-12">
			@component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-anteproyecto'])
				@slot('columns', [
					'#' => ['style' => 'width:20px;'],
					'id',
					'Titulo',
					'Palabras Clave',
					'Duracion',
					'Fecha Radicacion',
					'Fecha Limite',
					'Estado',
					'Min o E.A',
					'Requerimientos',
					'Director',
					'Estudiante 1',
					'Estudiante 2',
					'Jurado 1',
					'Jurado 2',
					'Acciones' => ['style' => 'width:160px;']
				])
			@endcomponent
		</div>
	</div>
	@endcomponent
</div>
	<script>
		jQuery(document).ready(function () {
			var table, url,columns;
            table = $('#lista-anteproyecto');
            url = "{{ route('anteproyecto.list') }}";
		
			columns=[
					{data: 'DT_Row_Index'},
                    {data: 'PK_NPRY_IdMinr008', "visible": false },
                    {data: 'NPRY_Titulo', searchable: true},
                    {data: 'NPRY_Keywords', searchable: true},
                    {data: 'NPRY_Duracion',searchable: true},
                    {data: 'NPRY_FechaR', className:'none',searchable: true},
                    {data: 'NPRY_FechaL', className:'none',searchable: true},
                    {data: 'NPRY_Estado',searchable: true, name: 'Estado'},
                    {data: 'radicacion.RDCN_Min',className:'none',
					 render: function (data, type, full, meta) {
						 return '<a class="document" href="{{ route('download.documento') }}/'+data+'">DESCARGAR MIN</a>';
					 }
                    },
                    {data: 'radicacion.RDCN_Requerimientos',className:'none',searchable: true,
					 render: function (data, type, full, meta) {
						 if(data=="NO FILE"){
							 return "NO APLICA";    
						 }else{
							 return '<a class="document" href="{{ route('download.documento') }}/'+data+'">DESCARGAR REQUERIMIENTOS</a>';    
						 }  
					 }
                    },  
                    {data:  function (data, type, dataToSet) {
						if(data.director[0]!=null)
							return data.director[0].usuarios.name + " " + data.director[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
							},className:'none',searchable: true
					},

                    {data: function (data, type, dataToSet) {
                        if(data.estudiante1[0]!=null)
                            return data.estudiante1[0].usuarios.name + " " + data.estudiante1[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
							},className:'none',searchable: true
					},
                    {data: function (data, type, dataToSet) {
						if(data.estudiante2[0]!=null)
							return data.estudiante2[0].usuarios.name + " " + data.estudiante2[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
							}, className:'none',searchable: true
					},
                    {data: function (data, type, dataToSet) {
                        if(data.jurado1[0]!=null)
                        return data.jurado1[0].usuarios.name + " " + data.jurado1[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
							}, className:'none',searchable: true},
                    {data: function (data, type, dataToSet) {
                        if(data.jurado2[0]!=null)
							return data.jurado2[0].usuarios.name + " " + data.jurado2[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
							},className:'none',searchable: true
					}, 
                    {data:'action',
                     className:'',
                     searchable: false,
                     name:'action',
                     title:'Acciones',
                     orderable: false,
                     exportable: false,
                     printable: false,
                     responsivePriority:2,
                     render: function ( data, type, full, meta ) {
						 if(full.NPRY_Estado=="<span class='label label-sm label-success'>APROBADO<\/span>"){
							 if(full.proyecto==null){
								 return '@permission("MODIFY_PROJECT_GESAP")<a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#"><i class="icon-pencil"></i></a>@endpermission @permission("ASSIGN_TEACHER_GESAP")<a href="#" class="btn btn-simple btn-success btn-icon assign"><i class="icon-users"></i></a>@endpermission @permission("DELETE_PROJECT_GESAP")<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission';
                             }else{
                                 if (full.proyecto.PRYT_Estado=="TERMINADO") {
                                     return '<span class="label label-sm label-success">Proyecto Terminado</span>';
                                 } else {
                                    return '@permission("ASSIGN_TEACHER_GESAP")<a href="#" class="btn btn-simple btn-success btn-icon assign"><i class="icon-users"></i></a>@endpermission<span class="label label-sm label-success">Proyecto en curso</span>'; 
                                 } 
                             }
                         }else{
                             return '@permission("MODIFY_PROJECT_GESAP")<a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#"><i class="icon-pencil"></i></a>@endpermission @permission("ASSIGN_TEACHER_GESAP")<a href="#" class="btn btn-simple btn-success btn-icon assign"><i class="icon-users"></i></a>@endpermission @permission("DELETE_PROJECT_GESAP")<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission';
						 }
					 }, 
					}
				],
			dataTableServer.init(table, url, columns);
			
       
    
            $( ".create" ).on('click', function (e) {
				e.preventDefault();
                var route = '{{ route('min.create') }}';
                $(".content-ajax").load(route);
            });
            
            table = table.DataTable();
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var o = table.row($tr).data();
				$.ajax({
					type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function (data) {
					route = '{{ route('min.edit') }}'+'/'+o.PK_NPRY_IdMinr008;
					$(".content-ajax").load(route);
                });
            });
    
            table.on('click', '.assign', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var o = table.row($tr).data();
	           	$.ajax({
                    type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function (data) {
                    route = '{{ route('anteproyecto.asignar') }}'+'/'+o.PK_NPRY_IdMinr008;
					$(".content-ajax").load(route);
                });
            });
            
            table.on('click', '.remove', function (e) {
				e.preventDefault();
				$tr = $(this).closest('tr');
				var o = table.row($tr).data();
				var route = '{{route('min.destroy')}}/'+o.PK_NPRY_IdMinr008;
				var type = 'DELETE';
				var async = async || false;
				swal({
					title: "¿Esta seguro?",
                    text: "¿Esta seguro de eliminar el Anteproyecto seleccionado?",
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
            
            table.on('click','.boton_mas_info',function(){
                if($(this).parent().find('.texto-ocultado').css('display') == 'none'){
					$(this).parent().find('.texto-ocultado').css('display','inline');
                    $(this).parent().find('.puntos').html(' ');
                    $(this).text('Ver menos');
                } else {
                    $(this).parent().find('.texto-ocultado').css('display','none');
                    $(this).parent().find('.puntos').html('...');
                    $(this).html('Ver más');
                };
            }); 
            table.on('click', '.document', function (e) {
                e.preventDefault();
                var uri=$(this).attr('href');
                $.ajax({
                    url: uri,
                    beforeSend: function () {
				        App.blockUI({target: '.portlet-form', animate: true});
				    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            if(response.title === "Ocurrió un problema") {
                                UIToastr.init('error', response.title, response.message);
                                App.unblockUI();
                            }else{
                               var a = document.createElement('a');
                                a.href = uri;
                                a.click();
                                window.URL.revokeObjectURL(uri); 
                            }
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 &&  xhr === 'error') {
                            UIToastr.init(xhr, response.title, response.message);
                        }
                    }
                });
                return false; 
            }); 
         
         
		});
    </script>

<div class="col-md-12">
	@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Actividades'])
	@permission('DIRECTOR_LIST_GESAP')
    	@slot('actions', [
			'link_back-director' => [
			'link' => '',
			'icon' => 'fa fa-arrow-left',
			],
        ])
    @endpermission
    @permission('STUDENT_LIST_GESAP')
    	@slot('actions', [
			'link_back-estudiante' => [
			'link' => '',
			'icon' => 'fa fa-arrow-left',
			],
		])
    @endpermission
	<div class="row">
		<div class="col-md-6">
			{!! Field::hidden('id', $id) !!}
		</div>
		<div class="clearfix"> </div><br>
		<div class="col-md-12">                
			<div class="portlet light portlet-fit ">
				<div class="portlet-body">
					<div class="mt-element-list">
						<div class="mt-list-head list-default green-seagreen">
							<div class="list-head-title-container">
								<h3 class="list-title uppercase sbold">
									{{$anteproyecto[0]->NPRY_Titulo}}
								</h3>
							</div>
						</div>
						<div class="mt-list-container list-default ext-1 group">
							<div class="mt-list-title uppercase">Lista de actividades
								@permission('CREATE_ACTIVITY_GESAP')
								@if($anteproyecto[0]->proyecto->PRYT_Estado != "TERMINADO")
								<span class="badge badge-default pull-right bg-hover-green-jungle">
									<a class="font-white" href="javascript:;" id="create">
										<i class="fa fa-plus"></i>
									</a>
								</span>
								@endif
								@endpermission
							</div>
							<a class="list-toggle-container" data-toggle="collapse" href="#completed" aria-expanded="false">
								<div class="list-toggle  uppercase"> Completadas
									<span class="badge badge-default pull-right bg-white font-green bold" id="completadas">
									</span>
								</div>
							</a>
							<div class="panel-collapse collapse" id="completed">
								<ul>
									@foreach($anteproyecto[0]->proyecto->documentos as $documento)
									@if($documento->DMNT_Archivo != Null)
									<li class="mt-list-item" id="{{$documento->PK_DMNT_IdProyecto}}">
										<div class="list-icon-container">
											<a href="javascript:;">
												<i class="icon-check"></i>
											</a>
										</div>
										@permission('Delete_Activity_Gesap')
										<div class="list-datetime"> 
											@if($anteproyecto[0]->proyecto->PRYT_Estado != "TERMINADO")
											<a class="task-trash delete" id=""  href="javascript:;">
												<i class="fa fa-trash"></i>
											</a>
											@endif
																	
											<a class="task-trash download" id=""  
											   href="{{route('download.activity')}}/{{$documento->PK_DMNT_IdProyecto}}/{{$documento->DMNT_Archivo}}"> 
												<i class="fa fa-download"></i> 
											</a> 
																	
										</div>
										@endpermission
										@permission('UPDATE_FINAL_PROJECT_GESAP')
										@if($anteproyecto[0]->proyecto->PRYT_Estado != "TERMINADO")
										<div class="list-datetime"> 
											<a class="task-trash upload" id=""  href="javascript:;">
												<i class="fa fa-upload"></i>
											</a>    
                                            	                    
										</div>
										@endif
										@endpermission
                                        	                    
										<div class="list-datetime"> 
											{{ date('h A', strtotime($documento->updated_at)) }}
											<br/> 
											{{ date('d M', strtotime($documento->created_at)) }} </div>
										<div class="list-item-content">
											<h3 class="uppercase">
												<a href="javascript:;">{{$documento->DMNT_Nombre}}</a>
											</h3>
											<p>{{$documento->DMNT_Descripcion}}</p>
										</div>
									</li>
									@endif
									@endforeach
								</ul>
							</div>
							<a class="list-toggle-container" data-toggle="collapse" href="#pending" aria-expanded="true">
								<div class="list-toggle done uppercase"> Pendientes
									<span class="badge badge-default pull-right bg-white font-dark bold" id="pendientes"></span>
								</div>
							</a>
							<div class="panel-collapse collapse in" id="pending" aria-expanded="true">
								<ul>
									@foreach($anteproyecto[0]->proyecto->documentos as $documento)
									@if($documento->DMNT_Archivo == Null)
									<li class="mt-list-item done" id="{{$documento->PK_DMNT_IdProyecto}}">
										<div class="list-icon-container">
											<a href="javascript:;">
												<i class="icon-close"></i>
											</a>
										</div>
										@permission('Delete_Activity_Gesap')
										@if($anteproyecto[0]->proyecto->PRYT_Estado != "TERMINADO")
										<div class="list-datetime"> 
											<a class="task-trash delete" id=""  href="javascript:;">
												<i class="fa fa-trash"></i>
											</a>
                                            	                    
										</div>
										@endif
										@endpermission
										@permission('UPDATE_FINAL_PROJECT_GESAP')
										@if($anteproyecto[0]->proyecto->PRYT_Estado != "TERMINADO")
										<div class="list-datetime"> 
											<a class="task-trash upload" id=""  href="javascript:;">
												<i class="fa fa-upload"></i>
											</a>
										</div>
										@endif
										@endpermission
										<div class="list-datetime" style="width:70px">
											{{ date('h A', strtotime($documento->updated_at)) }}
											<br/> 
											{{ date('d M y', strtotime($documento->created_at)) }} </div>
										<div class="list-item-content">
											<h3 class="uppercase">
												<a href="javascript:;">{{$documento->DMNT_Nombre}}</a>
											</h3>
											<p>{{$documento->DMNT_Descripcion}}</p>
										</div>
									</li>
									@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!--MODAL CREAR ACTIVIDAD-->
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12">
			<!-- Modal -->
			<div class="modal fade" id="modal-create-activity" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						{!! Form::open(['id' => 'from_create-activity', 'class' => '', 'url' => '/forms']) !!}
						{!! Field::hidden('PK_proyecto',$anteproyecto[0]->proyecto->PK_PRYT_IdProyecto) !!}
                        	    
						<div class="modal-header modal-header-success">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h1><i class="glyphicon glyphicon-plus"></i> Añadir Actividad</h1>
						</div>	
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group form-md-line-input">
										<div class="input-icon">
											{{ Form::textarea('nombre', null, 
											['required', 'auto' => 'off','rows' => '1','class'=>'form-control','id'=>'nombre'],
											[ 'icon' => 'fa fa-user']) 
											}}
											<label for="title" class="control-label">Nombre</label>
											<span class="help-block"> </span>
											<i class=" fa fa-user "></i>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group form-md-line-input">
										<div class="input-icon">
											{{ Form::textarea('descripcion', null, 
											['required', 'auto' => 'off','rows' => '6','class'=>'form-control','id'=>'descripcion'],
											[ 'icon' => 'fa fa-book']) 
											}}
											<label for="title" class="control-label">Descripcion</label>
											<span class="help-block"> </span>
											<i class=" fa fa-user "></i>
										</div>
									</div>
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
			</div>
		</div>
	</div>  
    <!--MODAL Subir archivo-->
    
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12">
			<!-- Modal -->
			<div class="modal fade" id="modal_documento" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header modal-header-success" >
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h1><i class="glyphicon glyphicon-thumbs-up"></i> SUBIR ARCHIVO</h1>
						</div>
						<div class="modal-body">                    	                                              
							{!! Form::open(['id' => 'my-dropzone', 'class' => 'dropzone dropzone-file-area', 'url'=>'/form']) !!}
							{!! Field::hidden('PK_actividad') !!}
							<h3 class="sbold">Arrastra o da click aquí para cargar el archivo</h3> 
							{!! Form::close() !!}
							<br>
							{!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
							{!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                            	        
						</div>
                                
					</div>
				</div>
			</div>
		</div>
	</div>  
	@endcomponent
</div>

	<!--Local Scripts-->
	
<script src="{{ asset('assets/main/gesap/js/dropzone.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>	
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

	<script>
		jQuery(document).ready(function () {
			$("#completadas").html($("#completed li").size());
			$("#pendientes").html($("#pending li").size());

			$('#create').on('click', function (e) {
				e.preventDefault();
				$('#modal-create-activity').modal('toggle');
			});

			$('.upload').on('click', function (e) {
				e.preventDefault();
				var parent = $(this).closest('li').attr('id');
				$('input[name="PK_actividad"]').val(parent);
				$('#modal_documento').modal('toggle');
			});

			var createActivity = function () {
				return{
					init: function () {
						var route = '{{ route('proyecto.nueva.actividad') }}';
						var type = 'POST';
						var async = async || false;

						var formData = new FormData();
						formData.append('nombre', $('#nombre').val());
						formData.append('descripcion', $('#descripcion').val());
						formData.append('PK_proyecto', $('input[name="PK_proyecto"]').val());

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

							},
							success: function (response, xhr, request) {
								if (request.status === 200 && xhr === 'success') {
									$('#modal-create-activity').modal('hide');
									$('#from_create-activity')[0].reset(); //Limpia formulario
									UIToastr.init(xhr , response.title , response.message  );
								}},
							error: function (response, xhr, request) {
								if (request.status === 422 &&  xhr === 'error') {
									UIToastr.init(xhr, response.title, response.message);
								}}
						}).done(function (data) {
							route = '{{ route('proyecto.actividades') }}/{{$id}}';
							$(".content-ajax").load(route);
						});
					}
				}
			};

		var form = $('#from_create-activity');
		var rules = {
			nombre: {required: true},
			descripcion: {required: true}
		};
		FormValidationMd.init(form,rules,false,createActivity());

		$('.delete').on('click', function (e) {
			e.preventDefault();
			var parent = $(this).closest('li').attr('id');
			var route = '{{ route('proyecto.actividades') }}'+'/'+$(this).closest('li').attr('id');
			var type = 'DELETE';
			var async = async || false;
			swal({
				title: "¿Esta seguro?",
				text: "¿Esta seguro de eliminar la actividad seleccionado?",
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
									UIToastr.init(xhr, response.title, response.message);
									$('#'+parent).remove();
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

			var documento = function () { 
				return { 
					init:function(){
					}
			  }; 
			}
			var route = '{{ route("proyecto.actividades.upload") }}'; 
			var comeback = '{{ route('proyecto.actividades') }}/{{$id}}';
			var formatfile = '.jpeg,.pdf,.jpg,.png,.gif'; 
			var numfile = 1; 
		   $("#my-dropzone").dropzone(FormDropzone.init(route, formatfile, numfile, documento(),name,comeback)); 

		
		
				$('#link_back-director').on('click', function (e) {
			e.preventDefault();
			var route = '{{ route('anteproyecto.index.directorList.ajax') }}';
			$(".content-ajax").load(route);
		});    


		$('#link_back-estudiante').on('click', function (e) {
			e.preventDefault();
			var route = '{{ route('anteproyecto.index.studentList.ajax') }}';
			$(".content-ajax").load(route);
		});
		
	});

    
	</script>   

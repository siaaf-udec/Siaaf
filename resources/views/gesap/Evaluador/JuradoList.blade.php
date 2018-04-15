@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Utoastr Styles -->
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Select2 Styles -->
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{  asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{  asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
<!-- FileInput Styles -->
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Dashboard')

@section('page-title', 'JURADO')

@section('page-title', 'Anteproyectos/Proyectos como Jurado')

@section('content')
<div class="col-md-12">
	@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list  ', 'title' => 'Jurado'])
	<div class="row">
		<div class="col-md-12">
			@component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-anteproyecto'])

			@slot('columns', [
			'#' => ['style' => 'width:20px;'],
			'id',
			'Tipo',        
			'Titulo',
			'Palabras Clave',
			'Duracion',
			'Fecha Radicacion',
			'Fecha Limite',
			'Min',
			'Requerimientos',
			'Director',
			'Estudiante 1',
			'Estudiante 2',
			'Jurado 1',
			'Jurado 2',
			'Concepto',
			'Estado',
			'Acciones' => ['style' => 'width:100px;']
			])
			@endcomponent
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12">
		<!-- Modal -->
		<div class="modal fade" id="modal-create-concept" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					{!! Form::open(['id' => 'from_concept_create', 'class' => '', 'url' => '/forms']) !!}
					<div class="modal-header modal-header-success">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h1><i class="glyphicon glyphicon-ok"></i> Concepto Final</h1>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								{!! Field::hidden('PK_anteproyecto') !!}
								{!! Field::hidden('user', Auth::user()->id) !!}
								{!! Field::select('concepto',["1"=>"Aprobado","2"=>"Aplazado","3"=>"Reprobado"],null) !!}
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

<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12">
		<!-- Modal -->
		<div class="modal fade" id="modal-create-observation" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					{!! Form::open(['url' => '#', 'method' => 'post', 'novalidate','enctype'=>'multipart/form-data','id'=>'form-register-obser']) !!}
					{!! Field::hidden('PK_anteproyecto') !!}
					{!! Field::hidden('user', Auth::user()->id) !!}
					<div class="modal-header modal-header-success">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h1><i class="glyphicon glyphicon-eye-open"></i> Observaciones</h1>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-2" style="font-size: 14px;color: #888;padding:0px">Anteproyecto:</label>
									<div class="col-md-10">
										<p class="" data-display="username" id="title"> </p>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								{!! Field::textarea('observacion',
								['label' => 'Observaciones', 'rows' => '1','max' => '600', 'min' => '10', 'required', 'auto' => 'off','id'=>'observacion'],
								['help' => 'Ingrese la observacion a realizar', 'icon' => 'fa fa-book']) !!}
							</div>
							<div class="col-md-12">
								<h3 class="center">Documentos Calificados(Opcional)</h3>
							</div>
							<div class="col-md-12" id="file">
								<div class="form-md-line-input" style="margin: 0 0 35px;">
									<div class="fileinput-new input-icon" data-provides="fileinput">    
										<label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Min o E.A</label>
										<div class="input-group input-large">
											<div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
												<i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
												<span class="fileinput-filename" style="position:absolute"> </span>
											</div>
											<span class="input-group-addon btn default btn-file">
												<span class="fileinput-new"> Select file </span>    
												<span class="fileinput-exists"> Change </span>
												<input type="file" name="Min" class="" id="Min" > </span>
											<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
										</div>
									</div>
								</div> 
							</div>
							<div class="col-md-12" id="file">
								<div class="form-md-line-input" style="margin: 0 0 35px;">
									<div class="fileinput-new input-icon" data-provides="fileinput">    
										<label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Requerimientos</label>
										<div class="input-group input-large">
											<div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
												<i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
												<span class="fileinput-filename" style="position:absolute"> </span>
											</div>
											<span class="input-group-addon btn default btn-file">
												<span class="fileinput-new"> Select file </span>
												<span class="fileinput-exists" > Change </span>
												<input type="file" name="requerimientos" class=""  id="Requerimientos"> </span>
											<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
										</div>
									</div>
								</div> 
							</div>
						</div>
					</div>
					<div class="modal-footer">
						{{ Form::reset('Reset', ['class' => 'btn yellow-gold','style'=>'float:right;margin-left:1rem']) }}
						{{ Form::submit('Guardar', ['class' => 'btn green','style'=>'float:right']) }}
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>    

@endcomponent
@endsection



@push('plugins')
<!-- Datatables Plugins -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<!-- Utoastr Plugins -->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<!-- Validation Plugins -->
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!-- Select2 Scripts -->
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<!-- FileInput Scripts -->
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<!-- Local Scripts -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script>
	jQuery(document).ready(function () {
		App.unblockUI();
		var table, url,columns;
		table = $('#lista-anteproyecto');
		url = "{{ route('anteproyecto.juryList') }}";

		columns=[
			{data: 'DT_Row_Index',name:"DT_Row_Index"},
			{data: 'anteproyecto.PK_NPRY_IdMinr008',name:"PK_NPRY_IdMinr008", "visible": false },
			{data: function (data, type, dataToSet) {
				if(data.anteproyecto.proyecto!=null){
					return "PROYECTO"
				}else{
					return "ANTEPROYECTO"
				}
			},name:"Tipo",searchable: true},
			{data: 'NPRY_Titulo',name:"NPRY_Titulo", searchable: true},
			{data: 'anteproyecto.NPRY_Keywords',name:"NPRY_Keywords", className:'none',searchable: true},
			{data: 'anteproyecto.NPRY_Duracion',name:"NPRY_Duracion",className:'none',searchable: true},
			{data: 'anteproyecto.NPRY_FechaR',name:"NPRY_FechaR", className:'none',searchable: true},
			{data: 'anteproyecto.NPRY_FechaL',name:"NPRY_FechaL", className:'none',searchable: true},
			{data: 'anteproyecto.radicacion.RDCN_Min',name:"RDCN_Min",
			 render: function (data, type, full, meta) 
			 {
				 return '<a class="document" href="{{ route('download.documento') }}/'+data+'">DESCARGAR MIN</a>';
			 }, className:'none'
			},
			{data: 'anteproyecto.radicacion.RDCN_Requerimientos',name:"RDCN_Requerimientos",searchable: true,
			 render: function (data, type, full, meta) 
			 {
				 if(data=="NO FILE"){
					 return "NO APLICA";    
				 }else{
					 return '<a class="document" href="{{ route('download.documento') }}/'+data+'">DESCARGAR REQUERIMIENTOS</a>';    
				 }  
			 }, className:'none'
			}, 
			{data:  function (data, type, dataToSet) {
				if(data.anteproyecto.director[0]!=null)
					return data.anteproyecto.director[0].usuarios.name + " " + data.anteproyecto.director[0].usuarios.lastname;
				else
					return "No hay asignado"
					},name:"director",className:'none',searchable: true},
			{data: function (data, type, dataToSet) {
				if(data.anteproyecto.estudiante1[0]!=null)
					return data.anteproyecto.estudiante1[0].usuarios.name + " " + data.anteproyecto.estudiante1[0].usuarios.lastname;
				else
					return "No hay asignado"
					},name:"estudiante1",className:'none',searchable: true},
			{data: function (data, type, dataToSet) {
				if(data.anteproyecto.estudiante2[0]!=null)
					return data.anteproyecto.estudiante2[0].usuarios.name + " " + data.anteproyecto.estudiante2[0].usuarios.lastname;
				else
					return "No hay asignado"
					}, name:"estudiante2",className:'none',searchable: true},
			{data: function (data, type, dataToSet) {
				if(data.anteproyecto.jurado1[0]!=null)
					return data.anteproyecto.jurado1[0].usuarios.name + " " + data.anteproyecto.jurado1[0].usuarios.lastname;
				else
					return "No hay asignado"
					}, name:"jurado1",className:'none',searchable: true},
			{data: function (data, type, dataToSet) {
				if(data.anteproyecto.jurado2[0]!=null)
					return data.anteproyecto.jurado2[0].usuarios.name + " " + data.anteproyecto.jurado2[0].usuarios.lastname;
				else
					return "No hay asignado"
					},name:"jurado2",className:'none',searchable: true},
			{data: 'anteproyecto.concepto_final',render: "[, ].conceptos.CNPT_Concepto","visible": false },
			{data: 'NPRY_Estado',searchable: true,name:'Estado'},
			{data:"PK_NPRY_idMinr008",
			 name:'action',
			 title:'Acciones',
			 orderable: false,
			 searchable: false,
			 exportable: false,
			 printable: false,
			 responsivePriority:2,
			 className: '',   
			 render: function ( data, type, full, meta ) {
				 if(full.anteproyecto.proyecto!=null){
					 if(full.anteproyecto.proyecto.PRYT_Estado=="TERMINADO"){
						 return '<span class="label label-sm label-success">Proyecto Terminado</span>';
					 }
				 }

				 return '@permission("CREATE_OBSERVATIONS_GESAP")<a href="{{ route('proyecto.aprobado') }}'+'/'+data+'" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-commenting"> </i></a>@endpermission @permission("CREATE_CONCEPT_GESAP")<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-check"></i></a>@endpermission';
			 }

			}
		];

		dataTableServer.init(table, url, columns);
		table = table.DataTable();
		table.on('click', '.edit', function (e) {
			e.preventDefault();
			$tr = $(this).closest('tr');
			var dataTable = table.row($tr).data();
			$('input[name="PK_anteproyecto"]').val(dataTable.anteproyecto.PK_NPRY_IdMinr008);

			if(dataTable.anteproyecto.concepto_final[0].conceptos!=null){
				$('select[name="concepto"]').val(dataTable.anteproyecto.concepto_final[0].conceptos.CNPT_Concepto);
			}else{
				$('select[name="concepto"]').val("0");
			}
			$('#modal-create-concept').modal('toggle');
		});

		var createConcept = function () {
			return{
				init: function () {
					var route = '{{ route('anteproyecto.guardar.conceptos') }}';
					var type = 'POST';
					var async = async || false;

					var formData = new FormData();
					formData.append('concepto', $('select[name="concepto"]').val());
					formData.append('user', $('input[name="user"]').val());
					formData.append('PK_anteproyecto', $('input[name="PK_anteproyecto"]').val());

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
								table.ajax.reload();
								$('#modal-create-concept').modal('hide');
								$('#from_concept_create')[0].reset(); //Limpia formulario
								UIToastr.init(xhr , response.title , response.message  );
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
		var form_edit = $('#from_concept_create');
		var rules_edit = {
			concepto: {required: true}
		};
		FormValidationMd.init(form_edit,rules_edit,false,createConcept());

		table.on('click', '.create', function (e) {
			e.preventDefault();
			$tr = $(this).closest('tr');
			var dataTable = table.row($tr).data();
			$('input[name="PK_anteproyecto"]').val(dataTable.anteproyecto.PK_NPRY_IdMinr008);
			$('#title').html(dataTable.anteproyecto.NPRY_Titulo);
			$('#modal-create-observation').modal('toggle');
		});

		var createObservation = function () {
			return{
				init: function () {
					var route = '{{ route('anteproyecto.guardar.observaciones') }}';
					var type = 'POST';
					var async = async || false;

					var formData = new FormData();
					formData.append('observacion', $('#observacion').val());
					formData.append('user', $('input[name="user"]').val());
					formData.append('PK_anteproyecto', $('input[name="PK_anteproyecto"]').val());
					var FileMin =  document.getElementById("Min");
					if ($('#Min').get(0).files.length === 0) {
						formData.append('Min', "Vacio");  
					}else{
						formData.append('Min', FileMin.files[0]);    
					};
					var FileReq =  document.getElementById("Requerimientos");
					if ($('#Requerimientos').get(0).files.length === 0) {
						formData.append('Requerimientos', "Vacio");  
					}else{
						formData.append('Requerimientos', FileReq.files[0]);    
					};
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
								table.ajax.reload();
								$('#modal-create-observation').modal('hide');
								$('#form-register-obser')[0].reset(); //Limpia formulario
								UIToastr.init(xhr , response.title , response.message  );
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
		var form_create = $('#form-register-obser');
		var rules_create = {
			observacion:{required: true,minlength: 10,maxlength:600},
			Min:{extension: "txt|pdf|doc|docx"},
			requerimientos:{extension: "txt|pdf|doc|docx"}
		};
		FormValidationMd.init(form_create,rules_create,false,createObservation());

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
							App.unblockUI('.portlet-form');
						}else{
							var a = document.createElement('a');
							a.href = uri;
							a.click();
							window.URL.revokeObjectURL(uri); 
							App.unblockUI('.portlet-form');
						}
					}
				},
				error: function (response, xhr, request) {
					if (request.status === 422 &&  xhr === 'error') {
						UIToastr.init(xhr, response.title, response.message);
						App.unblockUI('.portlet-form');
					}
				}
			});
			return false; 
		}); 
	});

	$('.select2-selection--single').addClass('form-control');
	var form = $('#from_concept_create');
	/*Configuracion de Select*/
	$.fn.select2.defaults.set("theme", "bootstrap");
	$(".pmd-select2").select2({
		placeholder: "Selecccionar",
		allowClear: true,
		width: 'auto',
		escapeMarkup: function (m) {
			return m;
		}
	});
	$('.pmd-select2', $form).change(function () {
		$form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
	}); 
</script>
@endpush
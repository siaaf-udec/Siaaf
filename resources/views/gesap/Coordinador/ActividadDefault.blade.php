@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Actividades')

@section('page-title', 'Actividades')


@section('content')
<div class="col-md-12">
	@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'Lista de Actividades'])
	<div class="clearfix"> </div><br><br><br>    
	<div class="row">

		<div class="col-md-12">
			<div class="actions">
				<a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a></div>
		</div>
		<div class="clearfix"> </div><br>
		<div class="col-md-12">
			@component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-actividad'])
			@slot('columns', [
			'#' => ['style' => 'width:20px;'],
			'id',
			'Nombre',
			'Descripcion',
			'Acciones'
			])
			@endcomponent
		</div>
	</div>
	@endcomponent
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

					<div class="modal-header modal-header-success">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h1><i class="glyphicon glyphicon-plus"></i> Añadir Actividad predeterminada</h1>
					</div>	
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								{!! Field::textarea('nombre', null, 
								['label'=>'Nombre', 'required', 'auto' => 'off','rows' => '5','max' => '50', 'min' => '5','id'=>'nombre'],
								[ 'help'=>'Nombre de actividad','icon' => 'fa fa-user']) !!}
							</div>
							<div class="col-md-12">
								{!! Field::textarea('descripcion', null, 
								['label'=>'Descripción','required', 'auto' => 'off','rows' => '1','max' => '100', 'min' => '1','id'=>'descripcion'],
								[ 'help'=>'Descripcion','icon' => 'fa fa-book']) !!}
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

<!--MODAL EDITAR ACTIVIDAD-->
<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12">
		<!-- Modal -->
		<div class="modal fade" id="modal-edit-activity" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					{!! Form::open(['id' => 'from_edit-activity', 'class' => '', 'url' => '/forms']) !!}
					{!! Field::hidden('PK_CTVD_IdActividad') !!}

					<div class="modal-header modal-header-success">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h1><i class="glyphicon glyphicon-pencil"></i> Editar actividad predeterminada</h1>
					</div>	
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								{!! Field::textarea('nombre', null, 
								['label'=>'Nombre', 'required', 'auto' => 'off','rows' => '1','max' => '50', 'min' => '5','id'=>'nombreUpdate'],
								[ 'help'=>'Nombre de actividad','icon' => 'fa fa-user']) !!}
							</div>
							<div class="col-md-12">
								{!! Field::textarea('descripcion', null, 
								['label'=>'Descripción','required', 'auto' => 'off','rows' => '3','max' => '100', 'min' => '1','id'=>'descripcionUpdate'],
								[ 'help'=>'Descripcion','icon' => 'fa fa-book']) !!}
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

@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<!-- Validation Plugins -->
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!-- toastr Scripts -->
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<!-- identicon Plugins -->
<script src="{{ asset('assets/global/plugins/stewartlord-identicon/identicon.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/stewartlord-identicon/pnglib.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<!--Local Scripts-->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script>
	jQuery(document).ready(function () 
						   {
		var table, url,columns;
		table = $('#lista-actividad');
		url = "{{ route('actividad.default.list') }}";

		columns=[
			{data: 'DT_Row_Index',name:'DT_Row_Index'},
			{data: 'PK_CTVD_IdActividad',name:'PK_CTVD_IdActividad', "visible": false },
			{data: 'CTVD_Nombre',name:'CTVD_Nombre', searchable: true},
			{data: 'CTVD_Descripcion',name:'CTVD_Descripcion', searchable: true},
			{
				defaultContent: '@permission("EDIT_ACTIVITY_DEFAULT_GESAP")<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>@endpermission @permission("DELETE_ACTIVITY_DEFAULT_GESAP")<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission',
				data:'action',
				name:'action',
				title:'Acciones',
				orderable: false,
				searchable: false,
				exportable: false,
				printable: false,
				className: 'text-right',
				render: null,
				responsivePriority:2
			}
		];

		dataTableServer.init(table, url, columns);
		$('.create').on('click', function (e) {
			e.preventDefault();
			$('#modal-create-activity').modal('toggle');
		});

		var createActivity = function () {
			return{
				init: function () {
					var route = '{{ route('nueva.actividad') }}';
					var type = 'POST';
					var async = async || false;

					var formData = new FormData();
					formData.append('nombre', $('#nombre').val());
					formData.append('descripcion', $('#descripcion').val());

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
								$('#modal-create-activity').modal('hide');
								$('#from_create-activity')[0].reset(); //Limpia formulario
								UIToastr.init(xhr , response.title , response.message  );
								App.unblockUI('.portlet-form');
							}},
						error: function (response, xhr, request) {
							if (request.status === 422 &&  xhr === 'error') {
								UIToastr.init(xhr, response.title, response.message);
								App.unblockUI('.portlet-form');
							}}
					});
				}
			}
		};

		var form = $('#from_create-activity');
		var rules = {
			nombre: {required: true,minlength: 5,maxlength:50},
			descripcion: {required: true,minlength: 1,maxlength:100}
		};
		FormValidationMd.init(form,rules,false,createActivity());
		table = table.DataTable(); 	
		table.on('click', '.edit', function (e) {
			e.preventDefault();
			$tr = $(this).closest('tr');
			var dataTable = table.row($tr).data();
			$('input[name="PK_CTVD_IdActividad"]').val(dataTable.PK_CTVD_IdActividad);
			$('#nombreUpdate').val(dataTable.CTVD_Nombre);
			$('#descripcionUpdate').val(dataTable.CTVD_Descripcion);
			$('#modal-edit-activity').modal('toggle');
		});

		var updateActivity = function () {
			return{
				init: function () {
					var route = '{{ route('editar.actividad') }}';
					var type = 'POST';
					var async = async || false;

					var formData = new FormData();
					formData.append('PK_CTVD_IdActividad', $('input[name="PK_CTVD_IdActividad"]').val());
					formData.append('nombre', $('#nombreUpdate').val());
					formData.append('descripcion', $('#descripcionUpdate').val());

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
								$('#modal-edit-activity').modal('hide');
								$('#from_edit-activity')[0].reset(); //Limpia formulario
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
		var form_edit = $('#from_edit-activity');
		FormValidationMd.init(form_edit,rules,false,updateActivity());	

		table.on('click', '.remove', function (e) {
			e.preventDefault();
			$tr = $(this).closest('tr');
			var o = table.row($tr).data();
			var route = '{{route('activity.default.destroy')}}/'+o.PK_CTVD_IdActividad;
			var type = 'DELETE';
			var async = async || false;
			swal({
				title: "¿Esta seguro?",
				text: "¿Esta seguro de eliminar la actividad seleccionada?",
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
						beforeSend: function () {
							App.blockUI({target: '.portlet-form', animate: true});
						},
						success: function (response, xhr, request) {
							if (request.status === 200 && xhr === 'success') {
								table.ajax.reload();
								UIToastr.init(xhr, response.title, response.message); 
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
					swal.close();
				} else {
					swal("Cancelado", "No se eliminó ninguna actividad", "error");
				}
			});
		});
	});
</script>
@endpush
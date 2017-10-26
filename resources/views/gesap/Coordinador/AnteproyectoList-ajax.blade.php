<div class="col-md-12">
	@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'Lista de Anteproyectos'])
	<div class="row">
		<div class="col-md-6">
			<div class="btn-group">
				@permission('Create_Project_Gesap')
				<a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>
				@endpermission
			</div>
		</div>
		<div class="clearfix"> </div><br><br>
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

	<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function () {
			var table, url;
            table = $('#lista-anteproyecto');
            url = "{{ route('anteproyecto.list') }}";

            table.DataTable({
				lengthMenu: [
					[5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Todo"]
                ],
                responsive: true,
                colReorder: true,
                processing: true,
                serverSide: true,
                ajax: url,
                searching: true,
                language: 
                {
                    "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": 
                    {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": 
                    {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                columns:[
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
						 return '<a href="{{ route('download.documento') }}/'+data+'">DESCARGAR MIN</a>';
					 }
                    },
                    {data: 'radicacion.RDCN_Requerimientos',className:'none',searchable: true,
					 render: function (data, type, full, meta) {
						 if(data=="NO FILE"){
							 return "NO APLICA";    
						 }else{
							 return '<a href="{{ route('download.documento') }}/'+data+'">DESCARGAR REQUERIMIENTOS</a>';    
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
								 return '@permission("Modify_Project_Gesap")<a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#"><i class="icon-pencil"></i></a> @permission("Assign_teacher_Gesap")<a href="#" class="btn btn-simple btn-success btn-icon assign"><i class="icon-users"></i></a>@endpermission @permission("Delete_Project_Gesap")<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission';
                             }else{
                                 if (full.proyecto.PRYT_Estado=="TERMINADO") {
                                     return '<span class="label label-sm label-success">Proyecto Terminado</span>';
                                 } else {
                                    return '@permission("Assign_teacher_Gesap")<a href="#" class="btn btn-simple btn-success btn-icon assign"><i class="icon-users"></i></a>@endpermission<span class="label label-sm label-success">Proyecto en curso</span>'; 
                                 } 
                             }
                         }else{
                             return '@permission("Modify_Project_Gesap")<a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#"><i class="icon-pencil"></i></a>@endpermission @permission("Assign_teacher_Gesap")<a href="#" class="btn btn-simple btn-success btn-icon assign"><i class="icon-users"></i></a>@endpermission @permission("Delete_Project_Gesap")<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission';
						 }
					 }, 
					}
				],
                buttons: [
                    { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
                    { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
                    { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',exportOptions: {columns: ':visible'}},
                    { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
                    { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
                    { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
                    {text: '<i class="fa fa-refresh"></i>', className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
                        action: function ( e, dt, node, config ) {
                            dt.ajax.reload();
                        }
                    }
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            });
    
            $( ".create" ).on('click', function (e) {
				e.preventDefault();
                var route = '{{ route('min.create') }}';
                $(".content-ajax").load(route);
            });
            
            table = table.DataTable();
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = table.row($tr).data();
				$.ajax({
					type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function (data) {
					route = '{{ route('min.edit') }}'+'/'+O.PK_NPRY_IdMinr008;
					$(".content-ajax").load(route);
                });
            });
    
            table.on('click', '.assign', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = table.row($tr).data();
	           	$.ajax({
                    type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function (data) {
                    route = '{{ route('anteproyecto.asignar') }}'+'/'+O.PK_NPRY_IdMinr008;
					$(".content-ajax").load(route);
                });
            });
            
            table.on('click', '.remove', function (e) {
				e.preventDefault();
				$tr = $(this).closest('tr');
				var O = table.row($tr).data();
				var route = 'min/'+O.PK_NPRY_IdMinr008;
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
		});
    </script>
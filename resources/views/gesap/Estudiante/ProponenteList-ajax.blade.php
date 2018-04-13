<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'Proyectos'])
        <div class="row">
        
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
                    'Min',
                    'Requerimientos',
                    'Director',
                    'Estudiante 1',
                    'Estudiante 2',
                    'Jurado 1',
                    'Jurado 2',
                    'Estado',
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
		url = "{{ route('anteproyecto.studentList') }}";

		columns=[
			  {data: 'DT_Row_Index'},
			   {data: 'anteproyecto.PK_NPRY_IdMinr008', "visible": false },
			   {data: 'NPRY_Titulo', searchable: true},
			   {data: 'anteproyecto.NPRY_Keywords', searchable: true},
			   {data: 'anteproyecto.NPRY_Duracion',searchable: true},
			   {data: 'anteproyecto.NPRY_FechaR', className:'none',searchable: true},
			   {data: 'anteproyecto.NPRY_FechaL', className:'none',searchable: true},
			   {data: 'anteproyecto.radicacion.RDCN_Min',className:'none',
							render: function (data, type, full, meta) 
							{
								return '<a class="document" href="{{ route('download.documento') }}/'+data+'">DESCARGAR MIN</a>';
							}
						},
						{data: 'anteproyecto.radicacion.RDCN_Requerimientos',className:'none',searchable: true,
							render: function (data, type, full, meta) 
							{
								if(data=="NO FILE"){
									return "NO FILE";    
								}else{
									return '<a class="document" href="{{ route('download.documento') }}/'+data+'">DESCARGAR REQUERIMIENTOS</a>';    
								}  
							}
						}, 
			   {data:  function (data, type, dataToSet) {
							if(data.anteproyecto.director[0]!=null)
								return data.anteproyecto.director[0].usuarios.name + " " + data.anteproyecto.director[0].usuarios.lastname;
							else
								return "No hay asignado"
						},className:'none',searchable: true},

						{data: function (data, type, dataToSet) {
							if(data.anteproyecto.estudiante1[0]!=null)
								return data.anteproyecto.estudiante1[0].usuarios.name + " " + data.anteproyecto.estudiante1[0].usuarios.lastname;
							else
								return "No hay asignado"
						},className:'none',searchable: true},
						{data: function (data, type, dataToSet) {
							if(data.anteproyecto.estudiante2[0]!=null)
							return data.anteproyecto.estudiante2[0].usuarios.name + " " + data.anteproyecto.estudiante2[0].usuarios.lastname;
							else
								return "No hay asignado"
						}, className:'none',searchable: true},
						{data: function (data, type, dataToSet) {
							if(data.anteproyecto.jurado1[0]!=null)
							return data.anteproyecto.jurado1[0].usuarios.name + " " + data.anteproyecto.jurado1[0].usuarios.lastname;
							else
								return "No hay asignado"
						}, className:'none',searchable: true},
						{data: function (data, type, dataToSet) {
							if(data.anteproyecto.jurado2[0]!=null)
							return data.anteproyecto.jurado2[0].usuarios.name + " " + data.anteproyecto.jurado2[0].usuarios.lastname;
							else
								return "No hay asignado"
						},className:'none',searchable: true},
			   {data: 'NPRY_Estado',searchable: true},
						  {data:'action',
				 className:'',searchable: false,
				name:'action',
				title:'Acciones',
				orderable: false,
				exportable: false,
				printable: false,
				responsivePriority:2,
				render: function ( data, type, full, meta ) {
					if(full.anteproyecto.proyecto!=null){
						return '@permission("SEE_OBSERVATIONS_GESAP")<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-eye"></i></a>@endpermission @permission("SEE_ACTIVITY_GESAP")<a href="#" class="btn btn-simple btn-success btn-icon create"><i class="icon-list"></i></a>@endpermission';
					}else{
						return '@permission("SEE_OBSERVATIONS_GESAP")<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-eye"></i></a>@endpermission';
					}
					 },
				}
		   ];
		
		dataTableServer.init(table, url, columns);
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
				route = '{{ route('evaluar.show') }}'+'/'+o.anteproyecto.PK_NPRY_IdMinr008;
				$(".content-ajax").load(route);
			});
		});

		table.on('click', '.create', function (e) {
			e.preventDefault();
			$tr = $(this).closest('tr');
			var o = table.row($tr).data();
			$.ajax({
				type: "GET",
				url: '',
				dataType: "html",

			}).done(function (data) {
				route = '{{ route('proyecto.actividades') }}'+'/'+o.anteproyecto.PK_NPRY_IdMinr008;
				$(".content-ajax").load(route);
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
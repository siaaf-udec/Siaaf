@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Gestion Funcionarios')

@section('page-title', 'Gestion Funcionarios')

@section('page-description', 'ver, modificar, eliminar y crear nuevos funcionarios.')

@section('content')
	<div class="col-md-12">
		@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-users', 'title' => 'Gestion Funcionarios'])
            @include('audiovisuals.funcionario.modal')
			<div class="clearfix"> </div><br><br><br>
			<div class="row">
				<div class="col-md-12">

					@component('themes.bootstrap.elements.tables.datatables', ['id' => 'gestionar-funcionarios-ajax'])
						@slot('columns', [
                                '#' => ['style' => 'width:20px;'],
                                'Cedula',
                                'Nombres',
                                'Correo',
                                'Programa',
                                'Acciones' => ['style' => 'width:90px;']
                            ])
					@endcomponent
				</div>
			</div>
		@endcomponent
	</div>
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

@endpush

@push('functions')
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {
    //UIToastr.init('success', 'Bien', 'Correcto');
	var table, url, columns;
	table = $('#gestionar-funcionarios-ajax');
	url = "{{ route('funcionario.listing') }}";

	columns = [
        {data: 'DT_Row_Index'},
        {data: 'PK_FNS_Cedula', name: 'Cedula'},
        {data: 'FNS_Nombres', name: 'Nombres'},
        {data: 'FNS_Correo', name: 'Correo Electronico'},
        {data: 'FK_FNS_Programa', name: 'Programa'},
        {
            defaultContent: '<a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#myModal"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
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

    table = table.DataTable();
    table.on('click', '.remove', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var dataTable = table.row($tr).data();

        alert(dataTable.PK_FNS_Cedula);

        $.get( "../../audiovisuales/funcionario/all/"+ dataTable.PK_FNS_Cedula, function( data ) {
            console.log(data);
            //table.ajax.reload();
        });
    });
    table.on('click', '.edit', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var dataTable = table.row($tr).data();
        // alert(dataTable.PK_FNS_Cedula);
        $.get( "../../audiovisuales/funcionario/all/"+ dataTable.PK_FNS_Cedula, function( data ) {
            console.log(data);
            //table.ajax.reload();
            $("#FNS_Nombres").val(data.FNS_Nombres);
            $("#FNS_Apellidos").val(data.FNS_Apellidos);
            $("#id").val(data.PK_FNS_Cedula);
            $("#PK_FNS_Cedula").val(data.PK_FNS_Cedula);
            $("#FNS_Correo").val(data.FNS_Correo);
            $("#FNS_Telefono").val(data.FNS_Telefono);
            $("#FNS_Direccion").val(data.FNS_Direccion);
            $("#FK_FNS_Estado").val(data.FK_FNS_Estado);
            $("#FK_FNS_Programa").val(data.FK_FNS_Programa);
            $("#FNS_Clave").val(data.FNS_Clave);

            // PARA SELECCIONAR LA OPCION DE RADIO
            if (data.FK_FNS_Rol=='Estudiante'){
                    $("input[name=FK_FNS_Rol][value='Estudiante']").prop("checked",true);
            }else {
                        $("input[name=FK_FNS_Rol][value='Docente']").prop("checked",true);
            }
        });
        $("#actualizar").click(function(){
              
                var value = $("#id").val();
                var fns = $("#form_funcionario");
                var route = "{{ route('funcionario.editar', ['id' => '1070977299']) }}";
                var token = $("#token").val();


              $.ajax({
                url: route,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'PUT',
                    dataType: 'json',
                    data:$(fns).serialize(),
                success: function(){

                  
                  $("#myModal").modal('toggle');// OCULTAR MODAL

                  //$("#msj-success-actualizar").fadeIn();//MENSAJE
                  
                }
              });
        }); 
    });
    /*$('#ipdate').on('click', function(){
        var id = $('#id_usu').val();
    });*/
     

});
</script>
@endpush
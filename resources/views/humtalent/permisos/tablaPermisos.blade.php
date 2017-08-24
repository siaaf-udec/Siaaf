@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Consulta de Permisos')

@section('page-title', 'Consulta  y registro de permisos :')

@section('content')
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-offset-1 col-md-10">
                <br><br>
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                    <thead>
                    <th>Número de Cedula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    </thead>
                    <tbody>
                    <td>{{$empleado->PK_PRSN_Cedula}}</td>
                    <td>{{$empleado->PRSN_Nombres}}</td>
                    <td>{{$empleado->PRSN_Apellidos}}</td>
                    <td>{{$empleado->PRSN_Telefono}}</td>
                    <td>{{$empleado->PRSN_Correo}}</td>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Permisos registrado:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-permisos'])
                        @slot('columns', [
                            '#',
                            'Descripción',
                            'Fecha',
                            'Acciones'
                        ])
                    @endcomponent
                </div>
            </div>

        <!-- Modal -->
            <div class="modal fade" id="modal-create-permission" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_permission_create', 'method'=>'POST', 'route'=> ['talento.humano.permisos.store']]) !!}
                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-thumbs-up"></i> Regitro de permisos o incapacidades</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula,['id'=>'FK_TBL_Persona_Cedula']) !!}

                                    {!! Field::textarea(
                                        'PERM_Descripcion',
                                        ['label' => 'Descripción del permiso o incapacidad', 'max' => '300', 'min' => '2', 'auto' => 'off'],
                                        ['help' => 'Ingrese la Descripción del permiso a registrar']) !!}
                                    {!! Field::date('PERM_Fecha',
                                                   ['label'=>'Fecha del permiso o incapacidad','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                   ['help' => 'Seleccione la fecha del permiso o incapacidad.', 'icon' => 'fa fa-calendar']) !!}
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
            <!-- Modal -->
            <div class="modal fade" id="modal-update-permission" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_permission_update', 'method'=>'POST', 'route'=> ['talento.humano.permisos.update']]) !!}
                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-thumbs-up"></i> Edición de permisos o incapacidades</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula,['id'=>'FK_TBL_Persona_Cedula']) !!}
                                    {!! Field::hidden('PK_PERM_IdPermiso') !!}
                                    {!! Field::text(
                                        'PERM_Descripcion',
                                        ['label' => 'Descripción del permiso o incapacidad', 'max' => '300', 'min' => '2', 'auto' => 'off'],
                                        ['help' => 'Ingrese la Descripción del permiso a registrar']) !!}
                                    {!! Field::date('PERM_Fecha',
                                                   ['label'=>'Fecha del permiso o incapacidad','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                   ['help' => 'Seleccione la fecha del permiso o incapacidad.', 'icon' => 'fa fa-calendar']) !!}
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
        @endcomponent
    </div>
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {
        @if(Session::has('message'))
            var type="{{Session::get('alert-type','info')}}"
            switch(type){
                case 'success':
                    toastr.options.closeButton = true;
                    toastr.success("{{Session::get('message')}}",'Registro exitoso:');
                    break;
            }
        @endif
        var cedula=$('input[id="FK_TBL_Persona_Cedula"]').val();
        var table, url,columns;
        table = $('#lista-permisos');
        url = '{{ route('talento.humano.permisos.consultaPermisos')}}'+'/'+cedula;
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PERM_Descripcion', name: 'Descripción'},
            {data: 'PERM_Fecha', name: 'Fecha'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-primary edit" ><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
                data:'action',
                name:'action',
                title:'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority:2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('talento.humano.permisos.destroy') }}'+'/'+dataTable.PK_PERM_IdPermiso;
            var type = 'DELETE';
            var async = async || false;
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
                    if (request.status === 422 &&  xhr === 'success') {
                        UIToastr.init(xhr, response.title, response.message);
                    }
                }
            });
        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input[name="PK_PERM_IdPermiso"]').val(dataTable.PK_PERM_IdPermiso);
            $('input[name="PERM_Descripcion"]').val(dataTable.PERM_Descripcion);
            $('input[name="PERM_Fecha"]').val(dataTable.PERM_Fecha);
            $('#modal-update-permission').modal('toggle');
        });

        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            $('#modal-create-permission').modal('toggle');
        });
    });
</script>
@endpush
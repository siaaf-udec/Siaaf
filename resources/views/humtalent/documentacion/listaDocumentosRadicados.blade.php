
@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Consulta de Documentación')

@section('page-title', 'Consulta de la documentación entregada por los empleados :')

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
                @if($estado == 'Afiliado')
                    <h4>Fecha de afiliación: {{$fecha}}</h4>
                @endif
                <br>
                <br>
            </div>
        </div>
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => ''])
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-empleados'])
                        @slot('columns', [
                            '#',
                            'Documento',
                            'Fecha'
                        ])
                    @endcomponent
                </div>
            </div>
            {!! Field::hidden('cedula',$id,['id'=>'cedula']) !!}
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
        var cedula=$('input[id="cedula"]').val();
        var table, url,columns;
        table = $('#lista-empleados');
        url = '{{ route('talento.humano.historialDocumentos.documentosRadicados')}}'+'/'+cedula;
        columns = [
            {data: 'DT_Row_Index'},
            {data: "documentacion_personas.DCMTP_Nombre_Documento", name: 'Documento'},
            {data: 'EDCMT_Fecha', name: 'Fecha'},

        ];
        dataTableServer.init(table, url, columns);

    });
</script>
@endpush
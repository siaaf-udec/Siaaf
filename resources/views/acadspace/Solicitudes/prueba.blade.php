@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" /><link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('title', '| Dashboard')

@section('page-title', 'PROYECTOS REGISTRADOS')

@section('page-description', 'Listado de anteproyectos y proyectos registrados')

@section('content')
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Portlet'])
<div class="row">
    <div class="col-md-12">
        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-anteproyecto'])

        @slot('columns', [
        ' ',
        'id',
        'Nucleo',
        'Guia',
        'created_at',
        'updated_at'
        ])
        @endcomponent
    </div>
</div>

@endcomponent
@endsection



@push('plugins')
<!--HANDLEBAR-->
<script src="{{ asset('assets/main/acadspace/js/handlebars.js') }}"></script>
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')

<script id="details-template" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td>Full name:</td>
            <td>@{{SOL_Guia_Practica}}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>@{{SOL_Software}}</td>
        </tr>
        <tr>
            <td>Comentario:</td>
            <td>@{{comentario}}</td>
        </tr>
        <tr>
            <td>Sala asignada:</td>
            <td>@{{id_sala}}</td>
        </tr>
    </table>
</script>
<script>
    jQuery(document).ready(function () {
        var template = Handlebars.compile($("#details-template").html());

        var table = $('#lista-anteproyecto').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('espacios.academicos.espacad.pruebat') }}",
            columns: [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "searchable":     false,
                    "data":           null,
                    "defaultContent": '<a href="javascript:;" class="btn blue" data-toggle="confirmation"><i class="glyphicon glyphicon-zoom-in"></i></a>'
                },
                {data: 'PK_SOL_id_solicitud', name: 'id'},
                {data: 'SOL_Guia_Practica', name: 'Nucleo'},
                {data: 'SOL_Software', name: 'Guia'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'}
            ]
        });

        // Add event listener for opening and closing details
        $('#lista-anteproyecto tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( template(row.data()) ).show();
                tr.addClass('shown');
            }
        });
    });
</script>
@endpush
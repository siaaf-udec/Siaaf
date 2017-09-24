@extends('material.layouts.dashboard')

@section('page-title', 'Solicitudes realizadas:')
@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <div class="col-md-12">
        <div class="row ui-sortable" id="sortable_portlets">
            <div class="col-md-12">
                <div class="portlet portlet-sortable light bordered portlet-form" style="display: block;">
                    <table class="display" id="mis_solicitudes">
                        <thead>
                            <th></th>
                            <th>Nucleo</th>
                            <th>Grupo</th>
                            <th>N Estudiantes</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </thead>
                        <tbody>
                            @foreach($solicitudes as $solicitud)
                            <tr></tr>
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$solicitud->SOL_nucleo_tematico}}</td>
                                    <td>{{$solicitud->SOL_grupo}}</td>
                                    <td>{{$solicitud->SOL_cant_estudiantes}}</td>
                                    @if($solicitud->SOL_estado==0)
                                        <td>Por consultar</td>
                                    @endif
                                    @if($solicitud->SOL_estado==1)
                                        <td>Aprobada</td>
                                    @endif
                                    @if($solicitud->SOL_estado==2)
                                        <td>Rechazada</td>
                                    @endif
                                    <td>boton</td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>


                </div>
                <!-- empty sortable porlet required for each columns! -->
                <div class="portlet portlet-sortable-empty"> </div>
            </div>
        </div>

    </div>
@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script type="text/javascript">
    $(document).ready(function() {
        var dt = $('#mis_solicitudes').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "scripts/ids-objects.php",
            "columns": [
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { "data": "SOL_nucleo_tematico" },
                { "data": "SOL_grupo" },
                { "data": "SOL_cant_estudiantes" },
                { "data": "SOL_estado" }
            ],
            "order": [[1, 'asc']]
        } );

        // Array to track the ids of the details displayed rows
        var detailRows = [];

        $('#example tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );
                row.child( format( row.data() ) ).show();

                // Add to the 'open' array
                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        } );

        // On each draw, loop over the `detailRows` array and show any child rows
        dt.on( 'draw', function () {
            $.each( detailRows, function ( i, id ) {
                $('#'+id+' td.details-control').trigger( 'click' );
            } );
        } );
    } );
 </script>
@endpush

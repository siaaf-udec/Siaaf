@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet"
      type="text/css"/>
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('title', '| Información del parqueadero')

@section('page-title', 'Parqueadero Universidad De Cundinamarca Extensión Facatativá:')

@section('content')
    @permission('FUNC_CARPARK')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Motocicletas dentro de la Universidad:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission('CREATE_INGRESO_CARPARK') <a href="javascript:;"
                                                                 class="btn btn-simple btn-success btn-icon create">
                            <i class="fa fa-plus">
                            </i>Acción
                        </a>@endpermission
                        @permission('REPORT_INGRESO_CARPARK')<a href="javascript:;"
                                                                class="btn btn-simple btn-success btn-icon reports"
                                                                title="Reporte"><i
                                    class="glyphicon glyphicon-list-alt"></i>Reporte
                            de Ingresos</a><br>@endpermission
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaMotosDentro'])
                        @slot('columns', [
                            '#',
                            'Nombre Usuario',
                            'Código Usuario',
                            'Placa',                            
                            'Código Motocicleta'
                        ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>
    @endpermission
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
        type="text/javascript"></script>

@endpush
@push('functions')
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {

        var table, url, columns;
        table = $('#listaMotosDentro');
        url = "{{ route('parqueadero.ingresosCarpark.tablaMotosDentro')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CI_NombresUser', name: 'Nombre Usuario'},
            {data: 'CI_CodigoUser', name: 'Código Usuario'},
            {data: 'CI_Placa', name: 'Placa'},
            {data: 'CI_CodigoMoto', name: 'PK_CI_IdIngreso'}
        ];
        dataTableServer.init(table, url, columns);

        $(".create").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.ingresosCarpark.create') }}';
            $(".content-ajax").load(route);
        });

        $(".reports").on('click', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            $.ajax({}).done(function () {
                window.open('{{ route('parqueadero.reportesCarpark.ReporteMotosDentro') }}', '_blank');
            });
        });


    });
</script>
@endpush